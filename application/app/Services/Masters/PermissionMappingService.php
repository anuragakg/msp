<?php

namespace App\Services\Masters;

use App\Services\Service;
use Illuminate\Support\Facades\Auth;
use App\Models\Masters\PermissionMapping as PermissionMappingModel;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use DB;
class PermissionMappingService extends Service
{
    /**
     * Get all items from database
     *
     * @return mixed
     */
    function getAll()
    {
        return PermissionMappingModel::all();
    }

    /**
     * Creates a new item in table
     *
     * @param Array $data
     * @return mixed
     */
    public function createItem($data)
    {
        $item = [];

        DB::beginTransaction();
        try {
             /*==========Add Permissiosn Details========*/
            $permission_data=array();
            PermissionMappingModel::where('role_id', $data['role_id'])->delete();
            if(isset($data['permission_id']) && !empty($data['permission_id']))
            {
                //Master Management
                if(in_array("2", $data['permission_id']) || in_array("3", $data['permission_id']))
                {
                    if(!in_array("1", $data['permission_id']))
                    {
                        $data['permission_id'][]="1";    
                    }
                }

                if(in_array("6", $data['permission_id']) || in_array("7", $data['permission_id']))
                {
                    if(!in_array("5", $data['permission_id']))
                    {
                        $data['permission_id'][]="5";    
                    }
                }
                if(in_array("10", $data['permission_id']) || in_array("11", $data['permission_id']))
                {
                    if(!in_array("9", $data['permission_id']))
                    {
                        $data['permission_id'][]="9";    
                    }
                }
                if(in_array("13", $data['permission_id']) || in_array("14", $data['permission_id']))
                {
                    if(!in_array("15", $data['permission_id']))
                    {
                        $data['permission_id'][]="15";    
                    }
                }
                if(in_array("19", $data['permission_id']) || in_array("20", $data['permission_id']))
                {
                    if(!in_array("18", $data['permission_id']))
                    {
                        $data['permission_id'][]="18";    
                    }
                }
                if(in_array("23", $data['permission_id']) || in_array("24", $data['permission_id']))
                {
                    if(!in_array("22", $data['permission_id']))
                    {
                        $data['permission_id'][]="22";    
                    }
                }
                if(in_array("26", $data['permission_id']))
                {
                    if(!in_array("27", $data['permission_id']))
                    {
                        $data['permission_id'][]="27";    
                    }
                }
                if(in_array("28", $data['permission_id']) || in_array("29", $data['permission_id']) || in_array("30", $data['permission_id']) || in_array("31", $data['permission_id'])|| in_array("32", $data['permission_id'])|| in_array("33", $data['permission_id'])|| in_array("34", $data['permission_id'])|| in_array("35", $data['permission_id']))
                {
                    if(!in_array("18", $data['permission_id']))
                    {
                        $data['permission_id'][]="18";    
                    }
                }
                 if(in_array("37", $data['permission_id']) || in_array("38", $data['permission_id']))
                {
                    if(!in_array("36", $data['permission_id']))
                    {
                        $data['permission_id'][]="36";    
                    }
                }//dd($data['permission_id']);
                foreach ($data['permission_id'] as $key => $permission_id) 
                {
                    $permission_data=array(
                        'role_id'=>$data['role_id'],
                        'permission_id'=>$permission_id,
                    );
                    
                    $permission =new PermissionMappingModel($permission_data);
                    $permission->save(); 
                }
            }
            $item = $this->getOne($data['role_id']);
            //===================================
            DB::commit();
            return $item;
        }catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
        
    }

    /**
     * Validates for creating a record.
     *
     * @param Array $data
     * @return mixed
     */
    public function validateCreate($data)
    {
        return Validator::make($data, [
            'role_id' =>'required|exists:user_roles,id',
            'permission_id.*' =>'nullable|distinct|exists:permissions,id'
        ],
            [
                'role_id.required' => 'Please provide role',

            ]);
    }

    public function validateUpdate($data)
    {
        return Validator::make($data, [
            'role_id' =>'required|exists:user_roles,id',
            'permission_id.*' =>'nullable|distinct|exists:permissions,id'
        ],
            [
                'role_id.required' => 'Please provide role',
            ]);
    }
    /**
     * Get a single item from database
     *
     * @param number $id
     * @return mixed
     */
    public function getOne($id)
    {
        $data = PermissionMappingModel::where('role_id', $id)->get();

        return $data;
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
        $item = PermissionMappingModel::findOrFail($id);
        

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
        $item = PermissionMappingModel::findOrFail($id);
        //$table=$model->getTable()
        //DB::select("delete from $table WHERE role_id=$id");
        return $item->delete();
    }

    public function delete_permission($role_id)
    {
         $model = new PermissionMappingModel();
        $table=$model->getTable();
        
        DB::statement("DELETE FROM $table where role_id=$role_id");
    }    

    /**
     * Switch the status of the given user id.
     *
     * @param integer $id
     * @return string|integer
     */
    public function switchStatus($id)
    {
        $model = PermissionMappingModel::where([
            'id' => $id
        ])->firstOrFail();
        $model->switchStatus();
        $model->save();
        return $model->status;
    }
}
