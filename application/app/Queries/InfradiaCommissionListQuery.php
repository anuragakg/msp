<?php

namespace App\Queries;
use App\Models\Actualdetail\Infrastructure_development_actual_detail as ServiceModel;
use Illuminate\Database\Eloquent\Builder;
use DB;
class InfradiaCommissionListQuery extends BaseQuery
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
            
        ];

        if (isset($mappings[$user->role])) {
            return call_user_func([$this, $mappings[$user->role]], $user,$request);
        }else{
            return call_user_func([$this, $mappings[6]], $user,$request);
        }

        return abort(403,'Role based query is not defined.');
    }

    private function getAdminData($user,$request)
    {
        $where=array();
        return ServiceModel::where($where)->where('commission_amount','>',0)->where('created_by', $user->id)->whereHas('getInfraFormDetails', function (Builder $query) use ($user,$request) {
                if(isset($request['search']['value']) && !empty($request['search']['value']))
                {
                    $search = $request['search']['value'];       
                    $query->where(DB::raw("CONCAT(`proposal_id`)"), 'LIKE', "%".$search."%");
                }
        });
    }
    private function getDiaData($user,$request)
    {
        $where=array();
        return ServiceModel::where($where)->where('commission_amount','>',0)->where('created_by', $user->id)->whereHas('getInfraFormDetails', function (Builder $query) use ($user,$request) {
                if(isset($request['search']['value']) && !empty($request['search']['value']))
                {
                    $search = $request['search']['value'];       
                    $query->where(DB::raw("CONCAT(`proposal_id`)"), 'LIKE', "%".$search."%");
                }
        });
    }

    private function getNodalData($user,$request)
    {
        $where=array();
        return ServiceModel::where($where)->where('commission_amount','>',0)->where('created_by', $user->id)->whereHas('getInfraFormDetails', function (Builder $query) use ($user,$request) {
                if(isset($request['search']['value']) && !empty($request['search']['value']))
                {
                    $search = $request['search']['value'];       
                    $query->where(DB::raw("CONCAT(`proposal_id`)"), 'LIKE', "%".$search."%");
                }
        });
        
    }
   
}
