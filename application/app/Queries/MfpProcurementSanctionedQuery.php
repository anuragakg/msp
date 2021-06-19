<?php

namespace App\Queries;

use App\Models\Mfp_procurement_sanctioned;
use Illuminate\Database\Eloquent\Builder;
use DB;
class MfpProcurementSanctionedQuery extends BaseQuery
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
            $where['mfp_procurement_sanction.is_sanctioned']=$request['status'];
        }
        return Mfp_procurement_sanctioned::join('mfp_procurement_consolidation', function($join) {
                  $join->on('mfp_procurement_sanction.consolidated_id', '=', 'mfp_procurement_consolidation.id');
                });
    }
    private function getTrifedData($user,$request)
    {
        $where=array();
       
        if(isset($request['status']) && $request['status']!='')
        {
            $where['mfp_procurement_sanction.is_sanctioned']=$request['status'];
        }
        $query= Mfp_procurement_sanctioned::join('mfp_procurement_consolidation', function($join) {
                  $join->on('mfp_procurement_sanction.consolidated_id', '=', 'mfp_procurement_consolidation.id');
                });

        $query->where('mfp_procurement_sanction.sanctioned_amount','>',0);
        return $query;
    }
    private function getMinistryData($user,$request)
    {
        $where=array();
       
        if(isset($request['status']) && $request['status']!='')
        {
            $where['mfp_procurement_sanction.is_sanctioned']=$request['status'];
        }
        
        $where['assigned_to'] = $user->id;    
        
        return Mfp_procurement_sanctioned::where($where)->join('mfp_procurement_consolidation', function($join) {
                  $join->on('mfp_procurement_sanction.consolidated_id', '=', 'mfp_procurement_consolidation.id');
                });
    }
    
    private function getNodalData($user,$request)
    {
       $where=array();
       
        if(isset($request['status']) && $request['status']!='')
        {
            $where['mfp_procurement_sanction.is_sanctioned']=$request['status'];
        }
        
        $where['assigned_to'] = $user->id;    
        
        return Mfp_procurement_sanctioned::where($where)->join('mfp_procurement_consolidation', function($join) {
                  $join->on('mfp_procurement_sanction.consolidated_id', '=', 'mfp_procurement_consolidation.id');
                });
    }


    
}
