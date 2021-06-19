<?php

namespace App\Queries;
use Illuminate\Support\Facades\Auth;
use App\Models\FundManagement\SanctionLetter;
use App\Models\WareHouseOne;
use App\Models\Warehouse\WarehouseFormMapping;
use App\Models\HaatMarketOne;
use App\Models\Shg\ShgGatherers;
use App\Models\Shg\ShgGroup;
use App\Models\Proposed\ProposedLocation;
use App\Models\HaatBazaarFormMapping;
use App\Models\Proposed\Vdvk;
use App\Models\User;
use App\Models\UsersMapping;
use App\Models\UserDetail;
use DB;

use Illuminate\Database\Eloquent\Builder;

class DashboardQuery extends BaseQuery
{

    /**
     * Get all the haat markets (Pending / Verified) according to role
     * @return Haat Market
     */
    public function viewAllQuery($filters = [])
    {
        $user = $this->getUser();

        $mappings = [
            1 => 'getDashboardSuperAdmin',
            2 => 'getDashboardTrifedAdmin',
            4 => 'getDashboardSnd',
            19 => 'getDashboardSnd',
            20 => 'getDashboardSnd',
            7 => 'getDashboardSio',
            9 => 'getDashboardSio', // Inspection user
            10 => 'getDashboardSio', // Evaluation User
            23 => 'getDashboardSio', // Evaluation User
            24 => 'getDashboardSio', // Evaluation User
            8 => 'getDashboardMo',
            11 => 'getDashboardSurveyor',
            12 => 'getDashboardSupervisor',
            13 => 'getDashboardDio',
            6 => 'getDashboardRm',
            21 => 'getDashboardDio',
            22 => 'getDashboardDio',

            3 => "getDashboardSuperAdmin",
            5 => "getDashboardSuperAdmin",
            14 => "getDashboardDio",
            25 => "getDashboardDio",
            26 => "getDashboardDio",
            15 => "getDashboardSuperAdmin",
            16 => "getDashboardSuperAdmin",
            17 => "getDashboardSuperAdmin",
            18 => "getDashboardSuperAdmin",
        ];

        if (isset($mappings[$user->role])) {
            return call_user_func([$this, $mappings[$user->role]], $user , $filters);
        }

        return abort(403,'Role based query is not defined.');;
    }

    public function viewPublicQuery($filters = [])
    {
        
            return call_user_func([$this, 'getDashboardSuperAdmin'],array() , array());
        
    }

    /**
     * Get all the haat markets (Pending / Verified) according to MO's state
     * @param $user
     * @return Haat Market
     */
    private function getDashboardMo($user , $filters)
    {
        $state = $user->getUserDetails;

    	$filters =['state' => $state['state']];

        return $this->dashboardQueryMoState($user, $filters);
    }

    /**
     * Get all the haat markets (Pending / Verified) according to SND's state
     * @param $user
     * @return Haat Market
     */
    private function getDashboardSnd($user , $filters)
    {	
    	$state = $user->getUserDetails;

    	$filters =['state' => $state['state']];

        return $this->dashboardQueryState($user, $filters);
    }

    /**
     * Get all the haat markets (Pending / Verified) according to SIO's state
     * @param $user
     * @return Haat Market
     */
    private function getDashboardSio($user , $filters)
    {
        $state 		= $user->getUserDetails;
		$filters 	= ['state' => $state['state']];
        return $this->dashboardQueryState($user, $filters);
    }
	
	private function getDashboardRm($user , $filters)
    {
        return $this->dashboardQueryMultipleState($user, $filters);
    }

    /**
     * Get all the haat markets (Pending / Verified) according to DIO's district
     * @param $user
     * @return Haat Market
     */
    private function getDashboardDio($user , $filters)
    {
    	$state 		= $user->getUserDetails;
		$filters 	= [
			'state' 	=> $state['state'],
			'district' 	=> $state['district']
		];
        return $this->dashboardQueryState($user, $filters);
    }

    /**
     * Get all the haat markets (Pending / Verified) according to Surveyor's state
     * @param $user
     * @return Haat Market
     */
    private function getDashboardSurveyor($user , $filters)
    {
        $state 		= $user->getUserDetails;
		$filters 	= [
			'state' 	=> $state['state']
		];
        return $this->dashboardQueryState($user, $filters);
    }

