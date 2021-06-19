<?php

namespace App\Queries;

use App\Models\Shg\ShgGatherers;
use App\Models\User;
use App\Models\UsersMapping;
use Illuminate\Database\Eloquent\Builder;
use DB;
class ShgQuery extends BaseQuery
{

    /**
     * Get all the Shg gatherers (Pending / Verified) according to role
     * @return SHG Gatherer
     */
    public function viewAllQuery($filters,$orderBy=null)
    {
        $user = $this->getUser();             

        $mappings = [
            8 => 'getShgMo',
            1 => 'getShgAdmin',
            2 => 'getShgAdmin',
            3 => 'getShgAdmin',
            4 => 'getShgSnd',
            19 => 'getShgSnd',
            20 => 'getShgSnd',
            7 => 'getShgSio',
            23 => 'getShgSio',
            24 => 'getShgSio',
            13 => 'getShgDio',
            6 => 'getShgSio',
            21 => 'getShgDio',
            22 => 'getShgDio',
            25 => 'getShgDio',
            26 => 'getShgDio',
            11 => 'getShgSurveyor',
            12 => 'getShgSupervisor',

            5 => "getShgAdmin",
            14 => "getShgDio",
            15 => "getShgAdmin",
            16 => "getShgAdmin",
            17 => "getShgAdmin",
            18 => "getShgAdmin",
        ];

        if (isset($mappings[$user->role])) {
            return call_user_func([$this, $mappings[$user->role]], $user, $filters,$orderBy);
        }

        return abort(403,'Role based query is not defined.');
    }

    /**
     * Get all the Shg gatherers (Verified) according to role
     * @return SHG Gatherer
     */
    public function viewAllVerifiedQuery()
    {
        $user = $this->getUser();

        $mappings = [
            8 => 'getShgVerifiedMo',
            1 => 'getShgAdmin',

            2 => "getShgAdmin",
            3 => "getShgAdmin",
            5 => "getShgAdmin",
            14 => "getShgDio",
            25 => "getShgDio",
            26 => "getShgDio",
            15 => "getShgAdmin",
            16 => "getShgAdmin",
            17 => "getShgAdmin",
            18 => "getShgAdmin",
        ];

        if (isset($mappings[$user->role])) {
            return call_user_func([$this, $mappings[$user->role]], $user);
        }

        return abort(403, 'Role based query is not defined.');
    }

    /**
     * Get all the shg gatherers (Pending / Verified) according to MO's state
     * @param $user
     * @return SHG Gatherer
     */
    private function getShgMo($user, $filter,$orderBy=null)
    {
        $order_by='shg_gatherer_groups_relation.group_id';
        $sort_type='asc';
        if($orderBy=='group_id')
        {
            $order_by='shg_gatherer_groups_relation.group_id';
            $sort_type='asc';
        }
        if($orderBy=='shg_name')
        {
            $order_by='users.name';
            $sort_type='asc';
        }
        if($orderBy=='shgname')
        {
            $order_by='shg_gatherers.shg_name';
            $sort_type='asc';
        }
        if($orderBy=='vdvk_id')
        {
            $order_by='proposed_shg.vdvk_id';
            $sort_type='desc';
        }
        if($orderBy=='name_of_proposed')
        {
            $order_by='shg_gatherers.name_of_proposed';
            $sort_type='desc';
        }
		$where=array();
        //$where['created_by']=$user->id;
        
         $mo = User::findOrFail($user->id);
              $child_users=array();
              //$child_users=$mo->getChildUsers->pluck('id');
              //========surveyor users==========
              $surveyor_users_id=$mo->getChildUsers->pluck('id');
              
              //==============get supervisor's mapped surveyor============
              $child_users=UsersMapping::whereIn('parent_id',$surveyor_users_id)->pluck('child_id');
              //===================================================
              $child_users[]=$user->id;
              //dd($child_users);
        if(isset($filter['state']) && $filter['state']!=''){
            $where['state']=$filter['state'];
        }
        if(isset($filter['district']) && $filter['district']!=''){
            $where['district']=$filter['district'];
        }
        if(isset($filter['block']) && $filter['block']!=''){
            $where['block']=$filter['block'];
        }
        if (isset($filter['village'])) {
            $where['village'] = $filter['village'];
        }
        if (isset($filter['surveyor'])) {
            $where['shg_gatherers.created_by'] = $filter['surveyor'];
        }
        if (isset($filter['pincode'])) {
            $where['pin_code'] = $filter['pincode'];
        }
        if(isset($filter['shg_gatherers.status']) && $filter['shg_gatherers.status']!=''){
            $where['shg_gatherers.status']=$filter['shg_gatherers.status'];
        }
        return ShgGatherers::leftJoin('shg_gatherer_groups_relation', function($join) {
                  $join->on('shg_gatherer_groups_relation.shg_id', '=', 'shg_gatherers.id');
                })
                 //=========ADDED on 8-july-2020 for kendra name sorting===========
                ->leftJoin('proposed_shg', function($join) {
                  $join->on('proposed_shg.shg_id', '=', 'shg_gatherer_groups_relation.group_id');
                })
                
                //================================================================
                ->leftJoin('users', function($join) {
                      $join->on('shg_gatherers.created_by', '=', 'users.id');
                })
                ->select(['shg_gatherers.*'])

                ->where($where)
                ->whereIn('shg_gatherers.created_by',$child_users)
                ->groupBy('shg_gatherers.id')
                ->orderBy($order_by, $sort_type);
    }

