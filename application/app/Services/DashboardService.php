<?php

namespace App\Services;

use App\Models\Masters\State;
use Illuminate\Support\Facades\Auth;
use App\Services\Service;
use App\Models\HaatBazaarFormMapping;
use App\Models\Warehouse\WarehouseFormMapping;
use App\Models\Shg\ShgGatherers;
use App\Models\Proposed\Vdvk;
use App\Models\WareHouseOne;
use App\Models\HaatMarketOne;
use App\Models\CaptureLocation;
use App\Models\User;
use App\Models\Proposed\ProposedLocation;
use App\Models\Proposed\StatusLogsModel;
use App\Rules\ValidateFormType;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;
use App\Models\FundManagement\SanctionLetter;
use App\Models\FundManagement\SanctionLetterVdvkMapping;
use App\Queries\DashboardQuery;
use DB;
use Illuminate\Database\Eloquent\Builder;
use App\Models\Masters\District;
use App\Models\Masters\Block;
use App\Models\Shg\ShgGroup;
class DashboardService extends Service
{

    private $dashboardQuery;

    public function __construct(DashboardQuery $dashboardQuery = null) 
    {
        $this->dashboardQuery = $dashboardQuery;
    }

    /**
     * Get all items from database
     *
     * @return mixed
     */
    function getItem($filters)
    {
        return $this->dashboardQuery->viewAllQuery($filters);
    }

    function get_public_dashboard($filters)
    {
        return $this->dashboardQuery->viewPublicQuery($filters);
    }

     /**
     * Validates for creating a record.
     * 
     * @param Array $data
     * @return mixed
     */
    public function validateData($data)
    {
        return Validator::make($data, [
            'state' => 'exists:states_master,id|integer',
            'district' => 'exists:districts_master,id|integer',
            'block' => 'exists:blocks_master,id|integer'
        ]);
    }

    public function captureDashboard()
    { 	$returnData=array(); 
    	$returnData['total_capture'] = CaptureLocation::count();
    	 return $returnData;
    }
    public function mobileDashboard() 
    {
        $user = Auth::user();
        $state_id = $user->getUserDetails->state;
        if($user->role == 11) {
          $entityFor = $user->getSurveyorSupervisorDetails->survey_for;
          $surveyors = [$user->id];
        }
        else if($user->role == 12) {
          $entityFor = $user->getSurveyorSupervisorDetails->supervising_for;
          $surveyors = $user->getChildUsers;
        }

        if(in_array($user->role, [11, 12])) {

          $data = []; 
          $status = new \stdClass();
          $status->pending = ['status' => '0'];
          $status->approved = ['status' => '1'];

          $supervisingMaster = new \stdClass();
          $supervisingMaster->details = [
            'shg_gatherers' => '1',
            'haat_bazaar' => '2',
            'warehouse' => '3',
          ];

          $supervisingMaster->mapping = [
            'shg_gatherers' => ShgGatherers::class,
            'haat_bazaar' => HaatBazaarFormMapping::class,
            'warehouse' => WarehouseFormMapping::class,
          ];

          $query = Builder::class;
		  $usersWithMapping = $user->getChildUsers->pluck('id');
			//echo '<pre>';print_r($usersWithMapping);die;
          foreach($supervisingMaster->details as $supervising) {
            $entity = array_search($supervising, $supervisingMaster->details);

            if(in_array($supervising, $entityFor)) {

              if($entity == 'warehouse')
              {
                $data[$entity.'_pending'] = $supervisingMaster->mapping[$entity]::whereHas('getPartOne',function($query) use ($user,$usersWithMapping){ 
					//$usersWithMapping = $user->getChildUsers->pluck('id');
					if($user->role=='11')
					{
						$query->where('created_by', $user->id);	
					}
					if($user->role=='12')
					{
						$query->whereIn('created_by', $usersWithMapping);	
					}
				})->where($status->pending)->count();
                $data[$entity.'_approved'] = $supervisingMaster->mapping[$entity]::whereHas('getPartOne', function($query) use ($user)
					{
						$usersWithMapping = $user->getChildUsers->pluck('id');
						if($user->role=='11')
						{
							$query->where('created_by', $user->id);	
						}
						if($user->role=='12')
						{
							$query->whereIn('created_by', $usersWithMapping);	
						}
					})->where($status->approved)->count();
              }
              if($entity == 'haat_bazaar')
              {
				if($user->role=='11')
				{
					$data[$entity.'_pending'] = $supervisingMaster->mapping[$entity]::where('created_by', $user->id)->where($status->pending)->count();
					$data[$entity.'_approved'] = $supervisingMaster->mapping[$entity]::where('created_by', $user->id)->where($status->approved)->count();
				}
				if($user->role=='12')
				{
					$data[$entity.'_pending'] = $supervisingMaster->mapping[$entity]::whereIn('created_by', $usersWithMapping)->where($status->pending)->count();
					$data[$entity.'_approved'] = $supervisingMaster->mapping[$entity]::whereIn('created_by', $usersWithMapping)->where($status->approved)->count();
				}
              }
              if($entity == 'shg_gatherers')
              {
				if($user->role=='11')
				{
					$data[$entity.'_pending'] = $supervisingMaster->mapping[$entity]::where($status->pending)->where('created_by', $user->id)->count();
					$data[$entity.'_approved'] = $supervisingMaster->mapping[$entity]::where($status->approved)->where('created_by', $user->id)->count();	
				}
				if($user->role=='12')
				{
					$data[$entity.'_pending'] = $supervisingMaster->mapping[$entity]::where($status->pending)->whereIn('created_by', $usersWithMapping)->count();
					$data[$entity.'_approved'] = $supervisingMaster->mapping[$entity]::where($status->approved)->whereIn('created_by', $usersWithMapping)->count();	
				}
              }
            } else {
              $data[$entity.'_pending'] = null;
              $data[$entity.'_approved'] = null;
            }
          }
          return $data;
        }

        return;
    }
    public function vdvk_statewise($data)
    {
		$where 			= array();
		$user = Auth::user();
		$role_id=$user->role;
		$user_details = $user->getUserDetails;
		
		if(($role_id ==4 || $role_id ==7 || $role_id ==9 || $role_id ==10 || $role_id ==11 || $role_id ==12 ) && isset($user_details['state']) && !empty($user_details['state']))
		{
			$data['state']=$user_details['state'];
		}
		if($role_id ==13  && isset($user_details['state']) && !empty($user_details['state']))
		{
			$data['state']=$user_details['state'];
			$data['district']=$user_details['district'];
		}
		if($role_id ==8)
		{
			$where['vdvk.created_by'] 							= $user->id; 
		}
		
		if(isset($data['state']) || isset($data['district']) || isset($data['block']))
		{
			if(isset($data['state'])){
				$where['state'] 							= $data['state']; 
			}
			if(isset($data['district'])){
				$where['district'] 								= $data['district']; 
			}
			if(isset($data['block'])){
				$where['block'] 							= $data['block']; 
			}
		}//echo '<pre>';print_r($where);die;
		$state_ids=array();
		if($role_id ==6)
		{
			$state_ids=$user->getUsersAllowedStates->pluck('state');
			$state_ids[]=$user->getUserDetails->state;    	
		}
		
       $query= ProposedLocation::join('vdvk', function($join) {
                  $join->on('proposed_location.vdvk_id', '=', 'vdvk.id');
                })
                ->leftJoin('states_master', function($join) {
                  $join->on('proposed_location.state', '=', 'states_master.id');
                })
                ->where('vdvk.status','=',$data['status'])
                ->where($where);
				if(!empty($state_ids))
				{
					$query=$query->whereIn('proposed_location.state',$state_ids);
				}
                $query=$query->select('proposed_location.state',DB::raw('count(vdvk.id) as count'),'states_master.title as state_name')->groupBy('proposed_location.state')->get();
				//echo '<pre>';print_r($query->toArray());die;
		return $query;		
    }
	
