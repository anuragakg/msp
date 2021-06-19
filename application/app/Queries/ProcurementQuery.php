<?php

namespace App\Queries;

use App\Models\Proposals\Mfp_procurement as ServiceModel;
use Illuminate\Database\Eloquent\Builder;
use DB;
class ProcurementQuery extends BaseQuery
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
            7 => 'getPaData',
            
        ];

        if (isset($mappings[$user->role])) {
            return call_user_func([$this, $mappings[$user->role]], $user);
        }else{
            return call_user_func([$this, $mappings[6]], $user);
        }

        return abort(403,'Role based query is not defined.');
    }

    private function getAdminData($user)
    {
        
        return ServiceModel::where('submission_status',1);
    }
    private function getDiaData($user)
    {
        return ServiceModel::where('created_by', $user->id);
    }
    private function getNodalData($user)
    {
        return ServiceModel::whereHas('getUserDetails', function (Builder $query) use ($user) {
                $query->where('state', $user->getUserDetails->state);
        });
    }

    private function getPaData($user)
    {
        return ServiceModel::where('created_by', $user->id);
    }

    
}
