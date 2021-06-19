<?php

namespace App\Queries\MisReport;

use App\Models\Shg\ShgGatherers;
use App\Models\Shg\ShgMfpYearlyGathering;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;

class MisReportShgQuery extends MisBaseQuery
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

        return abort(403,'Role based query is not defined.');
    }

    private function getMisReportShgMo($user, $filters)
    { 
        $surveyor = User::where('created_by', $user->id)->pluck('id');
        return ShgGatherers::whereIn('created_by', $surveyor)->get();

//        $where = [];
//
//        if (isset($filters['state'])) {
//            $where['state'] = $filters['state'];
//        }
//        if (isset($filters['district'])) {
//            $where['district'] = $filters['district'];
//        }
//        if (isset($filters['block'])) {
//            $where['block'] = $filters['block'];
//        }
//
//        return ShgGatherers::where([
//            'state' => $user->getUserDetails->state
//        ])->where($where)->get();
    }

    private function getMisReportShgAdmin($user, $filters)
    { 
        $where = [];         
        if (isset($filters['state'])) {
            $where['shg_gatherers.state'] = $filters['state'];
        }
        if (isset($filters['district'])) {
            $where['shg_gatherers.district'] = $filters['district'];
        }
        if (isset($filters['block'])) {
            $where['shg_gatherers.block'] = $filters['block'];
        }
        if (isset($filters['gender'])) {
            $where['shg_gatherers.gender'] = $filters['gender'];
        }
        if (isset($filters['year'])) {
            $where['shg_gatherers.financial_year'] = $filters['year'];
        }
        if (isset($filters['status'])) {
            $where['shg_gatherers.status'] = $filters['status'];
        }
        if (isset($filters['existing_membership'])) {
            $where['shg_gatherers.existing_membership'] = $filters['existing_membership'];
        }
        if (isset($filters['category'])) {
            $category=explode(',', $filters['category']);           
            }
        else
        {
            $category= array(1,2,3,4);
        }
      if (isset($filters['commodity'])) {
            $where['commodity'] = $filters['commodity'];
        }
        
       // return ShgGatherers::where($where);
        return ShgGatherers::leftJoin('shg_mfp_yearly_gatherings', function($join) {
                  $join->on('shg_gatherers.id', '=', 'shg_mfp_yearly_gatherings.shg_id');
                })->where($where)->whereIn('shg_gatherers.category',$category)->select('shg_gatherers.*');
    }

    /**
     * @param $user
     * @param $filters
     * @return mixed
     */
    private function getMisReportShgTrifedUser($user, $filters)
    { 
        $where = [];

        if (isset($filters['state'])) {
            $where['state'] = $filters['state'];
        }
        if (isset($filters['district'])) {
            $where['district'] = $filters['district'];
        }
        if (isset($filters['block'])) {
            $where['block'] = $filters['block'];
        }
         if (isset($filters['gender'])) {
            $where['shg_gatherers.gender'] = $filters['gender'];
        }
        if (isset($filters['year'])) {
            $where['shg_gatherers.financial_year'] = $filters['year'];
        }
        if (isset($filters['status'])) {
            $where['shg_gatherers.status'] = $filters['status'];
        }
        if (isset($filters['existing_membership'])) {
            $where['shg_gatherers.existing_membership'] = $filters['existing_membership'];
        }
        if (isset($filters['category'])) {
            $category=explode(',', $filters['category']);           
            }
        else
        {
            $category= array(1,2,3,4);
        }
        if (isset($filters['commodity'])) {
            $where['commodity'] = $filters['commodity'];
        }
        return ShgGatherers::where($where)->whereIn('shg_gatherers.category',$category);
    }

    /**
     * @param $user
     * @param $filters
     * @return mixed
     */
    private function getMisReportShgTrifedAdmin($user, $filters)
    {
        $where = [];
        $cat=[];
        if (isset($filters['state'])) {
            $where['shg_gatherers.state'] = $filters['state'];
        }
        if (isset($filters['district'])) {
            $where['shg_gatherers.district'] = $filters['district'];
        }
        if (isset($filters['block'])) {
            $where['shg_gatherers.block'] = $filters['block'];
        }
         if (isset($filters['gender'])) {
            $where['shg_gatherers.gender'] = $filters['gender'];
        }
         
         if (isset($filters['year'])) {
            $where['shg_gatherers.financial_year'] = $filters['year'];
        }
        if (isset($filters['status'])) {
            $where['shg_gatherers.status'] = $filters['status'];
        }
        if (isset($filters['existing_membership'])) {
            $where['shg_gatherers.existing_membership'] = $filters['existing_membership'];
        }
         if (isset($filters['category'])) {
            $category=explode(',', $filters['category']);           
            }
        else
        {
            $category= array(1,2,3,4);
        }
        if (isset($filters['commodity'])) {
            $where['shg_mfp_yearly_gatherings.commodity'] = $filters['commodity'];
        }
       // return ShgGatherers::where($where);
        return ShgGatherers::leftJoin('shg_mfp_yearly_gatherings', function($join) {
                  $join->on('shg_gatherers.id', '=', 'shg_mfp_yearly_gatherings.shg_id');
                })->where($where)->whereIn('shg_gatherers.category',$category)->select('shg_gatherers.*');
    }

    /**
     * @param $user
     * @param $filters
     * @return mixed
     */
    private function getMisReportShgSio($user, $filters)
    {
        $where = [];

        if (isset($filters['state'])) {
            $where['state'] = $filters['state'];
        }
        if (isset($filters['district'])) {
            $where['district'] = $filters['district'];
        }
        if (isset($filters['block'])) {
            $where['block'] = $filters['block'];
        }
         if (isset($filters['gender'])) {
            $where['shg_gatherers.gender'] = $filters['gender'];
        }
        if (isset($filters['year'])) {
            $where['shg_gatherers.financial_year'] = $filters['year'];
        }
        if (isset($filters['status'])) {
            $where['shg_gatherers.status'] = $filters['status'];
        }
        if (isset($filters['existing_membership'])) {
            $where['shg_gatherers.existing_membership'] = $filters['existing_membership'];
        }
         if (isset($filters['category'])) {
            $category=explode(',', $filters['category']);           
            }
        else
        {
            $category= array(1,2,3,4);
        }
        if (isset($filters['commodity'])) {
            $where['commodity'] = $filters['commodity'];
        }
        return ShgGatherers::where([
            'state' => $user->getUserDetails->state
        ])->where($where)->whereIn('shg_gatherers.category',$category);
    }

    /**
     * @param $user
     * @param $filters
     * @return mixed
     */
    private function getMisReportShgDio($user, $filters)
    {
        $where = [];

        if (isset($filters['state'])) {
            $where['state'] = $filters['state'];
        }
        if (isset($filters['district'])) {
            $where['district'] = $filters['district'];
        }
        if (isset($filters['block'])) {
            $where['block'] = $filters['block'];
        }
         if (isset($filters['gender'])) {
            $where['shg_gatherers.gender'] = $filters['gender'];
        }
        if (isset($filters['year'])) {
            $where['shg_gatherers.financial_year'] = $filters['year'];
        }
        if (isset($filters['status'])) {
            $where['shg_gatherers.status'] = $filters['status'];
        }

        if (isset($filters['existing_membership'])) {
            $where['shg_gatherers.existing_membership'] = $filters['existing_membership'];
        }
         if (isset($filters['category'])) {
            $category=explode(',', $filters['category']);           
            }
        else
        {
            $category= array(1,2,3,4);
        }
        if (isset($filters['commodity'])) {
            $where['commodity'] = $filters['commodity'];
        }
        return ShgGatherers::where([
            'district' => $user->getUserDetails->district
        ])->where($where)->whereIn('shg_gatherers.category',$category);
    }

    /**
     * @param $user
     * @param $filters
     * @return mixed
     */
    private function getMisReportShgSnd($user, $filters)
    {
        $where = [];

        if (isset($filters['state'])) {
            $where['state'] = $filters['state'];
        }
        if (isset($filters['district'])) {
            $where['district'] = $filters['district'];
        }
        if (isset($filters['block'])) {
            $where['block'] = $filters['block'];
        }
        if (isset($filters['commodity'])) {
            $where['commodity'] = $filters['commodity'];
        }
         if (isset($filters['gender'])) {
            $where['shg_gatherers.gender'] = $filters['gender'];
        }
        if (isset($filters['year'])) {
            $where['shg_gatherers.financial_year'] = $filters['year'];
        }
        if (isset($filters['status'])) {
            $where['shg_gatherers.status'] = $filters['status'];
        }
        if (isset($filters['existing_membership'])) {
            $where['shg_gatherers.existing_membership'] = $filters['existing_membership'];
        }
         if (isset($filters['category'])) {
            $category=explode(',', $filters['category']);           
            }
        else
        {
            $category= array(1,2,3,4);
        }
        return ShgGatherers::where([
            'state' => $user->getUserDetails->state
        ])->where($where)->whereIn('shg_gatherers.category',$category);
    }

    /**
     * @param $user
     * @param $filters
     * @return mixed
     */
    private function getMisReportShgSurveyor($user)
    {
        return ShgGatherers::where('created_by', $user->id)->get();
    }

    /**
     * @param $user
     * @param $filters
     * @return mixed
     */
    private function getMisReportShgSupervisor($user)
    {
        $usersWithMapping = $user->getChildUsers;
        return $usersWithMapping->map(function($user){
            return $user->getShgGatherer;
        })->flatten();
    }


}
