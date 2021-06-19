<?php

namespace App\Queries\MisReport;

use App\Models\Proposed\Vdvk;
use Illuminate\Database\Eloquent\Builder;
use App\Models\FundDistribution\VdvkFundBalance;

class MisReportVdvkFundBalanceQuery extends MisBaseQuery
{

    /**
     * MO get haat market query in proposed haat market linkage
     * @param string $id Resource ID
     * @return Vdvk
     */
    public function __construct($serviceName, $filters = [])
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


    private function getMisReportVdvkFundBalanceAdmin($user, $filters)
    {
        return Vdvk::whereHas('getProposedLocation', function (Builder $query) use ($user,$filters) {
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


    private function getMisReportVdvkFundBalanceMo($user)
    {
        $state = $user->getUserDetails->state ?? 0;
        return Vdvk::where('user_id',$user->id)->whereHas('getProposedLocation', function (Builder $query) use ($state) {
            $query->where('state', $state);
        })->get();
    }
    
    private function getMisReportVdvkFundBalanceSio($user)
    {
        $state = $user->getUserDetails->state ?? 0;
        return Vdvk::whereHas('getProposedLocation', function (Builder $query) use ($state) {
            $query->where('state', $state);
        })->get();
    }


    private function getMisReportVdvkFundBalanceDio($user)
    {
        $district = $user->getUserDetails->district ?? 0;
        return Vdvk::whereHas('getProposedLocation', function (Builder $query) use ($district) {
            $query->where('district', $district);
        })->get();
    }

    /**
     * @param $user
     * @return mixed
     */
    private function getMisReportVdvkFundBalanceTrifedUser($user, $filters)
    {
        return Vdvk::whereHas('getProposedLocation', function (Builder $query) use ($user,$filters) {
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
     * @param $user
     * @return mixed
     */
    private function getMisReportVdvkFundBalanceTrifedAdmin($user, $filters)
    {
        return Vdvk::whereHas('getProposedLocation', function (Builder $query) use ($user,$filters) {
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
