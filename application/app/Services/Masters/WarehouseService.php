<?php

namespace App\Services\Masters;

use App\Services\Service;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use App\Models\Masters\WarehouseMaster as ServiceModel;
use App\Models\Masters\WarehouseMasterBlocks;
use App\Models\Masters\District;
use App\Models\Masters\Block;
use App\Queries\WarehouseQuery;
use App\Models\Haatbazaar\HaatBazaarFormMapping;
use App\Models\Warehouse\WarehouseFormMapping;
use App\Rules\UniqueWarehouseMaster;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use DB;
class WarehouseService extends Service
{   
    private $warehouseQuery;

    public function __construct(WarehouseQuery $warehouseQuery = null) {
        $this->warehouseQuery = $warehouseQuery;
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
                    6=> 'storage_capacity',
            );
        $limit = isset($request['length'])?$request['length']:10;
        

        $order = isset($columns[$request['order'][0]['column']])?$columns[$request['order'][0]['column']]:'id';
        $dir = isset($request['order'][0]['dir'])?$request['order'][0]['dir']:'DESC';
        $query=$this->warehouseQuery->viewAllQuery();
        $query=$query->orderBy($order,$dir);
        if(isset($request['state_id']) && !empty($request['state_id']))
        {
            $query->where('state_id', $request['state_id']);
        }
        if(isset($request['district_id']) && !empty($request['district_id']))
        {
            $query->where('district_id', $request['district_id']);
        }
        if(isset($request['warehouse']) && !empty($request['warehouse']))
        {
            $query->where('warehouse', $request['warehouse']);
        }
        if(isset($request['corresponding_hats']) && !empty($request['corresponding_hats']))
        {
            $query->where('corresponding_hats', $request['corresponding_hats']);
        }
        if(isset($request['blocks']) && !empty($request['blocks']))
        {
            $blocks=$request['blocks'];
            $query->whereHas('getWarehouseBlocks',function (Builder $query) use($blocks){
                $query->where('block_id', $blocks);
            });
        }

        if(isset($request['search']['value']) && !empty($request['search']['value']))
        {
            $search = $request['search']['value'];         
            $query->where(DB::raw("CONCAT(`storage_type`,`storage_capacity`)"), 'LIKE', "%".$search."%");
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
            $warehouse_data=array();
            $user_id=Auth::user()->id;    
            
            foreach ($data['warehouse'] as $key => $row) 
            {
                $warehouse_data['state_id']=$row['state'];
                $warehouse_data['district_id']=$row['district'];
                $warehouse_data['warehouse']=$row['warehouse'];
                $warehouse_data['corresponding_hats']=$row['corresponding_hats'];
                $warehouse_data['storage_type']=$row['storage_type'];
                $warehouse_data['storage_capacity']=$row['storage_capacity'];
                $warehouse_data['created_by']=$user_id;
                $warehouse_data['updated_by']=$user_id;

                $item = new ServiceModel($warehouse_data);
                $item->save();    

                /*Insert blocks Now               */
                $warehouse_block_data=array();
                foreach ($row['block'] as $key => $value) 
                {
                    $warehouse_block_data['warehouse_id']=$item->id;
                    $warehouse_block_data['block_id']=$value;
                    $warehouse_block_data['created_by']=$user_id;
                    $warehouse_block_data['updated_by']=$user_id;
                    $block_data=new WarehouseMasterBlocks($warehouse_block_data);
                    $block_data->save();    
                }
                
            }

            

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
            $warehouse_data=array();
            $user_id=Auth::user()->id;    
            
            foreach ($data['warehouse'] as $key => $row) 
            {
                $item = ServiceModel::findOrFail($id);
                $item->state_id=$row['state'];
                $item->district_id=$row['district'];
                $item->warehouse=$row['warehouse'];
                $item->corresponding_hats=$row['corresponding_hats'];
                $item->storage_type=$row['storage_type'];
                $item->storage_capacity=$row['storage_capacity'];
                $item->updated_by=$user_id;

                $item->save();    

                /*Insert blocks Now               */
                $warehouse_block_data=array();
                WarehouseMasterBlocks::where('warehouse_id', $item->id)->delete();
                foreach ($row['block'] as $key => $value) 
                {
                    $warehouse_block_data['warehouse_id']=$item->id;
                    $warehouse_block_data['block_id']=$value;
                    $warehouse_block_data['created_by']=$user_id;
                    $warehouse_block_data['updated_by']=$user_id;
                    $block_data=new WarehouseMasterBlocks($warehouse_block_data);
                    $block_data->save();    
                }
                
            }

            

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
        $messages=$this->validation_messages($data);
        return Validator::make($data, [
            'form_id'=>'nullable|exists:warehouse_master,id',
            'warehouse.*.state' => [
                'required','exists:mysql2.states_master,id',
            ],
            'warehouse.*.district' => [
                'required','exists:mysql2.districts_master,id',
            ],
            'warehouse.*.warehouse' => [
                'required','exists:mysql2.warehouse_form_mapping,id','distinct',
                
                /*Rule::unique('warehouse_master')->where(function ($query) use($data) {
                    $res= $query->where(['state_id'=> 23]);
                    //dd($res);die;
                }),*/
                new UniqueWarehouseMaster($data)
            ],
            'warehouse.*.block.*' => [
                'required','exists:mysql2.blocks_master,id',
            ],
            'warehouse.*.corresponding_hats' => [
                'required','exists:mysql2.haat_bazaar_form_mapping,id',
            ],
            'warehouse.*.storage_type' => [
                'required','in:Cold,Dry',
            ],
            'warehouse.*.storage_capacity' => [
                'required','numeric',
            ],

            
        ],$messages);
    }

