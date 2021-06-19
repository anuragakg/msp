<?php

namespace App\Services\Masters;

use App\Services\Service;
use Illuminate\Support\Facades\Auth;
use App\Models\Masters\MFPUse as ServiceModel;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use DB;

class MFPUseService extends Service
{
    /**
     * Get all items from database
     *
     * @return mixed
     */
    public function getAll()
    {
        return $this->getMasterData(ServiceModel::class);
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
                'required',
                Rule::unique($model->getTable())
            ]
        ],
        [
            'title.required' => 'Please provide MFP use',
            'title.unique' => 'The MFP use has already been taken'
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
                'required',
                Rule::unique($model->getTable())->ignore($id)
            ]
        ],
        [
            'title.required' => 'Please provide MFP use',
            'title.unique' => 'The MFP use has already been taken'
        ]);
    }

    public function getMfpUseByName($mfpUse)
    {
        $mfpUseArray = explode(",",$mfpUse);
        return ServiceModel::select(DB::raw("GROUP_CONCAT(id SEPARATOR ',') as `ids`"))->whereIn('title',$mfpUseArray)->get();

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