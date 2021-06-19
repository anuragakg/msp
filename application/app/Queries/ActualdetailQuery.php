<?php

namespace App\Queries;
use App\Models\Actualdetail\Mfp_procurement_actual_detail as ServiceModel;
use App\Models\Proposals\Mfp_procurement_transaction;
use Illuminate\Database\Eloquent\Builder;
use DB;
use phpDocumentor\Reflection\Types\Null_;

class ActualdetailQuery extends BaseQuery
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

    public function viewAllTransactionQuery($request=null)
    {
        $user = $this->getUser();

        $mappings = [
            1 => 'getAdminTransactionData',
            2 => 'getAdminTransactionData',
            3 => 'getAdminTransactionData',
            4 => 'getNodalTransactionData',
            5 => 'getNodalTransactionData',
            6 => 'getDiaTransactionData',
            7 => 'getPaTransactionData',
            
        ];

        if (isset($mappings[$user->role])) {
            return call_user_func([$this, $mappings[$user->role]], $user);
        }else{
            return call_user_func([$this, $mappings[6]], $user);
        }

        return abort(403,'Role based query is not defined.');
    }

    public function viewAllConsolidatedTransactionQuery($request=null)
    {
        $user = $this->getUser();

        $mappings = [
            1 => 'getAdminConsolidatedTransactionData',
            2 => 'getAdminConsolidatedTransactionData',
            3 => 'getAdminConsolidatedTransactionData',
            4 => 'getNodalConsolidatedTransactionData',
            5 => 'getNodalConsolidatedTransactionData',
            6 => 'getDiaConsolidatedTransactionData',
            7 => 'getPaConsolidatedTransactionData',
            
        ];

        if (isset($mappings[$user->role])) {
            return call_user_func([$this, $mappings[$user->role]], $user);
        }else{
            return call_user_func([$this, $mappings[6]], $user);
        }

        return abort(403,'Role based query is not defined.');
    }

    private function getPaTransactionData($user)
    {
        return Mfp_procurement_transaction::with(['getDiaRelease'])->where('transaction_consolidated_id',Null)->where('created_by',$user->id);
        // return ServiceModel::with(['getMfpTransaction'])->where('mfp_procurement_actual_detail.created_by', $user->id)->where('consolidated_id','>' ,0)->where('is_procurement_details_submitted',1)->where('is_overhead_details_submitted',1);
    }

    private function getDiaTransactionData($user)
    {
        return Mfp_procurement_transaction::with(['getMfpActualDetail.getActualDetailCommodity'])->where('transaction_consolidated_id',Null)->where('district_id',$user->district_id);
        // return ServiceModel::with(['getMfpTransaction'])->where('mfp_procurement_actual_detail.consolidated_id','>' ,0)->where('is_procurement_details_submitted',1)->where('is_overhead_details_submitted',1);
    }

    
    private function getNodalTransactionData($user)
    {
        return Mfp_procurement_transaction::with(['getMfpActualDetail.getActualDetailCommodity'])->where('transaction_consolidated_id',Null);
    }
    
    private function getAdminTransactionData(){
        return Mfp_procurement_transaction::with(['getMfpActualDetail.getActualDetailCommodity'])->where('transaction_consolidated_id',Null);
    }

    private function getPaConsolidatedTransactionData($user)
    {
        //where('consolidated_id','>',0)
        return ServiceModel::where('mfp_procurement_actual_detail.created_by', $user->id);
        // ->whereHas('statusLog', function (Builder $query) use ($user) {
        //     $query->whereIn('status',[0,1,2,3]);
        // });
    }
    private function getDiaConsolidatedTransactionData($user)
    {
        return ServiceModel::whereHas('statusLog', function (Builder $query) use ($user) {
                $query->orWhere('assigned_to','=',$user->id);
                $query->orWhere('assigned_by','=', $user->id);
        });
    }
    private function getNodalConsolidatedTransactionData($user)
    {
        return ServiceModel::where('consolidated_id','>',0)->whereHas('statusLog', function (Builder $query) use ($user) {
            $query->where('status', 1);
        });
    }
    private function getAdminConsolidatedTransactionData($user){
        return ServiceModel::where('consolidated_id','>',0)->whereHas('statusLog', function (Builder $query) use ($user) {
            $query->where('status', 1);
        });
    }

    private function getAdminData($user)
    {
        return ServiceModel::whereHas('getActualDetailCommodity');
    }
    private function getDiaData($user)
    {
        return ServiceModel::whereHas('getProcurementAgentDetails', function (Builder $query) use ($user) {
                $query->where('state', $user->getUserDetails->district);
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
        return ServiceModel::where('mfp_procurement_actual_detail.created_by', $user->id);
    }

    
}
