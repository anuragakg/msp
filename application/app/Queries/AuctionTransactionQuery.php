<?php

namespace App\Queries;
use App\Models\Masters\District;
use App\Models\Auction\AuctionTransaction;
use App\Models\Auction\AuctionTransactionDetail;
use Illuminate\Database\Eloquent\Builder;
use DB;
class AuctionTransactionQuery extends BaseQuery
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
            
            
        ];

        if (isset($mappings[$user->role])) {
            return call_user_func([$this, $mappings[$user->role]], $user);
        }else{
            return call_user_func([$this, $mappings[5]], $user);
        }

        return abort(403,'Role based query is not defined.');
    }

    private function getAdminData($user)
    {
        $where=array();
        return AuctionTransactionDetail::where($where);
    }
    private function getDiaData($user)
    {
        return AuctionTransactionDetail::where('created_by', $user->id);
    }
    private function getNodalData($user)
    {
        $districts_ids=District::where('state_id', $user->getUserDetails->state)->pluck('id');
        return AuctionTransactionDetail::whereIn('district_id', $districts_ids);
        
    }

    private function getPaData($user)
    {
        return AuctionTransactionDetail::where('created_by', $user->id);
    }

    
}
