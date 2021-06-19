<?php

namespace App\Queries;
use Carbon\Carbon;

use App\Models\Infrastructures\Infrastructure_Development_consolidated;
use App\Models\InfraSanctionLetter as ServiceModel;
use Illuminate\Database\Eloquent\Builder;
use DB;
class InfraSanctionQuery extends BaseQuery
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
        return ServiceModel::whereHas('getConsolidatedData', function (Builder $query) use ($user,$request) {
            if(isset($request['state']) && !empty($request['state']))
            {
                $query->where('state', $request['state']);
            }
            if(isset($request['year_id']) && !empty($request['year_id']))
            {
                $query->where('year_id', $request['year_id']);
            }
             if(isset($request['from_date']) && !empty($request['from_date']))
            {
                $from_date=Carbon::createFromFormat('d/m/Y', $request['from_date']);
                $from_date=date('Y-m-d',strtotime($from_date));
                $query=$query->whereDate('infrastructure_development_sanction_letter.created_at','>=', $from_date);
            }
            if(isset($request['to_date']) && !empty($request['to_date']))
            {
                $to_date=Carbon::createFromFormat('d/m/Y', $request['to_date']);
                $to_date=date('Y-m-d',strtotime($to_date));
                $query=$query->whereDate('infrastructure_development_sanction_letter.created_at','<=', $to_date);
            }
        });
    }
    private function getNodalDeaprtment($user,$request)
    {  
        return ServiceModel::where('created_by',$user->id)->whereHas('getConsolidatedData', function (Builder $query) use ($user,$request) {
            //$query->where('state', $user->getUserDetails->state);
            
            if(isset($request['year_id']) && !empty($request['year_id']))
            {
                $query->where('year_id', $request['year_id']);
            }
            if(isset($request['from_date']) && !empty($request['from_date']))
            {
                $from_date=Carbon::createFromFormat('d/m/Y', $request['from_date']);
                $from_date=date('Y-m-d',strtotime($from_date));
              
                $query=$query->whereDate('infrastructure_development_sanction_letter.created_at','>=', $from_date);
            }
            if(isset($request['to_date']) && !empty($request['to_date']))
            {
                $to_date=Carbon::createFromFormat('d/m/Y', $request['to_date']);
                $to_date=date('Y-m-d',strtotime($to_date));
                $query=$query->whereDate('infrastructure_development_sanction_letter.created_at','<=', $to_date);
            }
        });
    }

    private function getUserAdmin($user,$request)
    {
        return ServiceModel::where('created_by',$user->id)->whereHas('getConsolidatedData', function (Builder $query) use ($user,$request) {
            //$query->where('state', $user->getUserDetails->state);
            
            if(isset($request['year_id']) && !empty($request['year_id']))
            {
                $query->where('year_id', $request['year_id']);
            }
            if(isset($request['from_date']) && !empty($request['from_date']))
            {
                $from_date=Carbon::createFromFormat('d/m/Y', $request['from_date']);
                $from_date=date('Y-m-d',strtotime($from_date));
                $query=$query->whereDate('infrastructure_development_sanction_letter.created_at','>=', $from_date);
            }
            if(isset($request['to_date']) && !empty($request['to_date']))
            {
                $to_date=Carbon::createFromFormat('d/m/Y', $request['to_date']);
                $to_date=date('Y-m-d',strtotime($to_date));
                $query=$query->whereDate('infrastructure_development_sanction_letter.created_at','<=', $to_date);
            }
        });
    }
    private function getUserCreated_by($user,$request)
    {
        return ServiceModel::where('created_by',$user->id)->whereHas('getConsolidatedData', function (Builder $query) use ($user,$request) {
            //$query->where('state', $user->getUserDetails->state);
            
            if(isset($request['year_id']) && !empty($request['year_id']))
            {
                $query->where('year_id', $request['year_id']);
            }
            if(isset($request['from_date']) && !empty($request['from_date']))
            {
                $from_date=Carbon::createFromFormat('d/m/Y', $request['from_date']);
                $from_date=date('Y-m-d',strtotime($from_date));
                $query=$query->whereDate('infrastructure_development_sanction_letter.created_at','>=', $from_date);
            }
            if(isset($request['to_date']) && !empty($request['to_date']))
            {
                $to_date=Carbon::createFromFormat('d/m/Y', $request['to_date']);
                $to_date=date('Y-m-d',strtotime($to_date));
                $query=$query->whereDate('infrastructure_development_sanction_letter.created_at','<=', $to_date);
            }
        });
    }

    
}
