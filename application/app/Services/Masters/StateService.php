<?php

namespace App\Services\Masters;

use App\Services\Service;
use App\Queries\StateQuery;
use Illuminate\Support\Facades\Auth;
use App\Models\Masters\State as ServiceModel;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class StateService extends Service
{   
    private $stateQuery;

    public function __construct(StateQuery $stateQuery = null) {
        $this->stateQuery = $stateQuery;
    }
    /**
     * Get all items from database
     *
     * @return mixed
     */
    public function getAll()
    {
        return $this->stateQuery->viewAllQuery();
    }

    /**
     * Creates a new item in table
     *
     * @param Array $data
     * @return mixed
     */
    public function createItem($data)
    {
        $item = new ServiceModel($data);
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
        $item = ServiceModel::findOrFail($id);

        $item->title = $data['title'];
        $item->code = $data['code'];
        $item->status = $data['status'];

        $item->save();

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
        $model = new ServiceModel();
        return Validator::make($data, [
            'title' => [
                'required','string','alpha_spaces',
                Rule::unique('mysql2.states_master')
            ],
            'code' => [
                'required','numeric', 'digits:4',
                Rule::unique('mysql2.states_master')
            ]
        ],
        [
            'title.required' => 'Please provide state name',
            'title.alpha_spaces' => 'State name may only contain letters and spaces',
            'code.required' => 'Please provide state code',
            'title.unique' => 'The State Name has already been taken',
            'code.unique' => 'The State Code has already been taken',
            'code.digits_between' => 'Code may only contain 4 digits'
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
        $model = new ServiceModel();
        return Validator::make($data, [
            'title' => [
                'required','string','alpha_spaces',
                Rule::unique('mysql2.states_master')->ignore($id)
            ],
            'code' => [
                'required','numeric', 'digits:4',
                Rule::unique('mysql2.states_master')->ignore($id)
            ]
        ],
        [
            'title.required' => 'Please provide state name',
            'title.alpha_spaces' => 'State name may only contain letters and spaces',
            'code.required' => 'Please provide state code',
            'title.unique' => 'The State Name has already been taken',
            'code.unique' => 'The State Code has already been taken',
            'code.digits_between' => 'Code may only contain 4 digits'
        ]);
    }

    public function getStateByName($state)
    {
        return ServiceModel::whereTitle($state)->first();
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

    function checkState($id)
    {
        return ServiceModel::where([
            'id' => $id
        ])->count();
    }

    public static function getStateById($state)
    {
        return ServiceModel::where('id',$state)->first();
    }

    public function getAllData()
    {
        $query = ServiceModel::all();
        $query->where('status','1');
        return $query;
    }
    
}
