<?php

namespace App\Services\Proposals;

use App\Models\Proposals\Mfp_procurement;
use App\Models\Proposals\Mfp_coverage;
use App\Models\Proposals\Mfp_coverage_haat_block;
use App\Models\Proposals\Mfp_procurement_consolidate_proposal;
use App\Models\Proposals\Mfp_seasonality;
use App\Models\Proposals\Mfp_seasonality_commodity;
use App\Models\Proposals\Mfp_seasonality_commodity_month;
use App\Models\User;
use App\Models\Proposals\Mfp_procurement_disposal;
use App\Models\Proposals\Mfp_procurement_consolidated;
use App\Models\Proposals\Mfp_procurement_disposal_warehouse;
use App\Models\Proposals\Mfp_procurement_disposal_warehouse_months;
use App\Models\Proposals\Mfp_procurement_summary;
use App\Models\Proposals\Mfp_procurement_scrutiny_level_history;
use App\Models\Proposals\Mfp_procurement_status_log;
use App\Models\Mfp_procurement_sanctioned;
use App\Models\Mfp_procurement_dia_release_commodity;
use App\Models\Masters\StateRoleSubLevel;
use App\Models\Masters\Mfp;
use App\Notifications\MfpProcurementApprove;
use App\Notifications\MfpProcurementAssignNextLevel;
use App\Notifications\MfpProcurementConsolidationAssignNextLevel;
use App\Notifications\MfpProcurementConsolidatedNextLevel;
use App\Notifications\MfpProcurementRevertNextLevel;
use App\Notifications\MfpProcurementReject;
use App\Services\Service;
use App\Queries\ProcurementQuery;
use App\Queries\ProcurementRecommendQuery;
use App\Queries\ProcurementApprovedQuery;
use App\Queries\MfpProcurementSanctionedQuery;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;
use App\Http\Resources\Api\Proposals\MfpCoverageResource;
use App\Http\Resources\Api\Proposals\MfpProcurementServiceChargesDiaResource;
use App\Http\Resources\Api\Proposals\MfpProcurementTransportationChargesResource;
use App\Http\Resources\Api\Proposals\MfpProcurementWarehouseChargesResource;
use App\Http\Resources\Api\Proposals\MfpProcurementWeightmentChargesResource;
use App\Http\Resources\Api\Proposals\MfpProcurementServiceChargesResource;
use App\Http\Resources\Api\Proposals\MfpProcurementOtherCostsResource;
use App\Http\Resources\Api\Proposals\MfpProcurementLabourChargesResource;
use App\Http\Resources\Api\Proposals\MfpProcurementWarehouseLabourResource;
use App\Http\Resources\Api\Proposals\MfpProcurementEstimatedWastagesResource;
use App\Http\Resources\Api\Proposals\MfpProcurementCommodityResource;
use App\Http\Resources\Api\Proposals\MfpCollectionLevelResource;
use App\Http\Resources\Api\Proposals\MfpSeasionalityQuarterWiseResource;
use App\Http\Resources\Api\Proposals\MfpPlanDetailViewResource;
use App\Models\Masters\HaatDetailsMaster;
use App\Models\Proposals\Mfp_procurement_commodity;
use App\Models\Proposals\Mfp_procurement_nodal;
use App\Rules\UniqueMfpYear;
use App\Services\Proposals\MfpProcurementPlanService;
use App\Rules\UniqueHaatBlock;
use App\Rules\UniqueHaatForMfp;
use App\Rules\UniqueSeasonalityMonth;
use Helper;
use Carbon\Carbon;

use DB;
use Doctrine\DBAL\Driver\IBMDB2\DB2Driver;
use Illuminate\Support\Facades\DB as FacadesDB;

class MfpProcurementService extends Service
{
    private $procurementQuery;
    private $planService;
    private $mfpProcurementSanctionedQuery;
    private $procurementApprovedQuery;

    public function __construct(ProcurementQuery $procurementQuery = null,MfpProcurementPlanService $mfpProcurementPlanService,ProcurementRecommendQuery $procurementRecommendQuery=null,MfpProcurementSanctionedQuery $mfpProcurementSanctionedQuery,ProcurementApprovedQuery $procurementApprovedQuery)
    {
        $this->procurementQuery = $procurementQuery;
        $this->procurementRecommendQuery = $procurementRecommendQuery;
        $this->mfpProcurementSanctionedQuery = $mfpProcurementSanctionedQuery;
        $this->planService = $mfpProcurementPlanService;
        $this->procurementApprovedQuery = $procurementApprovedQuery;
    }
    /**
     * Get all items from database
     *
     * @return mixed
     */
    public function getAll($request)
    {
        $columns = array(
            0 => 'id',
            1 => 'state_id',
            6 => 'storage_capacity',
        );
        $limit = isset($request['length']) ? $request['length'] : 10;


        $order = isset($columns[$request['order'][0]['column']]) ? $columns[$request['order'][0]['column']] : 'id';
        $dir = isset($request['order'][0]['dir']) ? $request['order'][0]['dir'] : 'DESC';
        $query = $this->procurementQuery->viewAllQuery();
        $query = $query->orderBy($order, $dir);

        if (isset($request['year_id']) && !empty($request['year_id'])) {
            $query->where('year_id', $request['year_id']);
        }
        if (isset($request['status']) && $request['status']!='') {
            $query->where('status', $request['status']);
        }
        if (isset($request['proposal_id']) && $request['proposal_id']!='') {
            
            $query->where('proposal_id', 'LIKE', "%".$request['proposal_id']."%");
        }

        $query = $query->whereHas('getUserDetails', function (Builder $query) use ($request) {
            if (isset($request['state_id']) && !empty($request['state_id'])) {
                $query->where('state', $request['state_id']);
            }
            if (isset($request['district_id']) && !empty($request['district_id'])) {
                $query->where('district', $request['district_id']);
            }
        });



        if (isset($request['search']['value']) && !empty($request['search']['value'])) {
            $search = $request['search']['value'];
            //$query->where(DB::raw("CONCAT(`storage_type`,`storage_capacity`)"), 'LIKE', "%".$search."%");
        }
        if (isset($request['page']) && !empty($request['page'])) {
            return $query->paginate($limit);
        } else {
            //$query=$query->where('status','1');
            return $query->get();
        }
    }


    /**
     * Get all items from database
     *
     * @return mixed
     */
    public function proposalListing($request)
    {
        $user_id = Auth::user()->id;
        
        $columns = array(
            0 => 'id',
            1 => 'id',
            2 => 'proposal_id',
        );
        $limit = isset($request['length']) ? $request['length'] : 10;

        $order = isset($columns[$request['order'][0]['column']]) ? $columns[$request['order'][0]['column']] : 'id';
        $dir = isset($request['order'][0]['dir']) ? $request['order'][0]['dir'] : 'DESC';
        //$query=$this->procurementQuery->viewAllQuery();
        //DB::enableQueryLog();
        //If logged in user super admin
        if(Auth::user()->role == 1 ){
            $where = ['consolidated_id'=>null];
        }else{
            $where = ['assigned_to'=>$user_id,'consolidated_id'=>null];
        }
       

        $query=Mfp_procurement::where($where);
        $query=$query->whereIn('current_status',[0,1,2]);
        $query=$query->orderBy($order,$dir);
        if(isset($request['from_date']) && !empty($request['from_date']))
        {
            $from_date=Carbon::createFromFormat('d/m/Y', $request['from_date']);
            $from_date=date('Y-m-d',strtotime($from_date));
            $query=$query->whereDate('assigned_date','>=', $from_date);
        }
        if(isset($request['to_date']) && !empty($request['to_date']))
        {
            $to_date=Carbon::createFromFormat('d/m/Y', $request['to_date']);
            $to_date=date('Y-m-d',strtotime($to_date));
            $query=$query->whereDate('assigned_date','<=', $to_date);
        }
        $query = $query->whereHas('getUserDetails', function (Builder $query) use ($request) {

            if (isset($request['district_id']) && !empty($request['district_id'])) {
                $query->where('district', $request['district_id']);
            }
            if (isset($request['block_id']) && !empty($request['block_id'])) {
                $query->where('block', $request['block_id']);
            }
        });

        if (isset($request['proposal_id']) && !empty($request['proposal_id'])) {
            $query->where('proposal_id', $request['proposal_id']);
        }


        if (isset($request['status']) && !empty($request['status'])) {
            $query->where('status', $request['status']);
        }

        
        if (isset($request['search']['value']) && !empty($request['search']['value'])) {
            $search = $request['search']['value'];
            $query->where(DB::raw("CONCAT(`proposal_id`)"), 'LIKE', "%".$search."%");
        }
       

        if (isset($request['page']) && !empty($request['page'])) {
            return $query->paginate($limit);
        } else {
            return $query->count();
        }
    }
    /**
     * Get all proposalRecommendedListing items from database
     *
     * @return mixed
     */
    public function proposalRecommendedListing($request)
    {
        $user_id = Auth::user()->id;
        $columns = array(
            0 => 'id',
            1 => 'id',
            2 => 'proposal_id',
        );
        $limit = isset($request['length']) ? $request['length'] : 10;

        $order = isset($columns[$request['order'][0]['column']]) ? $columns[$request['order'][0]['column']] : 'id';
        $dir = isset($request['order'][0]['dir']) ? $request['order'][0]['dir'] : 'DESC';
        $query=$this->procurementRecommendQuery->viewAllQuery($request);
       
        /*$query = Mfp_procurement::whereHas('getProposedStatusLogs',function(Builder $query) use ($user_id){
            if(Auth::user()->role != 1 && Auth::user()->role != 3 ){
                $query->where('assigned_by', $user_id);
            }
            //if logged in user is ministry
            if(Auth::user()->role == 3){
                $query->where('assigned_to', $user_id);
                $query->where('mfp_procurement_status_log.is_assigned_next_level', 1);
                $query->where('mfp_procurement_status_log.status', 1);
            }
            // $query->where('mfp_procurement_status_log.is_assigned_next_level', 1);
            // $query->where('mfp_procurement_status_log.status', 1);
            
        });*/
        
        $query=$query->orderBy($order,$dir);
        
        /*$query = $query->whereHas('getUserDetails', function (Builder $query) use ($request) {

            if (isset($request['district_id']) && !empty($request['district_id'])) {
                $query->where('district', $request['district_id']);
            }
            if (isset($request['block_id']) && !empty($request['block_id'])) {
                $query->where('block', $request['block_id']);
            }
        });*/

        if (isset($request['status']) && !empty($request['status'])) {
            $query->where('status', $request['status']);
        }

        

        if (isset($request['page']) && !empty($request['page'])) {
            return $query->paginate($limit);
        } else {
            return $query->count();
        }
    }


    /**
     * Get all proposalRecommendedListing items from database
     *
     * @return mixed
     */
    public function proposalApprovedListing($request)
    {
        $user_id = Auth::user()->id;
        $columns = array(
            0 => 'id',
            1 => 'id',
            2 => 'proposal_id',
        );
        $limit = isset($request['length']) ? $request['length'] : 10;

        $order = isset($columns[$request['order'][0]['column']]) ? $columns[$request['order'][0]['column']] : 'id';
        $dir = isset($request['order'][0]['dir']) ? $request['order'][0]['dir'] : 'DESC';
        $query=$this->procurementApprovedQuery->viewAllQuery($request);
       
        
        
        $query=$query->orderBy($order,$dir);
        
        
        if (isset($request['status']) && !empty($request['status'])) {
            $query->where('status', $request['status']);
        }

        if (isset($request['page']) && !empty($request['page'])) {
            return $query->paginate($limit);
        } else {
            return $query->count();
        }
    }
    /**
     * Get all items from database
     *
     * @return mixed
     */
    public function getConsolidatedProposals($request)
    {
        $user_id=Auth::user()->id;   
        $columns = array( 
                    0 =>'id', 
                    1=> 'id',
                    2=> 'id',
            );
        $limit = isset($request['length'])?$request['length']:10;
        
        $order = isset($columns[$request['order'][0]['column']])?$columns[$request['order'][0]['column']]:'id';
        $dir = isset($request['order'][0]['dir'])?$request['order'][0]['dir']:'DESC';
       
       
        $query=Mfp_procurement_consolidated::whereHas('getMfpProcurement', function (Builder $query) use ($request,$user_id) {
        
            //If logged in user is super admin
            if(Auth::user()->role != 1){
                $query->where('assigned_to',$user_id);
                $query->where('created_by','!=',$user_id);
            } 
            $query->where('status','!=',1);
            $query->whereIn('current_status' , [0,1,2]);
        })->with(['getMfpProcurement' => function($query) use($request,$user_id) {
             //If logged in user is super admin
             if(Auth::user()->role != 1){
                $query->where('assigned_to',$user_id);
                $query->where('created_by','!=',$user_id);
            } 
            $query->where('status','!=',1);
            $query->whereIn('current_status' , [0,1,2]);
             if(isset($request['from_date']) && !empty($request['from_date']))
                {
                    $from_date=Carbon::createFromFormat('d/m/Y', $request['from_date']);
                    $from_date=date('Y-m-d',strtotime($from_date));
                    $query=$query->whereDate('mfp_procurement.created_at','>=', $from_date);
                }
                if(isset($request['to_date']) && !empty($request['to_date']))
                {
                    $to_date=Carbon::createFromFormat('d/m/Y', $request['to_date']);
                    $to_date=date('Y-m-d',strtotime($to_date));
                    $query=$query->whereDate('mfp_procurement.created_at','<=', $to_date);
                }
        }]);
        $query=$query->orderBy($order,$dir);

        if(isset($request['search']['value']) && !empty($request['search']['value']))
        {
            $search = $request['search']['value'];  
            $query->where(DB::raw("CONCAT(`reference_number`)"), 'LIKE', "%".$search."%");       
        }

        if(isset($request['page']) && !empty($request['page']))
        {
            return $query->paginate($limit);    
        }else{
            return $query->count();
        }
    }

