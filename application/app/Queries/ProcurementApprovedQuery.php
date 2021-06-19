<?php

namespace App\Queries;
use Carbon\Carbon;
use App\Models\Proposals\Mfp_procurement;
use App\Models\Proposals\Mfp_procurement_consolidated;
use Illuminate\Database\Eloquent\Builder;
use DB;
class ProcurementApprovedQuery extends BaseQuery
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
            4 => 'getOtherUsersData',
            7 => 'getOtherUsersData',
            
            
        ];

        if (isset($mappings[$user->role])) {
            return call_user_func([$this, $mappings[$user->role]], $user,$request);
        }else{
            return call_user_func([$this, $mappings[7]], $user,$request);
        }

        return abort(403,'Role based query is not defined.');
    }

    private function getAdminData($user,$request)
    {
        
        return Mfp_procurement::where('status',1);
    }
    private function getDiaData($user,$request)
    {
        return Mfp_procurement::where('approved_by',$user->id)->whereHas('getProposedStatusLogs',function(Builder $query) use ($user,$request){
            
            $query->where('assigned_to', $user->id);
            $query->where('mfp_procurement_status_log.is_assigned_next_level', 1);
            $query->where('mfp_procurement_status_log.status', 1);
             if(isset($request['from_date']) && !empty($request['from_date']))
            {
                $from_date=Carbon::createFromFormat('d/m/Y', $request['from_date']);
                $from_date=date('Y-m-d',strtotime($from_date));
                $query=$query->whereDate('mfp_procurement_status_log.created_at','>=', $from_date);
            }
            if(isset($request['to_date']) && !empty($request['to_date']))
            {
                $to_date=Carbon::createFromFormat('d/m/Y', $request['to_date']);
                $to_date=date('Y-m-d',strtotime($to_date));
                $query=$query->whereDate('mfp_procurement_status_log.created_at','<=', $to_date);
            }
            if (isset($request['search']['value']) && !empty($request['search']['value'])) {
                $search = $request['search']['value'];
                $query->where(DB::raw("CONCAT(`proposal_id`)"), 'LIKE', "%".$search."%");
            }
        });
    }
    private function getOtherUsersData($user,$request)
    {
        $query= Mfp_procurement_consolidated::whereHas('getMfpProcurement',function(Builder $query) use ($user,$request){
                $query->where('approved_by',$user->id);
                if(isset($request['from_date']) && !empty($request['from_date']))
                {
                    $from_date=Carbon::createFromFormat('d/m/Y', $request['from_date']);
                    $from_date=date('Y-m-d',strtotime($from_date));
                    $query=$query->whereDate('mfp_procurement.approval_date','>=', $from_date);
                }
                if(isset($request['to_date']) && !empty($request['to_date']))
                {
                    $to_date=Carbon::createFromFormat('d/m/Y', $request['to_date']);
                    $to_date=date('Y-m-d',strtotime($to_date));
                    $query=$query->whereDate('mfp_procurement.approval_date','<=', $to_date);
                }
            });
            
            if (isset($request['search']['value']) && !empty($request['search']['value'])) {
                $search = $request['search']['value'];
                $query->where(DB::raw("CONCAT(`reference_number`)"), 'LIKE', "%".$search."%");
            }
        return $query;
    }

    private function getNodalData($user,$request)
    {
        return Mfp_procurement::where('approved_by',$user->id)->whereHas('getProposedStatusLogs',function(Builder $query) use ($user,$request){
            
            $query->where('assigned_to', $user->id);
            $query->where('mfp_procurement_status_log.is_assigned_next_level', 1);
            $query->where('mfp_procurement_status_log.status', 1);
            if (isset($request['search']['value']) && !empty($request['search']['value'])) {
                $search = $request['search']['value'];
                $query->where(DB::raw("CONCAT(`proposal_id`)"), 'LIKE', "%".$search."%");
            }

           if(isset($request['from_date']) && !empty($request['from_date']))
            {
                $from_date=Carbon::createFromFormat('d/m/Y', $request['from_date']);
                $from_date=date('Y-m-d',strtotime($from_date));
                $query=$query->whereDate('mfp_procurement_status_log.created_at','>=', $from_date);
            }
            if(isset($request['to_date']) && !empty($request['to_date']))
            {
                $to_date=Carbon::createFromFormat('d/m/Y', $request['to_date']);
                $to_date=date('Y-m-d',strtotime($to_date));
                $query=$query->whereDate('mfp_procurement_status_log.created_at','<=', $to_date);
            }

        });
    }
        
    
    
}