    /**
     * Get all the shg gatherers (Pending / Verified) according to SND's state
     * @param $user
     * @return SHG Gatherer
     */
    private function getShgSnd($user, $filter,$orderBy=null)
    {
        return $this->getShgByState($user, $filter,$orderBy);
    }

    /**
     * Get all the shg gatherers (Pending / Verified) according to SIO's state
     * @param $user
     * @return SHG Gatherer
     */
    private function getShgSio($user, $filter,$orderBy=null)
    {
        return $this->getShgByState($user, $filter,$orderBy);
    }

    /**
     * Get all the shg gatherers (Pending / Verified) according to DIO's district
     * @param $user
     * @return SHG Gatherer
     */
    private function getShgDio($user, $filter,$orderBy=null)
    {
        $userDetails = $user->getUserDetails;
         $order_by='shg_gatherer_groups_relation.group_id';
        $sort_type='asc';
        if($orderBy=='group_id')
        {
            $order_by='shg_gatherer_groups_relation.group_id';
            $sort_type='asc';
        }
        if($orderBy=='shg_name')
        {
            $order_by='users.name';
            $sort_type='asc';
        }
        if($orderBy=='shgname')
        {
            $order_by='shg_gatherers.shg_name';
            $sort_type='asc';
        }
        if($orderBy=='vdvk_id')
        {
            $order_by='proposed_shg.vdvk_id';
            $sort_type='desc';
        }
        if($orderBy=='name_of_proposed')
        {
            $order_by='shg_gatherers.name_of_proposed';
            $sort_type='desc';
        }
        $where=array();
        if (isset($filter['village'])) {
            $where['village'] = $filter['village'];
        }
        if (isset($filter['pincode'])) {
            $where['pin_code'] = $filter['pincode'];
        }
        if (isset($filter['surveyor'])) {
            $where['shg_gatherers.created_by'] = $filter['surveyor'];
        }
        return ShgGatherers::leftJoin('shg_gatherer_groups_relation', function($join) {
                  $join->on('shg_gatherer_groups_relation.shg_id', '=', 'shg_gatherers.id');
                })
                 //=========ADDED on 8-july-2020 for kendra name sorting===========
                ->leftJoin('proposed_shg', function($join) {
                  $join->on('proposed_shg.shg_id', '=', 'shg_gatherer_groups_relation.group_id');
                })
                
                //================================================================
                ->leftJoin('users', function($join) {
                  $join->on('shg_gatherers.created_by', '=', 'users.id');
                })
                ->select(['shg_gatherers.*'])
                
                ->where('district', $userDetails->district)
                ->groupBy('shg_gatherers.id')
                ->orderBy($order_by, $sort_type)
                ->where($filter);
    }