	public function validate_statewise_filter($data)
    {
        return Validator::make($data, [
            'state' => 'nullable|exists:states_master,id|integer',
            'district' => 'nullable|exists:districts_master,id|integer',
            'block' => 'nullable|exists:blocks_master,id|integer',
            'status' => 'in:1,0'
        ]);
    }
	public function validate_districtwise_filter($data)
    {
        return Validator::make($data, [
            'state' => 'nullable|exists:states_master,id|integer',
            'district' => 'nullable|exists:districts_master,id|integer',
            //'block' => 'nullable|exists:blocks_master,id|integer',
            'status' => 'in:1,0'
        ]);
    }
	public function vdvk_districtwise($data)
    {
		$where 			= array();
		$user = Auth::user();
		$role_id=$user->role;
		$user_details = $user->getUserDetails;
		
		if(($role_id ==4 || $role_id ==7 || $role_id ==9 || $role_id ==10 || $role_id ==11 || $role_id ==12 ) && isset($user_details['state']) && !empty($user_details['state']))
		{
			$data['state']=$user_details['state'];
		}
		if($role_id ==13  && isset($user_details['state']) && !empty($user_details['state']))
		{
			$data['state']=$user_details['state'];
			$data['district']=$user_details['district'];
		}
		if($role_id ==8)
		{
			$where['vdvk.created_by'] 							= $user->id; 
		}
		if(isset($data['state']) || isset($data['district']) || isset($data['block']))
		{
			
			
			if(isset($data['state'])){
				$where['state'] 							= $data['state']; 
			}
			if(isset($data['district'])){
				$where['district'] 								= $data['district']; 
			}
			if(isset($data['block'])){
				$where['block'] 							= $data['block']; 
			}
		}
       $query= ProposedLocation::leftJoin('vdvk', function($join) {
                  $join->on('proposed_location.vdvk_id', '=', 'vdvk.id');
                })
                ->leftJoin('states_master', function($join) {
                  $join->on('proposed_location.state', '=', 'states_master.id');
                })
				->leftJoin('districts_master', function($join) {
                  $join->on('proposed_location.district', '=', 'districts_master.id');
                })
                ->where('vdvk.status','=',$data['status'])
                ->where($where)
                ->select('proposed_location.state',DB::raw('count(vdvk.id) as count'),'states_master.title as state_name','districts_master.title as district_name','proposed_location.district as district_id')->groupBy('proposed_location.district')->get();
				//echo '<pre>';print_r($query->toArray());die;
		return $query;		
    }
	public function validate_blockwise_filter($data)
    {
        return Validator::make($data, [
            'state' => 'nullable|exists:states_master,id|integer',
            'district' => 'nullable|exists:districts_master,id|integer',
            //'block' => 'nullable|exists:blocks_master,id|integer',
            'status' => 'in:1,0'
        ]);
    }
	public function vdvk_blockwise($data)
    {
		$where 			= array();
		$user = Auth::user();
		$role_id=$user->role;
		$user_details = $user->getUserDetails;
		
		if(($role_id ==4 || $role_id ==7 || $role_id ==9 || $role_id ==10 || $role_id ==11 || $role_id ==12 ) && isset($user_details['state']) && !empty($user_details['state']))
		{
			$data['state']=$user_details['state'];
		}
		if($role_id ==13  && isset($user_details['state']) && !empty($user_details['state']))
		{
			$data['state']=$user_details['state'];
			$data['district']=$user_details['district'];
		}
		if($role_id ==8)
		{
			$where['vdvk.created_by'] 							= $user->id; 
		}
		if(isset($data['state']) || isset($data['district']) || isset($data['block']))
		{
			
			
			if(isset($data['state'])){
				$where['state'] 							= $data['state']; 
			}
			if(isset($data['district'])){
				$where['district'] 								= $data['district']; 
			}
			if(isset($data['block'])){
				$where['block'] 							= $data['block']; 
			}
		}
       $query= ProposedLocation::leftJoin('vdvk', function($join) {
                  $join->on('proposed_location.vdvk_id', '=', 'vdvk.id');
                })
                ->leftJoin('states_master', function($join) {
                  $join->on('proposed_location.state', '=', 'states_master.id');
                })
				->leftJoin('districts_master', function($join) {
                  $join->on('proposed_location.district', '=', 'districts_master.id');
                })
				->leftJoin('blocks_master', function($join) {
                  $join->on('proposed_location.block', '=', 'blocks_master.id');
                })
				
                ->where('vdvk.status','=',$data['status'])
                ->where($where)
                ->select('proposed_location.state',DB::raw('count(vdvk.id) as count'),'states_master.title as state_name','blocks_master.title as block_name','districts_master.title as district_name','proposed_location.district as district_id','proposed_location.block as block_id')->groupBy('proposed_location.block')->get();
				//echo '<pre>';print_r($query->toArray());die;
		return $query;		
    }
	
	public function validate_warehouse_statewise_filter($data)
    {
        return Validator::make($data, [
            'state' => 'nullable|exists:states_master,id|integer',
            'district' => 'nullable|exists:districts_master,id|integer',
            'block' => 'nullable|exists:blocks_master,id|integer',
            'status' => 'in:1,0',
            'is_mobile' => 'in:1,0'
        ]);
    }
	
	public function warehouse_statewise($data)
    { 
		$user = Auth::user();
		$role_id=$user->role;
		$user_details = $user->getUserDetails;
		$state_ids=array();
        
		if($role_id ==6)
		{
			$state_ids=$user->getUsersAllowedStates->pluck('state');
			$state_ids[]=$user_details['state'];  
		}
		
		if(($role_id ==4  || $role_id ==7 || $role_id ==8 || $role_id ==9 || $role_id ==10 || $role_id ==11 || $role_id ==12  ) && isset($user_details['state']) && !empty($user_details['state']))
		{
			$data['state']=$user_details['state'];
		}
		if($role_id ==13  && isset($user_details['state']) && !empty($user_details['state']))
		{
			$data['state']=$user_details['state'];
			$data['district']=$user_details['district'];
		}
    	
		$where 			= array();
		$is_mobile 			= array();
		if(isset($data['state']) || isset($data['district']) || isset($data['block']) || isset($data['is_mobile']))
		{
			$where 			= array();
			$is_mobile 			= array();
			if(isset($data['state'])){
				$where['warehouse_ones.state'] 							= $data['state']; 
				
			}
			if(isset($data['district'])){
				$where['warehouse_ones.district'] 								= $data['district']; 
			}
			if(isset($data['block'])){
				$where['warehouse_ones.block'] 							= $data['block']; 
			}
			if(isset($data['is_mobile'])){
                $is_mobile['warehouse_form_mapping.is_mobile'] = $data['is_mobile']; 
            }
		}
		           
                    
		$query= WarehouseFormMapping::join('warehouse_ones', function($join) {
                  $join->on('warehouse_form_mapping.part_one', '=', 'warehouse_ones.id');
                })
				->where('warehouse_form_mapping.status','1')
				->where($where)
				->join('states_master', function($join) {
                  $join->on('warehouse_ones.state', '=', 'states_master.id');
                })
				->leftJoin('districts_master', function($join) {
                  $join->on('warehouse_ones.district', '=', 'districts_master.id');
                })
				->leftJoin('blocks_master', function($join) {
                  $join->on('warehouse_ones.block', '=', 'blocks_master.id');
                })
                ->where('warehouse_ones.deleted_at','=',null)
                ->where($is_mobile);
				if(!empty($state_ids))
				{
					$query=$query->whereIn('warehouse_ones.state',$state_ids);
				}
				$query=$query->select('warehouse_ones.state',DB::raw('count(warehouse_ones.id) as count'),'states_master.title as state_name','blocks_master.title as block_name','districts_master.title as district_name','warehouse_ones.district as district_id','warehouse_ones.block as block_id')->groupBy('warehouse_ones.state')->get();
		
		return $query;		
	}
	public function validate_haatbazaar_statewise_filter($data)
    {
        return Validator::make($data, [
            'state' => 'nullable|exists:states_master,id|integer',
            'district' => 'nullable|exists:districts_master,id|integer',
            'block' => 'nullable|exists:blocks_master,id|integer',
            //'status' => 'in:1,0'
            'is_mobile' => 'in:1,0'
        ]);
    }
	
