<?php

namespace App\Services\Proposals;

use App\Http\Resources\Api\Proposals\MfpSeasionalityQuarterWiseResource;
use App\Models\Proposals\Mfp_procurementPlan; 
use App\Models\Proposals\Mfp_coverage;
use App\Models\Proposals\Mfp_procurement_commodity; 
use App\Models\Proposals\Mfp_procurement_commodity_history; 
use App\Models\Proposals\Mfp_procurement_storage; 
use App\Models\Proposals\Mfp_storage_haat; 
use App\Models\Proposals\Mfp_seasonality;
use App\Models\Proposals\Mfp_seasonality_commodity;
use App\Models\Masters\HaatBlocksMapping;
use App\Models\Proposals\Mfp_procurement;
use App\Models\Proposals\Mfp_procurement_collection_level;
use App\Models\Proposals\Mfp_coverage_haat_block;
use App\Models\Masters\Mfp;
use App\Services\Service;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;
use DB;
use Helper;
class MfpProcurementPlanService extends Service
{   
    
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
            $mfp_coverage_data=array();
            $user_id=Auth::user()->id;   
             if(isset($data['submit_type']) && $data['submit_type']=='submit')
            {
                $is_draft='0';    
            }else{
                $is_draft='1';    
            }
           // $is_draft=isset($data['draft']) ? '1':'0';        
            $procurement=new Mfp_procurementPlan();  
            $procurement->year_id=$data['year_id'];
            $procurement->mfp_procurement_id=$data['form_id']; //
            $procurement->is_draft=$is_draft;
            $procurement->created_by=$user_id;
            $procurement->updated_by=$user_id;            
            $procurement->save();     

            if(isset($data['mfp_procurement']) && !empty($data['mfp_procurement']))
            { 
            Mfp_procurement_commodity::where('procurement_id', $procurement->id)->delete(); 
                foreach ($data['mfp_procurement'] as $key => $row) 
                {   
                    $mfp_storage=new Mfp_procurement_commodity();
                    $mfp_storage->mfp_procurement_id=$data['form_id'];
                    $mfp_storage->procurement_id=$procurement->id;
                    $mfp_storage->commodity_id=isset($row['commodity'])?$row['commodity']:null;
                    $mfp_storage->haat=isset($row['haat'])?$row['haat']:null;
                    $mfp_storage->blocks=isset($row['blocks'])?$row['blocks']:null;
                    $mfp_storage->lastqty=isset($row['lastqty'])?$row['lastqty']:null;
                    $mfp_storage->lastval=isset($row['lastval'])?$row['lastval']:null;
                    $mfp_storage->currentqty=isset($row['currentqty'])?$row['currentqty']:null;
                    $mfp_storage->currentval=isset($row['currentval'])?$row['currentval']:null;
                    $mfp_storage->created_by=$user_id;
                    $mfp_storage->updated_by=$user_id;
                    $mfp_storage->save();
                }    
            }


            if(isset($data['mfp_procurement']) && !empty($data['mfp_procurement']))
            { 
            //Mfp_procurement_commodity_history::where('procurement_id', $data['step2_id'])->forceDelete(); 
                foreach ($data['mfp_procurement'] as $key => $row) 
                {   
                    $mfp_storage=new Mfp_procurement_commodity_history();
                    $mfp_storage->mfp_procurement_id=$data['form_id'];                    
                    $mfp_storage->procurement_id=$data['step2_id'];
                    $mfp_storage->mfp_seasonality_id=$row['mfp_seasonality_id']; 
                    $mfp_storage->year_id=$data['year_id']-1; 
                    $mfp_storage->commodity_id=isset($row['commodity'])?$row['commodity']:null;
                    $mfp_storage->haat=isset($row['haat'])?$row['haat']:null;
                    $mfp_storage->blocks=isset($row['blocks'])?$row['blocks']:null;
                    $mfp_storage->qty=isset($row['lastqty'])?$row['lastqty']:null;
                    $mfp_storage->val=isset($row['lastval'])?$row['lastval']:null; 
                    $mfp_storage->created_by=$user_id;
                    $mfp_storage->updated_by=$user_id;


                    //if allredy exst (unset())
                    $mfp_storage->save();
                }    
            }
            