    /**
     * Get all the shg gatherers (Pending / Verified) according to Surveyors's state
     * @param $user
     * @return SHG Gatherer
     */
    private function getShgSurveyor($user, $filter,$orderBy=null)
    {
        $where['shg_gatherers.created_by']=$user->id;
        if(isset($filter['state']) && $filter['state']!=''){
            $where['state']=$filter['state'];
        }
        if(isset($filter['district']) && $filter['district']!=''){
            $where['district']=$filter['district'];
        }
        if(isset($filter['block']) && $filter['block']!=''){
            $where['block']=$filter['block'];
        }
        if (isset($filter['village'])) {
            $where['village'] = $filter['village'];
        }
        if (isset($filter['surveyor'])) {
            $where['shg_gatherers.created_by'] = $filter['surveyor'];
        }
        if (isset($filter['pincode'])) {
            $where['pin_code'] = $filter['pincode'];
        }
        if(isset($filter['shg_gatherers.status']) && $filter['shg_gatherers.status']!=''){
            $where['shg_gatherers.status']=$filter['shg_gatherers.status'];
        }
         $order_by='shg_gatherer_groups_relation.group_id';
        $sort_type='asc';
        if($orderBy=='group_id')
        {
            $order_by='shg_gatherer_groups_relation.group_id';
            $sort_type='asc';
        }
        if($orderBy=='shg_name')
        {
            $order_by='users.name';
            $sort_type='asc';
        }
        if($orderBy=='shgname')
        {
            $order_by='shg_gatherers.shg_name';
            $sort_type='asc';
        }
        if($orderBy=='vdvk_id')
        {
            $order_by='proposed_shg.vdvk_id';
            $sort_type='desc';
        }
        if($orderBy=='name_of_proposed')
        {
            $order_by='shg_gatherers.name_of_proposed';
            $sort_type='desc';
        }
        return ShgGatherers::leftJoin('shg_gatherer_groups_relation', function($join) {
                  $join->on('shg_gatherer_groups_relation.shg_id', '=', 'shg_gatherers.id');
                })
                 //=========ADDED on 8-july-2020 for kendra name sorting===========
                ->leftJoin('proposed_shg', function($join) {
                  $join->on('proposed_shg.shg_id', '=', 'shg_gatherer_groups_relation.group_id');
                })
                
                //================================================================ 
                ->leftJoin('users', function($join) {
                  $join->on('shg_gatherers.created_by', '=', 'users.id');
                })
                ->select(['shg_gatherers.*','shg_gatherer_groups_relation.group_id', DB::raw('IF(`group_id` IS NOT NULL, `group_id`, -1) `group_id`')])
                ->where($where)
                ->groupBy('shg_gatherers.id')
                ->orderBy($order_by, $sort_type);
        //return $this->getShgByState($user, $filter);
    }

    /**
     * Get all the shg gatherers (Pending / Verified) according to Supervisor's state
     * @param $user
     * @return SHG Gatherer
     */
    private function getShgSupervisor($user, $filter,$orderBy=null)
    {
        $usersWithMapping = $user->getChildUsers->pluck('id');
        $where=array();
        if(isset($filter['state']) && $filter['state']!=''){
            $where['state']=$filter['state'];
        }
        if(isset($filter['district']) && $filter['district']!=''){
            $where['district']=$filter['district'];
        }
        if(isset($filter['block']) && $filter['block']!=''){
            $where['block']=$filter['block'];
        }
         if (isset($filter['village'])) {
            $where['village'] = $filter['village'];
        }
        if (isset($filter['surveyor'])) {
            $where['shg_gatherers.created_by'] = $filter['surveyor'];
        }
        if (isset($filter['pincode'])) {
            $where['pin_code'] = $filter['pincode'];
        }

        if(isset($filter['shg_gatherers.status']) && $filter['shg_gatherers.status']!=''){
            $where['shg_gatherers.status']=$filter['shg_gatherers.status'];
        }
        $order_by='shg_gatherer_groups_relation.group_id';
        $sort_type='asc';
        if($orderBy=='group_id')
        {
            $order_by='shg_gatherer_groups_relation.group_id';
            $sort_type='asc';
        }
        if($orderBy=='shg_name')
        {
            $order_by='users.name';
            $sort_type='asc';
        }
        if($orderBy=='shgname')
        {
            $order_by='shg_gatherers.shg_name';
            $sort_type='asc';
        }
        if($orderBy=='vdvk_id')
        {
            $order_by='proposed_shg.vdvk_id';
            $sort_type='desc';
        }
        if($orderBy=='name_of_proposed')
        {
            $order_by='shg_gatherers.name_of_proposed';
            $sort_type='desc';
        }
        return ShgGatherers::leftJoin('shg_gatherer_groups_relation', function($join) {
                  $join->on('shg_gatherer_groups_relation.shg_id', '=', 'shg_gatherers.id');
                })
                 //=========ADDED on 8-july-2020 for kendra name sorting===========
                ->leftJoin('proposed_shg', function($join) {
                  $join->on('proposed_shg.shg_id', '=', 'shg_gatherer_groups_relation.group_id');
                })
                
                //================================================================ 
                ->leftJoin('users', function($join) {
                  $join->on('shg_gatherers.created_by', '=', 'users.id');
                })
                ->select(['shg_gatherers.*','shg_gatherer_groups_relation.group_id', DB::raw('IF(`group_id` IS NOT NULL, `group_id`, -1) `group_id`')])
                ->where($where)
                
                ->whereIn('shg_gatherers.created_by',$usersWithMapping)
                ->groupBy('shg_gatherers.id')  
                ->orderBy($order_by, $sort_type);
        //return $this->getShgByState($user, $filter);
    }

