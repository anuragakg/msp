<?php

namespace App\Services\Masters;

use App\Services\Service;
use Illuminate\Support\Facades\Auth;
use App\Models\Masters\District as ServiceModel;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class LocationService extends Service
{
    /**
     * Get all items from database
     *
     * @return mixed
     */
    function getAll($filters,$queryParams)
    { 
        $where = [];
         if($filters){
             if (isset($filters['state'])) {
                $where['state_id'] = $filters['state'];
            }
            if (isset($filters['q'])) {
                if(!is_numeric($filters['q'])){
                $where['title'] = $filters['q'];
                }
                else{
                $where['code'] = $filters['q']; 
                }
            }
        }       
        //$query = ServiceModel::with('state')->get();

        $paginateAmount = 20;

        if (isset($queryParams['per_page'])) {
            $paginateAmount = $queryParams['per_page'];
        }

        return ServiceModel::where($where)->with('state')->paginate($paginateAmount);
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
