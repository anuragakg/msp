<?php

namespace App\Services\Masters;

use App\Services\Service;
use Illuminate\Support\Facades\Auth;
use App\Models\Masters\ProcurementAgent as ServiceModel;
use App\Rules\ValidName;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class ProcurementAgentService extends Service
{
    /**
     * Get all items from database
     *
     * @return mixed
     */
    function getAll($filters = null)
    {
        $query = ServiceModel::query();

        if (isset($filters['state'])) {
            $query->where('state', $filters['state']);
        }

        return $query->get();
        
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
        ServiceModel::where('id', $id)->update($data);
        return ServiceModel::findOrFail($id);
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
     * Validates for creating a record.
     *
     * @param Array $data
     * @return mixed
     */
    public function validateCreate($data)
    {
        $model = new ServiceModel();
        return Validator::make($data, [
            'name' => ['required', 'alpha_spaces', 'max:20', new ValidName],
            'mobile_no' => [
                'required',
                Rule::unique($model->getTable()),
                'numeric',
                'digits_between:10,11'
            ],
            'landline_no' => [
                'required',
                Rule::unique($model->getTable()),
                'numeric',
                'digits_between:10,11'
            ],
            'address' => 'required|max:250',
            'state' => 'required|numeric|exists:states_master,id',
            'district' => 'required|numeric|exists:districts_master,id',
            'block' => 'required|numeric|exists:blocks_master,id',
        ],
        [
            'name.alpha_spaces' => 'Name may only contain letters and spaces',
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
            'name' => ['required', 'alpha_spaces', 'max:20', new ValidName],
            'mobile_no' => [
                'required',
                Rule::unique($model->getTable())->ignore($id),
                'numeric',
                'digits_between:10,11'
            ],
            'landline_no' => [
                'required',
                Rule::unique($model->getTable())->ignore($id),
                'numeric',
                'digits_between:10,11'
            ],
            'address' => 'required|max:250',
            'state' => 'required|numeric|exists:states_master,id',
            'district' => 'required|numeric|exists:districts_master,id',
            'block' => 'required|numeric|exists:blocks_master,id',
        ],
            [
                'name.alpha_spaces' => 'Name may only contain letters and spaces',
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

    /**
     * Validates Query Parameters
     * 
     * @param mixed $data 
     * @return array 
     */
    public function validateQueryParams($data)
    {
        return Validator::make($data, [
            'state' => 'nullable|numeric'
        ])->validated();
    }
}