    /**
     * Get all the shg gatherers (Pending / Verified) for Superadmin
     * @param $user
     * @return SHG Gatherer
     */
    private function getShgAdmin($user, $filter,$orderBy=null)
    {
        //return ShgGatherers::where($filter);  
       // print_r($filter); die();
        //CHANGE ON 05-03-2020 BY Anurag
        //CHANGE ON 03-06-2020 BY Kuldeep
        $where=array();
        if (isset($filter['village'])) {
            $where['village'] = $filter['village'];
        }
        if (isset($filter['surveyor'])) {
            $where['shg_gatherers.created_by'] = $filter['surveyor'];
        }
        if (isset($filter['pincode'])) {
            $where['pin_code'] = $filter['pincode'];
        }
        $order_by='shg_gatherer_groups_relation.group_id';
        $sort_type='asc';
        if($orderBy=='group_id')
        {
            $order_by='shg_gatherer_groups_relation.group_id';
            $sort_type='asc';
        }
        if($orderBy=='shg_name')
        {
            $order_by='users.name';
            $sort_type='asc';
        }
        if($orderBy=='shgname')
        {
            $order_by='shg_gatherers.shg_name';
            $sort_type='asc';
        }
        if($orderBy=='vdvk_id')
        {
            $order_by='proposed_shg.vdvk_id';
            $sort_type='desc';
        }
        if($orderBy=='name_of_proposed')
        {
            $order_by='shg_gatherers.name_of_proposed';
            $sort_type='desc';
        }
        return ShgGatherers::leftJoin('shg_gatherer_groups_relation', function($join) {
                  $join->on('shg_gatherer_groups_relation.shg_id', '=', 'shg_gatherers.id');
                })
                 //=========ADDED on 8-july-2020 for kendra name sorting===========
                ->leftJoin('proposed_shg', function($join) {
                  $join->on('shg_gatherer_groups_relation.group_id', '=', 'proposed_shg.shg_id');
                })
                
                //================================================================ 
                ->leftJoin('users', function($join) {
                  $join->on('shg_gatherers.created_by', '=', 'users.id');
                })
                
                ->select(['shg_gatherers.*'])
                ->where($filter)
                ->groupBy('shg_gatherers.id')
                ->orderBy($order_by, $sort_type);
    }

    /**
     * Common function to get all the shg gatherers by state, according to role
     * @param $user
     * @return SHG Gatherer
     */
    private function getShgByState($user, $filter,$orderBy=null)
    {
        $where=array();
        if (isset($filter['village'])) {
            $where['village'] = $filter['village'];
        }
        if (isset($filter['surveyor'])) {
            $where['shg_gatherers.created_by'] = $filter['surveyor'];
        }
        if (isset($filter['pincode'])) {
            $where['pin_code'] = $filter['pincode'];
        }
  		 $order_by='shg_gatherer_groups_relation.group_id';
        $sort_type='asc';
        if($orderBy=='group_id')
        {
            $order_by='shg_gatherer_groups_relation.group_id';
            $sort_type='asc';
        }
        if($orderBy=='shg_name')
        {
            $order_by='users.name';
            $sort_type='asc';
        }
        if($orderBy=='shgname')
        {
            $order_by='shg_gatherers.shg_name';
            $sort_type='asc';
        }
        if($orderBy=='vdvk_id')
        {
            $order_by='proposed_shg.vdvk_id';
            $sort_type='desc';
        }
        if($orderBy=='name_of_proposed')
        {
            $order_by='shg_gatherers.name_of_proposed';
            $sort_type='desc';
        }
        $state_ids=array();
                    $state_ids=$user->getUsersAllowedStates->pluck('state');
                    $state_ids[]=$user->getUserDetails->state;    
                    
        return ShgGatherers::leftJoin('shg_gatherer_groups_relation', function($join) {
                  $join->on('shg_gatherer_groups_relation.shg_id', '=', 'shg_gatherers.id');
                })
                 //=========ADDED on 8-july-2020 for kendra name sorting===========
                ->leftJoin('proposed_shg', function($join) {
                  $join->on('proposed_shg.shg_id', '=', 'shg_gatherer_groups_relation.group_id');
                })
                
                //================================================================ 
                ->leftJoin('users', function($join) {
                  $join->on('shg_gatherers.created_by', '=', 'users.id');
                })
                ->select(['shg_gatherers.*','shg_gatherer_groups_relation.group_id', DB::raw('IF(`group_id` IS NOT NULL, `group_id`, -1) `group_id`')])
		
		        ->whereIn(
              'state' , $state_ids
            //'district' => $user->getUserDetails->district
            )
            ->where($filter)
        ->groupBy('shg_gatherers.id')
		->orderBy($order_by, $sort_type);
    }

    /**
     * Get all the shg gatherers (Verified) according to MO's state
     * @param $user
     * @return SHG Gatherer
     */
    private function getShgVerifiedMo($user)
    {
        return $this->getShgMo($user, [])->where('status', '1');
    }
}