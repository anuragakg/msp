<?php

namespace App\Queries;
use App\Models\Mfp_procurement_fund_released_history as ServiceModel;
use Illuminate\Database\Eloquent\Builder;
use DB;
class SiaCommissionListQuery extends BaseQuery
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

    private function getAdminData($user,$request)
    {
        $where=array();
         return ServiceModel::where($where)->where('commission_amount','>',0);
    }
    private function getDiaData($user,$request)
    {
        $where=array();
         return ServiceModel::where($where)->where('commission_amount','>',0)->whereHas('getUserDetails', function (Builder $query) use ($user,$request) {
            $query->where('state', $user->getUserDetails->state);
        });
    }

    private function getNodalData($user,$request)
    {
        $where=array();
        if(isset($request['procurement_agent']) && !empty($request['procurement_agent']))
        {
            $where['procurement_agent']=$request['procurement_agent'];
        }
        if(isset($request['proposal_id']) && !empty($request['proposal_id']))
        {
            $where['mfp_procurement_id']=$request['proposal_id'];
        }
        return ServiceModel::where($where)->where('commission_amount','>',0)->whereHas('getUserDetails', function (Builder $query) use ($user,$request) {
            $query->where('state', $user->getUserDetails->state);
        });
        
    }
    private function getSiaData($user,$request)
    {
        $where=array();
        
         return ServiceModel::where($where)->where('commission_amount','>',0)->where('created_by',$user->id)->whereHas('getConsolidatedData', function (Builder $query) use ($user,$request) {  
             $search = $request['search']['value'];
             if (isset($search) && !empty($search)) { 
            $query->where('reference_number', $search);
        }
        });
        
    }

    
}
