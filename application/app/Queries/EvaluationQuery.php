<?php

namespace App\Queries;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder;

class EvaluationQuery extends BaseQuery
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
            1 => 'getEvaluationAdmin',
            2 => 'getEvaluationTrifedAdmin',
            3 => 'getEvaluationTrifedUser',
            4 => 'getEvaluationSnd',
            19 => 'getEvaluationSnd',
            20 => 'getEvaluationSnd',
            7 => 'getEvaluationSio',
            23 => 'getEvaluationSio',
            24 => 'getEvaluationSio',
            13 => 'getEvaluationDio',
            6 => 'getEvaluationRm',
            21 => 'getEvaluationDio',
            22 => 'getEvaluationDio',
            25 => 'getEvaluationDio',
            26 => 'getEvaluationDio',
            8 => 'getEvaluationMo',

            5 => "getEvaluationAdmin",
            14 => "getEvaluationDio",
            15 => "getEvaluationAdmin",
            16 => "getEvaluationAdmin",
            17 => "getEvaluationAdmin",
            18 => "getEvaluationAdmin",

        ];

        if (isset($mappings[$user->role])) {
            return call_user_func([$this, $mappings[$user->role]], $user);
        }

        return abort(403,'Role based query is not defined.');
    }

    private function getEvaluationAdmin($user)
    {
        return User::whereHas('getUserDetails', function (Builder $query) use ($user) {
            $query->where('role', 10);
        })
        ->get();
    }

    private function getEvaluationTrifedAdmin($user)
    {
        return User::whereHas('getUserDetails', function (Builder $query) use ($user) {
            $query->where('role', 10);
        })
        ->get();
    }

    private function getEvaluationMo($user)
    {
        return User::whereHas('getUserDetails', function (Builder $query) use ($user) {
            $query->where('state', $user->getUserDetails->state);
            $query->where('role', 10);
        })
        ->get();
    }

    private function getEvaluationSnd($user)
    {
        return User::whereHas('getUserDetails', function (Builder $query) use ($user) {
            $query->where('state', $user->getUserDetails->state);
            $query->where('role', 10);
        })
        ->get();
    }

    private function getEvaluationSio($user)
    {
        return User::whereHas('getUserDetails', function (Builder $query) use ($user) {
            $query->where('state', $user->getUserDetails->state);
            $query->where('role', 10);
        })
        ->get();
    }

    /**
     * get users for DIO
     * @param $user
     * @return mixed
     */
    public function getEvaluationDio($user)
    {
        return User::whereHas('getUserDetails', function (Builder $query) use ($user) {
            $query->where('state', $user->getUserDetails->state);
            $query->where('role', 10);
        })->get();

    }

    public function getEvaluationRm($user)
    {
        return User::whereHas('getUserDetails', function (Builder $query) use ($user) {
            $state_ids=array();
            $state_ids=$user->getUsersAllowedStates->pluck('state');
            $state_ids[]=$user->getUserDetails->state;       
            $query->whereIn('state', $state_ids);
            $query->where('role', 10);
        })->get();

    }

    /**
     * get user for Trifed user
     * @param $user
     * @return mixed
     */
    public function getEvaluationTrifedUser($user)
    {
        return User::whereHas('getUserDetails', function (Builder $query) use ($user) {
            $query->where('role', 10);
        })->get();
    }
}