    /**
     * Get all the haat markets (Pending / Verified) according to Supervisor's state
     * @param $user
     * @return Haat Market
     */
    private function getDashboardSupervisor($user , $filters)
    {
        $state 		= $user->getUserDetails;
		$filters 	= [
			'state' 	=> $state['state']
		];
        return $this->dashboardQueryState($user, $filters);
    }

    /**
     * Get all the haat markets (Pending / Verified) for Superadmin
     * @param $user
     * @return Haat Market
     */
    private function getDashboardSuperAdmin($user , $filters)
    {
        return $this->dashboardQueryState($user, $filters);
    }

    private function getDashboardTrifedAdmin($user , $filters)
    {
        return $this->dashboardQueryState($user, $filters);
    }

    private function getDashboardByState($user , $filters)
    {
        return HaatBazaarFormMapping::whereHas('getPartOne', function (Builder $query) use ($user , $filters) {
            $query->where([
                'state' => $user->getUserDetails->state
            ]);
        })->get();
    }

    /**
     * Common function to get all the dashboard by state, according to role
     * @param $user
     * @return Dashboard
     */
	public function dashboardQueryState($user , $data){

		$returnData = array();
            $where          = array();
            $shgWhere   = array();
	        if(isset($data['state']) || isset($data['district']) || isset($data['block'])){
	            
	            $stateWhere 	= array();
              $proposedWhere  = array();
	            

	            if(isset($data['state'])){
	                $where['state'] 							= $data['state']; 
	                $stateWhere['state'] 						= $data['state']; 
                  $proposedWhere['proposed_location.state']   = $data['state']; 
	                $shgWhere['user_details.state'] 	= $data['state']; 
	            }
	            if(isset($data['district'])){
	                $where['district'] 								= $data['district']; 
	                $stateWhere['district_id'] 						= $data['district']; 
	                $proposedWhere['proposed_location.district'] 	= $data['district']; 
                  $shgWhere['user_details.district']   = $data['district']; 
	            }
	            if(isset($data['block'])){
	                $where['block'] 							= $data['block']; 
	                $stateWhere['block_id'] 					= $data['block']; 
	                $proposedWhere['proposed_location.block'] 	= $data['block']; 
                  
	            }

	            $returnData['sanctionReleased'] = SanctionLetter::groupBy('state_id')->selectRaw('*, sum(sanctioned_amount) as sanctioned_sum')->where('state_id' , $data['state'])->with('getState')->get();
	            
              $returnData['sanction_amount'] = SanctionLetter::where('release_status',0)->where('state_id' , $data['state'])->sum('sanctioned_amount');
              $returnData['released_amount'] = SanctionLetter::where('release_status',1)->where('state_id' , $data['state'])->sum('released_amount');


	            $returnData['ware_houses'] 		= WarehouseFormMapping::join('warehouse_ones', function($join) {
                  $join->on('warehouse_form_mapping.part_one', '=', 'warehouse_ones.id');
                })->where($where)->where('warehouse_form_mapping.status','1')->count();

	            $returnData['haat_market'] 		= HaatMarketOne::leftJoin('haat_bazaar_form_mapping', function($join) {
                  $join->on('haat_bazaar_form_mapping.part_one', '=', 'haat_market_one.id');
                })->where('haat_bazaar_form_mapping.status','1')->where($stateWhere)->count();
	            $returnData['tribal_gatherers'] = ShgGatherers::where($where)->where('status','1')->count();
              $returnData['shg_group'] = ShgGroup::where($where)->count();
	            $returnData['pmdvy_approved'] 	= ProposedLocation::join('vdvk', function($join) {
	                $join->on('proposed_location.vdvk_id', '=', 'vdvk.id');
	              })
	              ->leftJoin('states_master', function($join) {
	                $join->on('proposed_location.state', '=', 'states_master.id');
	              })
	              ->where('vdvk.status','=','1')
	              ->where($where)
	              ->select('proposed_location.state',DB::raw('count(vdvk.id) as approval_count'),'states_master.title as state_name')->groupBy('proposed_location.state')->get();

                $auth = Auth::user(); 
             if($auth->role==1 || $auth->role==2 || $auth->role==3 || $auth->role==15 || $auth->role==16 || $auth->role==17){

                $returnData['surveyor']    = User::leftJoin('user_details', function($join) {
                  $join->on('user_details.user_id', '=', 'users.id');
                })->where($shgWhere)->where('users.role','11')->count();

                 $returnData['supervisor']    = User::leftJoin('user_details', function($join) {
                  $join->on('user_details.user_id', '=', 'users.id');
                })->where($shgWhere)->where('users.role','12')->count();
	             }
               else
               {
                $UserState=UserDetail::where(['user_id' => $auth->id])->first();
                 $returnData['surveyor']    = User::leftJoin('user_details', function($join) {
                  $join->on('user_details.user_id', '=', 'users.id');
                })->where($shgWhere)->where('users.role','11')->where('user_details.state' ,$UserState['state'])->count();

                 $returnData['supervisor']    = User::leftJoin('user_details', function($join) {
                  $join->on('user_details.user_id', '=', 'users.id');
                })->where($shgWhere)->where('users.role','12')->where('user_details.state' ,$UserState['state'])->count();
               }
	        }else{

	            $returnData['sanctionReleased'] = SanctionLetter::groupBy('state_id')->selectRaw('*, sum(sanctioned_amount) as sanctioned_sum')->with('getState')->get();

              $returnData['sanction_amount'] = SanctionLetter::where('release_status',0)->sum('sanctioned_amount');

              $returnData['released_amount'] = SanctionLetter::where('release_status',1)->sum('released_amount');

	            $returnData['ware_houses'] 		= WarehouseFormMapping::join('warehouse_ones', function($join) {
                  $join->on('warehouse_form_mapping.part_one', '=', 'warehouse_ones.id');
                })->where('warehouse_form_mapping.status','1')->count();
                //echo '<pre>'; print_r($returnData['ware_houses']);die;
	            $returnData['haat_market'] 		= HaatMarketOne::leftJoin('haat_bazaar_form_mapping', function($join) {
                  $join->on('haat_bazaar_form_mapping.part_one', '=', 'haat_market_one.id');
                })->where('haat_bazaar_form_mapping.status','1')->count();
	            $returnData['tribal_gatherers'] = ShgGatherers::where('status','1')->count();
               $returnData['shg_group'] = ShgGroup::where($where)->count();
	            $returnData['pmdvy_approved'] 	= ProposedLocation::leftJoin('vdvk', function($join) {
	                $join->on('proposed_location.vdvk_id', '=', 'vdvk.id');
	              })
	              ->leftJoin('states_master', function($join) {
	                $join->on('proposed_location.state', '=', 'states_master.id');
	              })
	              ->where('vdvk.status','=','1')
	              ->select('proposed_location.state',DB::raw('count(vdvk.id) as approval_count'),'states_master.title as state_name')->groupBy('proposed_location.state')->get();
	        }

            //$returnData['pending_count']    = Vdvk::where(['status' => '0'])->get()->count();
	        $pending_count 	= ProposedLocation::join('vdvk', function($join) {
                  $join->on('proposed_location.vdvk_id', '=', 'vdvk.id');
                })
                ->leftJoin('states_master', function($join) {
                  $join->on('proposed_location.state', '=', 'states_master.id');
                })
                ->join('proposal_status_log', function($join) {
                  $join->on('proposal_status_log.vdvk_id', '=', 'vdvk.id');
                })
                ->where('vdvk.status','=','0')
                ->where($where)
            
                ->groupBy('proposal_status_log.vdvk_id')
                ->get();
            $returnData['pending_count']=$pending_count->count();
	        
            $approved_count 	= ProposedLocation::join('vdvk', function($join) {
                  $join->on('proposed_location.vdvk_id', '=', 'vdvk.id');
                })
                ->leftJoin('states_master', function($join) {
                  $join->on('proposed_location.state', '=', 'states_master.id');
                })
                ->where('vdvk.status','=','1')
                ->where($where)
                ->selectRaw(DB::raw('count(vdvk.id) as count'))->get()->first();
            $returnData['approved_count']=isset($approved_count['count'])?$approved_count['count']:0; 

            $auth = Auth::user(); 
             if(empty($auth) || ($auth->role==1 || $auth->role==2 || $auth->role==3 || $auth->role==15 || $auth->role==16 || $auth->role==17) ){

                $returnData['surveyor']    = User::leftJoin('user_details', function($join) {
                  $join->on('user_details.user_id', '=', 'users.id');
                })->where($shgWhere)->where('users.role','11')->count();

                 $returnData['supervisor']    = User::leftJoin('user_details', function($join) {
                  $join->on('user_details.user_id', '=', 'users.id');
                })->where($shgWhere)->where('users.role','12')->count();
               }
               else
               {
                $UserState=UserDetail::where(['user_id' => $auth->id])->first();
                 $returnData['surveyor']    = User::leftJoin('user_details', function($join) {
                  $join->on('user_details.user_id', '=', 'users.id');
                })->where($shgWhere)->where('users.role','11')->where('user_details.state' ,$UserState['state'])->count();

                 $returnData['supervisor']    = User::leftJoin('user_details', function($join) {
                  $join->on('user_details.user_id', '=', 'users.id');
                })->where($shgWhere)->where('users.role','12')->where('user_details.state' ,$UserState['state'])->count();
               }
	        return $returnData;
		}
		
