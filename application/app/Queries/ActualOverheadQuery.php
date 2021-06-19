<?php

namespace App\Queries;
use App\Models\Proposals\Mfp_procurement as ServiceModel;
use Illuminate\Database\Eloquent\Builder;
use DB;
class ActualOverheadQuery extends BaseQuery
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
            7 => 'getPaData',
            
        ];

        if (isset($mappings[$user->role])) {
            return call_user_func([$this, $mappings[$user->role]], $user);
        }else{
            return call_user_func([$this, $mappings[6]], $user);
        }

        return abort(403,'Role based query is not defined.');
    }

    private function getAdminData($user)
    {
        
        return ServiceModel::whereHas('getActualDetailCommodity');
    }
    private function getDiaData($user)
    {
        return ServiceModel::whereHas('getUserDetails', function (Builder $query) use ($user) {
                $query->where('district', $user->getUserDetails->district);
        });
    }
    private function getNodalData($user)
    {
        return ServiceModel::whereHas('getProcurementAgentDetails', function (Builder $query) use ($user) {
                $query->where('state', $user->getUserDetails->state);
        });
    }

    private function getPaData($user)
    {
        return ServiceModel::with('getActualOverheadCollectionLevel','getActualOverheadLabourCharges','getActualOverheadWeightmentCharges','getActualOverheadTransportationCharges','getActualOverheadServiceCharges','getActualOverheadWarehouseLabourCharges','getActualOverheadWarehouseCharges','getActualOverheadEstimatedWastages','getActualOverheadServiceChargesDIA','getActualOverheadOtherCosts');
 
    }

    
}
