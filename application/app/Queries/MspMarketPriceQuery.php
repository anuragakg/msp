<?php

namespace App\Queries;

use App\Models\MspMarketPrice\MfpMarketPriceModel as ServiceModel;
use Illuminate\Database\Eloquent\Builder;
use DB;
class MspMarketPriceQuery extends BaseQuery
{

    /**
     * MO get states query in proposed location
     * @param string $id Resource ID
     * @return Vdvk
     */

    public function viewAllQuery($request=null)
    {
        $user = $this->getUser();

        $mappings = [
            1 => 'getAdminData',
            2 => 'getAdminData',
            3 => 'getAdminData',
            4 => 'getNodalData',
            5 => 'getNodalData',
            6 => 'getDiaData',
            11 => 'getTradersData',
            
            
        ];

        if (isset($mappings[$user->role])) {
            return call_user_func([$this, $mappings[$user->role]], $user);
        }else{
            return call_user_func([$this, $mappings[11]], $user);
        }

        return abort(403,'Role based query is not defined.');
    }

    private function getAdminData($user)
    {
        $where=array('status'=>1);
        return ServiceModel::where($where);
    }
    
    private function getNodalData($user)
    {
        $where=array('status'=>1);
        return ServiceModel::where($where)->whereHas('getUserDetails', function (Builder $query) use ($user) {
                $query->where('state', $user->getUserDetails->state);
        });
    }
    private function getDiaData($user)
    {
        $where=array('status'=>1);
        return ServiceModel::where($where)->whereHas('getUserDetails', function (Builder $query) use ($user) {
                $query->where('state', $user->getUserDetails->state);
                $query->where('district', $user->getUserDetails->district);
        });
    }

    private function getTradersData($user)
    {
        $where=array('status'=>1);
        return ServiceModel::where($where)->where('created_by', $user->id);
    }

    
}