    public function validation_messages($data)
    {
        $i=0;
        if(!empty($data['warehouse']))
        {
            $messages=array();
            foreach ($data['warehouse'] as $key => $row) 
            {
                ++$i;
                $row_message=" in ".$this->ordinal_suffix($i)." record";
                $messages['warehouse.'.$key.'.state.required']="Please select state $row_message";
                $messages['warehouse.'.$key.'.district.required']="Please select district $row_message";
                $messages['warehouse.'.$key.'.warehouse.required']="Please select warehouse $row_message";
                $messages['warehouse.'.$key.'.warehouse.distinct']="duplicate warehouse  $row_message";
                $messages['warehouse.'.$key.'.block.required']="Please select block $row_message";
                $messages['warehouse.'.$key.'.corresponding_hats.required']="Please select corresponding hats $row_message";
                $messages['warehouse.'.$key.'.storage_type.required']="Please select storage type $row_message";
                $messages['warehouse.'.$key.'.storage_capacity.numeric']="Please enter number in storage type $row_message";
            }
        }
        
        return $messages;
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
            'image' => 'nullable|mimes:pdf,jpeg,jpg|max:20480',
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
    
    public function getWarehouseHaatmarket($request)
    {
        
        $haat_data=HaatBazaarFormMapping::where('status','1')
        ->whereHas('getPartOne', function (Builder $query) use ($request) {
            if(isset($request['state_id']) && !empty($request['state_id']))
            {
                $query->where('state',$request['state_id']);    
            }
            if(isset($request['district_id']) && !empty($request['district_id']))
            {
                $query->where('district_id',$request['district_id']);    
            }  
        })
        ->with(
            [
                'getPartOne' => function ($query) {
                    $query->select(['id','rpm_name']);
                }
            ]
        )
        ->get();
        
        
        $warehouse_data=WarehouseFormMapping::where('status','1')
            ->whereHas('getPartOne', function (Builder $query) use ($request) {
            if(isset($request['state_id']) && !empty($request['state_id']))
            {
                $query->where('state',$request['state_id']);    
            }
            if(isset($request['district_id']) && !empty($request['district_id']))
            {
                $query->where('district',$request['district_id']);    
            }
        })
        ->with(
            [
                'getPartOne' => function ($query) {
                    $query->select(['id','name']);
                }
            ]
        )
        ->get();

        //$block_data=Block::where(['district_id'=>$request['district_id'],'status'=>'1'])->get();
        $district_ids=District::where(['state_id'=>$request['state_id'],'status'=>'1'])->pluck('id');
        $block_data=Block::whereIn('district_id',$district_ids)->where('status','1')->get();

        return [
            'haat_data'=>$haat_data,
            'warehouse_data'=>$warehouse_data,
            'block_data'=>$block_data,
        ];
    }
}
