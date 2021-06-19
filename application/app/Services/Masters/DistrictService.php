<?php

namespace App\Services\Masters;

use App\Queries\DistrictQuery;
use App\Services\Service;
use Illuminate\Support\Facades\Auth;
use App\Models\Masters\District as ServiceModel;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class DistrictService extends Service
{

    private $districtQuery;

    public function __construct(DistrictQuery $districtQuery = null) {
        $this->districtQuery = $districtQuery;
    }
    /**
     * Get all items from database
     *
     * @return mixed
     */
    function getAll($stateId)
    {
        return $this->districtQuery->viewAllQuery($stateId);
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
        $item->state_id = $data['state_id'];
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
        $item->deleteBlocks();
        return $item->delete();
    }

    /**
     * Validates for getting a record.
     *
     * @param Array $data
     * @return mixed
     */
    public function validateFetch($data)
    {
        $model = new ServiceModel();
        return Validator::make($data, [
            'state_id' => 'required'
        ]);
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
            'state_id' => 'required',
            'title' => [
                'required','alpha_spaces',
                Rule::unique('mysql2.districts_master')
            ],
            'code' => [
                'required', 
                Rule::unique('mysql2.districts_master')
            ]
        ],
        [
            'title.required' => 'Please provide district Name',
            'title.alpha_spaces' => 'District name may only contain letters and spaces',
            'code.required' => 'Please provide code',
            'title.unique' => 'District name has already been taken',
            'code.unique' => 'Code has already been taken'

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
            'state_id' => 'required',
            'title' => [
                'required', 'alpha_spaces',
                Rule::unique('mysql2.districts_master')->ignore($id)
            ],
            'code' => [
                'required', 
                Rule::unique('mysql2.districts_master')->ignore($id)
            ],
        ],
            [
                'title.required' => 'Please provide district Name',
                'title.alpha_spaces' => 'District name may only contain letters and spaces',
                'code.required' => 'Please provide code',
                'title.unique' => 'District name has already been taken',
                'code.unique' => 'Code has already been taken'
            ]);
    }

    public function getDistrictByName($stateId,$district)
    {
        return ServiceModel::whereStateId($stateId)->whereTitle($district)->first();
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

    public function getDistrictById($stateId,$districtId)
    {
        return ServiceModel::where('state_id',$stateId)->where('id',$districtId)->first();
    }

    public function getAllData()
    {
        $query = ServiceModel::all();
        $query->where('status','1');
        return $query;
    }
}
