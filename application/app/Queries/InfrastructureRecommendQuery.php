<?php

namespace App\Queries;
use Carbon\Carbon;
use App\Models\Infrastructures\Infrastructure_development;
use App\Models\Infrastructures\Infrastructure_Development_consolidated;
use Illuminate\Database\Eloquent\Builder;
use DB;
class InfrastructureRecommendQuery extends BaseQuery
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
            2 => 'getNdData',
            4 => 'getNdData',
            6 => 'getDiaData',
            //4 => 'getOtherUsersData',
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
        
        return Infrastructure_development::whereHas('getProposedStatusLogs',function(Builder $query) use ($user,$request){
                $query->where('assigned_to', $user->id);
                $query->where('infrastructure_development_status_log.is_assigned_next_level', 1);
                $query->where('infrastructure_development_status_log.status', 1);
                if (isset($request['search']['value']) && !empty($request['search']['value'])) {
                    $search = $request['search']['value'];
                    $query->where(DB::raw("CONCAT(`proposal_id`)"), 'LIKE', "%".$search."%");
                }
                if(isset($request['from_date']) && !empty($request['from_date']))
                {
                    $from_date=Carbon::createFromFormat('d/m/Y', $request['from_date']);
                    $from_date=date('Y-m-d',strtotime($from_date));
                    $query=$query->whereDate('infrastructure_development_status_log.created_at','>=', $from_date);
                }
                if(isset($request['to_date']) && !empty($request['to_date']))
                {
                    $to_date=Carbon::createFromFormat('d/m/Y', $request['to_date']);
                    $to_date=date('Y-m-d',strtotime($to_date));
                    $query=$query->whereDate('infrastructure_development_status_log.created_at','<=', $to_date);
                }
        });
    }
    private function getDiaData($user,$request)
    { 
        return Infrastructure_development::whereHas('getProposedStatusLogs',function(Builder $query) use ($user,$request){
            
            $query->where('assigned_to', $user->id);
            $query->where('infrastructure_development_status_log.is_assigned_next_level', 1);
            $query->where('infrastructure_development_status_log.status', 1);
            if(isset($request['from_date']) && !empty($request['from_date']))
            { 
                $from_date=Carbon::createFromFormat('d/m/Y', $request['from_date']);
                $from_date=date('Y-m-d',strtotime($from_date));
                $query=$query->whereDate('infrastructure_development_status_log.created_at','>=', $from_date);
            }
            if(isset($request['to_date']) && !empty($request['to_date']))
            {
                $to_date=Carbon::createFromFormat('d/m/Y', $request['to_date']);
                $to_date=date('Y-m-d',strtotime($to_date));
                $query=$query->whereDate('infrastructure_development_status_log.created_at','<=', $to_date);
            }
            if (isset($request['search']['value']) && !empty($request['search']['value'])) {
                $search = $request['search']['value'];
                $query->where(DB::raw("CONCAT(`proposal_id`)"), 'LIKE', "%".$search."%");
            }
        });
    }
    private function getOtherUsersData($user,$request)
    {  
        $query= Infrastructure_Development_consolidated::whereHas('getInfrastructures',function(Builder $query) use ($user,$request){
                $query->where('approved_by','!=',$user->id);
            })
            ->whereHas('getProposedStatusLogs',function(Builder $query) use ($user,$request){
            if($user->role != 1 && $user->role != 3 ){
                //$query->where('assigned_by', $user->id);
            }
            //if logged in user is ministry
            if($user->role == 3){
                //$query->where('assigned_to', $user->id);
                
            }
            $query->where('assigned_to', $user->id);
            $query->where('infrastructure_development_status_log.is_assigned_next_level', 1);
            $query->where('infrastructure_development_status_log.status', 1);

            if(isset($request['from_date']) && !empty($request['from_date']))
                {
                    $from_date=Carbon::createFromFormat('d/m/Y', $request['from_date']);
                    $from_date=date('Y-m-d',strtotime($from_date));
                    $query=$query->whereDate('infrastructure_development_status_log.created_at','>=', $from_date);
                }
                if(isset($request['to_date']) && !empty($request['to_date']))
                {
                    $to_date=Carbon::createFromFormat('d/m/Y', $request['to_date']);
                    $to_date=date('Y-m-d',strtotime($to_date));
                    $query=$query->whereDate('infrastructure_development_status_log.created_at','<=', $to_date);
                }
        });
            
        if (isset($request['search']['value']) && !empty($request['search']['value'])) {
            $search = $request['search']['value'];
            $query->where(DB::raw("CONCAT(`reference_number`)"), 'LIKE', "%".$search."%");
        }
        return $query;
    }


     private function getSiaData($user,$request)
    { 
        $query= Infrastructure_Development_consolidated::whereHas('getInfrastructures')
            ->whereHas('getProposedStatusLogs',function(Builder $query) use ($user,$request){
            $query->where('assigned_to', $user->id);
            $query->where('infrastructure_development_status_log.is_assigned_next_level', 1);
            $query->where('infrastructure_development_status_log.status', 1);
            if(isset($request['from_date']) && !empty($request['from_date']))
                {
                    $from_date=Carbon::createFromFormat('d/m/Y', $request['from_date']);
                    $from_date=date('Y-m-d',strtotime($from_date));
                    $query=$query->whereDate('infrastructure_development_status_log.created_at','>=', $from_date);
                }
                if(isset($request['to_date']) && !empty($request['to_date']))
                {
                    $to_date=Carbon::createFromFormat('d/m/Y', $request['to_date']);
                    $to_date=date('Y-m-d',strtotime($to_date));
                    $query=$query->whereDate('infrastructure_development_status_log.created_at','<=', $to_date);
                }
        });
            
        if (isset($request['search']['value']) && !empty($request['search']['value'])) {
             
            $search = $request['search']['value'];
            $query->where(DB::raw("CONCAT(`reference_number`)"), 'LIKE', "%".$search."%");
        }
        return $query;
    }
       
       private function getNdData($user,$request)
    {  
        $query= Infrastructure_Development_consolidated::whereHas('getInfrastructures')
            ->whereHas('getProposedStatusLogs',function(Builder $query) use ($user,$request){
            $query->where('assigned_to', $user->id);
            $query->where('infrastructure_development_status_log.is_assigned_next_level', 1);
            $query->where('infrastructure_development_status_log.status', 1);
            if(isset($request['from_date']) && !empty($request['from_date']))
                {
                    $from_date=Carbon::createFromFormat('d/m/Y', $request['from_date']);
                    $from_date=date('Y-m-d',strtotime($from_date));
                    $query=$query->whereDate('infrastructure_development_status_log.created_at','>=', $from_date);
                }
                if(isset($request['to_date']) && !empty($request['to_date']))
                {
                    $to_date=Carbon::createFromFormat('d/m/Y', $request['to_date']);
                    $to_date=date('Y-m-d',strtotime($to_date));
                    $query=$query->whereDate('infrastructure_development_status_log.created_at','<=', $to_date);
                }
        });
            
        if (isset($request['search']['value']) && !empty($request['search']['value'])) {
             
            $search = $request['search']['value'];
            $query->where(DB::raw("CONCAT(`reference_number`)"), 'LIKE', "%".$search."%");
        }
        return $query;
    } 
    
    
}
