<?php

namespace App\Queries\MisReport;

use App\Models\HaatBazaarFormMapping;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;

class MisReportHaatQuery extends MisBaseQuery
{

    private $query;
    private $filters;

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

        return abort(403,'Role based query is not defined.');
    }

    private function getMisReportHaatMo($user, $filters)
    {
        $surveyor = User::where('created_by', $user->id)->pluck('id');
        return HaatBazaarFormMapping::whereIn('created_by', $surveyor)->get();

//        $state = $user->getUserDetails->state ?? 0;
//        return HaatBazaarFormMapping::whereHas('getPartOne', function (Builder $query) use ($filters, $state) {
//            $query->where('state', $state);
//            if (isset($filters['state'])) {
//                $query->where('state', $filters['state']);
//            }
//            if (isset($filters['district'])) {
//                $query->where('district_id', $filters['district']);
//            }
//            if (isset($filters['block'])) {
//                $query->where('block_id', $filters['block']);
//            }
//        })->with('getPartOne')->get();
    }

    private function getMisReportHaatAdmin($user, $filters)
    {
        return HaatBazaarFormMapping::whereHas('getPartOne', function (Builder $query) use ($filters) {
            if (isset($filters['state'])) {
                $query->where('state', $filters['state']);
            }
            if (isset($filters['district'])) {
                $query->where('district_id', $filters['district']);
            }
            if (isset($filters['block'])) {
                $query->where('block_id', $filters['block']);
            }
        })->whereHas('getMfpCommodity', function (Builder $query) use ($filters) {
           
            if (isset($filters['commodity'])) {
                $query->where('commodity', $filters['commodity']);
            }
        })->with(['getPartOne','getProcurementAgents','getMfpCommodity'])->get();


        /* if (isset($filters['commodity'])) {
            $where['shg_mfp_yearly_gatherings.commodity'] = $filters['commodity'];
        }
         return HaatBazaarFormMapping::leftJoin('haat_warehouse_mfp_commodities', function($join) {
                  $join->on('getPartOne.form_id', '=', 'haat_warehouse_mfp_commodities.form_id');
                })->where($where)->select('getPartOne.*');*/
    }

    /**
     * @param $user
     * @param $filters
     * @return mixed
     * @return mixed
     */
    private function getMisReportHaatTrifedAdmin($user, $filters)
    {
        return HaatBazaarFormMapping::whereHas('getPartOne', function (Builder $query) use ($filters) {
            if (isset($filters['state'])) {
                $query->where('state', $filters['state']);
            }
            if (isset($filters['district'])) {
                $query->where('district_id', $filters['district']);
            }
            if (isset($filters['block'])) {
                $query->where('block_id', $filters['block']);
            }
        })->with('getPartOne')->get();
    }

    /**
     * @param $user
     * @param $filters
     * @return mixed
     */
    private function getMisReportHaatTrifedUser($user, $filters)
    {
        return HaatBazaarFormMapping::whereHas('getPartOne', function (Builder $query) use ($filters) {
            if (isset($filters['state'])) {
                $query->where('state', $filters['state']);
            }
            if (isset($filters['district'])) {
                $query->where('district_id', $filters['district']);
            }
            if (isset($filters['block'])) {
                $query->where('block_id', $filters['block']);
            }
        })->with('getPartOne')->get();
    }

    /**
     * @param $user
     * @param $filters
     * @return mixed
     */
    private function getMisReportHaatSnd($user, $filters)
    {
        return HaatBazaarFormMapping::whereHas('getPartOne', function (Builder $query) use ($user, $filters) {
            $query->where([
                'state' => $user->getUserDetails->state
            ]);
            if (isset($filters['state'])) {
                $query->where('state', $filters['state']);
            }
            if (isset($filters['district'])) {
                $query->where('district_id', $filters['district']);
            }
            if (isset($filters['block'])) {
                $query->where('block_id', $filters['block']);
            }
        })->with('getPartOne')->get();
    }

    /**
     * @param $user
     * @param $filters
     * @return mixed
     */
    private function getMisReportHaatSio($user, $filters)
    {
        return HaatBazaarFormMapping::whereHas('getPartOne', function (Builder $query) use ($user, $filters) {
            $query->where([
                'state' => $user->getUserDetails->state
            ]);
            if (isset($filters['state'])) {
                $query->where('state', $filters['state']);
            }
            if (isset($filters['district'])) {
                $query->where('district_id', $filters['district']);
            }
            if (isset($filters['block'])) {
                $query->where('block_id', $filters['block']);
            }
        })->with('getPartOne')->get();
    }

    /**
     * @param $user
     * @param $filters
     * @return mixed
     */
    private function getMisReportHaatDio($user, $filters)
    {
        return HaatBazaarFormMapping::whereHas('getPartOne', function (Builder $query) use ($user, $filters) {
            $query->where([
                'district_id' => $user->getUserDetails->district,
            ]);
            if (isset($filters['state'])) {
                $query->where('state', $filters['state']);
            }
            if (isset($filters['district'])) {
                $query->where('district_id', $filters['district']);
            }
            if (isset($filters['block'])) {
                $query->where('block_id', $filters['block']);
            }
        })->with('getPartOne')->get();
    }

    /**
     * @param $user
     * @param $filters
     * @return mixed
     */
    private function getMisReportHaatSurveyor($user, $filters)
    {
        return HaatBazaarFormMapping::where('created_by', $user->id)->get();
    }

    /**
     * @param $user
     * @param $filters
     * @return mixed
     */
    private function getMisReportHaatSupervisor($user, $filters)
    {
        $usersWithMapping = $user->getChildUsers;
        return $usersWithMapping->map(function($user){
            return $user->getHaatBazaarFormMapping;
        })->flatten();
    }
}