		public function dashboardQueryMultipleState($user , $data)
		{

			$returnData = array();
            $where          = array();
            $shgWhere   = array();
			$state_ids=array();
			$state_ids=$user->getUsersAllowedStates->pluck('state');
			$state_ids[]=$user->getUserDetails->state;  
	        if(isset($data['state']) || isset($data['district']) || isset($data['block']))
			{
	            
	            $stateWhere 	= array();
				$proposedWhere  = array();
	            

	            if(isset($data['state']))
				{
	                $where['state'] 							= $data['state']; 
	                $stateWhere['state'] 						= $data['state']; 
					$proposedWhere['proposed_location.state']   = $data['state']; 
	                $shgWhere['user_details.state'] 	= $data['state']; 
	            }
	            if(isset($data['district']))
				{
	                $where['district'] 								= $data['district']; 
	                $stateWhere['district_id'] 						= $data['district']; 
	                $proposedWhere['proposed_location.district'] 	= $data['district']; 
					$shgWhere['user_details.district']   = $data['district']; 
	            }
	            if(isset($data['block']))
				{
	                $where['block'] 							= $data['block']; 
	                $stateWhere['block_id'] 					= $data['block']; 
	                $proposedWhere['proposed_location.block'] 	= $data['block']; 
                }

	            $returnData['sanctionReleased'] = SanctionLetter::groupBy('state_id')->selectRaw('*, sum(sanctioned_amount) as sanctioned_sum')->where('state_id' , $data['state'])->with('getState')->get();
	            
				$returnData['sanction_amount'] = SanctionLetter::where('release_status',0)->where('state_id' , $data['state'])->sum('sanctioned_amount');
				
				$returnData['released_amount'] = SanctionLetter::where('release_status',1)->where('state_id' , $data['state'])->sum('released_amount');


	            $returnData['ware_houses'] 		= WarehouseFormMapping::join('warehouse_ones', function($join) {
                  $join->on('warehouse_form_mapping.part_one', '=', 'warehouse_ones.id');
                })->where($where)->where('warehouse_form_mapping.status','1')->count();

	            $returnData['haat_market'] 		= HaatMarketOne::leftJoin('haat_bazaar_form_mapping', function($join) {
                  $join->on('haat_bazaar_form_mapping.part_one', '=', 'haat_market_one.id');
                })->where('haat_bazaar_form_mapping.status','1')->where($stateWhere)->count();
	            
				$returnData['tribal_gatherers'] = ShgGatherers::where($where)->where('status','1')->count();
              
				$returnData['shg_group'] = ShgGroup::where($where)->count();
	            
				$returnData['pmdvy_approved'] 	= ProposedLocation::join('vdvk', function($join) {
	                $join->on('proposed_location.vdvk_id', '=', 'vdvk.id');
	              })
	              ->leftJoin('states_master', function($join) {
	                $join->on('proposed_location.state', '=', 'states_master.id');
	              })
	              ->where('vdvk.status','=','1')
	              ->where($where)
	              ->select('proposed_location.state',DB::raw('count(vdvk.id) as approval_count'),'states_master.title as state_name')->groupBy('proposed_location.state')->get();

                $auth = Auth::user(); 
				if($auth->role==1 || $auth->role==2 || $auth->role==3 || $auth->role==15 || $auth->role==16 || $auth->role==17)
				{

					$returnData['surveyor']    = User::leftJoin('user_details', function($join) {
						$join->on('user_details.user_id', '=', 'users.id');
					})->where($shgWhere)->where('users.role','11')->count();

					$returnData['supervisor']    = User::leftJoin('user_details', function($join) {
						$join->on('user_details.user_id', '=', 'users.id');
					})->where($shgWhere)->where('users.role','12')->count();
	             }
				else
				{
					$UserState=UserDetail::where(['user_id' => $auth->id])->first();
					
					$returnData['surveyor']    = User::leftJoin('user_details', function($join) {
						$join->on('user_details.user_id', '=', 'users.id');
					})->where($shgWhere)->where('users.role','11')->where('user_details.state' ,$UserState['state'])->count();

					$returnData['supervisor']    = User::leftJoin('user_details', function($join) {
						$join->on('user_details.user_id', '=', 'users.id');
					})->where($shgWhere)->where('users.role','12')->where('user_details.state' ,$UserState['state'])->count();
               }
	        }else
			{
				  
				
	            $returnData['sanctionReleased'] = SanctionLetter::groupBy('state_id')->selectRaw('*, sum(sanctioned_amount) as sanctioned_sum')->whereIn('state_id' , $state_ids)->with('getState')->get();

				$returnData['sanction_amount'] = SanctionLetter::where('release_status',0)->whereIn('state_id' , $state_ids)->sum('sanctioned_amount');

				$returnData['released_amount'] = SanctionLetter::where('release_status',1)->whereIn('state_id' , $state_ids)->sum('released_amount');

	            $returnData['ware_houses'] 		= WarehouseFormMapping::join('warehouse_ones', function($join) {
                  $join->on('warehouse_form_mapping.part_one', '=', 'warehouse_ones.id');
                })->whereIn('state' , $state_ids)->where('warehouse_form_mapping.status','1')->count();
                
				$returnData['haat_market'] 		= HaatMarketOne::leftJoin('haat_bazaar_form_mapping', function($join) {
                  $join->on('haat_bazaar_form_mapping.part_one', '=', 'haat_market_one.id');
                })->whereIn('state' , $state_ids)->where('haat_bazaar_form_mapping.status','1')->count();
	            
				$returnData['tribal_gatherers'] = ShgGatherers::where('status','1')->whereIn('state' , $state_ids)->count();
				
				$returnData['shg_group'] = ShgGroup::whereIn('state' , $state_ids)
				->where($where)->count();
	            
				$returnData['pmdvy_approved'] 	= ProposedLocation::join('vdvk', function($join) {
	                $join->on('proposed_location.vdvk_id', '=', 'vdvk.id');
	              })
	              ->leftJoin('states_master', function($join) {
	                $join->on('proposed_location.state', '=', 'states_master.id');
	              })
	              ->where('vdvk.status','=','1')
				  ->whereIn('proposed_location.state' , $state_ids)
	              ->select('proposed_location.state',DB::raw('count(vdvk.id) as approval_count'),'states_master.title as state_name')->groupBy('proposed_location.state')->get();
	        }

            //$returnData['pending_count']    = Vdvk::where(['status' => '0'])->get()->count();
	        $pending_count 	= ProposedLocation::join('vdvk', function($join) {
                  $join->on('proposed_location.vdvk_id', '=', 'vdvk.id');
                })
                ->leftJoin('states_master', function($join) {
                  $join->on('proposed_location.state', '=', 'states_master.id');
                })
                ->join('proposal_status_log', function($join) {
                  $join->on('proposal_status_log.vdvk_id', '=', 'vdvk.id');
                })
                ->where('vdvk.status','=','0')
                ->where($where)
				->whereIn('proposed_location.state' , $state_ids)
                ->groupBy('proposal_status_log.vdvk_id')
                ->get();
				$returnData['pending_count']=$pending_count->count();
	        
            $approved_count 	= ProposedLocation::join('vdvk', function($join) {
                  $join->on('proposed_location.vdvk_id', '=', 'vdvk.id');
                })
                ->leftJoin('states_master', function($join) {
                  $join->on('proposed_location.state', '=', 'states_master.id');
                })
                ->where('vdvk.status','=','1')
                ->where($where)
				->whereIn('proposed_location.state' , $state_ids)
                ->selectRaw(DB::raw('count(vdvk.id) as count'))->get()->first();
            $returnData['approved_count']=isset($approved_count['count'])?$approved_count['count']:0; 

            $auth = Auth::user(); 
             if(empty($auth) || ($auth->role==1 || $auth->role==2 || $auth->role==3 || $auth->role==15 || $auth->role==16 || $auth->role==17) ){

                $returnData['surveyor']    = User::leftJoin('user_details', function($join) {
                  $join->on('user_details.user_id', '=', 'users.id');
                })->where($shgWhere)->where('users.role','11')->count();

                 $returnData['supervisor']    = User::leftJoin('user_details', function($join) {
                  $join->on('user_details.user_id', '=', 'users.id');
                })->whereIn('proposed_location.state' , $state_ids)->where($shgWhere)->where('users.role','12')->count();
               }
               else
               {
                $UserState=UserDetail::where(['user_id' => $auth->id])->first();
                 $returnData['surveyor']    = User::join('user_details', function($join) {
                  $join->on('user_details.user_id', '=', 'users.id');
                })->where('users.role',11)->whereIn('user_details.state' ,$state_ids)->count();

                 $returnData['supervisor']    = User::join('user_details', function($join) {
                  $join->on('user_details.user_id', '=', 'users.id');
                })->where('users.role',12)->whereIn('user_details.state' ,$state_ids)->count();
               }
	        return $returnData;
		}


