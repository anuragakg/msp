<?php

namespace App\Queries;

use App\Models\Masters\Mfp as ServiceModel;
use Illuminate\Database\Eloquent\Builder;
use DB;
class MfpQuery extends BaseQuery
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
            4 => 'getDioData',
            5 => 'getSiaData',
            6 => 'getDioData',
            7 => 'getPaData',
            8 => 'getAdminData',
            9 => 'getSiaData', //for warehouse user data show according to state
            10 => 'getAdminData',
            11 => 'getTradersData',
            
        ];

        if (isset($mappings[$user->role])) {
            return call_user_func([$this, $mappings[$user->role]], $user);
        }else{
            return call_user_func([$this, $mappings[1]], $user);
        }

        return abort(403,'Role based query is not defined.');
    }

    private function getAdminData($user)
    {
        
        return ServiceModel::select('*');
    }
    private function getDioData($user)
    {
        return ServiceModel::where('state_id', $user->getUserDetails->state);
    }

    private function getSiaData($user)
    {
        return ServiceModel::where('state_id', $user->getUserDetails->state);
    }
    private function getTradersData($user)
    {
        return ServiceModel::where('state_id', $user->getUserDetails->state);
    }
	private function getPaData($user)
    {
        return ServiceModel::where('state_id', $user->getUserDetails->state);
    }

    
}
