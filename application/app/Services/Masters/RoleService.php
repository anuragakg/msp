<?php

namespace App\Services\Masters;

use App\Services\Service;
use Illuminate\Support\Facades\Auth;
use App\Models\Masters\Role as RoleModel;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class RoleService extends Service
{
    /**
     * Get all items from database
     *
     * @return mixed
     */
    public function getAll()
    {
        return RoleModel::all();
    }

    /**
     * Get filtered user role from database
     *
     * @return mixed
     */
    public function fetchRoleMappingList()
    {
        return RoleModel::where('role_type', '1')->get();
    }

    public function getRolesListing($request)
    {
     
        $columns = array( 
                                0 =>'id', 
                                1=> 'title',
            );
        $limit = $request['length'];
        $start = $request['start'];
        //print_r($request);die;  
        $order = $columns[$request['order'][0]['column']];
        $dir = $request['order'][0]['dir'];
        
        $search = $request['search']['value']; 


        $query= RoleModel::orderBy($order,$dir);
        if(isset($search) && !empty($search))
        {
            $query->where('title','LIKE',"%{$search}%");   
        }
        return $query->paginate($limit);
    }

    /**
     * Get filtered user role from database
     *
     * @return mixed
     */
    public function fetchUserManagementList()
    {   $user = Auth::user();
        //If Logged in user super admin
        if($user->role == 1) {
             return RoleModel::where('id','!=',10)->get();//buyer
        }else if($user->role==2){ //If Logged in user nodal
            return RoleModel::whereIn('id',[4,5,6])->get();
        }
        else if($user->role==3){ //If Logged in user nodal
            return RoleModel::whereIn('id',[2,4,5,6])->get();
        }
        else if($user->role==4){ //If Logged in user nodal
            return RoleModel::whereIn('id',[5,8,9,11])->get();
        }else if($user->role==5){ //If Logged in user SIA
            return RoleModel::whereIn('id',[6])->get();
        }else if($user->role==6){//If Logged in user DIA
            return RoleModel::whereIn('id',[7])->get();
        }
        else if($user->role==7){
            return RoleModel::get();
        }else
        {
            return RoleModel::get();
        }
    }

    /**
     * Creates a new item in table
     *
     * @param Array $data
     * @return mixed
     */
    public function createItem($data)
    {
        $item = new RoleModel($data);
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
        return RoleModel::findOrFail($id);
    }


    public function validateCreate($data)
    {
        $model = new RoleModel();
        return Validator::make($data, [
            'title' => [
                'required',
                Rule::unique($model->getTable())
            ],
            'status'=>'required',
            'description'=>'required'
        ],
        [
            'title.required' => 'Please provide role name.',
            'title.unique' => 'Role name has already been taken.',
            'description.required' => 'Please provide description.',
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
        $item = RoleModel::findOrFail($id);
        

        $item->title = $data['title'];
        $item->status = $data['status'];
        $item->description = $data['description'];

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
        $item = RoleModel::findOrFail($id);
        return $item->delete();
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
        $model = new RoleModel();
        return Validator::make($data, [
            'title' => [
                'required',
                Rule::unique($model->getTable())->ignore($id)
            ],
            'status'=>'required',
            'description'=>'required'
        ],
            [
                'title.required' => 'Please provide role name.',
                'title.unique' => 'Role name has already been taken.',
                'description.required' => 'Please provide description.',
            ]);
    }

    public function getRoleByName($roleName)
    {
        return RoleModel::whereTitle($roleName)->first();
    }

    /**
     * Switch the status of the given user id.
     *
     * @param integer $id
     * @return string|integer
     */
    public function switchStatus($id)
    {
        $model = RoleModel::where([
            'id' => $id
        ])->firstOrFail();
        $model->switchStatus();
        $model->save();
        return $model->status;
    }

    public function getCommissionMasterList()
    {
        $user = Auth::user();
        if($user->role == 1 || $user->role==2 || $user->role ==3 || $user->role ==4 || $user->role == 5) {
            return RoleModel::whereIn('id',['5','6','7'])->get();
       }else if($user->role==6){ //If Logged in user trifed
           return RoleModel::whereIn('id',['6','7'])->get();
       }
     
    }
}
