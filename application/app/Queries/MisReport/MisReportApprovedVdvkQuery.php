<?php

namespace App\Queries\MisReport;

use App\Models\Proposed\ProposedLocation;
use App\Models\Proposed\Vdvk;
use Illuminate\Database\Eloquent\Builder;

class MisReportApprovedVdvkQuery extends MisBaseQuery
{

    /**
     * MO get haat market query in proposed haat market linkage
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

        return abort(403, 'Role based query is not defined.');
    }

    private function getMisReportApprovedVdvkMo($user, $filters)
    {
        $state = $user->getUserDetails->state ?? 0;
        return Vdvk::whereHas('getProposedLocation', function (Builder $query) use ($user,$filters, $state) {
            $query->where([
                'state' => $state,
                'created_by' => $user->id]);
            if (isset($filters['state'])) {
                $query->where('state', $filters['state']);
            }
            if (isset($filters['district'])) {
                $query->where('district', $filters['district']);
            }
            if (isset($filters['block'])) {
                $query->where('block', $filters['block']);
            }
            if (isset($filters['year'])) {
                $query->where('vdvk.year_id', $filters['year']);
            }
        })->where('status', 1)->get();
    }

    private function getMisReportApprovedVdvkAdmin($user, $filters)
    {
        return Vdvk::whereHas('getProposedLocation', function (Builder $query) use ($filters) {
            if (isset($filters['state'])) {
                $query->where('state', $filters['state']);
            }
            if (isset($filters['district'])) {
                $query->where('district', $filters['district']);
            }
            if (isset($filters['block'])) {
                $query->where('block', $filters['block']);
            }
            if (isset($filters['year'])) {
                $query->where('vdvk.year_id', $filters['year']);
            }
        })->where('status', 1)->get();
    }

    /**
     * @param $user
     * @param $filters
     */
    public function getMisReportApprovedVdvkTrifedAdmin($user, $filters)
    {
        return Vdvk::whereHas('getProposedLocation', function (Builder $query) use ($filters) {
            if (isset($filters['state'])) {
                $query->where('state', $filters['state']);
            }
            if (isset($filters['district'])) {
                $query->where('district', $filters['district']);
            }
            if (isset($filters['block'])) {
                $query->where('block', $filters['block']);
            }
            if (isset($filters['year'])) {
                $query->where('vdvk.year_id', $filters['year']);
            }
        })->where('status', 1)->get();
    }

    /**
     * @param $user
     * @param $filters
     */
    public function getMisReportApprovedVdvkTrifedUser($user, $filters)
    {
        return Vdvk::whereHas('getProposedLocation', function (Builder $query) use ($filters) {
            if (isset($filters['state'])) {
                $query->where('state', $filters['state']);
            }
            if (isset($filters['district'])) {
                $query->where('district', $filters['district']);
            }
            if (isset($filters['block'])) {
                $query->where('block', $filters['block']);
            }
            if (isset($filters['year'])) {
                $query->where('vdvk.year_id', $filters['year']);
            }
        })->where('status', 1)->get();
    }

    /**
     * @param $user
     * @param $filters
     */
    public function getMisReportApprovedVdvkSnd($user, $filters)
    {
        return Vdvk::whereHas('getProposedLocation', function (Builder $query) use ($user, $filters) {
            $query->where([
                'state' => $user->getUserDetails->state
            ]);
            if (isset($filters['state'])) {
                $query->where('state', $filters['state']);
            }
            if (isset($filters['district'])) {
                $query->where('district', $filters['district']);
            }
            if (isset($filters['block'])) {
                $query->where('block', $filters['block']);
            }
            if (isset($filters['year'])) {
                $query->where('vdvk.year_id', $filters['year']);
            }
        })->where('status', 1)->get();
    }

    /**
     * @param $user
     * @param $filters
     */
    public function getMisReportApprovedVdvkSio($user, $filters)
    {
        return Vdvk::whereHas('getProposedLocation', function (Builder $query) use ($user, $filters) {
            $query->where([
                'state' => $user->getUserDetails->state
            ]);
            if (isset($filters['state'])) {
                $query->where('state', $filters['state']);
            }
            if (isset($filters['district'])) {
                $query->where('district', $filters['district']);
            }
            if (isset($filters['block'])) {
                $query->where('block', $filters['block']);
            }
            if (isset($filters['year'])) {
                $query->where('vdvk.year_id', $filters['year']);
            }
        })->where('status', 1)->get();
    }

    /**
     * @param $user
     * @param $filters
     */
    public function getMisReportApprovedVdvkDio($user, $filters)
    {
        return Vdvk::whereHas('getProposedLocation', function (Builder $query) use ($user, $filters) {
            $query->where([
                'district' => $user->getUserDetails->district
            ]);
            if (isset($filters['state'])) {
                $query->where('state', $filters['state']);
            }
            if (isset($filters['district'])) {
                $query->where('district', $filters['district']);
            }
            if (isset($filters['block'])) {
                $query->where('block', $filters['block']);
            }
            if (isset($filters['year'])) {
                $query->where('vdvk.year_id', $filters['year']);
            }
        })->where('status', 1)->get();
    }

}
