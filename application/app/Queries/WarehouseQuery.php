<?php

namespace App\Queries;

use App\Models\Masters\WarehouseMaster as ServiceModel;
use Illuminate\Database\Eloquent\Builder;
use DB;
class WarehouseQuery extends BaseQuery
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
            4 => 'getAdminData',
            5 => 'getAdminData',
            6 => 'getDioData',
            7 => 'getDioData',
            8 => 'getAdminData',
            9 => 'getAdminData',
            10 => 'getAdminData',
            11 => 'getAdminData',
            
        ];

        if (isset($mappings[$user->role])) {
            return call_user_func([$this, $mappings[$user->role]], $user);
        }else{
            return call_user_func([$this, $mappings[1]], $user);
        }

        return abort(403,'Role based query is not defined.');
    }

    private function getAdminData($user)
    {
        
        return ServiceModel::select('*');
    }
    private function getDioData($user)
    {
        return ServiceModel::where('district_id', $user->getUserDetails->district);
    }

    
}
