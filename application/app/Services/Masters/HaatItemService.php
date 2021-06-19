<?php

namespace App\Services\Masters;

use App\Services\Service;
use Illuminate\Support\Facades\Auth;
use App\Models\Masters\HaatBazaarItem as HaatItemModel;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class HaatItemService extends Service
{
    /**
     * Get all items from database
     *
     * @return mixed
     */
    public function getAll($request)
    {

        $query=HaatItemModel::all();

         if(isset($request['status']) && !empty($request['status']))
                {                          
                    return $query->where('status','1');
                }
        return $query;
    }


    public function getHaatitemListing($request)
    {
     
        $columns = array( 
                                0 =>'id', 
                                1=> 'item_name',
                                2=> 'specification',
                                3=> 'unit',
                                4=> 'cost'
            );
        $limit = $request['length']??0;
        $start = $request['start']; 
        $order = $columns[$request['order'][0]['column']];
        $dir = $request['order'][0]['dir'];
        
        $search = $request['search']['value']; 


        $query= HaatItemModel::orderBy($order,$dir);
        if(isset($search) && !empty($search))
        {
            $query->where('item_name','LIKE',"%{$search}%");    
            $query->orWhere('specification','LIKE',"%{$search}%"); 
        }
        return $query->paginate($limit);
    }

    // /**
    //  * Get filtered user role from database
    //  *
    //  * @return mixed
    //  */ 
    /**
     * Creates a new item in table
     *
     * @param Array $data
     * @return mixed
     */
    public function createItem($data)
    {
        $item = new HaatItemModel($data);
        $item->save();
        //==Add User Activity
        $activity='updated haat item master  '.$data['item_name'];
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
        return HaatItemModel::findOrFail($id);
    }


    public function validateCreate($data)
    {    
        $model = new HaatItemModel();
        return Validator::make($data, [ 
            'item_name'=>'required|unique:haat_bazaar_item_master,item_name,'.$data['item_name'],
            'specification'=>'required',
            'unit'=>'required|numeric',
            'cost'=>'required|numeric',
        ],
        [
            'item_name.required' => 'Please provide Item name',
            'specification.required' => 'Please provide Specification',
            'unit.required' => 'Please provide Unit',
            'cost.required' => 'Please provide Cost',
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
        $item = HaatItemModel::findOrFail($id);

        $item->item_name = $data['item_name'];
        $item->specification = $data['specification'];
        $item->unit = $data['unit'];
        $item->cost = $data['cost'];

        $item->save();
        //==Add User Activity
        $activity='updated haat item master  '.$data['item_name'];
        $module='master';
        $this->addUserActivity($activity,$module);
        return $item;
    }

    // /**
    //  * Delete an item from database
    //  *
    //  * @param integer $id
    //  * @return boolean
    //  */
    public function deleteItem($id)
    {
        $item = HaatItemModel::findOrFail($id);
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
        $model = new HaatItemModel();
        return Validator::make($data, [
            'item_name'=>['required',
                Rule::unique('mysql.haat_bazaar_item_master')->ignore($id)
            ],
            'specification'=>'required',
            'unit'=>'required|numeric',
            'cost'=>'required|numeric',
        ],
            [
            'item_name.required' => 'Please provide Item name',
            'specification.required' => 'Please provide Specification',
            'unit.required' => 'Please provide Unit',
            'cost.required' => 'Please provide Cost',
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
        $model = HaatItemModel::where([
            'id' => $id
        ])->firstOrFail();
        $model->switchStatus();
        $model->save();
        return $model->status;
    }


    public function getAllData()
    {

        $query = HaatItemModel::all();
        $query->where('status','1');
       
        return $query;
    }
}
