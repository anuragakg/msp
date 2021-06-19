<?php

namespace App\Queries;

use App\Models\Masters\District;
use Illuminate\Database\Eloquent\Builder;

class DistrictQuery extends BaseQuery
{

    /**
     * MO get states query in proposed location
     * @param string $id Resource ID
     * @return Vdvk
     */
    public function viewAllQuery($stateId)
    {
        $user = $this->getUser();

        $mappings = [
            1 => 'getDistrictAdmin',
            2 => 'getDistrictTrifedAdmin',
            3 => 'getDistrictTrifedUser',
            4 => 'getDistrictSnd',
            19 => 'getDistrictSnd',
            20 => 'getDistrictSnd',
            7 => 'getDistrictSio',
            23 => 'getDistrictSio',
            24 => 'getDistrictSio',
            8 => 'getDistrictMo',
            9 => 'getDistrictInspection',
            10 => 'getDistrictEvaluation',
            13 => 'getDistrictDio',
            6 => 'getDistrictRm',
            21 => 'getDistrictDio',
            22 => 'getDistrictDio',
            11 => 'getDistrictSurveyor',
            12 => 'getDistrictSupervisor',

            5 => "getDistrictAdmin",
            14 => "getDistrictDio",
            25 => "getDistrictDio",
            26 => "getDistrictDio",
            15 => "getDistrictAdmin",
            16 => "getDistrictAdmin",
            17 => "getDistrictAdmin",
            18 => "getDistrictAdmin",
            27 => "getDistrictAdmin",
        ];

        if (isset($mappings[$user->role])) {
            return call_user_func([$this, $mappings[$user->role]], $user, $stateId);
        }

        return abort(403,'Role based query is not defined.');
    }

     private function getDistrictMo($user,$stateId)
    {
        return District::where('state_id','=',$stateId)->get();
        //return $this->getDistrictByUserDistrict($user);//commented by anurag on 16-03-2020
    }

     private function getDistrictRm($user,$stateId)
    {
        return District::where('state_id','=',$stateId)->get();
        //return $this->getDistrictByUserDistrict($user);//commented by anurag on 16-03-2020
    }

    private function getDistrictInspection($user)
    {
        return $this->getDistrictByUserState($user);
    }

    private function getDistrictEvaluation($user)
    {
        return $this->getDistrictByUserState($user);
    }

    private function getDistrictAdmin($user, $stateId)
    {
        return District::where('state_id','=',$stateId)->get();
    }

    private function getDistrictTrifedAdmin($user, $stateId)
    {
        return District::where('state_id','=',$stateId)->get();
    }

    private function getDistrictTrifedUser($user, $stateId)
    {
        return District::where('state_id','=',$stateId)->get();
    }

    private function getDistrictSnd($user) {
        return $this->getDistrictByUserState($user);
    }

    private function getDistrictSio($user) {
        return $this->getDistrictByUserState($user);
    }

    private function getDistrictDio($user) {
        return $this->getDistrictByUserDistrict($user);
    }

    private function getDistrictSurveyor($user,$stateId) {
        return District::where('state_id','=',$stateId)->get();
        //return $this->getDistrictByUserDistrict($user);
    }

    private function getDistrictSupervisor($user) {
        return $this->getDistrictByUserState($user);
    }

    private function getDistrictByUserState($user) {
        return District::where('state_id', $user->getUserDetails->state)->get();
    }

    private function getDistrictByUserDistrict($user) {
        return District::where('id', $user->getUserDetails->district)->get();
    }
}
