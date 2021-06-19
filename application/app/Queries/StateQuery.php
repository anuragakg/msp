<?php

namespace App\Queries;

use App\Models\Masters\State;
use Illuminate\Database\Eloquent\Builder;

class StateQuery extends BaseQuery
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
            1 => 'getStateAdmin',
            2 => 'getStateTrifedAdmin',
            3 => 'getStateMinistry',
            4 => 'getStateSnd',
            5 => "getStateSnd",
            6 => 'getStateDio',
            7 => 'getStatePa',
         
            // 7 => 'getStateSio',
            // 23 => 'getStateSio',
            // 24 => 'getStateSio',
            // 8 => 'getStateMo',
       
        ];

        if (isset($mappings[$user->role])) {
            return call_user_func([$this, $mappings[$user->role]], $user);
        }

        return abort(403,'Role based query is not defined.');
    }

    private function getStateMo($user)
    {
        return $this->getStateByUserState($user);
    }

    private function getStateInspection($user)
    {
        return $this->getStateByUserState($user);
    }

    private function getStateEvaluation($user)
    {
        return $this->getStateByUserState($user);
    }

    private function getStateAdmin($user)
    {
        return State::all();
    }

    private function getStateTrifedAdmin($user)
    {
        return State::all();
    }

    private function getStateMinistry($user)
    {
        return State::all();
    }

    private function getStateSnd($user) {
        return $this->getStateByUserState($user);
    }

    private function getStateSio($user) {
        return $this->getStateByUserState($user);
    }

    private function getStateRm($user) 
    {
        $state_ids=array();
        $state_ids=$user->getUsersAllowedStates->pluck('state');
        $state_ids[]=$user->getUserDetails->state;
        return State::whereIn('id', $state_ids)->get();
    }

    private function getStateDio($user) {
        return $this->getStateByUserState($user);
    }

    private function getStateSurveyor($user) {
        return $this->getStateByUserState($user);
    }

    private function getStateSupervisor($user) {
        return $this->getStateByUserState($user);
    }

    private function getStateByUserState($user) {
        return State::where('id', $user->getUserDetails->state)->get();
    }
    private function getStatePa($user) {
        return $this->getStateByUserState($user);
    }
}
