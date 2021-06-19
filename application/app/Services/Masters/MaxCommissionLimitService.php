<?php

namespace App\Services\Masters;

use App\Services\Service;
use App\Models\Masters\CommissionLimit as CommissionLimitModel;
use Illuminate\Support\Facades\Validator;
//use Illuminate\Validation\Rule;

class MaxCommissionLimitService extends Service
{
    /**
     * Get all items from database
     *
     * @return mixed
     */
    public function getAll()
    {
        return CommissionLimitModel::all();
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
        $order = $columns[$request['order'][0]['column']];
        $dir = $request['order'][0]['dir'];
        
        $search = $request['search']['value']; 
        
        $query= CommissionLimitModel::orderBy($order,$dir);

        if(isset($search) && !empty($search))
        {
            // $query->where('bag_type','LIKE',"%{$search}%");   
            // $query->orWhere('bag_name','LIKE',"%{$search}%"); 
            // $query->orWhere('specifications','LIKE',"%{$search}%"); 
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
      
        $item = new CommissionLimitModel($data);
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
        return CommissionLimitModel::findOrFail($id);
    }


    public function validateCreate($data)
    {
        // dd($data);
        $model = new CommissionLimitModel();
        return Validator::make($data, [
            'state'=>'required',
            'role'=> 'required',
            'commission'=>'required',
            'max_aggregate_commission'=>'required'
        ],
        [
            'state.required' => 'Please provide state name',
            'role.required'=> 'Please provide role name',
            'commission.required' => 'Please provide commission name',
            'max_aggregate_commission.required'=> 'Please provide aggregate commission limit'
            
            
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
        $item = CommissionLimitModel::findOrFail($id);
            
        $item->state = $data['state'];
        $item->commission = $data['commission'];
        $item->max_aggregate_commission = $data['max_aggregate_commission'];
        $item->save();

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
        $model = new CommissionLimitModel();
        return Validator::make($data, [
            'state'=>'required',
            'commission'=>'required',
            'max_aggregate_commission'=>'required'
        ],
        [
            'state.required'=> 'Please provide state name',
            'commission.required' => 'Please provide commission',
            'max_aggregate_commission.required'=> 'Please provide aggregate commission limit'
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
        $model = CommissionLimitModel::where([
            'id' => $id
        ])->firstOrFail();
        $model->switchStatus();
        $model->save();
        return $model->status;
    }
}
