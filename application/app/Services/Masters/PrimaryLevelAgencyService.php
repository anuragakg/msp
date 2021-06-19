<?php

namespace App\Services\Masters;

use App\Services\Service;
use Illuminate\Support\Facades\Auth;
use App\Models\Masters\PrimaryLevelAgency;
use Illuminate\Support\Facades\Validator;


class PrimaryLevelAgencyService extends Service
{
    /**
     * Get all items from database
     *
     * @return mixed
     */
    public function getAll()
    {
        return PrimaryLevelAgency::all();
    }

    /**
     * Creates a new item in table
     *
     * @param Array $data
     * @return mixed
     */
    public function createItem($data)
    {
      
        $item = new PrimaryLevelAgency($data);
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
        return PrimaryLevelAgency::findOrFail($id);
    }


    public function validateCreate($data)
    {
        // dd($data);
        $model = new PrimaryLevelAgency();
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
        $item = PrimaryLevelAgency::findOrFail($id);

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
        $model = new PrimaryLevelAgency();
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
        $model = PrimaryLevelAgency::where([
            'id' => $id
        ])->firstOrFail();
        $model->switchStatus();
        $model->save();
        return $model->status;
    }

    

  
}
