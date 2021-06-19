<?php

namespace App\Services\Masters;

use App\Services\Service;
use Illuminate\Support\Facades\Auth;
use App\Models\Masters\Village as ServiceModel;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

use App\Queries\DownloadExcel\VillageDownloadExcelQuery;
class VillageService extends Service
{
    /**
     * Get all items from database
     *
     * @return mixed
     */
    function getAll($filters,$queryParams,$orderBy)
    {   
         $where = [];
         $order_by='title';
         if($filters){
            if (isset($filters['q'])) {
                $where['title'] = $filters['q'];
            }
            if (isset($filters['pincode'])) {
                $where['pincode'] = $filters['pincode'];
            }      
            if (isset($filters['code'])) {
                $where['code'] = $filters['code'];
            }       
        } 

        if($orderBy=='village')
            {
                $order_by='title';
            }
            if($orderBy=='pincode')
            {
                $order_by='pincode';
            } 

        $paginateAmount = 20;
        if (isset($queryParams['per_page'])) {
            $paginateAmount = $queryParams['per_page'];
        }

        return  ServiceModel::where($where)->orderBy($order_by, 'asc')->paginate($paginateAmount);
    }

    /**
     * Creates a new item in table
     *
     * @param Array $data
     * @return mixed
     */
    public function createItem($data)
    {
        $item = new ServiceModel();
        $item->title = $data['title'];
        $item->code = $data['code'];
        $item->pincode = $data['pincode'];
        $item->status = $data['status'];
        $item->created_by = $data['created_by'];
        $item->updated_by = $data['updated_by'];

        //$item = new ServiceModel($data);
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
        $item->code = $data['code'];
        $item->pincode = $data['pincode'];
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
                //Rule::unique($model->getTable())
                Rule::unique('mysql2.village_master')->where(function ($query) use ($data) {

                    return $query
                        ->where('title',$data['title'])
                        ->where('pincode',$data['pincode']);
                }),
            ],
            'code' => [
                'required',
                'numeric',
                Rule::unique('mysql2.village_master')
            ],
            'pincode' => 'required|numeric|digits_between:6,7',
        ],

        [
            'title.required' => 'Please provide village name',
           // 'title.alpha_spaces' => 'village name may only contain letters and spaces',
            'code.required' => 'Please provide code',
            'title.unique' => 'The Village Name and Pincode has already been taken',
            'code.unique' => 'The Village Code has already been taken'
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
                //Rule::unique($model->getTable())->ignore($id)
                Rule::unique('mysql2.village_master')->where(function ($query) use ($data) {

                    return $query
                        ->where('title',$data['title'])
                        ->where('pincode',$data['pincode']);
                        
                })->ignore($id),
            ],
            'code' => [
                'required',
                'numeric',
                Rule::unique('mysql2.village_master')->ignore($id)
            ],
            'pincode' => 'required|numeric|digits_between:6,7',
        ],
            [
                'title.required' => 'Please provide village name',
                //'title.alpha_spaces' => 'village name may only contain letters and spaces',
                'code.required' => 'Please provide code',
                'title.unique' => 'The Village Name and Pincode has already been taken',
                'code.unique' => 'The Village Code has already been taken'
            ]);
    }

    public function getVillageByName($village)
    {
        return ServiceModel::whereTitle($village)->first();
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

    public function getUser($id)
    {
        return User::findOrFail($id);
    }

     /**
     * @param $pincode
     */
    public function getVillageByPinCode($pincode)
    {
        return ServiceModel::where('pincode' ,$pincode)->get();
    }

    public function SearchVillage($filter)
    {
        if(!empty($filter['keyword'])){
            $village=$filter['keyword'];
        }
        else
        {
            $village='';
        }
        return ServiceModel::where('title','LIKE','%'.$village.'%')->groupby('title')->distinct()->limit(50)->get();
    }

    public function SearchPincode($filter)
    {   
        if(!empty($filter['keyword'])){
            $pincode=$filter['keyword'];
        }
        else
        {
            $pincode='';
        }
        return ServiceModel::where('pincode','LIKE','%'.$pincode.'%')->groupby('pincode')->distinct()->limit(50)->get();
    }

    public function export()
    {
        $this->villageDownloadExcelQuery = new VillageDownloadExcelQuery('Village');
        return $this->villageDownloadExcelQuery->executeMethods();
    }

    public function getAllData()
    {

        $query = ServiceModel::all();
        $query->where('status','1');
       
        return $query;
    }
}