    /**
     * Creates a new item in table
     *
     * @param Array $data
     * @return mixed
     */
    public function createItem($data)
    {
        DB::beginTransaction();
        try {
            $mfp_coverage_data = array();
            $user = Auth::user();
            $user_id =$user->id;
            $procurement = new Mfp_procurement();
            if (isset($data['submit_type']) && $data['submit_type'] == 'submit') {
                $is_draft = '0';
                $procurement->is_step1_complete = 1;
            } else {
                $is_draft = '1';
            }

            $proposal_id = $this->getCurrentDateLastProposalId();
            $new_proposal_id = (int)($proposal_id) + 1;

            
            $procurement->ref_id = (string) Str::uuid();
            $procurement->user_id = $user_id;
            $procurement->year_id = $data['year_id'];
            $procurement->status = '0';
            $procurement->submission_status = 0;
            $procurement->is_draft = $is_draft;
            $procurement->created_by = $user_id;
            $procurement->updated_by = $user_id;
            //$procurement->proposal_id = preg_replace("/[^0-9]/", "",  date('d-m-Y')) . $new_proposal_id;

            $procurement->save();
            $user_details=$user->getUserDetails;
            $state_id=$user_details->state;
            $state_id=str_pad($state_id, 2, '0', STR_PAD_LEFT);
            $district_id=$user_details->district;
            $district_id=$user_details->district;
            $district_id=str_pad($district_id, 4, '0', STR_PAD_LEFT);
            $proposal_id=$procurement->id;
            $proposal_id=str_pad($proposal_id, 6, '0', STR_PAD_LEFT);
            $procurement->proposal_id =$state_id.$proposal_id;
            $procurement->save();


            $mfp_coverage_mfp_haat=array();            
            $mfp_coverage_mfp_id=array();
            if (isset($data['mfp_coverage']) && !empty($data['mfp_coverage'])) {
                foreach ($data['mfp_coverage'] as $key => $row) {
                    foreach($row['haat_id'] as $haatRow){
                        $k = $haatRow.$row['mfp_id']; 
                        if(!isset($mfp_coverage_mfp_id[$k])){
                            $mfp_coverage_mfp_id[$k] =  $row['mfp_id'];
                        } else
                        {
                            if ($mfp_coverage_mfp_id[$k] != $row['mfp_id']) {
                                $mfp_coverage_mfp_id[$k] =  $row['mfp_id'];
                            }
                        }                    
                    }
                    // if(!in_array($row['mfp_id'], $mfp_coverage_mfp_id)){
                    //     $mfp_coverage_mfp_id[]=$row['mfp_id'];
                    // }
                    $mfp_coverage = new Mfp_coverage();
                    $mfp_coverage->mfp_procurement_id = $procurement->id;
                    $mfp_coverage->mfp_id = isset($row['mfp_id']) ? $row['mfp_id'] : null;
                    $mfp_coverage->district_id = isset($row['district_id']) ? $row['district_id'] : null;
                    $mfp_coverage->is_draft = $is_draft;
                    $mfp_coverage->created_by = $user_id;
                    $mfp_coverage->updated_by = $user_id;
                    $mfp_coverage->save();

                    $haat_block_data = array();
                    if (isset($row['haat_id']) && !empty($row['haat_id'])) {
                        foreach ($row['haat_id'] as $haat_key => $haat) {
                            
                            $mfp_coverage_mfp_haat[$row['mfp_id']][]=$haat;
                            
                            $mfp_coverage_haat_block = new Mfp_coverage_haat_block();
                            $mfp_coverage_haat_block->mfp_procurement_id = $procurement->id;
                            $mfp_coverage_haat_block->mfp_coverage_id = $mfp_coverage->id;
                            $mfp_coverage_haat_block->haat_id = $haat;
                            $mfp_coverage_haat_block->block_id = isset($row['block_id'][$haat_key]) ? $row['block_id'][$haat_key] : null;
                            $mfp_coverage_haat_block->is_draft = $is_draft;
                            $mfp_coverage_haat_block->created_by = $user_id;
                            $mfp_coverage_haat_block->updated_by = $user_id;
                            $mfp_coverage_haat_block->save();
                        }
                    }
                }
            }

             $mfp_seasonality_mfp_id=array();
            if (isset($data['seasonality']) && !empty($data['seasonality'])) {
                $haat_row=0;
                foreach ($data['seasonality'] as $key => $row) {
                    ++$haat_row;
                    $mfp_seasonality = new Mfp_seasonality();
                    $mfp_seasonality->mfp_procurement_id = $procurement->id;
                    $mfp_seasonality->haat_id = isset($row['haat_id']) ? $row['haat_id'] : null;
                    $mfp_seasonality->is_draft = $is_draft;
                    $mfp_seasonality->created_by = $user_id;
                    $mfp_seasonality->updated_by = $user_id;
                    $mfp_seasonality->save();
                    $mfp_qty_data = array();

                    $mfp_id_arr=array();
                    $commodity_row=0;
                    if (isset($row['mfp_id']) && !empty($row['mfp_id'])) {
                        foreach ($row['mfp_id'] as $mfp_key => $mfp) {
                            $k1 = $row['haat_id'].$mfp;
                            if(!isset($mfp_seasonality_mfp_id[$k1])){
                                $mfp_seasonality_mfp_id[$k1] =  $mfp;
                            } else {
                                if ($mfp_seasonality_mfp_id[$k1] != $mfp) {
                                   $mfp_seasonality_mfp_id[$k] =  $mfp;
                                }
                            }      
                            // if(!in_array($mfp, $mfp_seasonality_mfp_id)){
                            //     $mfp_seasonality_mfp_id[]=$mfp;
                            // }
                            ++$commodity_row;
                            if(isset($mfp_coverage_mfp_haat[$mfp]) && !in_array($row['haat_id'], $mfp_coverage_mfp_haat[$mfp]))
                            {
                                throw new \Exception("Please select same haat and MFP combination as in MFP coverage");   
                            }
                            $mfp_seasonality_commodity = new Mfp_seasonality_commodity();
                            $mfp_seasonality_commodity->mfp_procurement_id = $procurement->id;
                            $mfp_seasonality_commodity->mfp_seasonality_id = $mfp_seasonality->id;
                            $mfp_seasonality_commodity->haat_id = $mfp_seasonality->haat_id;
                            $mfp_seasonality_commodity->mfp_id = $mfp;
                            // if(in_array($mfp, $mfp_id_arr))
                            // {
                            //     throw new \Exception("Please select unique commodity in haat number $haat_row");
                                
                            // }else{
                            //     $mfp_id_arr[]=$mfp;
                            // }
                            $mfp_seasonality_commodity->qty = isset($row['quantity'][$mfp_key]) ? $row['quantity'][$mfp_key] : null;
                            $mfp_seasonality_commodity->value = isset($row['value'][$mfp_key]) ? $row['value'][$mfp_key] : null;
                            $mfp_seasonality_commodity->is_draft = $is_draft;
                            $mfp_seasonality_commodity->created_by = $user_id;
                            $mfp_seasonality_commodity->updated_by = $user_id;
                            $mfp_seasonality_commodity->save();
                            if (isset($row['month'][$mfp_key]) && !empty($row['month'][$mfp_key])) {
                                foreach ($row['month'][$mfp_key] as $key => $month) {
                                    $Mfp_seasonality_commodity_month = new Mfp_seasonality_commodity_month();
                                    $Mfp_seasonality_commodity_month->mfp_procurement_id = $procurement->id;
                                    $Mfp_seasonality_commodity_month->mfp_seasonality_id = $mfp_seasonality->id;
                                    $Mfp_seasonality_commodity_month->mfp_seasonality_commodity_id = $mfp_seasonality_commodity->id;
                                    $Mfp_seasonality_commodity_month->month = $month;
                                    $Mfp_seasonality_commodity_month->is_draft = $is_draft;
                                    $Mfp_seasonality_commodity_month->created_by = $user_id;
                                    $Mfp_seasonality_commodity_month->updated_by = $user_id;
                                    $Mfp_seasonality_commodity_month->save();
                                }
                            }
                        }
                    }
                }
            }
          
            $mfp_diff= array_diff_assoc($mfp_coverage_mfp_id, $mfp_seasonality_mfp_id);

           if (!empty($mfp_diff) && $is_draft==0) {
                foreach ($mfp_diff as $key => $mfp_id) {
                    $haat_id = str_replace($mfp_id,"",$key);
                    $mfp_data=Mfp::where('id',$mfp_id)->first();
                    $haat_data = HaatDetailsMaster::where('id',$haat_id)->first(); 
                    $mfp_name = $mfp_data->getMfpName->title;
                    $haat_name = $haat_data->getHaatBazaar->getPartOne->rpm_name;

                    throw new \Exception("Please select $mfp_name in seasonality for $haat_name");      
                }
           }
            DB::commit();

            return Mfp_procurement::where([
                'id' => $procurement->id
            ])->firstOrFail();
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
    }

    /**
     * Get a single item from database
     *
     * @param number $id
     * @return mixed
     */
    public function getOne($id)
    {
        return Mfp_procurement::where('ref_id', $id)->firstOrFail();
    }

    /**
     * Update one item from database
     *
     * @param number $id
     * @param Array $data
     * @return mixed
     */
    public function updateItem($id, $data)
    {
        DB::beginTransaction();
        try {
            $mfp_coverage_data = array();
            $user_id = Auth::user()->id;
            $procurement = Mfp_procurement::where('ref_id', $data['form_id'])->firstOrFail();
            $this->canUpdateProposal($procurement);
            if (isset($data['submit_type']) && $data['submit_type'] == 'submit') {
                $is_draft = '0';
                $procurement->is_step1_complete = '1';
            } else {
                $is_draft = '1';
            }
           


            $procurement->year_id = $data['year_id'];

            $procurement->is_draft = $is_draft;
            $procurement->updated_by = $user_id;
            $procurement->save();
            $mfp_coverage_mfp_haat=array();
            $mfp_coverage_mfp_id=array();
            if (isset($data['mfp_coverage']) && !empty($data['mfp_coverage'])) {
                foreach ($data['mfp_coverage'] as $key => $row) {
                    foreach($row['haat_id'] as $haatRow){
                        $k = $haatRow.$row['mfp_id']; 
                        if(!isset($mfp_coverage_mfp_id[$k])){
                            $mfp_coverage_mfp_id[$k] =  $row['mfp_id'];
                        } else
                        {
                            if ($mfp_coverage_mfp_id[$k] != $row['mfp_id']) {
                                $mfp_coverage_mfp_id[$k] =  $row['mfp_id'];
                            }
                        }                    
                    }
                    // if(!in_array($row['mfp_id'], $mfp_coverage_mfp_id)){
                    //     $mfp_coverage_mfp_id[]=$row['mfp_id'];
                    // }
                    
                    $mfp_coverage = Mfp_coverage::firstOrNew(array('id' => $row['item_id']));

                    $mfp_coverage->mfp_procurement_id = $procurement->id;
                    $mfp_coverage->mfp_id = isset($row['mfp_id']) ? $row['mfp_id'] : null;
                    $mfp_coverage->district_id = isset($row['district_id']) ? $row['district_id'] : null;
                    $mfp_coverage->is_draft = $is_draft;
                    $mfp_coverage->updated_by = $user_id;
                    $mfp_coverage->save();

                    $haat_block_data = array();
                    if (isset($row['haat_id']) && !empty($row['haat_id'])) {
                        foreach ($row['haat_id'] as $haat_key => $haat) {
                            $mfp_coverage_mfp_haat[$row['mfp_id']][]=$haat;
                            $mfp_coverage_haat_block = Mfp_coverage_haat_block::firstOrNew(array('id' => $row['mfp_coverage_haat_block_id'][$haat_key]));

                            $mfp_coverage_haat_block->mfp_procurement_id = $procurement->id;
                            $mfp_coverage_haat_block->mfp_coverage_id = $mfp_coverage->id;
                            $mfp_coverage_haat_block->haat_id = $haat;
                            $mfp_coverage_haat_block->block_id = isset($row['block_id'][$haat_key]) ? $row['block_id'][$haat_key] : null;
                            $mfp_coverage_haat_block->is_draft = $is_draft;
                            $mfp_coverage_haat_block->created_by = $user_id;
                            $mfp_coverage_haat_block->updated_by = $user_id;
                            $mfp_coverage_haat_block->save();
                        }
                    }
                }
            }
            $mfp_seasonality_mfp_id=array();
            if (isset($data['seasonality']) && !empty($data['seasonality'])) {
                foreach ($data['seasonality'] as $key => $row) {
                    $mfp_seasonality = Mfp_seasonality::firstOrNew(array('id' => $row['item_id']));
                    $mfp_seasonality->mfp_procurement_id = $procurement->id;
                    $mfp_seasonality->haat_id = isset($row['haat_id']) ? $row['haat_id'] : null;
                    $mfp_seasonality->is_draft = $is_draft;
                    $mfp_seasonality->created_by = $user_id;
                    $mfp_seasonality->updated_by = $user_id;
                    $mfp_seasonality->save();
                    $mfp_qty_data = array();
                    if (isset($row['mfp_id']) && !empty($row['mfp_id'])) {
                        foreach ($row['mfp_id'] as $mfp_key => $mfp) {
                            $k1 = $row['haat_id'].$mfp;
                            if(!isset($mfp_seasonality_mfp_id[$k1])){
                                $mfp_seasonality_mfp_id[$k1] =  $mfp;
                            } else {
                                if ($mfp_seasonality_mfp_id[$k1] != $mfp) {
                                   $mfp_seasonality_mfp_id[$k] =  $mfp;
                                }
                            }        
                            // if (!(isset($mfp_seasonality_mfp_id[$k1]) AND $mfp_seasonality_mfp_id[$k1] == $mfp)) {
                            //     $mfp_seasonality_mfp_id[$k1] =  $mfp;
                            // }
                    //            if(!in_array($mfp, $mfp_seasonality_mfp_id)){
                    //     $mfp_seasonality_mfp_id[]=$mfp;
                    // }

                            if(isset($mfp_coverage_mfp_haat[$mfp]) && !in_array($row['haat_id'], $mfp_coverage_mfp_haat[$mfp]))
                            {
                                throw new \Exception("Please select same haat and MFP combination as in MFP coverage ");   
                            }
                            $mfp_seasonality_commodity = Mfp_seasonality_commodity::firstOrNew(array('id' => $row['seasonability_commodity_id'][$mfp_key]));
                            $mfp_seasonality_commodity->mfp_procurement_id = $procurement->id;
                            $mfp_seasonality_commodity->mfp_seasonality_id = $mfp_seasonality->id;
                            $mfp_seasonality_commodity->haat_id = $mfp_seasonality->haat_id;
                            $mfp_seasonality_commodity->mfp_id = $mfp;
                            $mfp_seasonality_commodity->qty = isset($row['quantity'][$mfp_key]) ? $row['quantity'][$mfp_key] : null;
                            $mfp_seasonality_commodity->value = isset($row['value'][$mfp_key]) ? $row['value'][$mfp_key] : null;
                            $mfp_seasonality_commodity->is_draft = $is_draft;
                            $mfp_seasonality_commodity->created_by = $user_id;
                            $mfp_seasonality_commodity->updated_by = $user_id;
                            $mfp_seasonality_commodity->save();
                            if (isset($row['month'][$mfp_key]) && !empty($row['month'][$mfp_key])) {
                                Mfp_seasonality_commodity_month::where('mfp_seasonality_commodity_id', $mfp_seasonality_commodity->id)->delete();
                                foreach ($row['month'][$mfp_key] as $key => $month) {
                                    $Mfp_seasonality_commodity_month = new Mfp_seasonality_commodity_month();
                                    $Mfp_seasonality_commodity_month->mfp_procurement_id = $procurement->id;
                                    $Mfp_seasonality_commodity_month->mfp_seasonality_id = $mfp_seasonality->id;
                                    $Mfp_seasonality_commodity_month->mfp_seasonality_commodity_id = $mfp_seasonality_commodity->id;
                                    $Mfp_seasonality_commodity_month->month = $month;
                                    $Mfp_seasonality_commodity_month->is_draft = $is_draft;
                                    $Mfp_seasonality_commodity_month->created_by = $user_id;
                                    $Mfp_seasonality_commodity_month->updated_by = $user_id;
                                    $Mfp_seasonality_commodity_month->save();
                                }
                            }
                        }
                    }
                }
            }
            // print_r($mfp_coverage_mfp_id);
            // print_r($mfp_seasonality_mfp_id);die;
           $mfp_diff= array_diff_assoc($mfp_coverage_mfp_id, $mfp_seasonality_mfp_id);

           if (!empty($mfp_diff) && $is_draft==0) {
                foreach ($mfp_diff as $key => $mfp_id) {
                    $haat_id = str_replace($mfp_id,"",$key);
                    $mfp_data=Mfp::where('id',$mfp_id)->first();
                    $haat_data = HaatDetailsMaster::where('id',$haat_id)->first(); 
                    $mfp_name = $mfp_data->getMfpName->title;
                    $haat_name = $haat_data->getHaatBazaar->getPartOne->rpm_name;
                    throw new \Exception("Please select $mfp_name in seasonality for $haat_name");      
                }
           }
            DB::commit();

            return Mfp_procurement::where([
                'id' => $procurement->id
            ])->firstOrFail();
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
    }

    /**
     * Delete an item from database
     *
     * @param integer $id
     * @return boolean
     */
    public function deleteItem($id)
    {
        $item = ServiceModel::findOrFail($id);
        $item->deleteDistricts();

        return $item->delete();
    }

    /**
     * Validates for creating a record.
     *
     * @param Array $data
     * @return mixed
     */
    public function validateCreate($data)
    {
        $required = 'nullable';
        if (isset($data['submit_type']) && $data['submit_type'] == 'submit') {
            $required = 'required';
        }
        $messages = $this->validation_messages($data);
        return Validator::make(
            $data,
            [
                'form_id' => 'nullable|exists:mfp_procurement,ref_id',
                'submit_type'=> 'required',
                'year_id' => [
                    'required', 'exists:financial_year_master,id',
                ],
                'mfp_coverage.*.item_id' => [
                    'nullable'
                ],
                'mfp_coverage.*.mfp_id' => [
                    $required, 'exists:mfp_master,id', 'distinct',
                ],
                'mfp_coverage.*.district_id' => [
                    $required, 'exists:mysql2.districts_master,id',
                ],
                'mfp_coverage.*.mfp_coverage_haat_block_id.*' => [
                    'nullable'
                ],
                'mfp_coverage.*.haat_id.*' => [
                    $required, 'exists:haat_bazaar_master,id',new UniqueHaatForMfp($data)
                   
                ],
                'mfp_coverage.*.block_id.*' => [
                    $required, 'exists:mysql2.blocks_master,id',
                    new UniqueHaatBlock($data)
                ],
                'seasonality.*.item_id' => [
                    'nullable'
                ],
                'seasonality.*.haat_id' => [
                    $required, 'exists:haat_bazaar_master,id',
                ],
                'seasonality.*.seasonability_commodity_id.*' => [
                    'nullable'
                ],
                'seasonality.*.mfp_id.*' => [
                    $required, 'exists:mysql2.commodity_master,id',
                ],
                'seasonality.*.month.*.*' => [
                    $required, 'in:1,2,3,4,5,6,7,8,9,10,11,12',
                    new UniqueSeasonalityMonth($data)
                ],
                'seasonality.*.quantity.*' => [
                    $required, 'numeric','decimal_value_qty',
                ],
                'seasonality.*.value.*' => [
                    $required, 'numeric'
                ],



            ],
            $messages
        );
    }

    public function validation_messages($data)
    {
        $i = 0;
        if (!empty($data['mfp_coverage'])) {
            $messages = array();
            foreach ($data['mfp_coverage'] as $key => $row) {
                ++$i;
                $row_message = " in " . $this->ordinal_suffix($i) . " record";
                $messages['mfp_coverage.' . $key . '.mfp_id.required'] = "Please select MFP in MFP coverage $row_message";
                $messages['mfp_coverage.' . $key . '.mfp_id.distinct'] = "Please select unique MFP in MFP coverage $row_message";
                $messages['mfp_coverage.' . $key . '.district_id.required'] = "Please select district in MFP coverage $row_message";
                if (isset($row['haat_id']) && !empty($row['haat_id'])) {
                    foreach ($row['haat_id'] as $haat_key => $haat) {
                        $messages['mfp_coverage.' . $key . '.haat_id.' . $haat_key . '.required'] = "Please select haat in MFP coverage $row_message";
                        $messages['mfp_coverage.' . $key . '.block_id.' . $haat_key . '.required'] = "Please select block in MFP coverage $row_message";
                    }
                }
            }
        }
        $i = 0;
        if (isset($data['seasonality']) && !empty($data['seasonality'])) {
            foreach ($data['seasonality'] as $key => $row) {
                ++$i;
                $row_message = " in " . $this->ordinal_suffix($i) . " record";
                $messages['seasonality.' . $key . '.haat_id.required'] = "Please select Haat in seasonality $row_message";
                if (isset($row['mfp_id']) && !empty($row['mfp_id'])) {
                    foreach ($row['mfp_id'] as $mfp_key => $mfp) {
                        $messages['seasonality.' . $key . '.mfp_id.' . $mfp_key . '.required'] = "Please select commodity in seasonality $row_message";
                        $messages['seasonality.' . $key . '.quantity.' . $mfp_key . '.decimal_value_qty'] = "quantity should not contain more than 9 digits before decimal and more than 4 digits after decimal";
                        
                    }
                }
            }
        }
        return $messages;
    }
    /**
     * Validates for updating a record in databse
     *
     * @param integer $id
     * @param Array $data
     * @return mixed
     */
    public function validateUpdate($id, $data)
    {
        return Validator::make(
            $data,
            [
                'state_id' => [
                    'required', 'exists:mysql2.states_master,id',
                ],
                'mfp_name' => [
                    'required', 'exists:mysql2.commodity_master,id',
                ],
                'botanical_name' => [
                    'required', 'string', 'alpha_spaces',
                ],
                'local_name' => [
                    'required', 'string', 'alpha_spaces',
                ],
                'msp_price' => [
                    'required', 'numeric'
                ],
                'image' => 'nullable|mimes:pdf,jpeg,jpg|max:20480',
            ],
            [
                'image.max' => 'Image size should not be greater than 20 MB',
            ]
        );
    }

    /**
     * Switch the status of the given user id.
     *
     * @param integer $id
     * @return string|integer
     */
    public function switchStatus($id)
    {
        $model = ServiceModel::where([
            'id' => $id
        ])->firstOrFail();
        $model->switchStatus();
        $model->save();
        return $model->status;
    }

    public function deleteMfpCoverage($request)
    {
        DB::beginTransaction();
        try {
            $id = $request['id'];
            $mfp_coverage = Mfp_coverage::findOrFail($id);
            $mfp_id = $mfp_coverage->mfp_id;
            $mfp_coverage->delete();
            Mfp_coverage_haat_block::where('mfp_coverage_id', $id)->delete();
            
                        
            if (!empty($mfp_id)) {
                $mfp_procurement_disposal = Mfp_procurement_disposal::where('mfp_id', $mfp_id)->first();
                if(isset( $mfp_procurement_disposal->id))
                {
                    $mfp_procurement_disposal_id = $mfp_procurement_disposal->id;
                    Mfp_procurement_disposal::where('mfp_id', $mfp_id)->delete();
                    Mfp_procurement_disposal_warehouse::where('mfp_procurement_disposal_id', $mfp_procurement_disposal_id)->delete();
                    Mfp_procurement_disposal_warehouse_months::where('mfp_procurement_disposal_id', $mfp_procurement_disposal_id)->delete();
                }
                
                
                
            }
            //==Add User Activity
            $activity='deleted MFP coverage haat block ';
            $module='mfp_procurement';
            $this->addUserActivity($activity,$module);

            DB::commit();
            return true;
        } catch (\Throwable $th) {
            DB::rollBack();
            return false;
        }
    }
    public function deleteSeasonality($request)
    {
        DB::beginTransaction();
        try {
            $id = $request['id'];
            Mfp_seasonality::where('id', $id)->delete();
            Mfp_seasonality_commodity::where('mfp_seasonality_id', $id)->delete();
            Mfp_seasonality_commodity_month::where('mfp_seasonality_id', $id)->delete();
            //==Add User Activity
            $activity='deleted MFP seasonality and commodity';
            $module='mfp_procurement';
            $this->addUserActivity($activity,$module);
            DB::commit();
            return true;
        } catch (\Throwable $th) {
            DB::rollBack();
            return false;
        }
    }
    public function deleteMfpCoverageBlockHaat($request)
    {
        DB::beginTransaction();
        try {
            $id = $request['id'];
            Mfp_coverage_haat_block::where('id', $id)->delete();
            //==Add User Activity
            $activity='deleted MFP coverage haat block ';
            $module='mfp_procurement';
            $this->addUserActivity($activity,$module);
            DB::commit();
            return true;
        } catch (\Throwable $th) {
            DB::rollBack();
            return false;
        }
    }
    public function deleteCommodityHaat($request)
    {
        DB::beginTransaction();
        try {
            $id = $request['id'];
            Mfp_seasonality_commodity::where('id', $id)->delete();
            Mfp_seasonality_commodity_month::where('mfp_seasonality_commodity_id', $id)->delete();
            //==Add User Activity
            $activity='deleted MFP seasonality commodity ';
            $module='mfp_procurement';
            $this->addUserActivity($activity,$module);
            DB::commit();
            return true;
        } catch (\Throwable $th) {
            DB::rollBack();
            return false;
        }
    }
    public function getSeasionalityQuarterWise($item)
    {
        $data = array();

        $quarter_arr = array(
            1 => 'Quarter 1',
            2 => 'Quarter 1',
            3 => 'Quarter 1',
            4 => 'Quarter 2',
            5 => 'Quarter 2',
            6 => 'Quarter 2',
            7 => 'Quarter 3',
            8 => 'Quarter 3',
            9 => 'Quarter 3',
            10 => 'Quarter 4',
            11 => 'Quarter 4',
            12 => 'Quarter 4',
        );
        $quarter_data = array();
        if (isset($item['mfp_seasonality']) && !empty($item['mfp_seasonality'])) {
            foreach ($item['mfp_seasonality'] as $key => $row) {
                if (isset($row['haat_id']) && !empty($row['haat_id'])) {
                    $haat_id = $row['haat_id'];
                    if (isset($row['haat_data']['get_haat_bazaar_detail']['get_part_one']['rpm_name']) && !empty($row['haat_data']['get_haat_bazaar_detail']['get_part_one']['rpm_name'])) {
                        $haat_name[$haat_id] = $row['haat_data']['get_haat_bazaar_detail']['get_part_one']['rpm_name'];
                        if (isset($row['commodity_data']) && !empty($row['commodity_data'])) {

                            foreach ($row['commodity_data'] as $key => $commodity) {
                                if (isset($commodity['mfp_id']) && !empty($commodity['mfp_id'])) {
                                    $mfp_id = $commodity['mfp_id'];
                                    if (isset($commodity['getMfp']['get_mfp_name']['title']) && !empty($commodity['getMfp']['get_mfp_name']['title'])) {
                                        $mfp_name[$mfp_id] = $commodity['getMfp']['get_mfp_name']['title'];
                                        $qty = $commodity['qty'];
                                        $value = $commodity['value'];
                                        $months = $commodity['month'];
                                        if (!empty($months)) {
                                            $quarter_already=array();
                                            foreach ($months as $key => $month) {
                                                $month_id = $month['month'];
                                                $quarter = $quarter_arr[$month_id];
                                                
                                                if(!in_array($quarter, $quarter_already))
                                                {
                                                    $quarter_already[]=$quarter;
                                                }else{
                                                    continue;
                                                }
                                                if (isset($quarter_data[$haat_id][$mfp_id][$quarter]['qty'])) {

                                                    $quarter_data[$haat_id][$mfp_id][$quarter]['qty'] = $quarter_data[$haat_id][$mfp_id][$quarter]['qty'] + $qty;
                                                } else {
                                                    $quarter_data[$haat_id][$mfp_id][$quarter]['qty'] = $qty;
                                                }
                                                if (isset($quarter_data[$haat_id][$mfp_id][$quarter]['value'])) {

                                                    $quarter_data[$haat_id][$mfp_id][$quarter]['value'] = $quarter_data[$haat_id][$mfp_id][$quarter]['value'] + $value;
                                                } else {
                                                    $quarter_data[$haat_id][$mfp_id][$quarter]['value'] = $value;
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
        $data = array();
        if (!empty($quarter_data)) {
            foreach ($quarter_data as $haat_key => $haat) {


                foreach ($haat as $mfp_key => $mfp) {
                    foreach ($mfp as $quarter_key => $value) {
                        $data[] = array(
                            'haat_id' => $haat_key,
                            'haat_name' => $haat_name[$haat_key],
                            'mfp_id' => $mfp_key,
                            'mfp_name' => $mfp_name[$mfp_key],
                            'quarter' => $quarter_key,
                            'qty' => Helper::decimalNumberFormat($value['qty']),
                            'value' => Helper::decimalNumberFormat($value['value']),
                        );
                    }
                }
            }
        }

        return $data;
    }

    public function getMfpQuarterWiseForSummary($data)
    {
        $finalData = [];
        foreach ($data as $value) {
            if (isset($finalData[$value['quarter']][$value['mfp_id']])) {
                $finalData[$value['quarter']][$value['mfp_id']] += $value['value'];
            } else {
                $finalData[$value['quarter']][$value['mfp_id']] = $value['value'];
            }
        }
        return $finalData;
    }

    public function getCurrentDateLastProposalId()
    {
        $lastProposalID = Mfp_procurement::select("proposal_id")->where('created_at', '>=', date('Y-m-d'))->orderBy('created_at', 'DESC')->first();
        if ($lastProposalID) {
            //echo $lastProposalID;die;
            $lastProposalID = substr($lastProposalID['proposal_id'], 8);
            return $lastProposalID;
        } else {
            return  0;
        }
    }

    public function getAllProposalIDs()
    {
        $item = Mfp_procurement::select("proposal_id")->where('submission_status', 1)->get();
        return $item;
    }

  

    public function approveMfpProcurement($request)
    {
        DB::beginTransaction();       
        try {
            
            $procurement=$this->approveProcurement($request);
            //==Add User Activity
            $procurement= Mfp_procurement::where('ref_id', $request['form_id'])->first();
            $activity='approved MFP procurement proposal id - '.$procurement->proposal_id;
            $module='mfp_procurement_aproval';
            $this->addUserActivity($activity,$module);
            DB::commit();
            return $procurement;
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
    }
    public function approveProcurement($request)
    {
        $user=Auth::user();   
        $user_id=$user->id;
        $current_user_level_id=$user->level_id;
        
        $user_info= User::where([
                    'id' => $user_id
                ])->with([
                    'getUserDetails'
                ])->first();
        $user_data=$user_info->toArray();  
        
        $user_details=$user_data['get_user_details'];
        
        $procurement= Mfp_procurement::where('ref_id', $request['form_id'])->first();
        $dia_user=$procurement->created_by;
        $is_last_level=0;
        //====getLastLeval of scrutiny level====
        if(in_array($user->role, [1,2,3]))//ministry user
        {
            $user_state=$procurement->getUserDetails->getState->id;
        }else{
            $user_state=$user_details['state'];
        }
        //======================================
        if(!empty($procurement))
        {
            //===get last level user id====
            $last_level=StateRoleSubLevel::where('state_id',$user_state)->orderBy('id','desc')->first();
           
            $last_level_user=User::whereHas('getUserDetails', function (Builder $query) use ($last_level,$user) {
                    $query->where('role', $last_level->role_id);
                    if(!in_array($user->role, [1,2,3]))//ministry user
                    {
                        $query->where('state', $last_level->state_id);    
                    }
                    
                    $query->where('level_id', $last_level->sublevel_id);
                    
            })->first();
           
            if(!empty($last_level_user))
            {   
                if($user_id==$last_level_user->id)//last level user
                {
                    $procurement->status=1; 
                    $procurement->approval_date=date('Y-m-d H:i:s'); 
                    $procurement->approved_by=$user_id; 
                }
            }
            //=============================
            $procurement->current_status=1;
            $procurement->save();

            $logs= Mfp_procurement_status_log::where(['mfp_procurement_id'=>$procurement->id,'assigned_to'=>$user_id])->orderBy('id','desc')->first();
            
            $logs->status=1;
            if(!empty($last_level_user))
            {   
                if($user_id==$last_level_user->id)//last level user
                {
                    $logs->is_assigned_next_level='1';
                }else{
                    $logs->is_assigned_next_level='0';
                }
            }else{
                $logs->is_assigned_next_level='0';
            }
            
            $logs->remarks=$request['remarks'];
            $logs->updated_by = $user_id;
            $logs->save();
            if($user->role==6)//DIA
            {
                $proposals['proposals'][]=$request['form_id'];
                //dd($proposals);
                $this->send_mfpprocurement_to_nextlevel($proposals);    
            }
            //===============CALCULATE TOTAL APPROVED AMOUNT===========
            if(!empty($last_level_user))
            {   
                if($user_id==$last_level_user->id)//last level user
                {
                    //Update total approved amount of all proposals
                    $consolidated_id=$procurement->consolidated_id;                                                
                    $total_approved_amount=0;
                    if(!empty($consolidated_id))
                    {
                        $procurements=Mfp_procurement::where(['consolidated_id'=>$consolidated_id,'status'=>1])->get();

                        $procurement_pending=Mfp_procurement::where(['consolidated_id'=>$consolidated_id,'status'=>0])->first();
                        
                        foreach ($procurements as $key => $procurement) {
                            $summary=$procurement->getSummary;
                            $total_approved_amount +=isset($summary->total_fund_require)?$summary->total_fund_require:0;
                        }
                        $consolidation_row=Mfp_procurement_consolidated::findOrFail($consolidated_id);
                        $consolidation_row->approved_amount=$total_approved_amount;
                        $consolidation_row->balance_amount=$total_approved_amount;
                        if(empty($procurement_pending))
                        {
                            $consolidation_row->is_all_approved=1;    
                            $maximum_sanction_percent=75;
                            $mfp_procurement_sanctioned=new Mfp_procurement_sanctioned();
                            $mfp_procurement_sanctioned->consolidated_id=$consolidated_id;
                            $mfp_procurement_sanctioned->assigned_to=$user_id;
                            $mfp_procurement_sanctioned->approved_amount=$total_approved_amount;
                            $mfp_procurement_sanctioned->sanctioned_amount=0;
                            
                            $balance_amount=($total_approved_amount*$maximum_sanction_percent)/100;

                            $mfp_procurement_sanctioned->balance_amount=Helper::decimalNumber($balance_amount);
                            $mfp_procurement_sanctioned->is_sanctioned=0;
                            $mfp_procurement_sanctioned->maximum_sanction_percent=$maximum_sanction_percent;
                            $mfp_procurement_sanctioned->save();

                        }
                        $consolidation_row->save();
                    }
                    //send mail to dia user who filled the procurement form
                    $to = User::findOrFail($dia_user);
                    $from = User::findOrFail($user_id);
                    $to->notify(new MfpProcurementApprove($procurement,$from));
                }
            }
            //=========================================================
        }
        return $procurement;
    }
    public function revertMfpProcurement($request)
    {
        DB::beginTransaction();
        try {
            $procurement=$this->revertProcurement($request);
            //==Add User Activity
            $procurement= Mfp_procurement::where('ref_id', $request['form_id'])->first();
            $activity='Revert MFP procurement proposal id - '.$procurement->proposal_id;
            $module='mfp_procurement_aproval';
            $this->addUserActivity($activity,$module);
            DB::commit();
            return $procurement;
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
    }
    public function revertProcurement($request)
    {
        $user = Auth::user();
        $user_id = $user->id;
        $procurement = Mfp_procurement::where('ref_id', $request['form_id'])->first();
        //echo $procurement->id;die;
        if(!empty($procurement))
        {
            
            $procurement->current_status=2;
            $procurement->consolidated_id=null;
            
            $logs= Mfp_procurement_status_log::where(['mfp_procurement_id'=>$procurement->id,'assigned_to'=>$user_id])->orderBy('id','desc')->first();
            $request_received_from= Mfp_procurement_status_log::where(['mfp_procurement_id'=>$procurement->id])->where('assigned_to','=',$user_id)->where('id','<',$logs->id)->first();  
            if(!empty($request_received_from)){
                $request_received=$request_received_from->toArray();    
                $assigned_by=$request_received['assigned_by'];
                $status_log['assigned_to']=$assigned_by;
                $status_log['assigned_by']=$user_id;
                

            }else{
                $request_received_from= Mfp_procurement_status_log::where(['mfp_procurement_id'=>$procurement->id])->where('assigned_to','=',$user_id)->first();  
                $request_received=$request_received_from->toArray();
                $assigned_by=$request_received['assigned_by'];
                $status_log['assigned_to']=$assigned_by;
                $status_log['assigned_by']=$user_id;
            }
            
            $status_log['mfp_procurement_id']=$procurement->id;
            $status_log['status']=2;
            $status_log['created_by']=$user_id;
            $status_log['updated_by']=$user_id;
            $status_log['consolidated_id']=$procurement->consolidated_id;
            $status_log['consolidated_id']=null;

            $newstatuslog=new Mfp_procurement_status_log($status_log);
            $newstatuslog->save();  //assigned to previous user

            $logs->is_assigned_next_level='1';
            $logs->status='2';
            $logs->remarks=$request['remarks'];
            $logs->save();//updated to new user

            
            $procurement->assigned_to=$status_log['assigned_to'];
            $procurement->assigned_by=$status_log['assigned_by'];
            $procurement->assigned_date=date('Y-m-d H:i:s');

            $procurement_created_by=$procurement->created_by;
            if($status_log['assigned_to']==$procurement_created_by)
            {
                $procurement->submission_status=0;
                $procurement->status=2;         
            }
            
            $procurement->save();

            //===Send Notification========

            $to = User::findOrFail($status_log['assigned_to']);
            $from = User::findOrFail($user_id);
            $to->notify(new MfpProcurementRevertNextLevel($procurement,$from));
        }
        return $procurement;
        
    }
    public function rejectMfpProcurement($request)
    {
        DB::beginTransaction();

        try {
                $procurement=$this->rejectProcurement($request);
                //==Add User Activity
                $procurement= Mfp_procurement::where('ref_id', $request['form_id'])->first();
                $activity='Revert MFP procurement proposal id - '.$procurement->proposal_id;
                $module='mfp_procurement_aproval';
                $this->addUserActivity($activity,$module);

                DB::commit();
                return $procurement;
            
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
    }
    public function rejectProcurement($request)
    {
        $user = Auth::user();
        $user_id = $user->id;
        $procurement = Mfp_procurement::where('ref_id', $request['form_id'])->first();
        $proposal_form_create_by=$procurement->created_by;
        
        if (!empty($procurement)) {
            $procurement->current_status = 3;
            $procurement->status = 3;
            $procurement->consolidated_id=null;
            $procurement->save();

            $logs= Mfp_procurement_status_log::where(['mfp_procurement_id'=>$procurement->id,'assigned_to'=>$user_id])->orderBy('id','desc')->first();
            
            $logs->status=3;
            $logs->is_assigned_next_level='1';
            $logs->remarks=$request['remarks'];
            $logs->updated_by = $user_id;
            $logs->save();


            
            //===Send Notification========

            $to = User::findOrFail($proposal_form_create_by);
            $from = User::findOrFail($user_id);
            $to->notify(new MfpProcurementReject($procurement,$from));
            
        }
        return $procurement;
    }
    public function validateProposalsIds($data){
        return Validator::make($data, [
                'proposals'=>'required|exists:mfp_procurement,ref_id',
            ]
        
        );
    }
    public function validateConsolidateIds($data){
        return Validator::make($data, [
                'consolidated_proposals.*'=>'required|exists:mfp_procurement_consolidation,id',
            ]
        
        );
    }
    public function send_mfpprocurement_to_nextlevel($request)
    {
        $user=Auth::user();   
        $user_id=$user->id;
        $current_user_level_id=$user->level_id;
        
        $user_info= User::where([
                    'id' => $user_id
                ])->with([
                    'getUserDetails'
                ])->first();
        $user_data=$user_info->toArray();  
        $user_details=$user_data['get_user_details'];
        $user_state=$user_details['state'];

        if(isset($request['proposals']) && !empty($request['proposals']))
        {
            DB::beginTransaction();       
            try{
                foreach ($request['proposals'] as $key => $proposal) 
                {
                    $procurement= Mfp_procurement::where('ref_id', $proposal)->first();
                    $logs= Mfp_procurement_status_log::where(['mfp_procurement_id'=>$procurement->id,'assigned_to'=>$user_id])->orderBy('id','desc')->first();
                    $logs->is_assigned_next_level='1';
                    $logs->updated_by = $user_id;
                    $logs->save();  

                    
                    $current_level=StateRoleSubLevel::where(['state_id'=>$user_state,'sublevel_id'=>$current_user_level_id,'role_id'=>$user->role])->first();
                    $next_level=StateRoleSubLevel::where(['state_id'=>$user_state])->where('id','>',$current_level->id)->first();
                    if(!empty($next_level))
                    {
                        $next_user=User::whereHas('getUserDetails', function (Builder $query) use ($next_level) {
                            $query->where('role', $next_level->role_id);
                            if(!in_array($next_level->role_id, [1,2,3]))
                            {
                                $query->where('state', $next_level->state_id);    
                            }
                            $query->where('level_id', $next_level->sublevel_id);
                            
                        })->first();

                        if(!empty($next_user))
                        {
                            
                            $procurement->assigned_by = $user_id;
                            $procurement->assigned_to = $next_user->id;
                            $procurement->assigned_date=date('Y-m-d H:i:s');
                            $procurement->current_status = 0;    
                            $procurement->is_assigned_next_level = '0';    
                            
                            
                            $lookup=[
                                    'mfp_procurement_id'=>$procurement->id,
                                    'assigned_by'=>$user_id,
                                    'assigned_to'=>$next_user->id,
                                    'status'=>0
                                ];
                            $logs= Mfp_procurement_status_log::updateOrCreate(
                                $lookup,
                                [
                                    'mfp_procurement_id'=>$procurement->id,
                                    'assigned_by'=>$user_id,
                                    'assigned_to'=>$next_user->id,

                                    'status'=>0,  
                                    'is_assigned_next_level'=>'0',
                                    'created_by'=>$user_id,
                                    'updated_by'=>$user_id,
                                ]
                            );
                            
                            
                            $procurement->status=0;
                            $procurement->save();
                           

                            //===Send Notification========

                            $to = User::findOrFail($next_user->id);
                            //==Add User Activity
                            $activity='Send proposal to next level user'.$to->user_name.' proposal id - '.$procurement->proposal_id;
                            $module='mfp_procurement_aproval';
                            $this->addUserActivity($activity,$module);


                            $from = User::findOrFail($user_id);
                            $to->notify(new MfpProcurementAssignNextLevel($procurement,$from));
                        }else
                        {
                            throw new \Exception("No user is find in next level of level ".$next_level->level_id);   
                        }
                    }else{
                        throw new \Exception("No scrutiny level defined .Please contact administrator.");   
                    }
                }
                
                DB::commit();
                return $procurement;
            }catch (\Throwable $th) {
                DB::rollBack();
                throw $th;
            }
        }
    }
    public function consolidate_mfpprocurement($request,$state,$year_id)
    {
        $user=Auth::user();   
        $user_id=$user->id;
        $current_user_level_id=$user->level_id;
        
        $user_info= User::where([
                    'id' => $user_id
                ])->with([
                    'getUserDetails'
                ])->first();
        $user_data=$user_info->toArray();  
        $user_details=$user_data['get_user_details'];
        
        
        if(in_array($user->role, [1,2,3]))//ministry user
        {
            $user_state=$state;
        }else{
            $user_state=$user_details['state'];
        }
        if(isset($request['proposals']) && !empty($request['proposals']))
        {
            DB::beginTransaction();       
            try{


                //==============create consolidate===========
                $mfp_procurement_consolidated=new Mfp_procurement_consolidated();
                $mfp_procurement_consolidated->created_by=$user_id;
                $mfp_procurement_consolidated->updated_by=$user_id;
                $mfp_procurement_consolidated->save();
                
                $reference_number=$user_state.'_'.$mfp_procurement_consolidated->id;
                $consolidated=Mfp_procurement_consolidated::findOrFail($mfp_procurement_consolidated->id);
                $consolidated->reference_number=$reference_number;
                $consolidated->state=$state;
                $consolidated->year_id=$year_id;
                $consolidated->save();
                $proposal_ids=[];
                //===========================================
                foreach ($request['proposals'] as $key => $proposal) 
                {
                    $procurement= Mfp_procurement::where('ref_id', $proposal)->first();
                    $proposal_ids[]=$procurement->proposal_id;
                    $logs= Mfp_procurement_status_log::where(['mfp_procurement_id'=>$procurement->id,'assigned_to'=>$user_id])->orderBy('id','desc')->first();
                    $logs->is_assigned_next_level='1';
                    $logs->consolidated_id=$consolidated->id;
                    $logs->updated_by = $user_id;
                    $logs->save();  

                    
                    $current_level=StateRoleSubLevel::where(['state_id'=>$user_state,'sublevel_id'=>$current_user_level_id,'role_id'=>$user->role])->first();
                    $next_level=StateRoleSubLevel::where(['state_id'=>$user_state])->where('id','>',$current_level->id)->first();
                   
                    if(!empty($next_level))
                    {
                        $next_user=User::whereHas('getUserDetails', function (Builder $query) use ($next_level) {
                            $query->where('role', $next_level->role_id);
                            if(!in_array($next_level->role_id, [1,2,3]))
                            {
                                $query->where('state', $next_level->state_id);    
                            }
                            $query->where('level_id', $next_level->sublevel_id);
                            
                        })->first();

                        if(!empty($next_user))
                        {
                            
                            $procurement->assigned_by = $user_id;
                            $procurement->assigned_to = $next_user->id;
                            $procurement->assigned_date=date('Y-m-d H:i:s');
                            $procurement->current_status = 0;    
                            $procurement->is_assigned_next_level = '0';    
                            $procurement->consolidated_id=$consolidated->id;
                            
                            $lookup=[
                                    'mfp_procurement_id'=>$procurement->id,
                                    'assigned_by'=>$user_id,
                                    'assigned_to'=>$next_user->id,
                                    'status'=>0
                                ];
                            $logs= Mfp_procurement_status_log::updateOrCreate(
                                $lookup,
                                [
                                    'mfp_procurement_id'=>$procurement->id,
                                    'consolidated_id'=>$consolidated->id,
                                    'assigned_by'=>$user_id,
                                    'assigned_to'=>$next_user->id,
                                    'status'=>0,  
                                    'is_assigned_next_level'=>'0',
                                    'created_by'=>$user_id,
                                    'updated_by'=>$user_id,
                                ]
                            );
                            
                            
                            $procurement->status=0;
                            $procurement->save();
                           

                           
                        }else
                        {
                            throw new \Exception("No user is find in next level of level ".$next_level->level_id);   
                        }
                    }else{
                        throw new \Exception("No scrutiny level defined .Please contact administrator.");   
                    }
                }
                //==Add User Activity
                $proposal_ids=implode(',', $proposal_ids);
                $activity='Proposal consolidated into '.$consolidated->reference_number.' of proposal ids - '.$proposal_ids;
                $module='mfp_procurement_aproval';
                $this->addUserActivity($activity,$module);
                 //===Send Notification========

                $to = User::findOrFail($next_user->id);
                $from = User::findOrFail($user_id);
                $to->notify(new MfpProcurementConsolidatedNextLevel($consolidated,$from));
                DB::commit();
                return $procurement;
            }catch (\Throwable $th) {
                DB::rollBack();
                throw $th;
            }
        }
    }
    public function consolidate_references($request)
    {
        $user=Auth::user();   
        $user_id=$user->id;
        $current_user_level_id=$user->level_id;
        
        $user_info= User::where([
                    'id' => $user_id
                ])->with([
                    'getUserDetails'
                ])->first();
        $user_data=$user_info->toArray();  
        $user_details=$user_data['get_user_details'];
        
        $user_state=$user_details['state'];
        if(isset($request['consolidated_proposals']) && !empty($request['consolidated_proposals']))
        {
            DB::beginTransaction();       
            try{
                //get first consolidation id and merge all other consolidation into that
                $i=0;
                $merging_consolidation_id= $request['consolidated_proposals'][0];
                $consolidated=Mfp_procurement_consolidated::where('id',$merging_consolidation_id)->first();
                $proposal_ids=array();
                foreach ($request['consolidated_proposals'] as $key => $consolidateId) 
                {
                    ++$i;
                    if($i==1){
                        continue;
                    }
                    $consolidated_procurement= Mfp_procurement::where('consolidated_id', $consolidateId)->get();

                    foreach ($consolidated_procurement as $key => $proc) 
                    {
                        $procurement= Mfp_procurement::where('id', $proc->id)->first();
                        $proposal_ids[]=$procurement->proposal_id;
                        $procurement->consolidated_id=$merging_consolidation_id;
                        $procurement->save();

                        $logs=Mfp_procurement_status_log::where(['mfp_procurement_id'=>$procurement->id,'assigned_to'=>$user_id])->orderBy('id','desc')->first();

                        $logs->consolidated_id=$merging_consolidation_id;

                        $logs->save();
                    }
                }
                //==Add User Activity
                $proposalids=implode(',', $proposal_ids);
                $activity='Proposal consolidated into '.$consolidated->reference_number.' of proposal ids - '.$proposalids;
                $module='mfp_procurement_aproval';
                $this->addUserActivity($activity,$module);
                 //===Send Notification========
                DB::commit();
                return $procurement;
            }catch (\Throwable $th) {
                DB::rollBack();
                throw $th;
            }
        }
    }
    public function getResourceData($item)
    {
        $item = json_encode($item);
        $array =  collect(json_decode($item, true));
        return $array->toArray();
    }

    public function getConsolidatedProposal($id)
    {
        $consolidation=Mfp_procurement_consolidated::where('id',$id)->first();
        //show only those mfps which are pending 
        $procurement = Mfp_procurement::with('getMfpCoverage', 'getMfpSeasonality', 'getMfpDisposal', 'getMfpLabourCharges', 'getMfpWeightmentCharges', 'getMfpTransportationCharges', 'getMfpServiceCharges', 'getMfpWarehouseLabourCharges', 'getMfpWarehouseCharges', 'getEstimatedWastages', 'getMfpOtherCosts', 'getMfpServiceChargesDIA', 'getMfpCollectionLevel','getSummary')->where('consolidated_id', $id)->get();
        $finalData = [];
        $finalData['financial_year_name']=$consolidation->getProposedFinancialYear->title;
        foreach ($procurement as $value) {
            //========================
            $planItem = $this->planService->getAnother($value->ref_id);
            $planItem = MfpPlanDetailViewResource::make($planItem);
            $planItem = $this->getResourceData($planItem);
            //======================================
            $item = $this->getOne($value->ref_id);
            $item = MfpSeasionalityQuarterWiseResource::make($item);
            $item = $this->getResourceData($item);
            $item = $this->getSeasionalityQuarterWise($item);
            $finalData['estimatedQuarterlyRequirement'][]  = $this->getMfpQuarterWiseForSummary($item);
            //==========
            $finalData['financialYear'] = $value->year_id;
            $finalData['getMfpSummary'][] =  $value->getSummary;
            $finalData['mfp_coverage'][] =  MfpCoverageResource::collection($value->getMfpCoverage);
            $finalData['CostOfPackagingMaterial'][] =  MfpCollectionLevelResource::collection($value->getMfpCollectionLevel);
            $finalData['getMfpCommodity'][] =  $planItem;
            $finalData['getMfpLabourCharges'][] = MfpProcurementLabourChargesResource::collection($value->getMfpLabourCharges);
            $finalData['getMfpWeightmentCharges'][] = MfpProcurementWeightmentChargesResource::collection($value->getMfpWeightmentCharges);
            $finalData['getMfpTransportationCharges'][] = MfpProcurementTransportationChargesResource::collection($value->getMfpTransportationCharges);
            $finalData['getMfpServiceCharges'][] = MfpProcurementServiceChargesResource::collection($value->getMfpServiceCharges);
            $finalData['getMfpWarhouseLabourCharges'][] = MfpProcurementWarehouseLabourResource::collection($value->getMfpWarehouseLabourCharges);
            $finalData['getMfpWarhouseCharges'][] = MfpProcurementWarehouseChargesResource::collection($value->getMfpWarehouseCharges);
            $finalData['getMfpEstimatedWastages'][] = MfpProcurementEstimatedWastagesResource::collection($value->getEstimatedWastages);
            $finalData['getMfpOtherCosts'][] = MfpProcurementOtherCostsResource::collection($value->getMfpOtherCosts);
            $finalData['getMfpServiceChargesDIA'][] = MfpProcurementServiceChargesDiaResource::collection($value->getMfpServiceChargesDIA);
        }
      
        $finalData = $this->create_consolidated_array($finalData, 'mfp_coverage','current_year_estimated_value');
        $finalData['QuarterData'] = $this->buildQuarterlyConsolidatedMfpData($finalData['estimatedQuarterlyRequirement']);
        $finalData['commodityData'] = $this->buildCommodityMfpData($finalData['getMfpCommodity']);
        $finalData['estimatedProurement'] = $this->buildCommodityMfpData($finalData['getMfpCommodity'],true);
        $finalData =  $this->create_consolidated_array($finalData, 'CostOfPackagingMaterial', 'total_cost_of_packaging_material');
        $finalData = $this->create_consolidated_array($finalData, 'getMfpLabourCharges', 'total_estimated_cost');
        $finalData = $this->create_consolidated_array($finalData, 'getMfpWeightmentCharges', 'total_estimated_cost');
        $finalData = $this->create_consolidated_array($finalData, 'getMfpTransportationCharges', 'estimated_total_cost_of_transportation');
        $finalData = $this->create_consolidated_array($finalData, 'getMfpServiceCharges', 'service_charge_in_total_value_of_procurement');
        $finalData = $this->create_consolidated_array($finalData, 'getMfpWarhouseLabourCharges', 'total_estimated_cost');
        $finalData = $this->create_consolidated_array($finalData, 'getMfpWarhouseCharges', 'total_estimated_cost');
        $finalData = $this->create_consolidated_array($finalData, 'getMfpEstimatedWastages', 'estimated_driage_rs');
        $finalData = $this->create_consolidated_array($finalData, 'getMfpOtherCosts', 'other_costs');
        $finalData = $this->create_consolidated_array($finalData, 'getMfpServiceChargesDIA', 'service_charge_value');

        return $finalData;

        // return $procurement;

    }

    public function create_consolidated_array($finalData,  $section_name, $propertyName = '')
    {
        foreach ($finalData[$section_name] as $mfp_coverage) {
            foreach ($mfp_coverage as $mfp_coverage_value) {
                if ($propertyName == '') {
                    $arr1[] =  $mfp_coverage_value;
                } else {
                    $mfp_id = isset($mfp_coverage_value->mfp_id) ? $mfp_coverage_value->mfp_id : (isset($mfp_coverage_value->mfp) ? $mfp_coverage_value->mfp : $mfp_coverage_value->commodity_id);
                    if (isset($arr1[$mfp_id])) {
                        $arr1[$mfp_id][$propertyName] +=  $mfp_coverage_value[$propertyName];
                    } else {
                        $arr1[$mfp_id] =  $mfp_coverage_value;
                    }
                }
            }
        }
        $finalData[$section_name] = $arr1;
        return $finalData;
    }

    public function buildQuarterlyConsolidatedMfpData($quarterlyData)
    {
        $finalData = [];
        foreach ($quarterlyData as $quarterRow) {
            foreach ($quarterRow as $k => $quarterRowValue) {
                if (isset($finalData[$k])) {
                    foreach ($quarterRowValue as $k1 => $quarterMfpValue) {
                        if (isset($finalData[$k][$k1])) {
                            $finalData[$k][$k1] += $quarterMfpValue;
                        } else {
                            $finalData[$k][$k1] = $quarterMfpValue;
                        }
                    }
                } else {
                    $finalData[$k] = $quarterRowValue;
                }
            }
        }

        return $finalData;
    }

    public function buildCommodityMfpData($commodityData,$flag=false){
        //print_r($commodityData);die;
        $finalData = [];
        foreach ($commodityData as $commodityRow) {
            foreach ($commodityRow['mfp_commodity'] as $commodityRowValue) {
                if($flag){
                    $key = $commodityRowValue['commodity_id'];
                }else{
                    $key = $commodityRowValue['commodity_id'].$commodityRowValue['haat'].$commodityRowValue['blocks'];
                }
               
                if (isset($finalData[$key])) {
                    $finalData[$key]['currentqty']+=$commodityRowValue['currentqty'];
                    $finalData[$key]['currentval']+=$commodityRowValue['currentval'];
                    $finalData[$key]['lastqty']+=!empty($commodityRowValue['lastqty'])?$commodityRowValue['lastqty']:0;
                    $finalData[$key]['lastval']+=!empty($commodityRowValue['lastval'])?$commodityRowValue['lastval']:0;
                } else {
                    $finalData[$key]=$commodityRowValue;
                }
                //$finalData[$commodityRowValue['commodity_id']] = $commodityRowValue;
            }
         }
		
        return $finalData;

    }

    function send_consolidated_next_level($request)
    {
         DB::beginTransaction();  
         $next_user=$this->send_consolidated_to_next_level($request);
         $this->SendNotificationAssignNextLevel($next_user,$request);         
         DB::commit();  
    }
    public function send_consolidated_to_next_level($request)
    {
        $user=Auth::user();   
        $user_id=$user->id;
        $current_user_level_id=$user->level_id;
        
        $user_info= User::where([
                    'id' => $user_id
                ])->with([
                    'getUserDetails'
                ])->first();
        $user_data=$user_info->toArray();  
        $user_details=$user_data['get_user_details'];
        $user_state=$user_details['state'];
        
        $query=Mfp_procurement_consolidated::where('id',$request['consolidated_id'])
        ->whereHas('getMfpProcurement', function (Builder $query) use ($request,$user_id) {
            $query->where('assigned_to',$user_id);
            $query->where('current_status',1);
            $query->where('status',0);
        })
        //->with('getMfpProcurement')
        ->with(['getMfpProcurement' => function($query) use($user_id) {
            $query->where('assigned_to',$user_id);
            $query->where('current_status',1);
            $query->where('status',0);
        }])
        ->first();
            
        

        
        if(isset($query->getMfpProcurement) && !empty($query->getMfpProcurement))
        {
            if(in_array($user->role, [1,2,3]))//in case of ministry,there is not any state,so state will be fetch from consolidated id
            {
                $user_state=   $query->state;      
            }
              
            try{
                foreach ($query->getMfpProcurement as $key => $proposal) 
                {
                    $procurement= Mfp_procurement::where('ref_id', $proposal->ref_id)->first();
                    $logs= Mfp_procurement_status_log::where(['mfp_procurement_id'=>$procurement->id,'assigned_to'=>$user_id])->orderBy('id','desc')->first();
                    $logs->is_assigned_next_level='1';
                    $logs->updated_by = $user_id;
                    $logs->save();  


                    
                    $current_level=StateRoleSubLevel::where(['state_id'=>$user_state,'sublevel_id'=>$current_user_level_id,'role_id'=>$user->role])->first();
                    $next_level=StateRoleSubLevel::where(['state_id'=>$user_state])->where('id','>',$current_level->id)->first();
                    
                    if(!empty($next_level))
                    {
                        $next_user=User::whereHas('getUserDetails', function (Builder $query) use ($next_level) {
                            $query->where('role', $next_level->role_id);
                            if(!in_array($next_level->role_id, [1,2,3]))
                            {
                                $query->where('state', $next_level->state_id);    
                            }
                            $query->where('level_id', $next_level->sublevel_id);
                            
                        })->first();

                        if(!empty($next_user))
                        {
                            
                            $procurement->assigned_by = $user_id;
                            $procurement->assigned_to = $next_user->id;
                            $procurement->current_status = 0;    
                            $procurement->is_assigned_next_level = '0';    
                            
                            
                            $lookup=[
                                    'mfp_procurement_id'=>$procurement->id,
                                    'assigned_by'=>$user_id,
                                    'assigned_to'=>$next_user->id,
                                    'status'=>0
                                ];
                            $logs= Mfp_procurement_status_log::updateOrCreate(
                                $lookup,
                                [
                                    'mfp_procurement_id'=>$procurement->id,
                                    'consolidated_id'=>$procurement->consolidated_id,
                                    'assigned_by'=>$user_id,
                                    'assigned_to'=>$next_user->id,
                                    'status'=>0,  
                                    'is_assigned_next_level'=>'0',
                                    'created_by'=>$user_id,
                                    'updated_by'=>$user_id,
                                ]
                            );
                            
                            $procurement->assigned_date=date('Y-m-d H:i:s');
                            $procurement->status=0;
                            $procurement->save();
                           
                            //==Add User Activity
                            $activity='Proposal id '.$procurement->proposal_id.' assigned to '.$next_user->user_name;
                            $module='mfp_procurement_aproval';
                            $this->addUserActivity($activity,$module);
                            //===Send Notification========

                            //$to = User::findOrFail($next_user->id);
                            //$from = User::findOrFail($user_id);
                            //$to->notify(new MfpProcurementAssignNextLevel($procurement,$from));
                        }else
                        {
                            throw new \Exception("No user is find in next level of level ".$next_level->level_id);   
                        }
                    }else{
                        throw new \Exception("No scrutiny level defined .Please contact administrator.");   
                    }
                }

                
                return $next_user;
            }catch (\Throwable $th) {
                DB::rollBack();
                throw $th;
            }
        }        
        
    }

    public function SendNotificationAssignNextLevel($next_user,$request)
    {
        $user=Auth::user();   
        $user_id=$user->id;
        if(!empty($next_user))
        {
            $consolidation=Mfp_procurement_consolidated::where('id',$request['consolidated_id'])->first();
            $to = User::findOrFail($next_user->id);
            $from = User::findOrFail($user_id);
            $to->notify(new MfpProcurementConsolidationAssignNextLevel($consolidation,$from));    
        }
        
    }

    public function verifyConsolidatdMfpProcurement($data)
    {
       
        if($data){
            $user = Auth::user();
            $user_id = $user->id;
           
            //perform action on only pending request
            $procurement = Mfp_procurement::where(['consolidated_id'=> $data['consolidated_id'],   'assigned_to' => $user_id,
             'current_status' => 0])
             ->get()->toArray();
            DB::beginTransaction();
            try {
                $proposal_ids=array();
                if (!empty($procurement)) {
                    
                    foreach ($procurement as $key => $procurementRow)
                    {
                    $proposal_id=$procurementRow['proposal_id'];
                    $proposal_ids[]=$proposal_id;
                     $procurementRow['form_id'] = $procurementRow['ref_id'];
                     $procurementRow['remarks'] = $data['remarks'];
                      //dd($procurementRow);
                     if($data['request_type']=="1"){
                        $action='Approved';
                        $this->approveProcurement($procurementRow);
                        $consolidated_data['consolidated_id']=$data['consolidated_id'];
                       // $this->send_consolidated_to_next_level($consolidated_data);
                     }
                     if($data['request_type']=="2"){
                        $action='Revert';
                        $this->revertProcurement($procurementRow);
                     }
                     if($data['request_type']=="3"){
                        $action='Reject';
                        $this->rejectProcurement($procurementRow);
                     }
                     
                   }
                   if($data['request_type']=="1"){
                        $next_user=$this->send_consolidated_to_next_level($data);
                        $this->SendNotificationAssignNextLevel($next_user,$data);         
                    }

                   //==Add User Activity
                    $proposalids=implode(',', $proposal_ids);
                    $activity="$action MFP procurement proposal ids - ".$proposalids;
                    $module='mfp_procurement_aproval';
                    $this->addUserActivity($activity,$module); 
                    DB::commit();
                    return $procurement;
                }
            } catch (\Throwable $th) {
                DB::rollBack();
                throw $th;
            }
            
        }


    }


    public function getProposalMfpList($request){
        $columns = array(
            0 => 'id',
            1 => 'mfp_name',
            2 => 'qty',
            3 => 'value'
        );
        $limit = isset($request['length']) ? $request['length'] : 10;
        $order = isset($columns[$request['order'][0]['column']]) ? $columns[$request['order'][0]['column']] : 'id';
        $dir = isset($request['order'][0]['dir']) ? $request['order'][0]['dir'] : 'DESC';
        $procurement = Mfp_procurement::where('ref_id',$request['id'])->first();
        $query = Mfp_procurement_commodity::where('mfp_procurement_id',$procurement->id);
        
        $query = $query->orderBy($order, $dir);
        $query = $query->limit($limit);
        return $query->paginate();
        
    }

    public function proposal_status_logs($id)
    {
        $procurement = Mfp_procurement::where('id',$id)->first();
        return $procurement;
    }    
    /**
     * Get all getProposalReverted items from database which were reverted by current user
     *
     * @return mixed
     */
    public function getProposalReverted($request)
    {
        $user_id = Auth::user()->id;
        $columns = array(
            0 => 'mfp_procurement.id',
            1 => 'mfp_procurement.id',
            2 => 'mfp_procurement.proposal_id',
        );
        $limit = isset($request['length']) ? $request['length'] : 10;
        //DB::connection()->enableQueryLog();
        $order = isset($columns[$request['order'][0]['column']]) ? $columns[$request['order'][0]['column']] : 'id';
        $dir = isset($request['order'][0]['dir']) ? $request['order'][0]['dir'] : 'DESC';
      
        $query = Mfp_procurement::whereHas('getProposedStatusLogs',function(Builder $query) use ($user_id,$request){
           
            if(Auth::user()->role != 1){
                $query->where('mfp_procurement_status_log.assigned_to', $user_id);
            }
            $query->where('mfp_procurement_status_log.status', 2);
             if(isset($request['from_date']) && !empty($request['from_date']))
            {
                $from_date=Carbon::createFromFormat('d/m/Y', $request['from_date']);
                $from_date=date('Y-m-d',strtotime($from_date));
                $query=$query->whereDate('mfp_procurement_status_log.updated_at','>=', $from_date);
            }
            if(isset($request['to_date']) && !empty($request['to_date']))
            {
                $to_date=Carbon::createFromFormat('d/m/Y', $request['to_date']);
                $to_date=date('Y-m-d',strtotime($to_date));
                $query=$query->whereDate('mfp_procurement_status_log.updated_at','<=', $to_date);
            }
        });
        
        $query=$query->orderBy($order,$dir);
        
        $query = $query->whereHas('getUserDetails', function (Builder $query) use ($request) {

            if (isset($request['district_id']) && !empty($request['district_id'])) {
                $query->where('district', $request['district_id']);
            }
            if (isset($request['block_id']) && !empty($request['block_id'])) {
                $query->where('block', $request['block_id']);
            }
        });

        if (isset($request['status']) && !empty($request['status'])) {
            $query->where('status', $request['status']);
        }

        if (isset($request['search']['value']) && !empty($request['search']['value'])) {
            $search = $request['search']['value'];
            $query->where(DB::raw("CONCAT(`proposal_id`)"), 'LIKE', "%".$search."%");
        }

        if (isset($request['page']) && !empty($request['page'])) {
            return $query->paginate($limit);
        } else {
            return $query->count();
        }
    }
    /**
     * Get all getProposalReverted items from database which were reverted by current user
     *
     * @return mixed
     */
    public function getProposalRejected($request)
    {
        $user_id = Auth::user()->id;
        $columns = array(
            0 => 'id',
            1 => 'id',
            2 => 'proposal_id',
        );
        $limit = isset($request['length']) ? $request['length'] : 10;

        $order = isset($columns[$request['order'][0]['column']]) ? $columns[$request['order'][0]['column']] : 'id';
        $dir = isset($request['order'][0]['dir']) ? $request['order'][0]['dir'] : 'DESC';
      
        $query = Mfp_procurement::where('status',3)->whereHas('getProposedStatusLogs',function(Builder $query) use ($user_id,$request){
           
            if(Auth::user()->role != 1){
                $query->where('assigned_to', $user_id);
            }
            $query->where('status', 3);
             if(isset($request['from_date']) && !empty($request['from_date']))
            {
                $from_date=Carbon::createFromFormat('d/m/Y', $request['from_date']);
                $from_date=date('Y-m-d',strtotime($from_date));
                $query=$query->whereDate('mfp_procurement_status_log.updated_at','>=', $from_date);
            }
            if(isset($request['to_date']) && !empty($request['to_date']))
            {
                $to_date=Carbon::createFromFormat('d/m/Y', $request['to_date']);
                $to_date=date('Y-m-d',strtotime($to_date));
                $query=$query->whereDate('mfp_procurement_status_log.updated_at','<=', $to_date);
            }
        });
        
        $query=$query->orderBy($order,$dir);
        
        $query = $query->whereHas('getUserDetails', function (Builder $query) use ($request) {

            if (isset($request['district_id']) && !empty($request['district_id'])) {
                $query->where('district', $request['district_id']);
            }
            if (isset($request['block_id']) && !empty($request['block_id'])) {
                $query->where('block', $request['block_id']);
            }
        });

        if (isset($request['status']) && !empty($request['status'])) {
            $query->where('status', $request['status']);
        }

        if (isset($request['search']['value']) && !empty($request['search']['value'])) {
            $search = $request['search']['value'];
            $query->where(DB::raw("CONCAT(`proposal_id`)"), 'LIKE', "%".$search."%");
        }

        if (isset($request['page']) && !empty($request['page'])) {
            return $query->paginate($limit);
        } else {
            return $query->count();
        }
    }

     public function validateAddMfp($data){
       
        return Validator::make(
            $data,
            [
                'mfp' => [
                    'required', 'exists:mfp_master,id'
                ],
                'year' => [ 'required', new UniqueMfpYear($data)],
                'procurement_qty' => ['required'],
                'procurement_value' => [ 'required'],
                'disposal_qty' => [ 'required', ],
                'disposal_value' => [ 'required',],
                'losses_qty' => ['required'],
                'losses_value' => [ 'required'],
          
            ],
            [
                'mfp.required' => 'Please provide MFP name',
                'year.required' => 'Please provide year',
                'procurement_qty.required' => 'Please provide procurement quantity',
                'procurement_value.required' => 'Please provide procurement value',
                'disposal_qty.required'=> 'Please provide disposal quantity',
                'disposal_value.required'=> 'Please provide disposal value',
                'losses_qty.required'=>'Please provide losses qunatity',
                'losses_value.required'=>'Please provide losses value'           
            ]
        );
    }

    public function createMfp($data){
        DB::beginTransaction();
        try {
            $user_id = Auth::user()->id;
            $procurement_mfp = new Mfp_procurement_nodal();
            $procurement_mfp->mfp = $data['mfp'];
            $procurement_mfp->year = $data['year'];
            $procurement_mfp->procurement_qty = $data['procurement_qty'];
            $procurement_mfp->procurement_value = $data['procurement_value'];
            $procurement_mfp->disposal_qty = $data['disposal_qty'];
            $procurement_mfp->disposal_value = $data['disposal_value'];
            $procurement_mfp->losses_qty = $data['losses_qty'];
            $procurement_mfp->losses_value = $data['losses_value'];
            $procurement_mfp->created_by = $user_id;
            $procurement_mfp->updated_by = $user_id;
            $procurement_mfp->save();
            //==Add User Activity
            $activity='Created Mfp';
            $module='mfp_procurement';
            $this->addUserActivity($activity,$module);
            DB::commit();

            return Mfp_procurement_nodal::where([
                'id' => $procurement_mfp->id
            ])->firstOrFail();
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
    }

    public function get_mfp_details($request,$queryParams){
        
        $where = [];
        if($request){
            if (isset($request['mfp']) && !empty($request['mfp'])) {
               $where['mfp'] = $request['mfp'];
            }

           
          
       }      
        $user = Auth::user();
        //DB::enableQueryLog();
      
        $paginateAmount = 5;

        if (isset($queryParams['per_page'])) {
            $paginateAmount = $queryParams['per_page'];
        }
        if (isset($request['id']) && !empty($request['id'])) {
            $mfps= Mfp_procurement::with('getMfpCoverage')->where('ref_id',$request['id'])->first();

            $item = json_encode($mfps);
            $array =  collect(json_decode($item, true));
            $item = $array->toArray();
			if(isset($item['get_mfp_coverage']))
			{
				foreach($item['get_mfp_coverage'] as $row){
					$proposal_mfps[]=$row['mfp_id'];
				}
			}
            
        }
       

        //dd($proposal_mfps);
        $query = Mfp_procurement_nodal::with('getMfpName.getMfpName','getCreatedUserName','getCreatedUserState.getState');
        
         if(isset($request['state']) && !empty($request['state'])){
            $query = $query->whereHas('getUserDetails', function (Builder $query) use ($request) {
                $query->where('state', $request['state']);
            });
       
        }
        
        $query = $query->where($where);

        if (isset($request['id']) && !empty($request['id']) && isset($proposal_mfps)) {
            $query = $query->whereIn('mfp',$proposal_mfps);
        }

        if($user->role !=1 && $user->role !=2 && $user->role != 3){
            $query = $query->where('created_by',$user->id);
            $query = $query->where('year','>=', DB::raw('YEAR(DATE_SUB(NOW(), INTERVAL 5 YEAR))'));       
        }
       
        $data = $query->groupBy('mfp')
                      ->paginate($paginateAmount);
                     
        return  $data;
     
     
    }

    public function get_proposal_mfp_details($request,$id,$queryParams){
        
        $where = [];
        if($request){
            if (isset($request['mfp']) && !empty($request['mfp'])) {
               $where['mfp'] = $request['mfp'];
            }
          
       }      
        $user = Auth::user();
        DB::enableQueryLog();
      
        $paginateAmount = 5;

        if (isset($queryParams['per_page'])) {
            $paginateAmount = $queryParams['per_page'];
        }
        
        $query = Mfp_procurement_nodal::with('getMfpName','getCreatedUserName','getCreatedUserState');
         if(isset($request['state']) && !empty($request['state'])){
            $query = $query->whereHas('getUserDetails', function (Builder $query) use ($request) {
                $query->where('state', $request['state']);
            });
        }
        $query = $query->where($where);

        if($user->role !=1 && $user->role !=2 && $user->role != 3){
            $query = $query->where('created_by',$user->id);
        }
       
        $data = $query->groupBy('mfp')
                      ->paginate($paginateAmount);
                      //dd($data);
                      //dd(DB::getQueryLog());
        return  $data;
     
     
    }



   
    

    /**
     * Get all items from database
     *
     * @return mixed
     */
    public function getApprovedConsolidatedProposals($request)
    {
        $user=Auth::user();   
        $user_id=$user->id;
        $user_role=$user->role;
        $columns = array( 
                    0 =>'mfp_procurement_sanction.id', 
                    1=> 'mfp_procurement_sanction.id',
                    2=> 'mfp_procurement_sanction.id',
            );
        $limit = isset($request['length'])?$request['length']:10;
        
        $order = isset($columns[$request['order'][0]['column']])?$columns[$request['order'][0]['column']]:'id';
        $dir = isset($request['order'][0]['dir'])?$request['order'][0]['dir']:'DESC';
        $where=array();
        $query =$this->mfpProcurementSanctionedQuery->viewAllQuery($request);
        
        /*$query = Mfp_procurement_sanctioned::join('mfp_procurement_consolidation', function($join) {
                  $join->on('mfp_procurement_sanction.consolidated_id', '=', 'mfp_procurement_consolidation.id');
                })*/
        $query =$query->where($where)->whereHas('getConsolidation', function (Builder $query) use ($request) {
            if(isset($request['state']) && $request['state']!='')
            {
                $query->where('state', $request['state']);
               
            }
        });
       
        $query=$query->orderBy($order,$dir);

        if(isset($request['search']['value']) && !empty($request['search']['value']))
        {
            $search = $request['search']['value'];  
            $query=$query->where(DB::raw("CONCAT(reference_number)"), 'LIKE', "%".$search."%");       
        }
        $query=$query->select('mfp_procurement_sanction.*');
        if(isset($request['page']) && !empty($request['page']))
        {//echo $query->toSql();die;
            return  $query->paginate($limit);    

        }else{
            return $query->get();
        }
    }

    public function mfp_year_data(){
        $user = Auth::user();
        //DB::enableQueryLog();
      
        $query = Mfp_procurement_nodal::with('getMfpName')
                                       ->where('year','>=', DB::raw('YEAR(DATE_SUB(NOW(), INTERVAL 5 YEAR))'))
                                       ->where('year','!=', DB::raw('YEAR(NOW())'));
        if($user->role !=1 && $user->role !=2 && $user->role != 3){
                $query = $query->where('created_by',$user->id);
        }                               
                                    
        $data = $query->get();

        //dd(DB::getQueryLog());
        return $data;
    }

    public function getSeasonalityCommodityDetails($item)
    {
        $mfp_data=array();
        if (isset($item['mfp_seasonality']) && !empty($item['mfp_seasonality'])) {
            foreach ($item['mfp_seasonality'] as $key => $row) {
                if (isset($row['commodity_data']) && !empty($row['commodity_data'])) {

                    foreach ($row['commodity_data'] as $key => $commodity) {
                        if (isset($commodity['mfp_id']) && !empty($commodity['mfp_id'])) {
                            $mfp_id = $commodity['mfp_id'];
                            if (isset($commodity['getMfp']['get_mfp_name']['title']) && !empty($commodity['getMfp']['get_mfp_name']['title'])) 
                            {
                                $mfp_id=$commodity['mfp_id'];
                                if(isset($mfp_data[$mfp_id])){
                                    $qty=$mfp_data[$mfp_id]['qty']+$commodity['qty'];    
                                }else{
                                    $qty=$commodity['qty'];   
                                }
                                $getMasterValue=Mfp::findOrFail($mfp_id);
                                $mfp_data[$mfp_id]=array(
                                        'mfp_id'=>$commodity['mfp_id'],
                                        'mfp_name'=>$commodity['getMfp']['get_mfp_name']['title'],
                                        'qty'=>$qty,
                                        'master_value'=>$getMasterValue->msp_price,
                                    );   
                            }
                        }
                    }          
                }
            }
        }
        
        return array_values($mfp_data);
        
    }

    public function getMfpValue($mfp_id)
    {
        $msp_price = Mfp::where('id', $mfp_id)->first()->msp_price;
       
        //price for MT
        $data['value'] = ($msp_price*1000); 
        return $data;
    }

    public function getMinScrutinyLevel()
    {
        $user = Auth::user();
        $user_id = $user->id;
        $user_info = User::where([
            'id' => $user_id
        ])->with([
            'getUserDetails'
        ])->first();
        $user_data = $user_info->toArray();
        $user_details = $user_data['get_user_details'];
        $user_state = $user_details['state'];

        //=== Find next level of logged in user state ===========================
        $next_level = StateRoleSubLevel::where('state_id', $user_state)->first();
        return $next_level;
    }
    public function mfpProcurementCheckLastLevelUser($id)
    {
        $user=Auth::user();   
        $user_id=$user->id;
        $current_user_level_id=$user->level_id;
        
        $user_info= User::where([
                    'id' => $user_id
                ])->with([
                    'getUserDetails'
                ])->first();
        $user_data=$user_info->toArray();  
        
        $user_details=$user_data['get_user_details'];
        
        $procurement= Mfp_procurement::where('ref_id', $id)->first();
        $dia_user=$procurement->created_by;
        $is_last_level=0;
        //====getLastLeval of scrutiny level====
        if(in_array($user->role, [1,2,3]))//ministry user
        {
            $user_state=$procurement->getUserDetails->getState->id;
        }else{
            $user_state=$user_details['state'];
        }
        //======================================
        if(!empty($procurement))
        {
            //===get last level user id====
            $last_level=StateRoleSubLevel::where('state_id',$user_state)->orderBy('id','desc')->first();
           
            $last_level_user=User::whereHas('getUserDetails', function (Builder $query) use ($last_level,$user) {
                    $query->where('role', $last_level->role_id);
                    if(!in_array($user->role, [1,2,3]))//ministry user
                    {
                        $query->where('state', $last_level->state_id);    
                    }
                    $query->where('level_id', $last_level->sublevel_id);
            })->first();
           
            if(!empty($last_level_user))
            {   
                if($user_id==$last_level_user->id)//last level user
                {
                    $is_last_level=1; 
                }
            }
            //=============================
            
        }
        return ['is_last_level'=>$is_last_level];
    }
    public function  mfpProcurementCheckConsolidatedLastLevelUser($id)
    {

        $user=Auth::user();   
        $user_id=$user->id;
        $current_user_level_id=$user->level_id;
        
        $user_info= User::where([
                    'id' => $user_id
                ])->with([
                    'getUserDetails'
                ])->first();
        $user_data=$user_info->toArray();  
        
        $user_details=$user_data['get_user_details'];
        
        $procurement = Mfp_procurement_consolidated::where(['id'=> $id])->first();
        
        $is_last_level=0;
        //====getLastLeval of scrutiny level====
        if(in_array($user->role, [1,2,3]))//ministry user
        {
            $user_state=$procurement->state;
        }else{
            $user_state=$user_details['state'];
        }
        //======================================
        if(!empty($procurement))
        {
            //===get last level user id====
            $last_level=StateRoleSubLevel::where('state_id',$user_state)->orderBy('id','desc')->first();
           
            $last_level_user=User::whereHas('getUserDetails', function (Builder $query) use ($last_level,$user) {
                    $query->where('role', $last_level->role_id);
                    if(!in_array($user->role, [1,2,3]))//ministry user
                    {
                        $query->where('state', $last_level->state_id);    
                    }
                    $query->where('level_id', $last_level->sublevel_id);
            })->first();
           
            if(!empty($last_level_user))
            {   
                if($user_id==$last_level_user->id)//last level user
                {
                    $is_last_level=1; 
                }
            }
            //=============================
            
        }
        return ['is_last_level'=>$is_last_level];
    }

    public function getConsolidatedProposalsList($request)
    {
        $user_id=Auth::user()->id;   
        $columns = array( 
                    0 =>'id', 
                    1=> 'id',
                    2=> 'id',
            );
        $limit = isset($request['length'])?$request['length']:10;
        
        $order = isset($columns[$request['order'][0]['column']])?$columns[$request['order'][0]['column']]:'id';
        $dir = isset($request['order'][0]['dir'])?$request['order'][0]['dir']:'DESC';
       
       
        $query=Mfp_procurement::where(['consolidated_id'=>$request['consolidated_id']]);
        if(Auth::user()->role != 1){
            $query->where('assigned_to',$user_id);
            $query->where('created_by','!=',$user_id);
        } 
        $query->where('status','!=',1);
        $query->whereIn('current_status' , [0,1,2]);
        $query=$query->orderBy($order,$dir);
        $query = $query->whereHas('getUserDetails', function (Builder $query) use ($request) {
            if (isset($request['state_id']) && !empty($request['state_id'])) {
                $query->where('state', $request['state_id']);
            }
            if (isset($request['district_id']) && !empty($request['district_id'])) {
                $query->where('district', $request['district_id']);
            }
        });
        if(isset($request['search']['value']) && !empty($request['search']['value']))
        {
            $search = $request['search']['value'];  
            $query->where(DB::raw("CONCAT(`proposal_id`)"), 'LIKE', "%".$search."%");       
        }

       
        if (isset($request['page']) && !empty($request['page'])) {
            return $query->paginate($limit);
        } else {
            return $query->count();
        }
       
    }
    public function getConsolidatedProposalsListRecommended($request)
    {
        $user=Auth::user();   
        $columns = array( 
                    0 =>'id', 
                    1=> 'id',
                    2=> 'id',
            );
        $limit = isset($request['length'])?$request['length']:10;
        
        $order = isset($columns[$request['order'][0]['column']])?$columns[$request['order'][0]['column']]:'id';
        $dir = isset($request['order'][0]['dir'])?$request['order'][0]['dir']:'DESC';
       
       
        $query=Mfp_procurement::where(['consolidated_id'=>$request['consolidated_id']]);
        $query=$query->whereHas('getProposedStatusLogs',function(Builder $query) use ($user,$request){
            
            $query->where('assigned_to', $user->id);
            $query->where('mfp_procurement_status_log.is_assigned_next_level', 1);
            $query->where('mfp_procurement_status_log.status', 1);
        });
        $query=$query->orderBy($order,$dir);
        $query = $query->whereHas('getUserDetails', function (Builder $query) use ($request) {
            if (isset($request['state_id']) && !empty($request['state_id'])) {
                $query->where('state', $request['state_id']);
            }
            if (isset($request['district_id']) && !empty($request['district_id'])) {
                $query->where('district', $request['district_id']);
            }
        });
        if(isset($request['search']['value']) && !empty($request['search']['value']))
        {
            $search = $request['search']['value'];  
            $query->where(DB::raw("CONCAT(`proposal_id`)"), 'LIKE', "%".$search."%");       
        }

       
        if (isset($request['page']) && !empty($request['page'])) {
            return $query->paginate($limit);
        } else {
            return $query->count();
        }
       
    }

    public function getMfpDetails($id)
    {   
        $procurement=Mfp_procurement::where('ref_id', $id)->first(); 
    $msp_commodity = Mfp_procurement_dia_release_commodity::where('mfp_procurement_id', $procurement->id)->get();
      $data=array();
      $newdata=array();
      foreach ($msp_commodity as $value) {
         if(isset($data[$value['mfp_id']]))
         {
            $data[$value['mfp_id']]['qty']   = $data[$value['mfp_id']]['qty']+$value['qty'];
            $data[$value['mfp_id']]['value']   = $data[$value['mfp_id']]['value']+$value['value'];
         }else{
            $data[$value['mfp_id']]=array(
            'id' => $value['id'], 
            'mfp_id' => $value['mfp_id'],
            'mfp_name' => $value->getMfpName->getMfpName->title,
            'qty' => $value['qty'],
            'value' => $value['value'],
         );
         }
         
      }

      foreach ($data as $key => $val) {
           $newdata[]=$val;
       } 
        return $newdata;
    }

   function getSecondLastRoleApprovedDetails($id){
          //===get last level user id====
          $consolidate_proposal = Mfp_procurement_consolidated::where('id',$id)->first();
          $second_last_role = StateRoleSubLevel::where('state_id',$consolidate_proposal->state)->whereNotIn('role_id',[3])->orderBy('id','desc')->first();

          $assigned_by = User::where('role',$second_last_role->role_id)->where('level_id',$second_last_role->sublevel_id)->first();
        
          $recommanded_date = Mfp_procurement_status_log::where('consolidated_id',$id)->where('assigned_by',$assigned_by->id)->orderBy('id','desc')->first(); 
          if(empty($recommanded_date))
          {
            $ids=$consolidate_proposal->getMfpProcurement->pluck('id');
            $recommanded_date = Mfp_procurement_status_log::whereIn('mfp_procurement_id',$ids)->where('assigned_by',$assigned_by->id)->orderBy('id','desc')->first(); 
          }
          return $recommanded_date->created_at;
        //$user_status =  
       
   }
}
