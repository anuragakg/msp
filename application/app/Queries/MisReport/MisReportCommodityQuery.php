<?php

namespace App\Queries\MisReport;

use App\Models\User;
use App\Models\Warehouse\WarehouseFormMapping;
use Illuminate\Database\Eloquent\Builder;

class MisReportCommodityQuery extends MisBaseQuery
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

    private function getMisReportWarehouseMo($user, $filters)
    {
        $surveyor = User::where('created_by', $user->id)->pluck('id');
        return WarehouseFormMapping::whereIn('created_by', $surveyor)->get();

//        $state = $user->getUserDetails->state ?? 0;
//        return WarehouseFormMapping::whereHas('getPartOne', function (Builder $query) use ($user, $filters, $state) {
//            $query->where([
//                'state' => $state,
//                'created_by' => $user->id]);
//            if (isset($filters['state'])) {
//                $query->where('state', $filters['state']);
//            }
//            if (isset($filters['district'])) {
//                $query->where('district', $filters['district']);
//            }
//            if (isset($filters['block'])) {
//                $query->where('block', $filters['block']);
//            }
//        })->with('getPartOne')->get();
    }

    private function getMisReportWarehouseAdmin($user, $filters)
    { 

        return WarehouseFormMapping::whereHas('getPartOne', function (Builder $query) use ($filters) {
            if (isset($filters['warehouse'])) {
                $query->where('warehouse_form_mapping.id', $filters['warehouse']);
            }
            if (isset($filters['type'])) {
                $query->where('type', $filters['type']);
            }
            if (isset($filters['state'])) {
                $query->where('state', $filters['state']);
            }
            if (isset($filters['district'])) {
                $query->where('district', $filters['district']);
            }
            if (isset($filters['block'])) {
                $query->where('block', $filters['block']);
            }
            
        })->whereHas('getWarehouse_mfp_commodities_Details', function (Builder $query) use ($filters) {
           
            if (isset($filters['commodity'])) {
                $query->where('commodity', $filters['commodity']);
            }
            if (isset($filters['scientific'])) {
                $query->where('commodity', $filters['scientific']);
            }
            if (isset($filters['comm_name'])) {
                $query->where('commodity', $filters['comm_name']);
            }
        })->with(['getPartOne','getWarehouse_mfp_commodities_Details'])->get(); //toSql(); print_r($qq); die();
    }

    /**
     * @param $user
     * @param $filters
     * @return mixed
     */
    private function getMisReportWarehouseTrifedAdmin($user, $filters)
    { 
        return WarehouseFormMapping::whereHas('getPartOne', function (Builder $query) use ($filters) {
             if (isset($filters['type'])) {
                $query->where('type', $filters['type']);
            }
            if (isset($filters['state'])) {
                $query->where('state', $filters['state']);
            }
            if (isset($filters['district'])) {
                $query->where('district', $filters['district']);
            }
            if (isset($filters['block'])) {
                $query->where('block', $filters['block']);
            }
        })->with('getPartOne')->get();
    }

    /**
     * @param $user
     * @param $filters
     * @return mixed
     */
    private function getMisReportWarehouseTrifedUser($user, $filters)
    {
        return WarehouseFormMapping::whereHas('getPartOne', function (Builder $query) use ($filters) {
             if (isset($filters['type'])) {
                $query->where('type', $filters['type']);
            }
            if (isset($filters['state'])) {
                $query->where('state', $filters['state']);
            }
            if (isset($filters['district'])) {
                $query->where('district', $filters['district']);
            }
            if (isset($filters['block'])) {
                $query->where('block', $filters['block']);
            }
        })->with('getPartOne')->get();
    }

    /**
     * @param $user
     * @param $filters
     * @return mixed
     */
    private function getMisReportWarehouseSnd($user, $filters)
    {
        return WarehouseFormMapping::whereHas('getPartOne', function (Builder $query) use ($user, $filters) {
            $query->where([
                'state' => $user->getUserDetails->state
            ]);
             if (isset($filters['type'])) {
                $query->where('type', $filters['type']);
            }
            if (isset($filters['state'])) {
                $query->where('state', $filters['state']);
            }
            if (isset($filters['district'])) {
                $query->where('district', $filters['district']);
            }
            if (isset($filters['block'])) {
                $query->where('block', $filters['block']);
            }
        })->with('getPartOne')->get();
    }

    /**
     * @param $user
     * @param $filters
     * @return mixed
     */
    private function getMisReportWarehouseSio($user, $filters)
    {
        return WarehouseFormMapping::whereHas('getPartOne', function (Builder $query) use ($user, $filters) {
            $query->where([
                'state' => $user->getUserDetails->state
            ]);
             if (isset($filters['type'])) {
                $query->where('type', $filters['type']);
            }
            if (isset($filters['state'])) {
                $query->where('state', $filters['state']);
            }
            if (isset($filters['district'])) {
                $query->where('district', $filters['district']);
            }
            if (isset($filters['block'])) {
                $query->where('block', $filters['block']);
            }
        })->with('getPartOne')->get();
    }

    /**
     * @param $user
     * @param $filters
     * @return mixed
     */
    private function getMisReportWarehouseDio($user, $filters)
    {
        return WarehouseFormMapping::whereHas('getPartOne', function (Builder $query) use ($user, $filters) {
            $query->where([
                'district' => $user->getUserDetails->district
            ]);
             if (isset($filters['type'])) {
                $query->where('type', $filters['type']);
            }
            if (isset($filters['state'])) {
                $query->where('state', $filters['state']);
            }
            if (isset($filters['district'])) {
                $query->where('district', $filters['district']);
            }
            if (isset($filters['block'])) {
                $query->where('block', $filters['block']);
            }
        })->with('getPartOne')->get();
    }

    /**
     * @param $user
     * @param $filters
     * @return mixed
     */
    private function getMisReportWarehouseSurveyor($user, $filters)
    {
        return WarehouseFormMapping::where('created_by', $user->id)->get();
    }

    /**
     * @param $user
     * @param $filters
     * @return mixed
     */
    private function getMisReportWarehouseSupervisor($user, $filters)
    {
        $usersWithMapping = $user->getChildUsers;
        return $usersWithMapping->map(function ($user) {
            return $user->getWarehouseFormMapping;
        })->flatten();
    }
}
