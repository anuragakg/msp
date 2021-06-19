<?php

namespace App\Queries;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder;

class InspectionQuery extends BaseQuery
{

    /**
     * MO get states query in proposed location
     * @param string $id Resource ID
     * @return Vdvk
     */
    public function viewAllQuery()
    {
        $user = $this->getUser();

        $mappings = [
            1 => 'getInspectionAdmin',
            2 => 'getInspectionTrifedAdmin',
            3 => 'getInspectionTrifedUser',
            4 => 'getInspectionSnd',
            19 => 'getInspectionSnd',
            20 => 'getInspectionSnd',
            7 => 'getInspectionSio',
            23 => 'getInspectionSio',
            24 => 'getInspectionSio',
            13 => 'getInspectionDio',
            6 => 'getInspectionRm',
            21 => 'getInspectionDio',
            22 => 'getInspectionDio',
            25 => 'getInspectionDio',
            26 => 'getInspectionDio',
            8 => 'getInspectionMo',

            5 => "getInspectionAdmin",
            14 => "getInspectionDio",
            15 => "getInspectionAdmin",
            16 => "getInspectionAdmin",
            17 => "getInspectionAdmin",
            18 => "getInspectionAdmin",

        ];

        if (isset($mappings[$user->role])) {
            return call_user_func([$this, $mappings[$user->role]], $user);
        }

        return abort(403,'Role based query is not defined.');
    }

    private function getInspectionAdmin($user)
    {
        return User::whereHas('getUserDetails', function (Builder $query) use ($user) {
            $query->where('role', 9);
        })
        ->get();
    }

    private function getInspectionTrifedAdmin($user)
    {
        return User::whereHas('getUserDetails', function (Builder $query) use ($user) {
            $query->where('role', 9);
        })
        ->get();
    }

    private function getInspectionMo($user)
    {
        return User::whereHas('getUserDetails', function (Builder $query) use ($user) {
            $query->where('state', $user->getUserDetails->state);
            $query->where('role', 9);
        })
        ->get();
    }

    private function getInspectionSnd($user)
    {
        return User::whereHas('getUserDetails', function (Builder $query) use ($user) {
            $query->where('state', $user->getUserDetails->state);
            $query->where('role', 9);
        })
        ->get();
    }

    private function getInspectionSio($user)
    {
        return User::whereHas('getUserDetails', function (Builder $query) use ($user) {
            $query->where('state', $user->getUserDetails->state);
            $query->where('role', 9);
        })
        ->get();
    }

    private function getInspectionRm($user)
    {
        return User::whereHas('getUserDetails', function (Builder $query) use ($user) {
            $state_ids=array();
            $state_ids=$user->getUsersAllowedStates->pluck('state');
            $state_ids[]=$user->getUserDetails->state;   
            $query->whereIn('state', $state_ids);
            //$query->where('state', $user->getUserDetails->state);
            $query->where('role', 9);
        })
        ->get();
    }

    /**
     * get users for DIO
     * @param $user
     * @return mixed
     */
    public function getInspectionDio($user)
    {
        return User::whereHas('getUserDetails', function (Builder $query) use ($user) {
            $query->where('state', $user->getUserDetails->state);
            $query->where('role', 9);
        })->get();

    }

    /**
     * get user for Trifed user
     * @param $user
     * @return mixed
     */
    public function getInspectionTrifedUser($user)
    {
        return User::whereHas('getUserDetails', function (Builder $query) use ($user) {
            $query->where('role', 9);
        })->get();
    }
}
