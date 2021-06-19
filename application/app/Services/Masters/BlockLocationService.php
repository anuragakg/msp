<?php

namespace App\Services\Masters;

use App\Services\Service;
use Illuminate\Support\Facades\Auth;
use App\Models\Masters\Block as ServiceModel;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class BlockLocationService extends Service
{
    /**
     * Get all items from database
     *
     * @return mixed
     */
    public static function getAll($filters,$queryParams)
    {
         $where = [];
         if($filters){
            if (isset($filters['q'])) {
                 if(!is_numeric($filters['q'])){
                $where['title'] = $filters['q'];
                }
                else{
                $where['code'] = $filters['q']; 
                }
            }
            
            if (isset($filters['district'])) {
                $where['district_id'] = $filters['district'];
            }
        }   
        $paginateAmount = 20;

        if (isset($queryParams['per_page'])) {
            $paginateAmount = $queryParams['per_page'];
        }
        // return ServiceModel::hasManyThrough('App\Models\District', 'App\Models\State')->get();   
        return ServiceModel::where($where)->paginate($paginateAmount);
        // return ServiceModel::with('district')->get();   
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
