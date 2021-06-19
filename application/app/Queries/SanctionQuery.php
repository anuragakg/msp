<?php

namespace App\Queries;

use App\Models\Proposals\Mfp_procurement_consolidated;
use App\Models\SanctionLetter as ServiceModel;
use Illuminate\Database\Eloquent\Builder;
use DB;
class SanctionQuery extends BaseQuery
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
            6 => 'getDiaData',
            2 => 'getAdminData', 
            3 => 'getAdminData',
            4 => 'getNodalDeaprtment',
            5 => 'getSiaData',
            6 => 'getSiaData',
            7 => 'getSiaData',
            8 => 'getSiaData',
            9 => 'getSiaData',
            10 => 'getSiaData',
            11 => 'getSiaData',
            
        ];

        if (isset($mappings[$user->role])) {
            return call_user_func([$this, $mappings[$user->role]], $user,$request);
        }

        return abort(403,'Role based query is not defined.');
    }

    private function getAdminData($user,$request)
    {
        return ServiceModel::where('created_by', $user->id)->whereHas('getConsolidatedData', function (Builder $query) use ($user,$request) {
            if(isset($request['state']) && !empty($request['state']))
            {
                $query->where('state', $request['state']);
            }
            if(isset($request['year_id']) && !empty($request['year_id']))
            {
                $query->where('year_id', $request['year_id']);
            }
        });
    }
    private function getNodalDeaprtment($user,$request)
    {
        return ServiceModel::where('created_by', $user->id)->whereHas('getConsolidatedData', function (Builder $query) use ($user,$request) {
            //$query->where('state', $user->getUserDetails->state);
            
            if(isset($request['year_id']) && !empty($request['year_id']))
            {
                $query->where('year_id', $request['year_id']);
            }
        });
    }
    private function getSiaData($user,$request)
    {
        return ServiceModel::where('created_by', $user->id)->whereHas('getConsolidatedData', function (Builder $query) use ($user,$request) {
            //$query->where('state', $user->getUserDetails->state);
            
            if(isset($request['year_id']) && !empty($request['year_id']))
            {
                $query->where('year_id', $request['year_id']);
            }
        });
    }
    

    
}
