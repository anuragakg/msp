<?php

namespace App\Services\Masters;

use App\Services\Service;

use Illuminate\Support\Facades\Auth;
use App\Models\Masters\Mfp as ServiceModel;
use App\Queries\MfpQuery;
use App\Queries\MfpLogQuery;
use App\Models\Masters\MfpPriceLog;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use DB;
class MfpService extends Service
{   
    private $mfpQuery;
    private $mfpLogQuery;

    public function __construct(MfpQuery $mfpQuery = null,MfpLogQuery $mfpLogQuery=null) {
        $this->mfpQuery = $mfpQuery;
        $this->mfpLogQuery = $mfpLogQuery;
    }

    public function getAllData()
    {
        $query = ServiceModel::all();
        $query->where('status','1');
        return $query;
        
    }
    /**
     * Get all items from database
     *
     * @return mixed
     */
    public function getAll($request)
    {
        $columns = array( 
                    0 =>'id', 
                    1=> 'state_id',
                    3=> 'botanical_name',
                    4=> 'local_name',
                    5=> 'msp_price',
            );
        $limit = isset($request['length'])?$request['length']:10;
        

        $order = isset($columns[$request['order'][0]['column']])?$columns[$request['order'][0]['column']]:'id';
        $dir = isset($request['order'][0]['dir'])?$request['order'][0]['dir']:'DESC';
        $query=$this->mfpQuery->viewAllQuery();
        $query=$query->orderBy($order,$dir);
        if(isset($request['state_id']) && !empty($request['state_id']))
        {
            $query->where('state_id', $request['state_id']);
        }
        if(isset($request['mfp_id']) && !empty($request['mfp_id']))
        {
            $query->where('mfp_id', $request['mfp_id']);
        }
        if(isset($request['search']['value']) && !empty($request['search']['value']))
        {
            $search = $request['search']['value'];         
            $query->where(DB::raw("CONCAT(`botanical_name`,`local_name`,' ',`msp_price`)"), 'LIKE', "%".$search."%");
        }
        if(isset($request['page']) && !empty($request['page']))
        {
            return $query->paginate($limit);    
        }else{
            $query=$query->where('status','1');
            return $query->get();
        }
        
    }

    /**
     * Creates a new item in table
     *
     * @param Array $data
     * @return mixed
     */
    public function createItem($data)
    {
        DB::beginTransaction();
        try {
            $user_id=Auth::user()->id;    
            $check_unique=ServiceModel::where(['state_id'=>$data['state_id'],'mfp_id'=>$data['mfp_name']])->first();
            if(!empty($check_unique))
            {
                throw new \Exception("This MFP is already existed for same state.");
            }
            $mfpData['state_id'] = $data['state_id'];
            $mfpData['mfp_id'] = $data['mfp_name'];
            $mfpData['botanical_name'] = $data['botanical_name'];
            $mfpData['local_name'] = $data['local_name'];
            $mfpData['msp_price'] = $data['msp_price'];
            
            $mfpData['status'] = 1; // By default status is 1.
            $mfpData['created_by'] = $user_id;
            $mfpData['updated_by'] = $user_id;
            $mfpData['image']=isset($data['image'])?$data['image']:'';

            $item = new ServiceModel($mfpData);
            $item->save();



            $mfpLogData['form_id'] = $item->id;
            $mfpLogData['state_id'] = $data['state_id'];
            $mfpLogData['mfp_id'] = $data['mfp_name'];
            $mfpLogData['botanical_name'] = $data['botanical_name'];
            $mfpLogData['local_name'] = $data['local_name'];
            $mfpLogData['msp_price'] = $data['msp_price'];
            
            $mfpLogData['status'] = 1; // By default status is 1.
            $mfpLogData['created_by'] = $user_id;
            $mfpLogData['updated_by'] = $user_id;
            if(isset($data['image'])){
                $mfpLogData['image']=isset($data['image'])?$data['image']:'';        
            }

            $mfp = new MfpPriceLog($mfpLogData);
            $mfp->save();
            DB::commit();

            return ServiceModel::where([
                'id' => $item->id
            ])->firstOrFail();
            
        }catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
    }

    /**
     * Get a single item from database
     *
     * @param number $id
     * @return mixed
     */
    public function getOne($id)
    {
        return ServiceModel::findOrFail($id);
    }