	public function haatbazaar_statewise($data)
    {
		$user = Auth::user();
		$role_id=$user->role;
		$user_details = $user->getUserDetails;
		$state_ids=array();
        
		if($role_id ==6)
		{
			$state_ids=$user->getUsersAllowedStates->pluck('state');
			$state_ids[]=$user_details['state'];  
		}
		if(($role_id ==4 || $role_id ==7 || $role_id ==8 || $role_id ==9 || $role_id ==10 || $role_id ==11 || $role_id ==12 ) && isset($user_details['state']) && !empty($user_details['state']))
		{
			$data['state']=$user_details['state'];
		}
		if($role_id ==13  && isset($user_details['state']) && !empty($user_details['state']))
		{
			$data['state']=$user_details['state'];
			$data['district']=$user_details['district'];
		}
    	
		$where 			= array();
		$is_mobile=	array();
		if(isset($data['state']) || isset($data['district']) || isset($data['block']) || isset($data['is_mobile']))
		{
			$where 			= array();
			$is_mobile=	array();
			if(isset($data['state'])){
				$where['haat_market_one.state'] 							= $data['state']; 
			}
			if(isset($data['district'])){
				$where['haat_market_one.district_id'] 								= $data['district']; 
			}
			if(isset($data['block'])){
				$where['haat_market_one.block_id'] 							= $data['block']; 
			}
			if(isset($data['is_mobile'])){
                $is_mobile['haat_bazaar_form_mapping.is_mobile'] = $data['is_mobile']; 
            }
		}
		
		$query= HaatMarketOne::leftJoin('haat_bazaar_form_mapping', function($join) {
                  $join->on('haat_bazaar_form_mapping.part_one', '=', 'haat_market_one.id');
                })
				->where('haat_bazaar_form_mapping.status','1')
				->where($where)->leftJoin('states_master', function($join) {
                  $join->on('haat_market_one.state', '=', 'states_master.id');
                })
				->leftJoin('districts_master', function($join) {
                  $join->on('haat_market_one.district_id', '=', 'districts_master.id');
                })
				->leftJoin('blocks_master', function($join) {
                  $join->on('haat_market_one.block_id', '=', 'blocks_master.id');
                })
                ->where($is_mobile);
				if(!empty($state_ids))
				{
					$query=$query->whereIn('haat_market_one.state',$state_ids);
				}
				$query=$query->select('haat_market_one.state',DB::raw('count(haat_market_one.id) as count'),'states_master.title as state_name','blocks_master.title as block_name','districts_master.title as district_name','haat_market_one.district_id','haat_market_one.block_id')->groupBy('haat_market_one.state')->get();
		
		return $query;		
	}
	public function validate_rolewise_filter($data)
    {
        return Validator::make($data, [
            'state' => 'nullable|exists:states_master,id|integer',
            'district' => 'nullable|exists:districts_master,id|integer',
            'block' => 'nullable|exists:blocks_master,id|integer',
            'status' => 'in:1,0'
        ]);
    }
	 public function vdvk_rolewise($data)
    {
		$where 			= array();
		$user = Auth::user();
		$role_id=$user->role;
		$user_details = $user->getUserDetails;
		$state_ids=array();
		if($role_id ==6){
			$state_ids=$user->getUsersAllowedStates->pluck('state');
			$state_ids[]=$user->getUserDetails->state; 
		}
		   
		if(($role_id ==4 || $role_id ==7 || $role_id ==9 || $role_id ==10 || $role_id ==11 || $role_id ==12 ) && isset($user_details['state']) && !empty($user_details['state']))
		{
			$data['state']=$user_details['state'];
		}
		if($role_id ==13  && isset($user_details['state']) && !empty($user_details['state']))
		{
			$data['state']=$user_details['state'];
			$data['district']=$user_details['district'];
		}
		if($role_id ==8)
		{
			$where['vdvk.created_by'] 							= $user->id; 
		}
		
		if(isset($data['state']) || isset($data['district']) || isset($data['block']))
		{
			if(isset($data['state'])){
				$where['state'] 							= $data['state']; 
			}
			if(isset($data['district'])){
				$where['district'] 								= $data['district']; 
			}
			if(isset($data['block'])){
				$where['block'] 							= $data['block']; 
			}
		}
      
		$qry="select user_roles.id as role_id,user_roles.title as role,COUNT(proposal_status_log.id) as total_count,proposal_status_log.assigned_to,proposal_status_log.vdvk_id,proposal_status_log.id 
		FROM proposal_status_log 
		INNER JOIN vdvk ON proposal_status_log.vdvk_id = vdvk.id 
		INNER JOIN proposed_location ON proposed_location.vdvk_id=vdvk.id 
		INNER JOIN users on proposal_status_log.assigned_to=users.id 
		INNER JOIN user_roles on users.role=user_roles.id 
		WHERE proposal_status_log.id IN ( SELECT MAX(id) from proposal_status_log WHERE (status='".$data['status']."' OR is_assigned_next_level='".$data['status']."') GROUP by vdvk_id) ";
		$qry .=" AND vdvk.status='".$data['status']."'";
		if($role_id ==8)
		{
			$qry .=" AND vdvk.created_by=".$user->id;
		}
		if(isset($data['state']) || isset($data['district']) || isset($data['block']))
		{
			if(isset($data['state'])){
				$qry .=" AND proposed_location.state=".$data['state'];
			}
			if(isset($data['district'])){
				$qry .=" AND proposed_location.district=".$data['district'];
			}
			if(isset($data['block'])){
				$qry .=" AND proposed_location.block=".$data['block'];
			}
		}
		if(!empty($state_ids))
		{
			//echo '<pre>';print_r($state_ids->toArray());die;
			$qry .=" AND proposed_location.state IN (".implode(',',$state_ids->toArray()).")";
		}
		$qry .=" GROUP BY user_roles.id";
		$query=DB::select($qry);
		return $query;			
    }
	
	public function validate_role_statewise_filter($data)
    {
        return Validator::make($data, [
            'role_id' => 'nullable|exists:user_roles,id|integer',
            'state' => 'nullable|exists:states_master,id|integer',
            'district' => 'nullable|exists:districts_master,id|integer',
            'block' => 'nullable|exists:blocks_master,id|integer',
            'status' => 'in:1,0'
        ]);
    }
	 public function vdvk_role_statewisewise($data)
    {
		$where 			= array();
		$user = Auth::user();
		$role_id=$user->role;
		$user_details = $user->getUserDetails;
		
		if(($role_id ==4 || $role_id ==7 || $role_id ==9 || $role_id ==10 || $role_id ==11 || $role_id ==12 ) && isset($user_details['state']) && !empty($user_details['state']))
		{
			$data['state']=$user_details['state'];
		}
		if($role_id ==13  && isset($user_details['state']) && !empty($user_details['state']))
		{
			$data['state']=$user_details['state'];
			$data['district']=$user_details['district'];
		}
		if($role_id ==8)
		{
			$where['vdvk.created_by'] 							= $user->id; 
		}
		$state_ids=array();
		if($role_id ==6)
		{
			$state_ids=$user->getUsersAllowedStates->pluck('state');
			$state_ids[]=$user->getUserDetails->state; 
		}
		if(isset($data['state']) || isset($data['district']) || isset($data['block']))
		{
			if(isset($data['state'])){
				$where['state'] 							= $data['state']; 
			}
			if(isset($data['district'])){
				$where['district'] 								= $data['district']; 
			}
			if(isset($data['block'])){
				$where['block'] 							= $data['block']; 
			}
		}
      
		$qry="select user_roles.id as role_id,user_roles.title as role,COUNT(proposal_status_log.id) as total_count,states_master.id as state_id,states_master.title as state_name,proposal_status_log.assigned_to,proposal_status_log.vdvk_id,proposal_status_log.id 
		FROM proposal_status_log 
		INNER JOIN vdvk ON proposal_status_log.vdvk_id = vdvk.id 
		INNER JOIN proposed_location ON proposed_location.vdvk_id=vdvk.id 
		INNER JOIN users on proposal_status_log.assigned_to=users.id 
		INNER JOIN user_roles on users.role=user_roles.id 
		INNER JOIN states_master on proposed_location.state=states_master.id
		WHERE proposal_status_log.id IN ( SELECT MAX(id) from proposal_status_log WHERE (status='".$data['status']."' OR is_assigned_next_level='".$data['status']."') GROUP by vdvk_id) ";
		$qry .=" AND vdvk.status='".$data['status']."'";
		$qry .=" AND users.role='".$data['role_id']."'";
		if($role_id ==8)
		{
			$qry .=" AND vdvk.created_by=".$user->id;
		}
		if(isset($data['state']) || isset($data['district']) || isset($data['block']))
		{
			if(isset($data['state'])){
				$qry .=" AND proposed_location.state=".$data['state'];
			}
			if(isset($data['district'])){
				$qry .=" AND proposed_location.district=".$data['district'];
			}
			if(isset($data['block'])){
				$qry .=" AND proposed_location.block=".$data['block'];
			}
		}
		if(!empty($state_ids))
		{
			//echo '<pre>';print_r($state_ids->toArray());die;
			$qry .=" AND proposed_location.state IN (".implode(',',$state_ids->toArray()).")";
		}
		$qry .=" GROUP BY proposed_location.state";
		$query=DB::select($qry);
		return $query;			
    }
	public function validate_role_districtwise_filter($data)
    {
        return Validator::make($data, [
            'role_id' => 'nullable|exists:user_roles,id|integer',
            'state' => 'required|exists:states_master,id|integer',
            'district' => 'nullable|exists:districts_master,id|integer',
            'block' => 'nullable|exists:blocks_master,id|integer',
            'status' => 'in:1,0'
        ]);
    }
	 public function vdvk_role_districtwise($data)
    {
		$where 			= array();
		$user = Auth::user();
		$role_id=$user->role;
		$user_details = $user->getUserDetails;
		
		if(($role_id ==4 || $role_id ==7 || $role_id ==9 || $role_id ==10 || $role_id ==11 || $role_id ==12 ) && isset($user_details['state']) && !empty($user_details['state']))
		{
			$data['state']=$user_details['state'];
		}
		if($role_id ==13  && isset($user_details['state']) && !empty($user_details['state']))
		{
			$data['state']=$user_details['state'];
			$data['district']=$user_details['district'];
		}
		if($role_id ==8)
		{
			$where['vdvk.created_by'] 							= $user->id; 
		}
		
		if(isset($data['state']) || isset($data['district']) || isset($data['block']))
		{
			if(isset($data['state'])){
				$where['state'] 							= $data['state']; 
			}
			if(isset($data['district'])){
				$where['district'] 								= $data['district']; 
			}
			if(isset($data['block'])){
				$where['block'] 							= $data['block']; 
			}
		}
      
		$qry="select user_roles.id as role_id,user_roles.title as role,COUNT(proposal_status_log.id) as total_count,states_master.id as state_id,states_master.title as state_name,districts_master.id as district_id,districts_master.title as district_name,proposal_status_log.assigned_to,proposal_status_log.vdvk_id,proposal_status_log.id 
		FROM proposal_status_log 
		INNER JOIN vdvk ON proposal_status_log.vdvk_id = vdvk.id 
		INNER JOIN proposed_location ON proposed_location.vdvk_id=vdvk.id 
		INNER JOIN users on proposal_status_log.assigned_to=users.id 
		INNER JOIN user_roles on users.role=user_roles.id 
		INNER JOIN states_master on proposed_location.state=states_master.id
		INNER JOIN districts_master on proposed_location.district=districts_master.id
		WHERE proposal_status_log.id IN ( SELECT MAX(id) from proposal_status_log WHERE (status='".$data['status']."' OR is_assigned_next_level='".$data['status']."') GROUP by vdvk_id) ";
		$qry .=" AND vdvk.status='".$data['status']."'";
		$qry .=" AND users.role='".$data['role_id']."'";
		if($role_id ==8)
		{
			$qry .=" AND vdvk.created_by=".$user->id;
		}
		if(isset($data['state']) || isset($data['district']) || isset($data['block']))
		{
			if(isset($data['state'])){
				$qry .=" AND proposed_location.state=".$data['state'];
			}
			if(isset($data['district'])){
				$qry .=" AND proposed_location.district=".$data['district'];
			}
			if(isset($data['block'])){
				$qry .=" AND proposed_location.block=".$data['block'];
			}
		}
		$qry .=" GROUP BY proposed_location.district";
		$query=DB::select($qry);
		return $query;			
    }
	public function validate_role_blockwise_filter($data)
    {
        return Validator::make($data, [
            'role_id' => 'nullable|exists:user_roles,id|integer',
            'state' => 'exists:states_master,id|integer',
            'district' => 'required|exists:districts_master,id|integer',
            'block' => 'nullable|exists:blocks_master,id|integer',
            'status' => 'in:1,0'
        ]);
    }
	 public function vdvk_role_blockwise($data)
    {
		$where 			= array();
		$user = Auth::user();
		$role_id=$user->role;
		$user_details = $user->getUserDetails;
		
		if(($role_id ==4 || $role_id ==7 || $role_id ==9 || $role_id ==10 || $role_id ==11 || $role_id ==12 ) && isset($user_details['state']) && !empty($user_details['state']))
		{
			$data['state']=$user_details['state'];
		}
		if($role_id ==13  && isset($user_details['state']) && !empty($user_details['state']))
		{
			$data['state']=$user_details['state'];
			$data['district']=$user_details['district'];
		}
		if($role_id ==8)
		{
			$where['vdvk.created_by'] 							= $user->id; 
		}
		
		if(isset($data['state']) || isset($data['district']) || isset($data['block']))
		{
			if(isset($data['state'])){
				$where['state'] 							= $data['state']; 
			}
			if(isset($data['district'])){
				$where['district'] 								= $data['district']; 
			}
			if(isset($data['block'])){
				$where['block'] 							= $data['block']; 
			}
		}
      
		$qry="select user_roles.id as role_id,user_roles.title as role,COUNT(proposal_status_log.id) as total_count,states_master.id as state_id,states_master.title as state_name,districts_master.id as district_id,districts_master.title as district_name,blocks_master.id as block_id,blocks_master.title as block_name,proposal_status_log.assigned_to,proposal_status_log.vdvk_id,proposal_status_log.id 
		FROM proposal_status_log 
		INNER JOIN vdvk ON proposal_status_log.vdvk_id = vdvk.id 
		INNER JOIN proposed_location ON proposed_location.vdvk_id=vdvk.id 
		INNER JOIN users on proposal_status_log.assigned_to=users.id 
		INNER JOIN user_roles on users.role=user_roles.id 
		INNER JOIN states_master on proposed_location.state=states_master.id
		INNER JOIN districts_master on proposed_location.district=districts_master.id
		INNER JOIN blocks_master on proposed_location.block=blocks_master.id
		WHERE proposal_status_log.id IN ( SELECT MAX(id) from proposal_status_log WHERE (status='".$data['status']."' OR is_assigned_next_level='".$data['status']."') GROUP by vdvk_id) ";
		$qry .=" AND vdvk.status='".$data['status']."'";
		$qry .=" AND users.role='".$data['role_id']."'";
		if($role_id ==8)
		{
			$qry .=" AND vdvk.created_by=".$user->id;
		}
		if(isset($data['state']) || isset($data['district']) || isset($data['block']))
		{
			if(isset($data['state'])){
				$qry .=" AND proposed_location.state=".$data['state'];
			}
			if(isset($data['district'])){
				$qry .=" AND proposed_location.district=".$data['district'];
			}
			if(isset($data['block'])){
				$qry .=" AND proposed_location.block=".$data['block'];
			}
		}
		$qry .=" GROUP BY proposed_location.block";
		$query=DB::select($qry);
		return $query;			
    }
	public function validate_rolewise_vdvk_filter($data)
    {
        return Validator::make($data, [
            'role_id' => 'nullable|exists:user_roles,id|integer',
            'state' => 'nullable|exists:states_master,id|integer',
            'district' => 'nullable|exists:districts_master,id|integer',
            'block' => 'nullable|exists:blocks_master,id|integer',
            'status' => 'in:1,0'
        ]);
    }
	
