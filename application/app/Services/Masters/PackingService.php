<?php

namespace App\Services\Masters;

use App\Services\Service;
use Illuminate\Support\Facades\Auth;
use App\Models\Masters\Packing as PackingModel;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class PackingService extends Service
{
    /**
     * Get all items from database
     *
     * @return mixed
     */
    public function getAll()
    {
        return PackingModel::all();
    }


    public function getPackingListing($request)
    {
     
        $columns = array( 
                                0 =>'id', 
                                1=> 'bag_type',
                                2=> 'bag_name',
                                3=> 'specifications'
            );
        $limit = $request['length'];
        $start = $request['start'];
        //print_r($request);die;  
        $order = isset($request['order'][0]['column'])?$columns[$request['order'][0]['column']]:'id';
        $dir = isset($request['order'][0]['dir'])?$request['order'][0]['dir']:'DESC';
        
        $search = $request['search']['value']; 

        $query= PackingModel::orderBy($order,$dir);
        if(isset($search) && !empty($search))
        {
            $query->where('bag_type','LIKE',"%{$search}%");   
            $query->orWhere('bag_name','LIKE',"%{$search}%"); 
            $query->orWhere('specifications','LIKE',"%{$search}%"); 
        }
        return $query->paginate($limit);
    }

    // /**
    //  * Get filtered user role from database
    //  *
    //  * @return mixed
    //  */
    // public function fetchUserManagementList()
    // {
    //     return RoleModel::whereIn('role_type', ['1', '2'])->get();
    // }

    /**
     * Creates a new item in table
     *
     * @param Array $data
     * @return mixed
     */
    public function createItem($data)
    {
        $bag_type=$data['bag_type'];
        $bag_name=$data['bag_name'];
        $check_already=PackingModel::where(['bag_type'=>$bag_type,'bag_name'=>$bag_name])->first();
        if(!empty($check_already))
        {
            throw new \Exception("$bag_type bag_type and $bag_name bag_name already existed", 1);
            
        }
        $item = new PackingModel($data);
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
        return PackingModel::findOrFail($id);
    }


    public function validateCreate($data)
    {
        $model = new PackingModel();
        return Validator::make($data, [
            'bag_type.*' => [
                'required'
                //Rule::unique($model->getTable())
            ],
            'bag_name.*'=>'required',
            'specifications.*'=>'required'
        ],
        [
            'bag_type.*.required' => 'Please provide bag type',
            'bag_name.*.required' => 'Please provide bag name',
            'specifications.*.required' => 'Please provide specifications',
            'bag_type.*.alpha_spaces' => 'Please provide characters only',
            'bag_name.*.alpha_spaces' => 'Please provide characters only',
            'specifications.*.alpha_spaces' => 'Please provide characters only',
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
        $bag_type=$data['bag_type'][0];
        $bag_name=$data['bag_name'][0];
        $check_already=PackingModel::where(['bag_type'=>$bag_type,'bag_name'=>$bag_name])->where('id','!=',$id)->first();
        if(!empty($check_already))
        {
            throw new \Exception("$bag_type bag_type and $bag_name bag_name already existed", 1);
            
        }
        $item = PackingModel::findOrFail($id);

        $item->bag_name = $data['bag_name'][0];
        $item->bag_type = $data['bag_type'][0];
        $item->specifications = $data['specifications'][0];

        $item->save();
        
        return $item;
    }

    // /**
    //  * Delete an item from database
    //  *
    //  * @param integer $id
    //  * @return boolean
    //  */
    // public function deleteItem($id)
    // {
    //     $item = RoleModel::findOrFail($id);
    //     return $item->delete();
    // }

    /**
     * Validates for updating a record in databse
     *
     * @param integer $id
     * @param Array $data
     * @return mixed
     */
    public function validateUpdate($id, $data)
    {
        $model = new PackingModel();
        return Validator::make($data, [
            'bag_type.*' => [
                'required',
                //Rule::unique($model->getTable())->ignore($id)
            ],
            'bag_name.*'=>'required',
            'specifications.*'=>'required'
        ],
            [
                'bag_type.*.required' => 'Please provide bag type',
                'bag_name.*.required' => 'Please provide bag name',
                'specifications.*.required' => 'Please provide specifications',
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
        $model = PackingModel::where([
            'id' => $id
        ])->firstOrFail();
        $model->switchStatus();
        $model->save();
        return $model->status;
    }
    public function checkBagName($value)
    { 
        $user = PackingModel::where('bag_name', $value['bagName'])->where('specifications',$value['specification'])->first();
        if ($user) {
            return true;
        }
        return false; 
    }
}