    /**
     * Update one item from database
     *
     * @param number $id
     * @param Array $data
     * @return mixed
     */
    public function updateItem($id, $data)
    {
        DB::beginTransaction();
        try {
            $check_unique=ServiceModel::where(['state_id'=>$data['state_id'],'mfp_id'=>$data['mfp_name']])->where('id','!=',$id)->first();
            if(!empty($check_unique))
            {
                throw new \Exception("This mfp is already existed for same state");
            }
            $item = ServiceModel::findOrFail($id);

            $user_id=Auth::user()->id;    
            $item->state_id = $data['state_id'];
            $item->mfp_id = $data['mfp_name'];


            $item->botanical_name = $data['botanical_name'];
            $item->local_name = $data['local_name'];
            $item->msp_price = $data['msp_price'];
            
            $item->status = 1; // By default status is 1.
            $item->updated_by = $user_id;
            if(isset($data['image'])){
                $item->image=isset($data['image'])?$data['image']:'';        
            }
            

            $item->save();   



            $mfpLogData['form_id'] = $id;
            $mfpLogData['state_id'] = $data['state_id'];
            $mfpLogData['mfp_id'] = $data['mfp_name'];
            $mfpLogData['botanical_name'] = $data['botanical_name'];
            $mfpLogData['local_name'] = $data['local_name'];
            $mfpLogData['msp_price'] = $data['msp_price'];
            
            $mfpLogData['status'] = 1; // By default status is 1.
            $mfpLogData['created_by'] = $user_id;
            $mfpLogData['updated_by'] = $user_id;
            if(isset($data['image'])){
                $mfpLogData['image']=isset($data['image'])?$data['image']:'';        
            }

            $mfp = new MfpPriceLog($mfpLogData);
            $mfp->save();
            DB::commit();
            return $item;       
        }catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
        

        return $item;
    }

    /**
     * Delete an item from database
     *
     * @param integer $id
     * @return boolean
     */
    public function deleteItem($id)
    {
        $item = ServiceModel::findOrFail($id);
        $item->deleteDistricts();
       
        return $item->delete();
    }

    /**
     * Validates for creating a record.
     *
     * @param Array $data
     * @return mixed
     */
    public function validateCreate($data)
    {
        return Validator::make($data, [
            'form_id'=>'nullable|exists:mfp_master,id',
            'state_id' => [
                'required','exists:mysql2.states_master,id',
            ],
            'mfp_name' => [
                'required','exists:mysql2.commodity_master,id',
            ],
            'botanical_name' => [
                'required','string','alpha_spaces',
                /*Rule::unique('mfp_master')->where(function ($query) use($data) {
                    
                    $where['state_id']=$data['state_id'];
                    $where['mfp_id']=$data['mfp_name'];
                    $where['botanical_name']=$data['botanical_name'];

                    $query= $query->where($where);    
                    if(isset($data['form_id']) && !empty($data['form_id']))
                    {
                        $query= $query->where('id','!=',$data['form_id']);    
                    }
                    return $query;
                }),*/
            ],
            'local_name' => [
                'required','string','alpha_spaces',
            ],
            'msp_price' => [
                'required','numeric'
            ],
            'image' => 'nullable|mimes:png,jpeg,jpg|max:20480',
        ],
        [
            'image.max' => 'Image size should not be greater than 20 MB',
            'msp_price.numeric' => 'MSP Price must be a number',
            
        ]);
    }

    /**
     * Validates for updating a record in databse
     *
     * @param integer $id
     * @param Array $data
     * @return mixed
     */
    public function validateUpdate($id, $data)
    {
        return Validator::make($data, [
            'state_id' => [
                'required','exists:mysql2.states_master,id',
            ],
            'mfp_name' => [
                'required','exists:mysql2.commodity_master,id',
            ],
            'botanical_name' => [
                'required','string','alpha_spaces',
            ],
            'local_name' => [
                'required','string','alpha_spaces',
            ],
            'msp_price' => [
                'required','numeric'
            ],
            'image' => 'nullable|mimes:png,jpeg,jpg|max:20480',
        ],
        [
            'image.max' => 'Image size should not be greater than 20 MB',
        ]);
    }

    /**
     * Switch the status of the given user id.
     *
     * @param integer $id
     * @return string|integer
     */
    public function switchStatus($id)
    {
        $model = ServiceModel::where([
            'id' => $id
        ])->firstOrFail();
        $model->switchStatus();
        $model->save();
        return $model->status;
    }    
    
    public function getMfpLogs($request)
    {
        $columns = array( 
                    0 =>'id', 
                    1=> 'state_id',
                    3=> 'botanical_name',
                    4=> 'local_name',
                    5=> 'msp_price',
            );
        $limit = isset($request['length'])?$request['length']:10;
        

        $order = isset($columns[$request['order'][0]['column']])?$columns[$request['order'][0]['column']]:'id';
        $dir = isset($request['order'][0]['dir'])?$request['order'][0]['dir']:'DESC';
        $query=$this->mfpLogQuery->viewAllQuery();
        $query=$query->orderBy($order,$dir);
        if(isset($request['state_id']) && !empty($request['state_id']))
        {
            $query->where('state_id', $request['state_id']);
        }
        if(isset($request['mfp_id']) && !empty($request['mfp_id']))
        {
            $query->where('mfp_id', $request['mfp_id']);
        }
        if(isset($request['search']['value']) && !empty($request['search']['value']))
        {
            $search = $request['search']['value'];         
            $query->where(DB::raw("CONCAT(`botanical_name`,`local_name`,' ',`msp_price`)"), 'LIKE', "%".$search."%");
        }
        if(isset($request['page']) && !empty($request['page']))
        {
            return $query->paginate($limit);    
        }else{
            $query=$query->where('status','1');
            return $query->get();
        }
        
    }    
}