	 public function rolewise_vdvk_list($data)
    {
		$where 			= array();
		$user = Auth::user();
		$role_id=$user->role;
		$user_details = $user->getUserDetails;
		
		if(($role_id ==4 || $role_id ==7 || $role_id ==9 || $role_id ==10 || $role_id ==11 || $role_id ==12 ) && isset($user_details['state']) && !empty($user_details['state']))
		{
			$data['state']=$user_details['state'];
		}
		if($role_id ==13  && isset($user_details['state']) && !empty($user_details['state']))
		{
			$data['state']=$user_details['state'];
			$data['district']=$user_details['district'];
		}
		if($role_id ==8)
		{
			$where['vdvk.created_by'] 							= $user->id; 
		}
		
		if(isset($data['state']) || isset($data['district']) || isset($data['block']))
		{
			if(isset($data['state'])){
				$where['state'] 							= $data['state']; 
			}
			if(isset($data['district'])){
				$where['district'] 								= $data['district']; 
			}
			if(isset($data['block'])){
				$where['block'] 							= $data['block']; 
			}
		}
      
		$qry="select user_roles.id as role_id,user_roles.title as role,states_master.id as state_id,states_master.title as state_name,districts_master.id as district_id,districts_master.title as district_name,blocks_master.id as block_id,blocks_master.title as block_name,proposal_status_log.assigned_to,proposal_status_log.vdvk_id,proposed_location.kendra_name,shg_gatherers.name_of_tribal as leader,proposed_location.leader_mobile,proposed_location.leader_email,proposed_location.created_at as submission_date,vdvk.status,vdvk.demo_unit
		FROM proposal_status_log 
		INNER JOIN vdvk ON proposal_status_log.vdvk_id = vdvk.id 
		INNER JOIN proposed_location ON proposed_location.vdvk_id=vdvk.id 
		INNER JOIN users on proposal_status_log.assigned_to=users.id 
		INNER JOIN user_roles on users.role=user_roles.id 
		LEFT JOIN states_master on proposed_location.state=states_master.id
		LEFT JOIN districts_master on proposed_location.district=districts_master.id
		LEFT JOIN blocks_master on proposed_location.block=blocks_master.id
		LEFT JOIN shg_gatherers on proposed_location.leader=shg_gatherers.id
		WHERE proposal_status_log.id IN ( SELECT MAX(id) from proposal_status_log WHERE (status='".$data['status']."' OR is_assigned_next_level='".$data['status']."') GROUP by vdvk_id) ";
		$qry .=" AND vdvk.status='".$data['status']."'";
		$qry .=" AND users.role='".$data['role_id']."'";
		if($role_id ==8)
		{
			$qry .=" AND vdvk.created_by=".$user->id;
		}
		if(isset($data['state']) || isset($data['district']) || isset($data['block']))
		{
			if(isset($data['state'])){
				$qry .=" AND proposed_location.state=".$data['state'];
			}
			if(isset($data['district'])){
				$qry .=" AND proposed_location.district=".$data['district'];
			}
			if(isset($data['block'])){
				$qry .=" AND proposed_location.block=".$data['block'];
			}
		}
		//$qry .=" GROUP BY proposed_location.block";
		$query=DB::select($qry);
		return $query;			
    }
	
