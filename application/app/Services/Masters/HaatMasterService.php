<?php

namespace App\Services\Masters;

use App\Services\Service;
use Illuminate\Support\Facades\Auth;
use App\Models\Masters\HaatDetailsMaster as HaatMasterModel;
use App\Models\Masters\HaatOperatingDaysMapping as HaatOperatingDayModel;
use App\Models\Masters\HaatBlocksMapping as HaatBlockModel;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Builder;
use App\Rules\UniqueHaatBazaarMaster;
use App\Queries\HaatbazaarQuery;

class HaatMasterService extends Service
{
    private $haatbazaarQuery;

    public function __construct(HaatbazaarQuery $haatbazaarQuery = null) {
        $this->haatbazaarQuery = $haatbazaarQuery;
    }
    /**
     * Get all items from database
     *
     * @return mixed
     */
    public function getAll()
    {
        return HaatMasterModel::all();
    }


    public function getHaatMasterListing($request)
    {
                 
        $columns = array( 
                        0 =>'id', 
                        1=> 'state_id',
                        2=> 'district_id',
                        3=> 'haat_id',
                        4=> 'block_id',
                        5=> 'operating_days',
                        6=> 'nature_of_operation'
            );
        $limit = isset($request['length'])?$request['length']:10;
        

        $order = isset($request['order'][0]['column'])?$columns[$request['order'][0]['column']]:'id';
        $dir = isset($request['order'][0]['dir'])?$request['order'][0]['dir']:'DESC';
        $query = $this->haatbazaarQuery->viewAllQuery();

        $search = isset($request['search']['value'])?$request['search']['value']:''; 
      
        $query= $query->orderBy($order,$dir);
      
        if(isset($search) && !empty($search))
        {
            // $query->where(DB::raw("CONCAT(`botanical_name`,`local_name`,' ',`msp_price`)"), 'LIKE', "%".$search."%");

        }
        if(isset($request['state']) && !empty($request['state']))
        {
            $query->where('state_id', $request['state']);
        }
        if(isset($request['district']) && !empty($request['district']))
        {
            $query->where('district_id', $request['district']);
        }
        // dd($request);
        if(isset($request['haat']) && !empty($request['haat']))
        {
            $query->where('haat_bazaar_id', $request['haat']);
        }
        if(isset($request['operating_days']) && !empty($request['operating_days']))
        {
            $operating_days= $request['operating_days'];
            $query->whereHas('operating_days', function (Builder $query) use ($operating_days) {
                if($operating_days)
                {
                   $query->whereIn('operating_day',$operating_days);    
                }
            });
        }
        if(isset($request['nature_of_operation']) && !empty($request['nature_of_operation']))
        {
            $query->where('nature_of_operation', $request['nature_of_operation']);
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
        $item = new HaatMasterModel($data);
        $item->save();
        return $item;
    }

     /**
     * Creates a new item in table
     *
     * @param Array $data
     * @return mixed
     */
    public function createHaatBlocks($data)
    {
        $item = new HaatBlockModel($data);
        $item->save();
        return $item;
    }
     /**
     * Creates a new item in table
     *
     * @param Array $data
     * @return mixed
     */
    public function createHaatOperatingDays($data)
    {
        $item = new HaatOperatingDayModel($data);
        $item->save();
        return $item;
    }
    /**
     * Get a single item from database
     *
     * @param number $id
     * @return mixed
     */
    public function getOne($id)
    {
        return HaatMasterModel::findOrFail($id);
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
        $item = HaatMasterModel::findOrFail($id);
        //echo $data['haatbazaar'][0]['state'];die;
        $item->state_id = $data['haatbazaar'][0]['state'];
        $item->district_id = $data['haatbazaar'][0]['district'];
        $item->haat_bazaar_id = $data['haatbazaar'][0]['haat_bazaar'];
        $item->nature_of_operation = $data['haatbazaar'][0]['nature_of_operation'];
        $item->updated_by = Auth::user()->id;
        // $item->updated_at = 
        
        $item->save();
        
        $block = HaatBlockModel::where('haat_detail_id',$id);
        $block->delete();
     
        foreach( $data['haatbazaar'][0]['block'] as  $block_id){
            $insert_data = array( 'haat_detail_id'=> $id,
                                  'block_id'=>(int) $block_id );
            $this->createHaatBlocks($insert_data);
        }

        $operating_day = HaatOperatingDayModel::where('haat_detail_id',$id);
        $operating_day->delete();

        foreach($data['haatbazaar'][0]['operating_day'] as  $operating_day_row){
            $insert_data = array( 'haat_detail_id'=> $id,
                                  'operating_day'=>$operating_day_row );

            $this->createHaatOperatingDays($insert_data);
        }

        return $item;
    }

    // /**
    //  * Delete an item from database
    //  *
    //  * @param integer $id
    //  * @return boolean
    //  */
    // public function deleteItem($id)
    // {
    //     $item = RoleModel::findOrFail($id);
    //     return $item->delete();
    // }

    /**
     * Validates for updating a record in databse
     *
     * @param integer $id
     * @param Array $data
     * @return mixed
     */
    public function validateCreate($data){
    
        $model = new HaatMasterModel();
        return Validator::make($data, [
            'form_id'=>'nullable|exists:haat_bazaar_master,id',
            'haatbazaar.*.state'=> [
                'required'
                //,'exists:mysql2.states_master,id',
                
            ],
            'haatbazaar.*.district' => 'required','exists:mysql2.districts_master,id',
            'haatbazaar.*.haat_bazaar*' => [
                'required','exists:mysql2.haat_bazaar_form_mapping,id','distinct',
                new UniqueHaatBazaarMaster($data)
            ],
            'haatbazaar.*.block.*' => 'required',
            'haatbazaar.*.operating_day.*' => 'required',
            'haatbazaar.*.nature_of_operation'=> 'required'
        ],
        [
            'haatbazaar.*.state'=>'Please provide state',
            'haatbazaar.*.district' => 'Please provide district',
            'haatbazaar.*.haat_bazaar*' => 'Please provide haat bazaar',
            'haatbazaar.*.block.*' => 'Please provide block',
            'haatbazaar.*.operating_day.*' => 'Please provide operating day',
            'haatbazaar.*.nature_of_operation'=> 'Please provide nature of operation'
        ]);
    }

    /**
     * Validates for updating a record in databse
     *
     * @param integer $id
     * @param Array $data
     * @return mixed
     */
    public function validateUpdate($id, $data){
    
        $model = new HaatMasterModel();
        return Validator::make($data, [
            'haatbazaar.*.state'=> [
                'required',
                
            ],
            'haatbazaar.*.district' => 'required',
            'haatbazaar.*.haat_bazaar*' => 'required',
            'haatbazaar.*.block.*' => 'required',
            'haatbazaar.*.operating_day.*' => 'required',
            'haatbazaar.*.nature_of_operation'=> 'required'
        ],
        [
            'haatbazaar.*.state'=>'Please provide state',
            'haatbazaar.*.district' => 'Please provide district',
            'haatbazaar.*.haat_bazaar*' => 'Please provide haat bazaar',
            'haatbazaar.*.block.*' => 'Please provide block',
            'haatbazaar.*.operating_day.*' => 'Please provide operating day',
            'haatbazaar.*.nature_of_operation'=> 'Please provide nature of operation'
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
        $model = HaatMasterModel::where([
            'id' => $id
        ])->firstOrFail();
        $model->switchStatus();
        $model->save();
        return $model->status;
    }
}
