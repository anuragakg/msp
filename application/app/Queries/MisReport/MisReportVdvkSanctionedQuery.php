<?php

namespace App\Queries\MisReport;

use App\Models\Proposed\Vdvk;
use Illuminate\Database\Eloquent\Builder;

class MisReportVdvkSanctionedQuery extends MisBaseQuery
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

    public function viewAllQuery($serviceName)
    {

        $user = $this->getUser();

        $mappings = [
            1 => 'getMisReport'.$serviceName.'Admin',
            2 => 'getMisReport'.$serviceName.'TrifedAdmin',
            3 => 'getMisReport'.$serviceName.'TrifedUser',
        ];

        return $mappings;

    }

    public function executeMethods() 
    {
        $user = $this->getUser();
        if (isset($this->query[$user->role])) {
            return call_user_func([$this, $this->query[$user->role]], $user, $this->filters);
        }
        return abort(403,'Role based query is not defined.');
    }

    private function getMisReportVdvkSanctionedSio($user, $filters)
    {
        $state = $user->getUserDetails->state ?? 0;
        return Vdvk::whereHas('getProposedLocation', function (Builder $query) use ($filters, $state) {
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
        })->get();
    }

    private function getMisReportVdvkSanctionedAdmin($user, $filters)
    {
        return Vdvk::where('sanctioned', '!=', 0)->whereHas('getProposedLocation', function (Builder $query) use ($filters) {
            if (isset($filters['state'])) {
                $query->where('state', $filters['state']);
            }
            if (isset($filters['district'])) {
                $query->where('district', $filters['district']);
            }
            if (isset($filters['block'])) {
                $query->where('block', $filters['block']);
            }
        })->get();
    }

    private function getMisReportVdvkSanctionedDio($user, $filters)
    {
        $district = $user->getUserDetails->district ?? 0;

        return Vdvk::where('sanctioned', '!=', 0)->whereHas('getProposedLocation', function (Builder $query) use ($filters, $district) {
            $query->where('district', $district);

            if (isset($filters['state'])) {
                $query->where('state', $filters['state']);
            }
            if (isset($filters['district'])) {
                $query->where('district', $filters['district']);
            }
            if (isset($filters['block'])) {
                $query->where('block', $filters['block']);
            }
        })->get();
    }

    // private function getMisReportVdvkSanctionedMO($user)
    // {
    //     $state = $user->getUserDetails->state ?? 0;
    //     return Vdvk::where('sanctioned', '!=', 0)->where('created_by', $user->id)->whereHas('getProposedLocation', function (Builder $query) use ($filters, $state) {
    //         $query->where('state', $state);
    //         if (isset($filters['state'])) {
    //             $query->where('state', $filters['state']);
    //         }
    //         if (isset($filters['district'])) {
    //             $query->where('district', $filters['district']);
    //         }
    //         if (isset($filters['block'])) {
    //             $query->where('block', $filters['block']);
    //         }
    //     })->get();
    // }

    /**
     * @return mixed
     */
    public function getMisReportVdvkSanctionedTrifedAdmin($user, $filters)
    {
        return Vdvk::where('sanctioned', '!=', 0)->whereHas('getProposedLocation', function (Builder $query) use ($filters) {
            if (isset($filters['state'])) {
                $query->where('state', $filters['state']);
            }
            if (isset($filters['district'])) {
                $query->where('district', $filters['district']);
            }
            if (isset($filters['block'])) {
                $query->where('block', $filters['block']);
            }
        })->get();
    }

    /**
     * @return mixed
     */
    public function getMisReportVdvkSanctionedTrifedUser($user, $filters)
    {
        return Vdvk::where('sanctioned', '!=', 0)->whereHas('getProposedLocation', function (Builder $query) use ($filters) {
            if (isset($filters['state'])) {
                $query->where('state', $filters['state']);
            }
            if (isset($filters['district'])) {
                $query->where('district', $filters['district']);
            }
            if (isset($filters['block'])) {
                $query->where('block', $filters['block']);
            }
        })->get();
    }
}