	public function get_dashboard_states()
	{
		$user = Auth::user();
		$role_id=$user->role;
		$user_details = $user->getUserDetails;
		$states_arr=array();
		
		
		if($role_id==1||$role_id==2||$role_id==3)	
		{
			$haat_query= HaatMarketOne::leftJoin('haat_bazaar_form_mapping', function($join) {
                  $join->on('haat_bazaar_form_mapping.part_one', '=', 'haat_market_one.id');
                })
				
				->leftJoin('states_master', function($join) {
                  $join->on('haat_market_one.state', '=', 'states_master.id');
                })
				
				->select('haat_market_one.state','states_master.title as state_name')->groupBy('haat_market_one.state')->get();
				if(!empty($haat_query))
				{
					$hat_states=$haat_query->toArray();	
					if(!empty($hat_states))
					{
						foreach($hat_states as $state)	
						{
							$state_id=$state['state'];
							$states_arr[$state_id]=array(
								'id'=>$state['state'],
								'title'=>$state['state_name'],
							);
						}
					}	
				}
				
			//========warehouse_states=======
				$warehouse_query= WareHouseOne::leftJoin('warehouse_form_mapping', function($join) {
                  $join->on('warehouse_form_mapping.part_one', '=', 'warehouse_ones.id');
                })
				
				->where('warehouse_form_mapping.status','1')
				->leftJoin('states_master', function($join) {
                  $join->on('warehouse_ones.state', '=', 'states_master.id');
                })
				
				->select('warehouse_ones.state','states_master.title as state_name')->groupBy('warehouse_ones.state')->get();
				if(!empty($warehouse_query))
				{
					$warehouse_states=$warehouse_query->toArray();		
					foreach($warehouse_states as $state)	
					{
						$state_id=$state['state'];
						$states_arr[$state_id]=array(
							'id'=>$state['state'],
							'title'=>$state['state_name'],
						);
					}
				}
				//======vdvk==============
				$vdvk_query= ProposedLocation::leftJoin('vdvk', function($join) {
                  $join->on('proposed_location.vdvk_id', '=', 'vdvk.id');
                })
                ->leftJoin('states_master', function($join) {
                  $join->on('proposed_location.state', '=', 'states_master.id');
                })
				
				
                ->select('proposed_location.state','states_master.title as state_name')->groupBy('proposed_location.state')->get();
				if(!empty($vdvk_query))
				{
					$vdvk_states=$vdvk_query->toArray();	
					foreach($vdvk_states as $state)	
					{
						$state_id=$state['state'];
						$states_arr[$state_id]=array(
							'id'=>$state['state'],
							'title'=>$state['state_name'],
						);
					}		
				}
				//========SHG Gatherer======
				$shg_query=ShgGatherers::leftJoin('states_master', function($join) {
                  $join->on('shg_gatherers.state', '=', 'states_master.id');
                })
				->select('shg_gatherers.state','states_master.title as state_name')->groupBy('shg_gatherers.state')->get();
				if(!empty($shg_query))
				{
					$shg_states=$shg_query->toArray();	
					foreach($shg_states as $state)	
					{
						$state_id=$state['state'];
						$states_arr[$state_id]=array(
							'id'=>$state['state'],
							'title'=>$state['state_name'],
						);
					}		
				}
				//==========================
				return $states_arr;
		}else if($role_id==6)
		{
			$state_ids=array();
			$state_ids=$user->getUsersAllowedStates->pluck('state');
			$state_ids[]=$user->getUserDetails->state;  
			
			return State::whereIn('id', $state_ids)->get();
		}else{
			return State::where('id', $user->getUserDetails->state)->get();
		}
	}
	public function get_dashboard_districts($state_id)
	{
		$user = Auth::user();
		$role_id=$user->role;
		$user_details = $user->getUserDetails;
		$district_arr=array();
		
		
		if($role_id==1||$role_id==2||$role_id==3)	
		{
			$haat_query= HaatMarketOne::leftJoin('haat_bazaar_form_mapping', function($join) {
                  $join->on('haat_bazaar_form_mapping.part_one', '=', 'haat_market_one.id');
                })
				
				->leftJoin('states_master', function($join) {
                  $join->on('haat_market_one.state', '=', 'states_master.id');
                })
				->leftJoin('districts_master', function($join) {
                  $join->on('haat_market_one.district_id', '=', 'districts_master.id');
                })
				->leftJoin('blocks_master', function($join) {
                  $join->on('haat_market_one.block_id', '=', 'blocks_master.id');
                })
				->where('haat_market_one.state',$state_id)
				->select('haat_market_one.state','states_master.title as state_name','districts_master.title as district_name','haat_market_one.district_id')->groupBy('haat_market_one.district_id')->get();
				
				if(!empty($haat_query))
				{
					$hat_data=$haat_query->toArray();	
					if(!empty($hat_data))
					{
						foreach($hat_data as $data)	
						{
							$district_id=$data['district_id'];
							$district_arr[$district_id]=array(
								'id'=>$data['district_id'],
								'title'=>$data['district_name'],
							);
						}
					}	
				}
				
			//========warehouse_states=======
				$warehouse_query= WareHouseOne::leftJoin('warehouse_form_mapping', function($join) {
                  $join->on('warehouse_form_mapping.part_one', '=', 'warehouse_ones.id');
                })
				
				->where('warehouse_form_mapping.status','1')
				->leftJoin('states_master', function($join) {
                  $join->on('warehouse_ones.state', '=', 'states_master.id');
                })
				->leftJoin('districts_master', function($join) {
                  $join->on('warehouse_ones.district', '=', 'districts_master.id');
                })
				->leftJoin('blocks_master', function($join) {
                  $join->on('warehouse_ones.block', '=', 'blocks_master.id');
                })
				->where('warehouse_ones.state',$state_id)
				->select('warehouse_ones.state','states_master.title as state_name','districts_master.title as district_name','warehouse_ones.district as district_id')->groupBy('warehouse_ones.district')->get();
				if(!empty($warehouse_query))
				{
					$warehouse_data=$warehouse_query->toArray();		
					foreach($warehouse_data as $data)	
					{
						$district_id=$data['district_id'];
						$district_arr[$district_id]=array(
							'id'=>$data['district_id'],
							'title'=>$data['district_name'],
						);
					}
				}
				//======vdvk==============
				$vdvk_query= ProposedLocation::leftJoin('vdvk', function($join) {
                  $join->on('proposed_location.vdvk_id', '=', 'vdvk.id');
                })
                ->leftJoin('states_master', function($join) {
                  $join->on('proposed_location.state', '=', 'states_master.id');
                })
				->leftJoin('districts_master', function($join) {
                  $join->on('proposed_location.district', '=', 'districts_master.id');
                })
				->where('proposed_location.state',$state_id)
                ->select('proposed_location.state','states_master.title as state_name','districts_master.title as district_name','proposed_location.district')->groupBy('proposed_location.district')->get();
				if(!empty($vdvk_query))
				{
					$vdvk_data=$vdvk_query->toArray();	
					foreach($vdvk_data as $data)	
					{
						$district_id=$data['district'];
						$district_arr[$district_id]=array(
							'id'=>$data['district'],
							'title'=>$data['district_name'],
						);
					}		
				}
				//========SHG Gatherer======
				$shg_query=ShgGatherers::leftJoin('states_master', function($join) {
                  $join->on('shg_gatherers.state', '=', 'states_master.id');
                })
				->leftJoin('districts_master', function($join) {
                  $join->on('shg_gatherers.district', '=', 'districts_master.id');
                })
				->where('shg_gatherers.state',$state_id)
				->select('shg_gatherers.state','states_master.title as state_name','districts_master.title as district_name','shg_gatherers.district')->groupBy('shg_gatherers.district')->get();
				if(!empty($shg_query))
				{
					$shg_data=$shg_query->toArray();	
					foreach($shg_data as $data)	
					{
						$district_id=$data['district'];
						$district_arr[$district_id]=array(
							'id'=>$data['district'],
							'title'=>$data['district_name'],
						);
					}		
				}
				//==========================
				return $district_arr;
		}else{
			return District::where('state_id','=',$state_id)->get();
		}
	}
	public function get_dashboard_blocks($district_id)
	{
		$user = Auth::user();
		$role_id=$user->role;
		$user_details = $user->getUserDetails;
		$block_arr=array();
		
		
		if($role_id==1||$role_id==2||$role_id==3)	
		{
			$haat_query= HaatMarketOne::leftJoin('haat_bazaar_form_mapping', function($join) {
                  $join->on('haat_bazaar_form_mapping.part_one', '=', 'haat_market_one.id');
                })
				
				->leftJoin('states_master', function($join) {
                  $join->on('haat_market_one.state', '=', 'states_master.id');
                })
				->leftJoin('districts_master', function($join) {
                  $join->on('haat_market_one.district_id', '=', 'districts_master.id');
                })
				->leftJoin('blocks_master', function($join) {
                  $join->on('haat_market_one.block_id', '=', 'blocks_master.id');
                })
				->where('haat_market_one.district_id',$district_id)
				->select('haat_market_one.state','states_master.title as state_name','districts_master.title as district_name','haat_market_one.district_id','blocks_master.title as block_name','haat_market_one.block_id')->groupBy('haat_market_one.block_id')->get();
				
				if(!empty($haat_query))
				{
					$hat_data=$haat_query->toArray();	
					if(!empty($hat_data))
					{
						foreach($hat_data as $data)	
						{
							$block_id=$data['block_id'];
							$block_arr[$block_id]=array(
								'id'=>$data['block_id'],
								'title'=>$data['block_name'],
							);
						}
					}	
				}
				
			//========warehouse_states=======
				$warehouse_query= WareHouseOne::leftJoin('warehouse_form_mapping', function($join) {
                  $join->on('warehouse_form_mapping.part_one', '=', 'warehouse_ones.id');
                })
				
				->where('warehouse_form_mapping.status','1')
				->leftJoin('states_master', function($join) {
                  $join->on('warehouse_ones.state', '=', 'states_master.id');
                })
				->leftJoin('districts_master', function($join) {
                  $join->on('warehouse_ones.district', '=', 'districts_master.id');
                })
				->leftJoin('blocks_master', function($join) {
                  $join->on('warehouse_ones.block', '=', 'blocks_master.id');
                })
				->where('warehouse_ones.district',$district_id)
				->select('warehouse_ones.state','states_master.title as state_name','districts_master.title as district_name','warehouse_ones.district as district_id','warehouse_ones.block','blocks_master.title as block_name')->groupBy('warehouse_ones.block')->get();
				if(!empty($warehouse_query))
				{
					$warehouse_data=$warehouse_query->toArray();		
					foreach($warehouse_data as $data)	
					{
						$block=$data['block'];
						$block_arr[$block]=array(
							'id'=>$data['block'],
							'title'=>$data['block_name'],
						);
					}
				}
				//======vdvk==============
				$vdvk_query= ProposedLocation::leftJoin('vdvk', function($join) {
                  $join->on('proposed_location.vdvk_id', '=', 'vdvk.id');
                })
                ->leftJoin('states_master', function($join) {
                  $join->on('proposed_location.state', '=', 'states_master.id');
                })
				->leftJoin('districts_master', function($join) {
                  $join->on('proposed_location.district', '=', 'districts_master.id');
                })
				->leftJoin('blocks_master', function($join) {
                  $join->on('proposed_location.block', '=', 'blocks_master.id');
                })
				->where('proposed_location.district',$district_id)
                ->select('proposed_location.state','states_master.title as state_name','districts_master.title as district_name','proposed_location.district','blocks_master.title as block_name','proposed_location.block')->groupBy('proposed_location.block')->get();
				if(!empty($vdvk_query))
				{
					$vdvk_data=$vdvk_query->toArray();	
					foreach($vdvk_data as $data)	
					{
						$block=$data['block'];
						$block_arr[$block]=array(
							'id'=>$data['block'],
							'title'=>$data['block_name'],
						);
					}		
				}
				//========SHG Gatherer======
				$shg_query=ShgGatherers::leftJoin('states_master', function($join) {
                  $join->on('shg_gatherers.state', '=', 'states_master.id');
                })
				->leftJoin('districts_master', function($join) {
                  $join->on('shg_gatherers.district', '=', 'districts_master.id');
                })
				->leftJoin('blocks_master', function($join) {
                  $join->on('shg_gatherers.block', '=', 'blocks_master.id');
                })
				->where('shg_gatherers.district',$district_id)
				->select('shg_gatherers.state','states_master.title as state_name','districts_master.title as district_name','shg_gatherers.district','blocks_master.title as block_name','shg_gatherers.block')->groupBy('shg_gatherers.block')->get();
				if(!empty($shg_query))
				{
					$shg_data=$shg_query->toArray();	
					foreach($shg_data as $data)	
					{
						$block=$data['block'];
						$block_arr[$block]=array(
							'id'=>$data['block'],
							'title'=>$data['block_name'],
						);
					}		
				}
				//==========================
				return $block_arr;
		}else{
			return Block::where('district_id','=',$district_id)->get();
		}
	}
	public function sanctioned_sndwise($data)
	{
		$where 			= array();
		$user = Auth::user();
		$role_id=$user->role;
		$user_details = $user->getUserDetails;
		
		if(($role_id ==4 || $role_id ==7 || $role_id ==9 || $role_id ==10 || $role_id ==11 || $role_id ==12 ) && isset($user_details['state']) && !empty($user_details['state']))
		{
			$data['state_id']=$user_details['state'];
		}
		if($role_id ==13  && isset($user_details['state']) && !empty($user_details['state']))
		{
			$data['state_id']=$user_details['state'];
		}
		if($role_id ==8)
		{
			$where['vdvk.created_by']	= $user->id; 
		}
		
		if(isset($data['state_id']) || isset($data['district']) || isset($data['block']))
		{
			if(isset($data['state_id'])){
				$where['state']	= $data['state_id']; 
			}
			
		}
		$query=SanctionLetterVdvkMapping::join('sanction_letter_schema', function($join) {
                  $join->on('sanction_letter_vdvk_mapping.letter_id', '=', 'sanction_letter_schema.id');
                })
				->join('vdvk', function($join) {
                  $join->on('sanction_letter_vdvk_mapping.vdvk_id', '=', 'vdvk.id');
                })
				->join('users', function($join) {
                  $join->on('sanction_letter_schema.snd_id', '=', 'users.id');
                })
				->join('proposed_location', function($join) {
                  $join->on('proposed_location.vdvk_id', '=', 'vdvk.id');
                })
                 ->leftJoin('states_master', function($join) {
                  $join->on('proposed_location.state', '=', 'states_master.id');
                })
                ->leftJoin('districts_master', function($join) {
                  $join->on('proposed_location.district', '=', 'districts_master.id');
                })
                ->leftJoin('blocks_master', function($join) {
                  $join->on('proposed_location.block', '=', 'blocks_master.id');
                })                
				->groupBy('sanction_letter_schema.snd_id')
				->whereIn('vdvk.sanctioned',['1','2'])
				->where($where)
				->where('sanction_letter_schema.release_status',0)
				->select('users.user_name','proposed_location.state','states_master.title as state_name','districts_master.title as district_name','blocks_master.title as block_name',DB::raw('count(sanction_letter_vdvk_mapping.vdvk_id) as no_vdvk,sum(sanction_letter_vdvk_mapping.sanctioned_amount) as sanctioned_amount'))
				//->toSql();
				->get();
				//print_r($query); die();
		return $query;		
	}

