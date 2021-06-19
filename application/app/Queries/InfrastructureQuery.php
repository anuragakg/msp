<?php

namespace App\Queries;

use App\Models\Infrastructures\Infrastructure_development as ServiceModel;

use DB;
class InfrastructureQuery extends BaseQuery
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
            3 => 'getAdminData',
            6 => 'getDioData',
            5 => 'getSiaData',
            4 => 'getNodalData',
        ];

        if (isset($mappings[$user->role])) {
            return call_user_func([$this, $mappings[$user->role]], $user);
        }

        return abort(403,'Role based query is not defined.');
    }

    private function getAdminData($user)
    {        
       return ServiceModel::where('submission_status',1);
    }
    private function getDioData($user)
    {
        return ServiceModel::where('created_by', $user->id);
    }

    private function getSiaData($user)
    {
        return ServiceModel::where('submission_status',1);
    }
     private function getNodalData($user)
    {
        return ServiceModel::where('submission_status',1); 
    }
}
