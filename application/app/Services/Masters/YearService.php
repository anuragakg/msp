<?php

namespace App\Services\Masters;

use App\Services\Service;
use Illuminate\Support\Facades\Auth;
use App\Models\Masters\Year as ServiceModel;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class YearService extends Service
{
    /**
     * Get all items from database
     *status
     * @return mixed
     */
    public function getAll($status = null)
    {
        if ($status) {
            //return ServiceModel::all();
			//CHANGE ON 05-03-2020 BY Anurag
			return ServiceModel::orderBy('title','desc')->get();;
        }else{
            return ServiceModel::where('status', 1)->orderBy('title','desc')->get();;
        }
        //return $this->getMasterData(ServiceModel::class);
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
                'required', 'digits:4',
                Rule::unique($model->getTable())
            ]
        ],
        [
            'title.required' => 'Please provide Year',
            'title.digits' => 'Please provide Year in 4 Digits',
            'title.unique' => 'The year has already been taken'
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
                'required', 'digits:4',
                Rule::unique($model->getTable())->ignore($id)
            ]
        ],
        [
            'title.required' => 'Please provide Year',
            'title.digits' => 'Please provide Year in 4 Digits',
            'title.unique' => 'The year has already been taken'
        ]);
    }

    public function getYearByName($year)
    {
        return ServiceModel::whereTitle($year)->first();
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