	public function view_sanctioned_sndwise($data)
	{ 
		$where 			= array();
		$user = Auth::user();
		$role_id=$user->role;
		$user_details = $user->getUserDetails;
		
		if(($role_id ==4 || $role_id ==7 || $role_id ==9 || $role_id ==10 || $role_id ==11 || $role_id ==12 ) && isset($user_details['state']) && !empty($user_details['state']))
		{
			$data['s_id']=$user_details['state'];
		}
		if($role_id ==13  && isset($user_details['state']) && !empty($user_details['state']))
		{
			$data['s_id']=$user_details['state'];
		}
		if($role_id ==8)
		{
			$where['vdvk.created_by']	= $user->id; 
		}
		
		if(isset($data['s_id'])){
			$where['state']	= $data['s_id']; 
		}

		$query=SanctionLetterVdvkMapping::join('sanction_letter_schema', function($join) {
                  $join->on('sanction_letter_vdvk_mapping.letter_id', '=', 'sanction_letter_schema.id');
                })
				->join('vdvk', function($join) {
                  $join->on('sanction_letter_vdvk_mapping.vdvk_id', '=', 'vdvk.id');
                })
				->join('users', function($join) {
                  $join->on('sanction_letter_schema.snd_id', '=', 'users.id');
                })
				->join('proposed_location', function($join) {
                  $join->on('proposed_location.vdvk_id', '=', 'vdvk.id');
                })            
                ->where($where)
				->whereIn('vdvk.sanctioned',['1','2'])
				->where('sanction_letter_schema.release_status',0)
				->select('sanction_letter_vdvk_mapping.vdvk_id','proposed_location.kendra_name','sanction_letter_vdvk_mapping.sanctioned_amount')
				//->toSql();
				->get();
				//print_r($query); die();
		return $query;		
	}	

	// Secnctioned Release Wise

