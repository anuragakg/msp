<?php

namespace App\Queries\MisReport;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder;

class MisReportMoQuery extends MisBaseQuery
{

    /**
     * MO get warehouse query in proposed haat market linkage
     * @param string $id Resource ID
     * @return Vdvk
     */
    public function __construct($serviceName ,$filters = []) 
    {
        $this->query = $this->viewAllQuery($serviceName);
        $this->filters = $filters;
    }

    public function executeMethods() 
    {

        $user = $this->getUser();
        if (isset($this->query[$user->role])) {
            return call_user_func([$this, $this->query[$user->role]], $user, $this->filters);
        }

        return abort(403,'Role based query is not defined.');
    }

    private function getMisReportMoAdmin($user, $filters)
    {
        return User::whereHas('getUserDetails', function (Builder $query) use ($filters) {
            $query->where('role', 8);
            if (isset($filters['state'])) {
                $query->where('state', $filters['state']);
            }
            if (isset($filters['district'])) {
                $query->where('district', $filters['district']);
            }
            if (isset($filters['block'])) {
                $query->where('block', $filters['block']);
            }
        })->with('getMentoringOrganisationDetails')->get();
    }

    /**
     * @param $user
     * @param $filters
     * @return mixed
     */
    private function getMisReportMoTrifedAdmin($user, $filters)
    {
        return User::whereHas('getUserDetails', function (Builder $query) use ($filters) {
            $query->where('role', 8);
            if (isset($filters['state'])) {
                $query->where('state', $filters['state']);
            }
            if (isset($filters['district'])) {
                $query->where('district', $filters['district']);
            }
            if (isset($filters['block'])) {
                $query->where('block', $filters['block']);
            }
        })->with('getMentoringOrganisationDetails')->get();
    }

    /**
     * @param $user
     * @param $filters
     * @return mixed
     */
    private function getMisReportMoTrifedUser($user, $filters)
    {
        return User::whereHas('getUserDetails', function (Builder $query) use ($filters) {
            $query->where('role', 8);
            if (isset($filters['state'])) {
                $query->where('state', $filters['state']);
            }
            if (isset($filters['district'])) {
                $query->where('district', $filters['district']);
            }
            if (isset($filters['block'])) {
                $query->where('block', $filters['block']);
            }
        })->with('getMentoringOrganisationDetails')->get();
    }

    /**
     * @param $user
     * @param $filters
     * @return mixed
     */
    private function getMisReportMoSnd($user, $filters)
    {
        return User::whereHas('getUserDetails', function (Builder $query) use ($user, $filters) {
            $query->where([
                'role' => 8,
                'state' => $user->getUserDetails->state]);
            if (isset($filters['state'])) {
                $query->where('state', $filters['state']);
            }
            if (isset($filters['district'])) {
                $query->where('district', $filters['district']);
            }
            if (isset($filters['block'])) {
                $query->where('block', $filters['block']);
            }
        })->with('getMentoringOrganisationDetails')->get();
    }

    /**
     * @param $user
     * @param $filters
     * @return mixed
     */
    private function getMisReportMoSio($user, $filters)
    {
        return User::whereHas('getUserDetails', function (Builder $query) use ($user, $filters) {
            $query->where([
                'role' => 8,
                'state' => $user->getUserDetails->state]);
            if (isset($filters['state'])) {
                $query->where('state', $filters['state']);
            }
            if (isset($filters['district'])) {
                $query->where('district', $filters['district']);
            }
            if (isset($filters['block'])) {
                $query->where('block', $filters['block']);
            }
        })->with('getMentoringOrganisationDetails')->get();
    }

    /**
     * @param $user
     * @param $filters
     * @return mixed
     */
    private function getMisReportMoDio($user, $filters)
    {
        return User::whereHas('getUserDetails', function (Builder $query) use ($user, $filters) {
            $query->where([
                'role' => 8,
                'district' => $user->getUserDetails->district]);
            if (isset($filters['state'])) {
                $query->where('state', $filters['state']);
            }
            if (isset($filters['district'])) {
                $query->where('district', $filters['district']);
            }
            if (isset($filters['block'])) {
                $query->where('block', $filters['block']);
            }
        })->with('getMentoringOrganisationDetails')->get();
    }
}
