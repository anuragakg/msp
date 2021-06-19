<?php

namespace App\Services\Masters;

use App\Services\Service;
use Illuminate\Support\Facades\Auth;
use App\Models\Masters\Block as ServiceModel;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class BlockService extends Service
{
    /**
     * Get all items from database
     *
     * @return mixed
     */
    function getAll()
    {
        return ServiceModel::get();
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
        $item->district_id = $data['district_id'];
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
            'district_id' => 'required'
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
            'district_id' => 'required',
            'title' => [
                'required', 'alpha_spaces',
                 Rule::unique('mysql2.blocks_master')
            ],
            'code' => [
                'required', 'digits:4',
                Rule::unique('mysql2.blocks_master')
            ],
        ],
        [
            'title.required' => 'Please provide block name',
            'title.unique' => 'Block/Tehsil has already been taken.',
            'title.alpha_spaces' => 'Block/Tehsil name may only contain letters and spaces',
            'code.required' => 'Please provide block code',
            'code.unique' => 'Block/Tehsil code has already been taken'
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
            'district_id' => 'required',
            'title' => [
                'required', 'alpha_spaces',
                 Rule::unique('mysql2.blocks_master')->ignore($id)
            ],
            'code' => [
                'required', 'digits:4',
                Rule::unique('mysql2.blocks_master')->ignore($id)
            ],
        ],
        [
            'title.required' => 'Please provide block name',
            'title.alpha_spaces' => 'Block name may only contain letters and spaces',
            'code.required' => 'Please provide block code',
            'code.unique' => 'The block code has already been taken'
        ]);
    }

    public function getBlockByName($districtId,$block)
    {
        return ServiceModel::whereDistrictId($districtId)->whereTitle($block)->first();
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

    public function getBlockById($districtId,$blockId)
    {
        return ServiceModel::where('district_id',$districtId)->where('id',$blockId)->first();
    }

    public function getBlockByDistrict($districtId)
    {
        return ServiceModel::where('district_id',$districtId)->get();
    }
    
    public function getAllData()
    {

        $query = ServiceModel::all();
        $query->where('status','1');
       
        return $query;
    }
}