	public function sanctioned_releasewise($data)
	{
		$where 			= array();
		$user = Auth::user();
		$role_id=$user->role;
		$user_details = $user->getUserDetails;
		
		if(($role_id ==4 || $role_id ==7 || $role_id ==9 || $role_id ==10 || $role_id ==11 || $role_id ==12 ) && isset($user_details['state']) && !empty($user_details['state']))
		{
			$data['state_id']=$user_details['state'];
		}
		if($role_id ==13  && isset($user_details['state']) && !empty($user_details['state']))
		{
			$data['state_id']=$user_details['state'];
		}
		if($role_id ==8)
		{
			$where['vdvk.created_by']	= $user->id; 
		}
		
		if(isset($data['state_id']) || isset($data['district']) || isset($data['block']))
		{
			if(isset($data['state_id'])){
				$where['state']	= $data['state_id']; 
			}
			
		}
		$query=SanctionLetterVdvkMapping::join('sanction_letter_schema', function($join) {
                  $join->on('sanction_letter_vdvk_mapping.letter_id', '=', 'sanction_letter_schema.id');
                })
				->join('vdvk', function($join) {
                  $join->on('sanction_letter_vdvk_mapping.vdvk_id', '=', 'vdvk.id');
                })
				->join('users', function($join) {
                  $join->on('sanction_letter_schema.snd_id', '=', 'users.id');
                })
				->join('proposed_location', function($join) {
                  $join->on('proposed_location.vdvk_id', '=', 'vdvk.id');
                })
                 ->leftJoin('states_master', function($join) {
                  $join->on('proposed_location.state', '=', 'states_master.id');
                })
                ->leftJoin('districts_master', function($join) {
                  $join->on('proposed_location.district', '=', 'districts_master.id');
                })
                ->leftJoin('blocks_master', function($join) {
                  $join->on('proposed_location.block', '=', 'blocks_master.id');
                })                
				->groupBy('sanction_letter_schema.snd_id')
				//->where('vdvk.sanctioned',1)
				->whereIn('vdvk.sanctioned',['1','2'])
				->where($where)
				->where('sanction_letter_schema.release_status',1)
				->select('users.name','proposed_location.state','users.last_name','states_master.title as state_name','districts_master.title as district_name','blocks_master.title as block_name',DB::raw('count(sanction_letter_vdvk_mapping.vdvk_id) as no_vdvk,sum(sanction_letter_vdvk_mapping.released_amount) as released_amount'))
				//->toSql();
				->get();
				//print_r($query); die();
		return $query;		
	}	
		public function view_sanctioned_releasewise($data)
	{ 
		$where 			= array();
		$user = Auth::user();
		$role_id=$user->role;
		$user_details = $user->getUserDetails;
		
		if(($role_id ==4 || $role_id ==7 || $role_id ==9 || $role_id ==10 || $role_id ==11 || $role_id ==12 ) && isset($user_details['state']) && !empty($user_details['state']))
		{
			$data['s_id']=$user_details['state'];
		}
		if($role_id ==13  && isset($user_details['state']) && !empty($user_details['state']))
		{
			$data['s_id']=$user_details['state'];
		}
		if($role_id ==8)
		{
			$where['vdvk.created_by']	= $user->id; 
		}
		
		if(isset($data['s_id'])){
			$where['state']	= $data['s_id']; 
		}

		$query=SanctionLetterVdvkMapping::join('sanction_letter_schema', function($join) {
                  $join->on('sanction_letter_vdvk_mapping.letter_id', '=', 'sanction_letter_schema.id');
                })
				->join('vdvk', function($join) {
                  $join->on('sanction_letter_vdvk_mapping.vdvk_id', '=', 'vdvk.id');
                })
				->join('users', function($join) {
                  $join->on('sanction_letter_schema.snd_id', '=', 'users.id');
                })
				->join('proposed_location', function($join) {
                  $join->on('proposed_location.vdvk_id', '=', 'vdvk.id');
                })            
                ->where($where)
				->whereIn('vdvk.sanctioned',['1','2'])
				->where('sanction_letter_schema.release_status',1)
				->select('sanction_letter_vdvk_mapping.vdvk_id','proposed_location.kendra_name','sanction_letter_schema.released_amount')
				//->toSql();
				->get();
				//print_r($query); die();
		return $query;		
	}	


public function statewise_surveyor($data)
	{
		$where 			= array();
		$user = Auth::user();
		$role_id=$user->role;
		$user_details = $user->getUserDetails;
		
		if(($role_id ==4 || $role_id ==7 || $role_id ==9 || $role_id ==10 || $role_id ==11 || $role_id ==12 ) && isset($user_details['state']) && !empty($user_details['state']))
		{
			$data['state_id']=$user_details['state'];
		}
		if($role_id ==13  && isset($user_details['state']) && !empty($user_details['state']))
		{
			$data['state_id']=$user_details['state'];
		}
		if($role_id ==8)
		{
			$where['users.created_by']	= $user->id; 
		}
		
		if(isset($data['state_id']) || isset($data['district']) || isset($data['block']))
		{
			if(isset($data['state_id'])){
				$where['state']	= $data['state_id']; 
			}			
			if(isset($data['district'])){
				$where['district']	= $data['district']; 
			}
			if(isset($data['block'])){
				$where['block']	= $data['block']; 
			}
		}
		$state_ids=array();
		if($role_id==6)
		{
			
			$state_ids=$user->getUsersAllowedStates->pluck('state');
			$state_ids[]=$user->getUserDetails->state;    
		}
		
		$surveyor_array=array();
		$query=User::join('user_details', function($join) {
                  $join->on('user_details.user_id', '=', 'users.id');
                })
                 ->leftJoin('states_master', function($join) {
                  $join->on('user_details.state', '=', 'states_master.id');
                })
                ->leftJoin('districts_master', function($join) {
                  $join->on('user_details.district', '=', 'districts_master.id');
                })
                ->leftJoin('blocks_master', function($join) {
                  $join->on('user_details.block', '=', 'blocks_master.id');
                })                
				->where($where)
				//->where('users.status',1)
				->where('users.role',11);
				if(!empty($state_ids))
				{
					$query=$query->whereIn('user_details.state',$state_ids);
				}
				
				$query=$query->select('users.id','users.user_name','users.name','states_master.title as state_name','districts_master.title as district_name','blocks_master.title as block_name')
				->get();
			
		if($role_id==8)
		{
			$list = User::where('role', 11);
        
			 $query  =$list->whereHas('getParentUsers.getParentUsers', function (Builder $query) use ($user){
				$query->where('parent_id',$user->id);
			})->join('user_details', function($join) {
                  $join->on('user_details.user_id', '=', 'users.id');
                })
                 ->leftJoin('states_master', function($join) {
                  $join->on('user_details.state', '=', 'states_master.id');
                })
                ->leftJoin('districts_master', function($join) {
                  $join->on('user_details.district', '=', 'districts_master.id');
                })
                ->leftJoin('blocks_master', function($join) {
                  $join->on('user_details.block', '=', 'blocks_master.id');
                })
				->select('users.id','users.user_name','users.name','states_master.title as state_name','districts_master.title as district_name','blocks_master.title as block_name')
				->get();
		}else{
			$query=User::join('user_details', function($join) {
                  $join->on('user_details.user_id', '=', 'users.id');
                })
                 ->leftJoin('states_master', function($join) {
                  $join->on('user_details.state', '=', 'states_master.id');
                })
                ->leftJoin('districts_master', function($join) {
                  $join->on('user_details.district', '=', 'districts_master.id');
                })
                ->leftJoin('blocks_master', function($join) {
                  $join->on('user_details.block', '=', 'blocks_master.id');
                })                
				->where($where)
				//->where('users.status',1)
				->where('users.role',11);
				if(!empty($state_ids))
				{
					$query=$query->whereIn('user_details.state',$state_ids);
				}
				$query=$query->select('users.id','users.user_name','users.name','states_master.title as state_name','districts_master.title as district_name','blocks_master.title as block_name')
				->get();	
		}	
			
			$user_count=array();
			$haarBazarQuery=HaatBazaarFormMapping::select(DB::raw('count(id) as no_forms'),'created_by')->where('status','1')->groupBy('created_by')->get();
			foreach ($haarBazarQuery as $value) {
				$user_count[$value['created_by']]=$value['no_forms'];
			}

			$wareHouseQuery=WarehouseFormMapping::select(DB::raw('count(id) as no_forms'),'created_by')->where('status','1')->groupBy('created_by')->get();			
			foreach ($wareHouseQuery as $Warevalue) {
				if (array_key_exists($Warevalue['created_by'],$user_count)){
					$user_count[$Warevalue['created_by']] +=$Warevalue['no_forms'];
				}
				else{
					$user_count[$Warevalue['created_by']] =$Warevalue['no_forms'];
				}
			}

			$shg_Query=ShgGatherers::select(DB::raw('count(id) as no_forms'),'created_by')->where('status','1')->groupBy('created_by')->get();
			foreach ($shg_Query as $Shgvalue) {
				if (array_key_exists($Shgvalue['created_by'],$user_count)){
					$user_count[$Shgvalue['created_by']] +=$Shgvalue['no_forms'];
				}
				else
				{
					$user_count[$Shgvalue['created_by']] =$Shgvalue['no_forms'];
				}
			}
		foreach ($query as  $val) {
				$user_id=$val['id'];
				$surveyor_array[]=array(
					'name'=>$val['name'],
					'state_name'=>$val['state_name'],
					'district_name'=>$val['district_name'],
					'block_name'=>$val['block_name'],
					'count'=>isset($user_count[$user_id]) ? $user_count[$user_id] : 0,
				);
			}
		return $surveyor_array;		
	}
	public function statewise_supervisor($data)
	{
		$where 			= array();
		$user = Auth::user();
		$role_id=$user->role;
		$user_details = $user->getUserDetails;
		$state_ids=array();
		if($role_id==6)
		{
			
			$state_ids=$user->getUsersAllowedStates->pluck('state');
			$state_ids[]=$user->getUserDetails->state;    
		}
		if(($role_id ==4 || $role_id ==7 || $role_id ==9 || $role_id ==10 || $role_id ==11 || $role_id ==12 ) && isset($user_details['state']) && !empty($user_details['state']))
		{
			$data['state_id']=$user_details['state'];
		}
		if($role_id ==13  && isset($user_details['state']) && !empty($user_details['state']))
		{
			$data['state_id']=$user_details['state'];
		}
		if($role_id ==8)
		{
			$where['users.created_by']	= $user->id; 
		}
		
		if(isset($data['state_id']) || isset($data['district']) || isset($data['block']))
		{
			if(isset($data['state_id'])){
				$where['state']	= $data['state_id']; 
			}
			if(isset($data['district'])){
				$where['district']	= $data['district']; 
			}
			if(isset($data['block'])){
				$where['block']	= $data['block']; 
			}
		}
		$surveyor_array=array();
		if($role_id==8)
		{	 
			$query=User::where('role', 12)->whereHas('getParentUsers', function (Builder $query) use ($user) {
            $query->where('parent_id', $user->id);
			})->join('user_details', function($join) {
                  $join->on('user_details.user_id', '=', 'users.id');
                })
                 ->leftJoin('states_master', function($join) {
                  $join->on('user_details.state', '=', 'states_master.id');
                })
                ->leftJoin('districts_master', function($join) {
                  $join->on('user_details.district', '=', 'districts_master.id');
                })
                ->leftJoin('blocks_master', function($join) {
                  $join->on('user_details.block', '=', 'blocks_master.id');
                }) 
				->select('users.id','users.user_name','users.name','states_master.title as state_name','districts_master.title as district_name','blocks_master.title as block_name')
				->get();
		}else{   
			$query=User::join('user_details', function($join) {
                  $join->on('user_details.user_id', '=', 'users.id');
                })
                 ->leftJoin('states_master', function($join) {
                  $join->on('user_details.state', '=', 'states_master.id');
                })
                ->leftJoin('districts_master', function($join) {
                  $join->on('user_details.district', '=', 'districts_master.id');
                })
                ->leftJoin('blocks_master', function($join) {
                  $join->on('user_details.block', '=', 'blocks_master.id');
                })                
				->where($where)
				//->where('users.status',1)
				->where('users.role',12);
				if(!empty($state_ids))
				{
					$query=$query->whereIn('user_details.state',$state_ids);
				}
				$query=$query->select('users.id','users.user_name','users.name','states_master.title as state_name','districts_master.title as district_name','blocks_master.title as block_name')
				->get();	
		}
		
			
			$user_count=array();
			$haarBazarQuery=HaatBazaarFormMapping::select(DB::raw('count(id) as no_forms'),'updated_by')->groupBy('updated_by')->get();
			foreach ($haarBazarQuery as $value) {
				$user_count[$value['updated_by']]=$value['no_forms'];
			}

			$wareHouseQuery=WarehouseFormMapping::select(DB::raw('count(id) as no_forms'),'updated_by')->groupBy('updated_by')->get();			
			foreach ($wareHouseQuery as $Warevalue) {
				if (array_key_exists($Warevalue['updated_by'],$user_count)){
					$user_count[$Warevalue['updated_by']] +=$Warevalue['no_forms'];
				}
				else{
					$user_count[$Warevalue['updated_by']] =$Warevalue['no_forms'];
				}
			}

			$shg_Query=ShgGatherers::select(DB::raw('count(id) as no_forms'),'updated_by')->groupBy('updated_by')->get();
			foreach ($shg_Query as $Shgvalue) {
				if (array_key_exists($Shgvalue['updated_by'],$user_count)){
					$user_count[$Shgvalue['updated_by']] +=$Shgvalue['no_forms'];
				}
				else
				{
					$user_count[$Shgvalue['updated_by']] =$Shgvalue['no_forms'];
				}
			}
		foreach ($query as  $val) {
				$user_id=$val['id'];
				$surveyor_array[]=array(
					'name'=>$val['name'],
					'state_name'=>$val['state_name'],
					'district_name'=>$val['district_name'],
					'block_name'=>$val['block_name'],					
					'count'=>isset($user_count[$user_id]) ? $user_count[$user_id] : 0,
				);
			}
		return $surveyor_array;					
		//return $query;		
	}
	public function state_shg_gatherer($reqBody)
	{  
		$where 			= array();
		$user = Auth::user();
		$role_id=$user->role;
		$user_details = $user->getUserDetails;
		$state_ids=array();
        
		if($role_id ==6)
		{
			$state_ids=$user->getUsersAllowedStates->pluck('state');
			$state_ids[]=$user_details['state'];  
		}
		$serveyor_details = $user->getSurveyorSupervisorDetails;
		if($role_id==11)
		{
			if(isset($serveyor_details->survey_for)&& !empty($serveyor_details->survey_for) && is_array($serveyor_details->survey_for) && in_array('1',$serveyor_details->survey_for))
			{
			
			}else{
				return '401';
			}	
		}
		
		
		if(($role_id ==4 || $role_id ==7 || $role_id ==8|| $role_id ==9 || $role_id ==10 || $role_id ==11 || $role_id ==12 ) && isset($user_details['state']) && !empty($user_details['state']))
		{
			$data['state']=$user_details['state'];
		}
		if(($role_id ==13 )  && isset($user_details['state']) && !empty($user_details['state']))
		{
			$data['state']=$user_details['state'];
			$data['district']=$user_details['district'];
		}
		if($role_id ==8)
		{
			$where['shg_groups.created_by'] 							= $user->id; 
		}
		
		if(isset($data['state']) || isset($data['district']) || isset($data['block']))
		{
			if(isset($data['state'])){
				$where['shg_groups.state'] 							= $data['state']; 
			}
			if(isset($data['district'])){
				$where['shg_groups.district'] 							= $data['district']; 
			}
		}
		if(isset($reqBody['state']))
		{
				$where['shg_groups.state'] 							= $reqBody['state']; 
		}
		//dd($where);
		$query=ShgGroup::join('user_details',function($join){
                  $join->on('shg_groups.created_by', '=', 'user_details.user_id');
              })
			  ->leftJoin('states_master', function($join) {
                  $join->on('shg_groups.state', '=', 'states_master.id');
                })
              ->where($where);
			  if(!empty($state_ids))
			  {
				  $query=$query->whereIn('shg_groups.state',$state_ids);
			  }
			  $query=$query->select('shg_groups.state',DB::raw('COUNT(shg_groups.id) as count'),'states_master.title as state_name')
              ->groupBy('shg_groups.state')
			  ->get();
		return $query;		
	}
	public function district_shg_group($data)
	{
		$where 			= array();
		$user = Auth::user();
		$role_id=$user->role;
		$user_details = $user->getUserDetails;
		$serveyor_details = $user->getSurveyorSupervisorDetails;
		if($role_id==11)
		{
			if(isset($serveyor_details->survey_for)&& !empty($serveyor_details->survey_for) && is_array($serveyor_details->survey_for) && in_array('1',$serveyor_details->survey_for))
			{
			
			}else{
				return '401';
			}	
		}
		
		
		if(($role_id ==4 || $role_id ==7 || $role_id ==8|| $role_id ==9 || $role_id ==10 || $role_id ==11 || $role_id ==12 ) && isset($user_details['state']) && !empty($user_details['state']))
		{
			$data['state']=$user_details['state'];
		}
		if(($role_id ==13 )  && isset($user_details['state']) && !empty($user_details['state']))
		{
			$data['state']=$user_details['state'];
			$data['district']=$user_details['district'];
		}
		if($role_id ==8)
		{
			$where['shg_groups.created_by'] 							= $user->id; 
		}
		
		if(isset($data['state']) || isset($data['district']) || isset($data['block']))
		{
			if(isset($data['state'])){
				$where['shg_groups.state'] 							= $data['state']; 
			}
			if(isset($data['district'])){
				$where['shg_groups.district'] 							= $data['district']; 
			}
		}
		$query=ShgGroup::join('user_details',function($join){
                  $join->on('shg_groups.created_by', '=', 'user_details.user_id');
              })
			  ->leftJoin('states_master', function($join) {
                  $join->on('shg_groups.state', '=', 'states_master.id');
                })
			  ->leftJoin('districts_master', function($join) {
                  $join->on('shg_groups.district', '=', 'districts_master.id');
                })	
              ->where($where)
			  ->select('shg_groups.state','shg_groups.district',DB::raw('COUNT(shg_groups.id) as count'),'states_master.title as state_name','districts_master.title as district_name')
              ->groupBy('shg_groups.district')
			  ->get();
		return $query;		
	}
	public function block_shg_group($data)
	{
		$where 			= array();
		$user = Auth::user();
		$role_id=$user->role;
		$user_details = $user->getUserDetails;
		$serveyor_details = $user->getSurveyorSupervisorDetails;
		if($role_id==11)
		{
			if(isset($serveyor_details->survey_for)&& !empty($serveyor_details->survey_for) && is_array($serveyor_details->survey_for) && in_array('1',$serveyor_details->survey_for))
			{
			
			}else{
				return '401';
			}	
		}
		
		
		if(($role_id ==4 || $role_id ==7 || $role_id ==8|| $role_id ==9 || $role_id ==10 || $role_id ==11 || $role_id ==12 ) && isset($user_details['state']) && !empty($user_details['state']))
		{
			$data['state']=$user_details['state'];
		}
		if(($role_id ==13 || $role_id ==6)  && isset($user_details['state']) && !empty($user_details['state']))
		{
			$data['state']=$user_details['state'];
			$data['district']=$user_details['district'];
		}
		if($role_id ==8)
		{
			$where['shg_groups.created_by'] 							= $user->id; 
		}
		
		if(isset($data['state']) || isset($data['district']) || isset($data['block']))
		{
			if(isset($data['state'])){
				$where['shg_groups.state'] 							= $data['state']; 
			}
			if(isset($data['district'])){
				$where['shg_groups.district'] 							= $data['district']; 
			}
		}
		$query=ShgGroup::join('user_details',function($join){
                  $join->on('shg_groups.created_by', '=', 'user_details.user_id');
              })
			  ->leftJoin('states_master', function($join) {
                  $join->on('shg_groups.state', '=', 'states_master.id');
                })
			  ->leftJoin('districts_master', function($join) {
                  $join->on('shg_groups.district', '=', 'districts_master.id');
                })
			  ->leftJoin('blocks_master', function($join) {
                  $join->on('shg_groups.block', '=', 'blocks_master.id');
                })		
              ->where($where)
			  ->select('shg_groups.state','shg_groups.district','shg_groups.block',DB::raw('COUNT(shg_groups.id) as count'),'states_master.title as state_name','districts_master.title as district_name','blocks_master.title as block_name')
              ->groupBy('shg_groups.block')
			  ->get();
		return $query;		
	}	
}