			/**
	     * Common function to get all the mo dashboard by state, according to role
	     * @param $user $filters
	     * @return Dashboard
	     */
		public function dashboardQueryMoState($user , $data){
					$returnData = array();

          $mo = User::findOrFail($user->id);
          $child_users=array();
          $surveyor_users_id=$mo->getChildUsers->pluck('id');
          $child_users[]=$user->id;
          //==============get supervisor's mapped surveyor============
          $child_users=UsersMapping::whereIn('parent_id',$surveyor_users_id)->pluck('child_id');
          //===================================================
          $child_users[]=$user->id; 
	        if(isset($data['state']) || isset($data['district']) || isset($data['block'])){

	            $where 			= array();
	            $stateWhere 	= array();
              $proposedWhere  = array();
              $shgWhere   = array();
	            //$where['created_by']=$user->id;
	            if(isset($data['state'])){
	                $where['state'] 							= $data['state']; 
	                $stateWhere['state'] 						= $data['state']; 
                  $proposedWhere['proposed_location.state']   = $data['state']; 
	                $shgWhere['user_details.state'] 	= $data['state']; 
	            }
	            if(isset($data['district'])){
	                $where['district'] 								= $data['district']; 
	                $stateWhere['district_id'] 						= $data['district']; 
	                $proposedWhere['proposed_location.district'] 	= $data['district']; 
                  $shgWhere['user_details.district']   = $data['district']; 
	            }
	            if(isset($data['block'])){
	                $where['block'] 							= $data['block']; 
	                $stateWhere['block_id'] 					= $data['block']; 
	                $proposedWhere['proposed_location.block'] 	= $data['block']; 
                  
	            }

	            $returnData['sanctionReleased'] = SanctionLetter::groupBy('state_id')->selectRaw('*, sum(sanctioned_amount) as sanctioned_sum')->where('state_id' , $data['state'])->with('getState')->get();

              $returnData['sanction_amount'] = SanctionLetter::where('release_status',0)->where('state_id' , $data['state'])->sum('sanctioned_amount');

              $returnData['released_amount'] = SanctionLetter::where('release_status',1)->where('state_id' , $data['state'])->sum('released_amount');
	            
	            $returnData['ware_houses'] 		= WarehouseFormMapping::join('warehouse_ones', function($join) {
                  $join->on('warehouse_form_mapping.part_one', '=', 'warehouse_ones.id');
                })->where($where)->where('warehouse_form_mapping.status','1')->count();
	            $returnData['haat_market'] 		= HaatMarketOne::leftJoin('haat_bazaar_form_mapping', function($join) {
                  $join->on('haat_bazaar_form_mapping.part_one', '=', 'haat_market_one.id');
                })->where('haat_bazaar_form_mapping.status','1')->where($stateWhere)->count();

	            $returnData['tribal_gatherers'] = ShgGatherers::where($where)->where('status','1')->whereIn('created_by',$child_users)->count();
              
               $returnData['shg_group'] = ShgGroup::where($where)->where('shg_groups.created_by',$user->id)->count();
	            $returnData['pmdvy_approved'] 	= ProposedLocation::join('vdvk', function($join) {
	                $join->on('proposed_location.vdvk_id', '=', 'vdvk.id');
	              })
	              ->leftJoin('states_master', function($join) {
	                $join->on('proposed_location.state', '=', 'states_master.id');
	              })
	              ->where('vdvk.status','=','1')
	              ->where($where)
	              ->select('proposed_location.state',DB::raw('count(vdvk.id) as approval_count'),'states_master.title as state_name')->groupBy('proposed_location.state')->get();

            //$returnData['pending_count']   = Vdvk::where(['status' => '0' , 'created_by' => $user->id ])->get()->count();
	        $pending_count   = ProposedLocation::join('vdvk', function($join) {
                  $join->on('proposed_location.vdvk_id', '=', 'vdvk.id');
                })
                ->leftJoin('states_master', function($join) {
                  $join->on('proposed_location.state', '=', 'states_master.id');
                })
                ->join('proposal_status_log', function($join) {
                  $join->on('proposal_status_log.vdvk_id', '=', 'vdvk.id');
                })

                ->where('vdvk.status','=','0')
                ->where($where)
                ->where('vdvk.created_by',$user->id)
                //->selectRaw(DB::raw('count(vdvk.id) as count'))
                ->groupBy('proposal_status_log.vdvk_id')
                ->get();

            $returnData['pending_count']=$pending_count->count();

	        $approved_count  = ProposedLocation::join('vdvk', function($join) {
                  $join->on('proposed_location.vdvk_id', '=', 'vdvk.id');
                })
                ->leftJoin('states_master', function($join) {
                  $join->on('proposed_location.state', '=', 'states_master.id');
                })
                ->where('vdvk.status','=','1')
                ->where($where)
                ->where('vdvk.created_by',$user->id)
                ->selectRaw(DB::raw('count(vdvk.id) as count'))->get()->first();

            $returnData['approved_count']=isset($approved_count['count'])?$approved_count['count']:0;    
            
           /*$returnData['surveyor']    = User::leftJoin('user_details', function($join) {
                  $join->on('user_details.user_id', '=', 'users.id');
                })->where($shgWhere)->where('users.role','11')->count(); */ 

			$list = User::where('role', 11);
        
			 $returnData['surveyor']    =$list->whereHas('getParentUsers.getParentUsers', function (Builder $query) use ($user){
				$query->where('parent_id',$user->id);
			})->orWhereHas(
				'getUserDetails',
				function (Builder $query) use ($data, $user) {
				$query->where('created_by',$user->id)->where('role',11);
					if (isset($data['district'])) {
						$query->where('district', $data['district']);
					}
					if (isset($data['state'])) {
						$query->where('state', $data['state']);
					}
					if (isset($data['name'])) {
						$query->where('name', $data['name']);
					}
				}
			)->count();
				
            $returnData['supervisor']    = User::where('role', '12')->whereHas('getParentUsers', function (Builder $query) use ($user) {
            $query->where('parent_id', $user->id);
			})->orWhereHas(
				'getUserDetails',
				function (Builder $query) use ($data, $user) {
				$query->where('created_by',$user->id)->where('role',11);
					if (isset($data['district'])) {
						$query->where('district', $data['district']);
					}
					if (isset($data['state'])) {
						$query->where('state', $data['state']);
					}
					if (isset($data['name'])) {
						$query->where('name', $data['name']);
					}
				}
			)->count();
	        return $returnData;
		}
	}
}




