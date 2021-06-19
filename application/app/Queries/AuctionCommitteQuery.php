<?php

namespace App\Queries;

use App\Models\Auction\AuctionCommitte as ServiceModel;
use Illuminate\Database\Eloquent\Builder;
use DB;
class AuctionCommitteQuery extends BaseQuery
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
            return call_user_func([$this, $mappings[6]], $user);
        }

        return abort(403,'Role based query is not defined.');
    }

    private function getAdminData($user)
    {
        
        return ServiceModel::whereHas('getCommitteMember');
    }
    private function getDiaData($user)
    {
        return ServiceModel::where('created_by', $user->id);
    }
    private function getNodalData($user)
    {
        return ServiceModel::where('state_id', $user->getUserDetails->state);
        
    }

    private function getPaData($user)
    {
        return ServiceModel::where('created_by', $user->id);
    }

    
}
