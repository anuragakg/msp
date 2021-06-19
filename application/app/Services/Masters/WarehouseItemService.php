<?php

namespace App\Services\Masters;

use App\Services\Service;
use Illuminate\Support\Facades\Auth;
use App\Models\Masters\WarehouseItem as WarehouseItemModal;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class WarehouseItemService extends Service
{
    /**
     * Get all items from database
     *
     * @return mixed
     */
    public function getAll()
    {
        $query= WarehouseItemModal::all();

        if(isset($request['status']) && !empty($request['status']))
                {                          
                    return $query->where('status','1');
                }
        return $query;
    }


    public function getWarehouseitemListing($request)
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


        $query= WarehouseItemModal::orderBy($order,$dir);
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
        $item = new WarehouseItemModal($data);
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
        return WarehouseItemModal::findOrFail($id);
    }


    public function validateCreate($data)
    {    
        $model = new WarehouseItemModal();
        return Validator::make($data, [ 
            'item_name'=>'required|unique:warehouse_item_master,item_name,'.$data['item_name'],
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
        $item = WarehouseItemModal::findOrFail($id);

        $item->item_name = $data['item_name'];
        $item->specification = $data['specification'];
        $item->unit = $data['unit'];
        $item->cost = $data['cost'];

        $item->save();

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
        $item = WarehouseItemModal::findOrFail($id);
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
        $model = new WarehouseItemModal();
        return Validator::make($data, [
             'item_name'=>'required|unique:warehouse_item_master,item_name,'.$data['item_name'],
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
        $model = WarehouseItemModal::where([
            'id' => $id
        ])->firstOrFail();
        $model->switchStatus();
        $model->save();
        return $model->status;
    }
}
