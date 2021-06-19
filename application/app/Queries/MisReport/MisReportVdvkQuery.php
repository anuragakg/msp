<?php

namespace App\Queries\MisReport;

use App\Models\Proposed\ProposedLocation;
use App\Models\Proposed\Vdvk;
use Illuminate\Database\Eloquent\Builder;

class MisReportVdvkQuery extends MisBaseQuery
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

    private function getMisReportVdvkMo($user, $filters)
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
            if (isset($filters['status'])) {
                $query->where('vdvk.status', $filters['status']);
            }
        })->get();
    }

    private function getMisReportVdvkAdmin($user, $filters)
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
            if (isset($filters['status'])) {
                $query->where('vdvk.status', $filters['status']);
            }
        })->get();
    }

    private function getMisReportVdvkDemoUnitMo($user, $filters)
    {
        $state = $user->getUserDetails->state ?? 0;
        return Vdvk::where('demo_unit', 1)->whereHas('getProposedLocation', function (Builder $query) use ($filters, $state) {
            $query->where('state', $state);
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
            if (isset($filters['status'])) {
                $query->where('vdvk.status', $filters['status']);
            }
        })->get();
    }

    private function getMisReportVdvkDemoUnitAdmin($user, $filters)
    {
        return Vdvk::where('demo_unit', 1)->whereHas('getProposedLocation', function (Builder $query) use ($filters) {
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
            if (isset($filters['status'])) {
                $query->where('vdvk.status', $filters['status']);
            }
        })->get();
    }

    /**
     * @param $user
     * @param $filters
     */
    public function getMisReportVdvkTrifedAdmin($user, $filters)
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
            if (isset($filters['status'])) {
                $query->where('vdvk.status', $filters['status']);
            }
        })->get();
    }

    /**
     * @param $user
     * @param $filters
     */
    public function getMisReportVdvkTrifedUser($user, $filters)
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
            if (isset($filters['status'])) {
                $query->where('vdvk.status', $filters['status']);
            }
        })->get();
    }

    /**
     * @param $user
     * @param $filters
     */
    public function getMisReportVdvkSnd($user, $filters)
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
            if (isset($filters['status'])) {
                $query->where('vdvk.status', $filters['status']);
            }
        })->get();
    }

    /**
     * @param $user
     * @param $filters
     */
    public function getMisReportVdvkSio($user, $filters)
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
            if (isset($filters['status'])) {
                $query->where('vdvk.status', $filters['status']);
            }
        })->get();
    }

    /**
     * @param $user
     * @param $filters
     */
    public function getMisReportVdvkDio($user, $filters)
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
            if (isset($filters['status'])) {
                $query->where('vdvk.status', $filters['status']);
            }
        })->get();
    }

}
