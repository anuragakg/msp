<?php

namespace App\Queries;

use App\Models\Mfp_procurement_dia_release_summary as ServiceModel;
use Illuminate\Database\Eloquent\Builder;
use DB;
class FundReceivedProcurementAgentQuery extends BaseQuery
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
            7 => 'getProcurementAgentData',
            
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
        if(isset($request['procurement_agent']) && !empty($request['procurement_agent']))
        {
            $where['procurement_agent']=$request['procurement_agent'];
        }
        return ServiceModel::with('getActualOverheadDetails')->where($where)->whereHas('getMfpProcurement', function (Builder $query) use ($user,$request) {
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
        if(isset($request['procurement_agent']) && !empty($request['procurement_agent']))
        {
            $where['procurement_agent']=$request['procurement_agent'];
        }
        return ServiceModel::where($where)->where('created_by', $user->id)->whereHas('getMfpProcurement', function (Builder $query) use ($user,$request) {
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
        if(isset($request['procurement_agent']) && !empty($request['procurement_agent']))
        {
            $where['procurement_agent']=$request['procurement_agent'];
        }
        return ServiceModel::where($where)->whereHas('getProcurementAgentDetails', function (Builder $query) use ($user) {
                $query->where('state', $user->getUserDetails->state);
        })->whereHas('getMfpProcurement', function (Builder $query) use ($user,$request) {
                if(isset($request['search']['value']) && !empty($request['search']['value']))
                {
                    $search = $request['search']['value'];       
                    $query->where(DB::raw("CONCAT(`proposal_id`)"), 'LIKE', "%".$search."%");
                }
        });
    }

    private function getProcurementAgentData($user,$request)
    {
        $where=array();
        if(isset($request['procurement_agent']) && !empty($request['procurement_agent']))
        {
            $where['procurement_agent']=$request['procurement_agent'];
        }
        return ServiceModel::with('getActualOverheadDetails')->where($where)->where('procurement_agent', $user->id)
        ->whereHas('getMfpProcurement', function (Builder $query) use ($user,$request) {
                if(isset($request['search']['value']) && !empty($request['search']['value']))
                {
                    $search = $request['search']['value'];       
                    $query->where(DB::raw("CONCAT(`proposal_id`)"), 'LIKE', "%".$search."%");
                }
        });
    }    
}