            if(isset($data['mfp_storage']) && !empty($data['mfp_storage']))
            { 
            Mfp_procurement_storage::where('procurement_id', $procurement->id)->delete(); 
            $mfp_coverage=Mfp_coverage::where(['mfp_procurement_id' => $data['form_id']])->get();
            //yha mfp seasonality commodity se quantity nikalenge aur ek array me rakh dnge mfp wise
            $mfp_seasonality_commodity=Mfp_seasonality_commodity::where(['mfp_procurement_id' => $data['form_id']])->get();
            $mfp_coverage_mfp_ids=array();
            
            foreach ($mfp_coverage as $key => $coverage) {
                $mfp_coverage_mfp_ids[$coverage->mfp_id]=$coverage->mfp_id;
            }
            $mfp_storage_mfp_ids=array();
            $mfp_storage_mfp_qty=array();
            $mfp_seasonality_mfp_qty=array();
            if(!empty($mfp_seasonality_commodity))
            {
                foreach ($mfp_seasonality_commodity as $key => $seasonality) {
                    if(isset($mfp_seasonality_mfp_qty[$seasonality->mfp_id]))
                    {
                           $mfp_seasonality_mfp_qty[$seasonality->mfp_id]=$mfp_seasonality_mfp_qty[$seasonality->mfp_id]+$seasonality->qty;     
                    }else{
                        $mfp_seasonality_mfp_qty[$seasonality->mfp_id]=$seasonality->qty;
                    }
                }    
            }
            
            foreach ($data['mfp_storage'] as $key => $row) 
            {
                if(isset($mfp_storage_mfp_qty[$row['mfp_name']]))
                {
                       $mfp_storage_mfp_qty[$row['mfp_name']]=$mfp_storage_mfp_qty[$row['mfp_name']]+$row['estimated_storage'];     
                }else{
                    $mfp_storage_mfp_qty[$row['mfp_name']]=$row['estimated_storage'];
                }
                $mfp_storage_mfp_ids[$row['mfp_name']]=$row['mfp_name'];
            }
            
            if(count($mfp_storage_mfp_ids) != count($mfp_coverage_mfp_ids))
            {
                throw new \Exception("Please select all MFP which were selected in first step");   
            }
            
                foreach ($data['mfp_storage'] as $key => $row) 
                {   
                    if(!in_array($row['mfp_name'], $mfp_coverage_mfp_ids))
                    {
                        throw new \Exception("Please select all MFP which were selected in first step");   
                    }
                    $mfp_id=$row['mfp_name'];
                    if(isset($mfp_storage_mfp_qty[$mfp_id]) && isset($mfp_seasonality_mfp_qty[$mfp_id]))
                    {
                        if($mfp_storage_mfp_qty[$mfp_id] > $mfp_seasonality_mfp_qty[$mfp_id])
                        {
                            
                            $quantity=$mfp_seasonality_mfp_qty[$mfp_id];
                            $mfp_data=Mfp::where('id',$mfp_id)->first();
                            $mfp_name=$mfp_data->getMfpName->title;

                            throw new \Exception("Please do not enter estimated storage of $mfp_name more than $quantity");      
                        }    
                    }
                    
                    $mfp_storage=new Mfp_procurement_storage();
                    $mfp_storage->mfp_procurement_id=$data['form_id'];                    
                    $mfp_storage->procurement_id=$procurement->id;
                    $mfp_storage->mfp_name=isset($row['mfp_name'])?$row['mfp_name']:null;
                    $mfp_storage->warehouse=isset($row['warehouse'])?$row['warehouse']:null;
                    $mfp_storage->storage_type=isset($row['storage_type'])?$row['storage_type']:null;
                    $mfp_storage->warehouse_type=isset($row['warehouse_type'])?$row['warehouse_type']:null;
                    $mfp_storage->storage_capacity=isset($row['storage_capacity'])?$row['storage_capacity']:null; 
                    $mfp_storage->estimated_storage=isset($row['estimated_storage'])?$row['estimated_storage']:null;
                    $mfp_storage->is_draft=$is_draft;
                    $mfp_storage->created_by=$user_id;
                    $mfp_storage->updated_by=$user_id;
                    $mfp_storage->save();
                    if(isset($row['haat']) && !empty($row['haat']))
                    { Mfp_storage_haat::where('mfp_storage_id', $mfp_storage->id)->delete(); 
                        foreach ($row['haat'] as $haat_key => $haat) 
                        {
                            $mfp_storage_haat=new Mfp_storage_haat();
                            $mfp_storage_haat->mfp_storage_id=$mfp_storage->id;
                            $mfp_storage_haat->mfp_procurement_id=$data['form_id']; 
                            $mfp_storage_haat->haat=$haat; 
                            $mfp_storage_haat->save();
                        }
                    }
                }    
            }
 
