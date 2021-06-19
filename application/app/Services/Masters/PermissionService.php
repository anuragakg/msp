<?php

namespace App\Services\Masters;

use App\Services\Service;
use Illuminate\Support\Facades\Auth;
use App\Models\Masters\Permission as PermissionModel;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class PermissionService extends Service
{
    /**
     * Get all items from database
     *
     * @return mixed
     */
    function getAll()
    {
        return PermissionModel::all(['id', 'name', 'alias', 'group','description']);
    }

    /**
     * Creates a new item in table
     *
     * @param Array $data
     * @return mixed
     */
    public function createItem($data)
    {
        $item = new PermissionModel($data);
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
        return PermissionModel::findOrFail($id);
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
        $item = PermissionModel::findOrFail($id);
        

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
        $item = PermissionModel::findOrFail($id);
        return $item->delete();
    }

    /**
     * Switch the status of the given user id.
     *
     * @param integer $id
     * @return string|integer
     */
    public function switchStatus($id)
    {
        $model = PermissionModel::where([
            'id' => $id
        ])->firstOrFail();
        $model->switchStatus();
        $model->save();
        return $model->status;
    }
    
}
