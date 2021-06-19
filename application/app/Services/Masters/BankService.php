<?php

namespace App\Services\Masters;

use App\Services\Service;
use Illuminate\Support\Facades\Auth;
use App\Models\Masters\Bank as ServiceModel;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class BankService extends Service
{
    /**
     * Get all items from database
     *
     * @return mixed
     */
    function getAll()
    {
        return ServiceModel::all();
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
        //==Add User Activity
        $activity='added bank master '.$data['title'];
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
        $item->status = $data['status'];
        $item->ifsc_code = $data['ifsc_code'];

        $item->save();
         //==Add User Activity
        $activity='Updated bank master '.$data['title'];
        $module='master';
        $this->addUserActivity($activity,$module);
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
     * Validates for creating a record.
     *
     * @param Array $data
     * @return mixed
     */
    public function validateCreate($data)
    {
        $model = new ServiceModel();
        return Validator::make($data, [
            'title' => 'required',
            'ifsc_code' => [
                'required',
                Rule::unique($model->getTable())
            ],
        ],
            [
                'ifsc_code.required' => 'Please provide ifsc code',
                'ifsc_code.unique' => 'ifsc code has already taken',
                'title.required' => 'Please provide bank name'
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
            'ifsc_code' => [
                'required',
                Rule::unique($model->getTable())->ignore($id)
            ],
            'title' => 'required'
        ],
            [
                'ifsc_code.required' => 'Please provide ifsc code',
                'ifsc_code.unique' => 'ifsc code has already taken',
                'title.required' => 'Please provide bank name'
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
}
