<?php

namespace App\Services\Masters;

use App\Services\Service;
use Illuminate\Support\Facades\Auth;
use App\Models\Masters\MultipurposeProcurementItem as MultipurposeProcurementModel;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class MultipurposeProcurementService extends Service
{
    /**
     * Get all items from database
     *
     * @return mixed
     */
    public function getAll()
    {
        return MultipurposeProcurementModel::all();
    }


    public function getitemListing($request)
    {
     
        $columns = array( 
                                0 =>'id', 
                                1=> 'item_name',
                                2=> 'specification',
                                3=> 'unit',
                                4=> 'cost'
            );
        $limit = isset($request['length'])?$request['length']:10;
        $start = $request['start']??0; 
        if(isset($request['order']))
        {
            $order = isset($columns[$request['order'][0]['column']])?$columns[$request['order'][0]['column']]:'id';    
        }else{
            $order = 'id';
        }
        
        $dir = isset($request['order'][0]['dir'])?$request['order'][0]['dir']:'DESC';
        
        $search = isset($request['search']['value'])?$request['search']['value']:''; 


        $query= MultipurposeProcurementModel::orderBy($order,$dir);
        if(isset($search) && !empty($search))
        {
            $query->where('item_name','LIKE',"%{$search}%");    
            $query->orWhere('specification','LIKE',"%{$search}%"); 
        }
        if(isset($request['page']) && !empty($request['page']))
        {
            return $query->paginate($limit);    
        }else{
            $query=$query->where('status','1');
            return $query->get();
        }
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
        $item = new MultipurposeProcurementModel($data);
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
        return MultipurposeProcurementModel::findOrFail($id);
    }


    public function validateCreate($data)
    {    
        $model = new MultipurposeProcurementModel();
        return Validator::make($data, [ 
            'item_name'=>'required|unique:multipurpose_procurement_centre_item_master,item_name,'.$data['item_name'],
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
        $item = MultipurposeProcurementModel::findOrFail($id);

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
        $item = MultipurposeProcurementModel::findOrFail($id);
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
        $model = new MultipurposeProcurementModel();
        return Validator::make($data, [
            'item_name'=>'required|unique:multipurpose_procurement_centre_item_master,item_name,'.$data['item_name'],
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
        $model = MultipurposeProcurementModel::where([
            'id' => $id
        ])->firstOrFail();
        $model->switchStatus();
        $model->save();
        return $model->status;
    }
}
