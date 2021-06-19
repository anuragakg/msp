<?php

namespace App\Queries;
use Carbon\Carbon;

use App\Models\Infrastructures\Infrastructure_Development_sanctioned;
use Illuminate\Database\Eloquent\Builder;
use DB;
class InfrastructureSanctionedQuery extends BaseQuery
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
            2 => 'getTrifedData',
            3 => 'getMinistryData',
            4 => 'getNodalData',
            5 => 'getNodalData',
        
        ];

        if (isset($mappings[$user->role])) {
            return call_user_func([$this, $mappings[$user->role]], $user,$request);
        }

        return abort(403,'Role based query is not defined.');
    }

    private function getAdminData($user,$request)
    {
        $where=array();
       
        if(isset($request['status']) && $request['status']!='')
        {
            $where['infrastructure_development_sanction.is_sanctioned']=$request['status'];
        }
        return Infrastructure_Development_sanctioned::join('infrastructure_development_consolidation', function($join) {
                  $join->on('infrastructure_development_sanction.consolidated_id', '=', 'infrastructure_development_consolidation.id');
                });
    }
    private function getTrifedData($user,$request)
    {
        $where=array();
       
        if(isset($request['status']) && $request['status']!='')
        {
            $where['infrastructure_development_sanction.is_sanctioned']=$request['status'];
        }
        $query= Infrastructure_Development_sanctioned::join('infrastructure_development_consolidation', function($join) {
                  $join->on('infrastructure_development_sanction.consolidated_id', '=', 'infrastructure_development_consolidation.id');
                });

        $query->where('infrastructure_development_sanction.sanctioned_amount','>',0);

        if(isset($request['from_date']) && !empty($request['from_date']))
            {
                $from_date=Carbon::createFromFormat('d/m/Y', $request['from_date']);
                $from_date=date('Y-m-d',strtotime($from_date));
                $query=$query->whereDate('infrastructure_development_sanction.created_at','>=', $from_date);
            }
            if(isset($request['to_date']) && !empty($request['to_date']))
            {
                $to_date=Carbon::createFromFormat('d/m/Y', $request['to_date']);
                $to_date=date('Y-m-d',strtotime($to_date));
                $query=$query->whereDate('infrastructure_development_sanction.created_at','<=', $to_date);
            }
        return $query;
    }
    private function getMinistryData($user,$request)
    {
        $where=array();
       
        if(isset($request['status']) && $request['status']!='')
        {
            $where['infrastructure_development_sanction.is_sanctioned']=$request['status'];
        }
        
        $where['assigned_to'] = $user->id;    

         $query=Infrastructure_Development_sanctioned::where($where);
         if(isset($request['from_date']) && !empty($request['from_date']))
            {
                $from_date=Carbon::createFromFormat('d/m/Y', $request['from_date']);
                $from_date=date('Y-m-d',strtotime($from_date));
                $query=$query->whereDate('infrastructure_development_sanction.created_at','>=', $from_date);
            }
            if(isset($request['to_date']) && !empty($request['to_date']))
            {
                $to_date=Carbon::createFromFormat('d/m/Y', $request['to_date']);
                $to_date=date('Y-m-d',strtotime($to_date));
                $query=$query->whereDate('infrastructure_development_sanction.created_at','<=', $to_date);
            }
         $query=$query->join('infrastructure_development_consolidation', function($join) {
                  $join->on('infrastructure_development_sanction.consolidated_id', '=', 'infrastructure_development_consolidation.id');
                });
         return $query;
    }
    
    private function getNodalData($user,$request)
    {
       $where=array();
       
        if(isset($request['status']) && $request['status']!='')
        {
            $where['infrastructure_development_sanction.is_sanctioned']=$request['status'];
        }
        
        $where['assigned_to'] = $user->id;    
        
        $query= infrastructure_development_sanctioned::where($where);
         if(isset($request['from_date']) && !empty($request['from_date']))
            {
                $from_date=Carbon::createFromFormat('d/m/Y', $request['from_date']);
                $from_date=date('Y-m-d',strtotime($from_date));                
                $query=$query->whereDate('infrastructure_development_sanction.created_at','>=', $from_date);
            }
            if(isset($request['to_date']) && !empty($request['to_date']))
            {
                $to_date=Carbon::createFromFormat('d/m/Y', $request['to_date']);
                $to_date=date('Y-m-d',strtotime($to_date));
                $query=$query->whereDate('infrastructure_development_sanction.created_at','<=', $to_date);
            }

        $query=$query->join('infrastructure_development_consolidation', function($join) {
                  $join->on('infrastructure_development_sanction.consolidated_id', '=', 'infrastructure_development_consolidation.id');
                });
    
         return $query;
    }


    
}
