<?php

namespace App\Services\Masters;

use App\Services\Service;
use Illuminate\Support\Facades\Auth;
use App\Models\Masters\CommissionMaster as CommissionMasterModel;
use App\Models\Masters\CommissionLimit as CommissionLimitModel;
use Illuminate\Support\Facades\Validator;
use App\Queries\CommissionQuery;
use Illuminate\Validation\Rule;
use DB;

class CommissionMasterService extends Service
{
    private $commissionQuery;

    public function __construct(CommissionQuery $commissionQuery = null) {
        $this->commissionQuery = $commissionQuery;
    }
    /**
     * Get all items from database
     *
     * @return mixed
     */
    public function getAll()
    {
        return CommissionMasterModel::all();
    }


    public function getCommissionListing($request)
    {
     
        $columns = array( 
                        0 =>'id', 
                        1=>'state_name',
                        1=> 'role_name',
                        2=> 'commission',
                        3=> 'status'
            );
        $limit = $request['length'];
        $start = $request['start'];
        //print_r($request);die;  
        $order = isset($request['order'][0]['column'])?$columns[$request['order'][0]['column']]:'id';
        $dir = isset($request['order'][0]['dir'])?$request['order'][0]['dir']:'DESC';
        
        $search = $request['search']['value']; 
        $query = $this->commissionQuery->viewAllQuery($request);
        $query= $query->orderBy($order,$dir);

        
        if(isset($request['state']) && !empty($request['state']))
        {
            $query->where('state', $request['state']);
        }
        if(isset($request['role']) && !empty($request['role']))
        {
            $query->where('role', $request['role']);
        }
        return $query->paginate($limit);
    }


    /**
     * Creates a new item in table
     *
     * @param Array $data
     * @return mixed
     */
    public function createItem($data)
    {
      
        $item = new CommissionMasterModel($data);
        $item->save();
        //==Add User Activity
        $activity='added commision master  ';
        $module='master';
        $this->addUserActivity($activity,$module);
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
        return CommissionMasterModel::findOrFail($id);
    }


    public function validateCreate($data)
    {
        // dd($data);
        $model = new CommissionMasterModel();
        return Validator::make($data, [
            'state'=>'required|numeric',
            'role' => 'required',
            'commission'=>'required|numeric|max:100',
            'max_aggregate_commission'=>'required',
            'status'=>'required'
        ],
        [
            'state.required' => 'Please provide state name',
            'role.required' => 'Please provide role name',
            'commission.required' => 'Please provide commission name',
            'status.required' => 'Please provide status',
            'max_aggregate_commission.required'=>'Please provide max aggregate commisssion'
        ]);
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
        $item = CommissionMasterModel::findOrFail($id);

        $item->role = $data['role'];
        $item->state = $data['state'];
        $item->commission = $data['commission'];
        $item->max_aggregate_commission = $data['max_aggregate_commission'];
        $item->status = $data['status'];

        $item->save();
        //==Add User Activity
        $activity='updated commision master  ';
        $module='master';
        $this->addUserActivity($activity,$module);
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
    public function validateUpdate($id, $data)
    {
        $model = new CommissionMasterModel();
        return Validator::make($data, [
            'state'=>'required',
            'role' => [
                'required',
                //Rule::unique($model->getTable())
            ],
            'commission'=>'required|numeric|max:100',
            'max_aggregate_commission'=>'required',
            'status'=>'required'
        ],
        [
            'state.required'=> 'Please provide state name',
            'role.required' => 'Please provide role name',
            'commission.required' => 'Please provide commission',
            'max_aggregate_commission.required'=>'Please provide max aggregate commission',
            'status.required' => 'Please provide status'
            
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
        $model = CommissionMasterModel::where([
            'id' => $id
        ])->firstOrFail();
        $model->switchStatus();
        $model->save();
        return $model->status;
    }

    /**
     * Get Commission state wise
     *
     * @param integer $id
     * @return string|integer
     */
    public function getCommissionListStatewise($id)
    {
       
         return CommissionLimitModel::where('state',5)->get();
        
    }

    public function checkUniqueRecord($value){
       
        $query= CommissionMasterModel::where('state', $value['state'])
                                      ->where('role', $value['role']);
                                      //->where('commission',$value['commission'])
                                      //->where('max_aggregate_commission',$value['max_aggregate_commission']);
                                    //   ->first();
                                      
        if(isset($value['commission_master_id'])){
            $data = $query->where('id','!=',$value['commission_master_id']);
            //dd($data);
        }
        $is_exist = $query->first();
        if($is_exist){
            return true;
        }
        return false;
    }
}
