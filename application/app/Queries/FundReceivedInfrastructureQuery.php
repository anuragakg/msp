<?php

namespace App\Queries;

use App\Models\Actualdetail\Infrastructure_development_actual_detail as ServiceModel;
use Illuminate\Database\Eloquent\Builder;
use DB;
class FundReceivedInfrastructureQuery extends BaseQuery
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
            5 => 'getSiaData',
            6 => 'getDiaData',
            
        ];

        if (isset($mappings[$user->role])) {
            return call_user_func([$this, $mappings[$user->role]], $user,$request);
        }else{
            return call_user_func([$this, $mappings[6]], $user,$request);
        }

        return abort(403,'Role based query is not defined.');
    }

    private function getAdminData($user)
    {        
       $query= ServiceModel::where('submission_status',1);
        if(isset($request['search']['value']) && !empty($request['search']['value']))
                {
                    $search = $request['search']['value'];       
                    $query->where(DB::raw("CONCAT(`proposal_id`)"), 'LIKE', "%".$search."%");
                }
        return $query;
    }
    private function getDiaData($user,$request)
    {   
       $query= ServiceModel::where('is_assigned_next_level','=',"1")->where('assigned_to','=',$user->id);
        if(isset($request['search']['value']) && !empty($request['search']['value']))
                {
                    $search = $request['search']['value'];       
                    $query->where(DB::raw("CONCAT(`proposal_id`)"), 'LIKE', "%".$search."%");
                }
        return $query;
    }

    private function getSiaData($user)
    {
        $query= ServiceModel::where('status', '1');
        if(isset($request['search']['value']) && !empty($request['search']['value']))
                {
                    $search = $request['search']['value'];       
                    $query->where(DB::raw("CONCAT(`proposal_id`)"), 'LIKE', "%".$search."%");
                }
        return $query;
    }

    private function getNodalData($user,$request)
    {
         $query= ServiceModel::where('status', 1);
         if(isset($request['search']['value']) && !empty($request['search']['value']))
                {
                    $search = $request['search']['value'];       
                    $query->where(DB::raw("CONCAT(`proposal_id`)"), 'LIKE', "%".$search."%");
                }
        return $query;
    }
 
}