            DB::commit();
            return Mfp_procurementPlan::where([
                'id' => $procurement->id
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
        return Mfp_procurementPlan::where('mfp_procurement_id', $id)->first(); 
    }
public function getAnother($id)
    {    
        $mfp_procurement_id = Mfp_procurement::where('ref_id',$id)->first(); 
        return Mfp_procurementPlan::where('mfp_procurement_id', $mfp_procurement_id['id'])->firstOrFail(); 
    }
    /**
     * Update one item from database
     *
     * @param number $id
     * @param Array $data
     * @return mixed
     */
    public function updateItem($id, $data)
    {  //die();
        DB::beginTransaction();
        //try { 
            $user_id=Auth::user()->id;   
            $procurement = Mfp_procurement::where('id', $id)->firstOrFail();
            if(isset($data['submit_type']) && $data['submit_type']=='submit')
            {
                $is_draft='0';    
                $procurement->is_step2_complete = 1;
                $procurement->save();
            }else{
                $is_draft='1';    
            } 
            if(isset($data['mfp_procurement']) && !empty($data['mfp_procurement']))
            { 
            
            $procurement_plan=Mfp_procurementPlan::where('mfp_procurement_id', $id)->first();         
            Mfp_procurement_commodity::where('mfp_procurement_id', $id)->forceDelete(); 
                foreach ($data['mfp_procurement'] as $key => $row) 
                {   
                    $mfp_storage=new Mfp_procurement_commodity();
                    $mfp_storage->mfp_procurement_id=$id;
                    $mfp_storage->procurement_id=$procurement_plan->id;
                    $mfp_storage->mfp_seasonality_id=$row['mfp_seasonality_id']??null; 
                    $mfp_storage->commodity_id=isset($row['commodity'])?$row['commodity']:null;
                    $mfp_storage->haat=isset($row['haat'])?$row['haat']:null;
                    $mfp_storage->blocks=isset($row['blocks'])?$row['blocks']:null;
                    $mfp_storage->lastqty=isset($row['lastqty'])?$row['lastqty']:null;
                    $mfp_storage->lastval=isset($row['lastval'])?$row['lastval']:null;
                    $mfp_storage->currentqty=isset($row['currentqty'])?$row['currentqty']:null;
                    $mfp_storage->currentval=isset($row['currentval'])?$row['currentval']:null; 
                    $mfp_storage->created_by=$user_id;
                    $mfp_storage->updated_by=$user_id;
                    $mfp_storage->save();
                }    
            }
            $mfp_seasonality_commodity=Mfp_seasonality_commodity::where(['mfp_procurement_id' => $id])->get();
            $mfp_storage_mfp_qty=array();
            $mfp_seasonality_mfp_qty=array();
            if(!empty($mfp_seasonality_commodity))
            {
                foreach ($mfp_seasonality_commodity as $key => $seasonality) {
                    if(isset($mfp_seasonality_mfp_qty[$seasonality->mfp_id]))
                    {
                           $mfp_seasonality_mfp_qty[$seasonality->mfp_id]=$mfp_seasonality_mfp_qty[$seasonality->mfp_id]+$seasonality->qty;     
                    }else{
                        $mfp_seasonality_mfp_qty[$seasonality->mfp_id]=$seasonality->qty;
                    }
                }    
            }
            
            if(isset($data['mfp_procurement']) && !empty($data['mfp_procurement']))
            { 
            Mfp_procurement_commodity_history::where('mfp_procurement_id', $id)->forceDelete(); 
                foreach ($data['mfp_procurement'] as $key => $row) 
                {   
                    $mfp_storage=new Mfp_procurement_commodity_history();
                    $mfp_storage->mfp_procurement_id=$id;
                    $mfp_storage->procurement_id=$procurement_plan->id;
                    $mfp_storage->mfp_seasonality_id=$row['mfp_seasonality_id']??null; 
                    $mfp_storage->year_id=$data['year_id']-1; 
                    $mfp_storage->commodity_id=isset($row['commodity'])?$row['commodity']:null;
                    $mfp_storage->haat=isset($row['haat'])?$row['haat']:null;
                    $mfp_storage->blocks=isset($row['blocks'])?$row['blocks']:null;
                    $mfp_storage->qty=isset($row['lastqty'])?$row['lastqty']:null;
                    $mfp_storage->val=isset($row['lastval'])?$row['lastval']:null; 
                    $mfp_storage->created_by=$user_id;
                    $mfp_storage->updated_by=$user_id;
                    $mfp_storage->save();
                }    
            }
            foreach ($data['mfp_storage'] as $key => $row) 
            {
                if(isset($mfp_storage_mfp_qty[$row['mfp_name']]))
                {
                       $mfp_storage_mfp_qty[$row['mfp_name']]=$mfp_storage_mfp_qty[$row['mfp_name']]+$row['estimated_storage'];     
                }else{
                    $mfp_storage_mfp_qty[$row['mfp_name']]=$row['estimated_storage'];
                }
                $mfp_storage_mfp_ids[$row['mfp_name']]=$row['mfp_name'];
            }
            if(isset($data['mfp_storage']) && !empty($data['mfp_storage']))
            { 
                Mfp_procurement_storage::where('mfp_procurement_id', $id)->forceDelete(); 
                foreach ($data['mfp_storage'] as $key => $row) 
                {     


                    $mfp_id=$row['mfp_name'];
                    if(isset($mfp_storage_mfp_qty[$mfp_id]) && isset($mfp_seasonality_mfp_qty[$mfp_id]))
                    {
                        if($mfp_storage_mfp_qty[$mfp_id] > $mfp_seasonality_mfp_qty[$mfp_id])
                        {
                            
                            $quantity=$mfp_seasonality_mfp_qty[$mfp_id];
                            $mfp_data=Mfp::where('id',$mfp_id)->first();
                            $mfp_name=$mfp_data->getMfpName->title;

                            throw new \Exception("Please do not enter estimated storage of $mfp_name more than $quantity");      
                        }    
                    }
                    $mfp_storage=new Mfp_procurement_storage();
                    $mfp_storage->mfp_procurement_id=$id;
                    $mfp_storage->procurement_id=$procurement_plan->id;
                    $mfp_storage->mfp_name=isset($row['mfp_name'])?$row['mfp_name']:null;
                    $mfp_storage->warehouse=isset($row['warehouse'])?$row['warehouse']:null;
                    $mfp_storage->storage_type=isset($row['storage_type'])?$row['storage_type']:null;
                    $mfp_storage->warehouse_type=isset($row['warehouse_type'])?$row['warehouse_type']:null;
                    $mfp_storage->storage_capacity=isset($row['storage_capacity'])?$row['storage_capacity']:null; 
                    $mfp_storage->estimated_storage=isset($row['estimated_storage'])?$row['estimated_storage']:null;
                    $mfp_storage->is_draft=$is_draft;
                    $mfp_storage->created_by=$user_id;
                    $mfp_storage->updated_by=$user_id;
                    $mfp_storage->save();

                    if(isset($row['haat']) && !empty($row['haat']))
                    { Mfp_storage_haat::where('mfp_storage_id', $mfp_storage->id)->delete(); 
                        foreach ($row['haat'] as $haat_key => $haat) 
                        {
                            $mfp_storage_haat=new Mfp_storage_haat();
                            $mfp_storage_haat->mfp_storage_id=$mfp_storage->id;
                            $mfp_storage_haat->mfp_procurement_id=$id; 
                            $mfp_storage_haat->haat=$haat; 
                            $mfp_storage_haat->save();
                        }
                    }
                }    
            }           

            DB::commit();

            return Mfp_procurementPlan::where([
                'id' => $procurement_plan->id
            ])->firstOrFail();
            
       /* }catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }*/
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

    public function validation_messages($data)
    {
        $i = 0;
        if (!empty($data['mfp_storage'])) {
            $messages = array();
            foreach ($data['mfp_storage'] as $key => $row) {
                ++$i;
                $row_message = " in " . $this->ordinal_suffix($i) . " record";
                $messages['mfp_storage.' . $key . '.mfp_name.required'] = "Please select MFP in MFP storage $row_message";
                $messages['mfp_storage.' . $key . '.mfp_name.distinct'] = "Please select unique MFP in MFP storage $row_message";
             
            }
        }
        return $messages;
    }
  
    /**
     * Validates for creating a record.
     *
     * @param Array $data
     * @return mixed
     */
    public function validateCreate($data)
    {
        $required='nullable';
         if(isset($data['submit_type']) && $data['submit_type']=='submit')
        {
            $required='required';
        }
        $messages = $this->validation_messages($data);
        return Validator::make($data, [
            'form_id'=>'nullable',
            'submit_type'=>'required',
            'step2_id'=>'nullable',
            'year_id' => [
                'required','exists:financial_year_master,id',
            ],
            'mfp_storage.*.mfp_name' => [
                $required,'exists:mfp_master,id', 'distinct',
            ],
            'mfp_storage.*.warehouse' => [
                $required,
            ],
            'mfp_storage.*.storage_type' => [
                $required,
            ],
            'mfp_storage.*.warehouse_type' => [
                $required,
            ],
            'mfp_storage.*.storage_capacity' => [
                $required,
            ],           
            'mfp_storage.*.haat.*' => [
                $required,'exists:haat_bazaar_master,id',
            ],
             'mfp_storage.*.estimated_storage' => [
                $required,
            ], 
             'mfp_procurement.*.mfp_seasonality_id' => [
                $required,
            ],
             'mfp_procurement.*.commodity' => [
                $required,//'exists:mfp_master,id',
            ],
             'mfp_procurement.*.haat' => [
                $required,
            ],
            'mfp_procurement.*.blocks' => [
                $required,
            ],
            'mfp_procurement.*.lastqty' => [
                $required,
            ],
            'mfp_procurement.*.lastval' => [
                $required,
            ],
            'mfp_procurement.*.currentqty' => [
                $required,
            ],
            'mfp_procurement.*.currentval' => [
                $required,
            ],
        ],$messages
        );
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
        $messages = $this->validation_messages($data);
        return Validator::make($data, [
           'form_id'=>'nullable',
            'step2_id'=>'nullable',
            'year_id' => [
                'required','exists:financial_year_master,id',
            ],
            'mfp_storage.*.mfp_name' => [
                'required','exists:mfp_master,id','distinct'
            ],
            'mfp_storage.*.warehouse' => [
                'required',
            ],
            'mfp_storage.*.storage_type' => [
                'required',
            ],
            'mfp_storage.*.warehouse_type' => [
                'required',
            ],
            'mfp_storage.*.storage_capacity' => [
                'required',
            ],           
            'mfp_storage.*.haat.*' => [
                'required','exists:haat_bazaar_master,id',
            ],
             'mfp_storage.*.estimated_storage' => [
                'required',
            ], 
              'mfp_procurement.*.mfp_seasonality_id' => [
                'required',
            ],
             'mfp_procurement.*.commodity' => [
                'required','exists:mfp_master,id',
            ],
             'mfp_procurement.*.haat' => [
                'required',
            ],
            'mfp_procurement.*.blocks' => [
                'required',
            ],
            'mfp_procurement.*.lastqty' => [
                'required',
            ],
            'mfp_procurement.*.lastval' => [
                'required',
            ],
            'mfp_procurement.*.currentqty' => [
                'required',
            ],
            'mfp_procurement.*.currentval' => [
                'required',
            ],$messages
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

    public function getAllCommodity($id)
    {     
        $array=array();
        $arrayTwo=array();    
        $user = Auth::user();    
        $mfp_procurement_id=Mfp_procurement::where('ref_id',$id)->first();
        $arrayTwo=array('year_id' =>$mfp_procurement_id['year_id'],'id' => $mfp_procurement_id['id']);
        $mfp_seasonality=Mfp_seasonality::where('mfp_procurement_id',$mfp_procurement_id['id'])->get();
         foreach ($mfp_seasonality as $value) {
            $haat_id= $value['haat_id'];         
            $block=HaatBlocksMapping::where('haat_detail_id',$value['haat_id'])->first();     
            $mfp_seasonality_commodity= Mfp_seasonality_commodity::where('mfp_seasonality_id',$value['id'])->get();

               foreach ($mfp_seasonality_commodity as  $row) {
                $whare= array(      
                       // 'mfp_seasonality_id' =>$row['id'],
                        'year_id' =>$mfp_procurement_id['year_id']-1,
                        'commodity_id' => $row['mfp_id'],
                        'haat' => $haat_id,   
                        'blocks' => $block['block_id'],
                        'created_by' => $user->id,
                    );
                $lastYearVal=0;
                $lastYearQty=0;
                $previd= array();

               // $mfp_history=Mfp_procurement_commodity_history::where($whare)->first(); //single
                $mfp_history=Mfp_procurement_commodity_history::where($whare)->get()->toArray(); //single
                foreach ($mfp_history as $value) {
                    $lastYearVal+=$value['val'];
                    $lastYearQty+=$value['qty'];
                    $previd[] = $value['mfp_procurement_id'];
                }
                $previd = array_unique($previd);
                $oldqty = 0;
                $oldval = 0;
                foreach($previd as $newval){
                    $where= array(   
                    
                        'mfp_procurement_id' =>$newval,
                        'commodity_id' => $row['mfp_id'],
                        'haat' => $haat_id,   
                        'blocks' => $block['block_id'],
                        'created_by' => $user->id,
                    );
                    
                    $prevVals = Mfp_procurement_commodity::where($where)->orderBy('id', 'desc')->first();
                    $oldqty = $prevVals['lastqty']; // $oldqty += $prevVals['lastqty']; 
                    $oldval =$prevVals['lastval'];  // $oldval +=$prevVals['lastval'];
                }
                
                $haat=Mfp_coverage_haat_block::with('getHaat')->select('haat_id')->where('haat_id',$haat_id)->first();
                $block=Mfp_coverage_haat_block::with('getBlock')->select('block_id')->where('block_id',$block['block_id'])->first();
               // print_r($block); die();
                $mfp=Mfp::with('getMfpName')->select('mfp_id')->where('id',$row['mfp_id'])->first();
          if(isset($array[$row['id']]))
         {
             //$array[$row['mfp_id']]['lastqty']   = $array[$row['mfp_id']]['lastqty']+$oldqty;
          //  $array[$row['mfp_id']]['lastval']   = $array[$row['mfp_id']]['lastval']+$oldval;
            $array[$row['id']]['qty']   = $array[$row['id']]['qty']+$row['qty'];
            $array[$row['id']]['val']   = $array[$row['id']]['val']+$row['value'];
         }else
         {  
               $array[$row['id']]= array(
                        'id' => $row['id'],   
                        'haat_id' => $haat_id,   
                        'haat_name' => $haat->getHaat->getHaatBazaarDetail->getPartOne->rpm_name??null,   
                        'block_id' => $block['block_id'],   
                        'block_name' => $block->getBlock->title??null,   
                        'mfp_id' => $row['mfp_id'],
                        'mfp_name' => $mfp->getMfpName->title??null,
                        'year_id' =>$mfp_procurement_id['year_id'],
                        'lastqty' => $oldqty,
                        'lastval' => $oldval,
                        'qty' => $row['qty'],
                        'val' => $row['value'],
                        );
           }
              }
         }  
        foreach ($array as $Val) {  
                  $arrayTwo['result'][]=$Val;
         }    
         return $arrayTwo; 
    }


    public function getResourceData($item)
    {
        $item=json_encode($item);
        $array=  collect(json_decode($item,true));
        return $array->toArray(); 
    }

    public function getCostOfPackagingMaterial($id)
    {
        $final_array = array();
        $mfp_arr = array();
        $capacity_arr = array();
        $qty_arr = array();
        $haat_arr = array();
        $procurement = Mfp_procurement::where('ref_id', $id)->firstOrFail();
        $item = MfpSeasionalityQuarterWiseResource::make($procurement);
        $item = $this->getResourceData($item);
       
        if (isset($item['mfp_seasonality']) && !empty($item['mfp_seasonality'])) {
            foreach ($item['mfp_seasonality'] as $key => $row) {
                if (isset($row['haat_id']) && !empty($row['haat_id'])) {
                    $haat_id = $row['haat_id'];
                    if (isset($row['haat_data']['get_haat_bazaar_detail']['get_part_one']['rpm_name']) && !empty($row['haat_data']['get_haat_bazaar_detail']['get_part_one']['rpm_name'])) {
                        $haat_name[$haat_id] = $row['haat_data']['get_haat_bazaar_detail']['get_part_one']['rpm_name'];
                      
                        if (isset($row['commodity_data']) && !empty($row['commodity_data'])) {

                            foreach ($row['commodity_data'] as $key => $commodity) {
                                if (isset($commodity['mfp_id']) && !empty($commodity['mfp_id'])) {
                                        $mfp_id = $commodity['mfp_id'];
                                        $qty = $commodity['qty'];
                                        $months = $commodity['month'];
                                        $mfp_haat[$mfp_id][] = $haat_id;
                                        if (!empty($months)) {
                                            foreach ($months as $key => $month) {
                                                if (isset($qty_arr[$mfp_id])) {
                                                    $qty_arr[$mfp_id] = $qty_arr[$mfp_id]+ $qty;
                                                } else {
                                                    $qty_arr[$mfp_id] = $qty;
                                                }
                                            }
                                        }
                                
                                }
                            }
                        }
                    }
                }
            }
        }

        $storage_plan_data = Mfp_procurement_storage::where('mfp_procurement_id', $procurement->id)->get();
        //get Mfp wise haats


        if (!empty($storage_plan_data)) {
            foreach ($storage_plan_data as $key => $plan) {
                $collection_data = Mfp_procurement_collection_level::where(['mfp_procurement_id' => $procurement->id, 'mfp_id' => $plan->mfp_name, 'warehouse' => $plan->warehouse])->first();
                $final_array[] = array(
                    'mfp_id' => $plan->mfp_name,
                    'warehouse' => $plan->warehouse ?? 0,
                    'qty' =>  $qty_arr[$plan->mfp_name] ?? 0,
                    'haat' => $mfp_haat[$plan->mfp_name] ?? 0,
                    'capacity' => Helper::decimalNumberFormat($plan->storage_capacity),
                    'procurement_center' => $collection_data->procurement_center ?? null,
                    'packing_material_type' => $collection_data->packing_material_type ?? null,
                    'standard_packing' => $collection_data->standard_packing ?? 0,
                    'category' => $collection_data->category ?? null,
                    'size' => $collection_data->size ?? null,
                    'total_packing_bags' => $collection_data->total_packing_bags ?? 0,
                    'unit_cost' => $collection_data->unit_cost ?? 0,
                    'total_cost_of_packaging_material' => $collection_data->total_cost_of_packaging_material ?? 0,
                );
            }
        }
        return $final_array;
    }

    public function getEstimatedProcurement($ref_id){
        $procurement = Mfp_procurement::where('ref_id', $ref_id)->firstOrFail();
        $value =  Mfp_procurement_commodity::where('mfp_procurement_id', $procurement->id)->groupBy('commodity_id')->selectRaw('commodity_id, sum(currentval) estimated_procurement')->get();
        return $value;
       

    }
}
