<?php

namespace App\Services\Masters;

use App\Services\Service;
use Illuminate\Support\Facades\Auth;
use App\Models\Masters\ProcurementCenter;
use Illuminate\Support\Facades\Validator;


class ProcurementCenterService extends Service
{
    /**
     * Get all items from database
     *
     * @return mixed
     */
    public function getAll()
    {
        return ProcurementCenter::all();
    }

    public function getProcurementCenterListing($request)
    {
     
        $columns = array( 
                        0 =>'id', 
                        1 =>'state_name',
                        1 =>'role_name',
                        2 =>'commission',
                        3 =>'status'
            );
        $limit = $request['length'];
        $start = $request['start'];
        //print_r($request);die;  
        $order = $columns[$request['order'][0]['column']];
        $dir = $request['order'][0]['dir'];
        
        $search = $request['search']['value']; 
        
        $query= ProcurementCenter::orderBy($order,$dir);

     
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
      
        $item = new ProcurementCenter($data);
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
        return ProcurementCenter::findOrFail($id);
    }


    public function validateCreate($data)
    {
        // dd($data);
        $model = new ProcurementCenter();
        return Validator::make($data, [
            'state'=>'required|numeric',
            'role' => 'required',
            'commission'=>'required',
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
        $item = ProcurementCenter::findOrFail($id);

        $item->role = $data['role'];
        $item->state = $data['state'];
        $item->commission = $data['commission'];
        $item->max_aggregate_commission = $data['max_aggregate_commission'];
        $item->status = $data['status'];

        $item->save();

        return $item;
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
        $model = new ProcurementCenter();
        return Validator::make($data, [
            'state'=>'required',
            'role' => [
                'required',
                //Rule::unique($model->getTable())
            ],
            'commission'=>'required',
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
        $model = ProcurementCenter::where([
            'id' => $id
        ])->firstOrFail();
        $model->switchStatus();
        $model->save();
        return $model->status;
    }

    

  
}
