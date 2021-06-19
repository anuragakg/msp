<?php

namespace App\Http\Controllers\Api\V1\Proposals;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Api\V1\ApiController;
use App\Http\Resources\Api\Proposals\MfpProcurementResource as ApiResource;
use App\Http\Resources\Api\Proposals\MfpListingResource;
use App\Http\Resources\Api\Proposals\MfpProposalListingResource;
use App\Http\Resources\Api\Proposals\MfpDetailViewResource;
use App\Http\Resources\Api\Proposals\MfpProposalConsolidateResource;
use App\Http\Resources\Api\SanctionLetter\MfpProcurementGenerateSanctionResource;
use App\Http\Resources\Api\Proposals\MfpSeasionalityQuarterWiseResource;
use App\Http\Resources\Api\Proposals\ProposalMfpListingResource;
use App\Http\Resources\Api\Proposals\ProposalMfpStatusLogResource;
use App\Http\Resources\Api\Proposals\MfpDetailsForProcurementResource as MfpResource;
use App\Services\Proposals\MfpProcurementService;
use App\Models\Proposals\Mfp_procurement_consolidated;
use App\Models\Proposals\Mfp_procurement;

class MfpProcurementController extends ApiController
{
    protected $service;

    public function __construct(MfpProcurementService $mfpProcurementService)
    {
        $this->service = $mfpProcurementService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->checkPermission("mfp_procurement_plan_view");
        $items = $this->service->getAll($request);
        $items = MfpListingResource::collection($items);
        if(isset($request['page']) && !empty($request['page']))
        {
            $json_data = array(
                    "draw"            => intval($request['draw']),  
                    "recordsTotal"    => $items->total(),  
                    "recordsFiltered" => $items->total(), 
                    "data"            => $items,
                    'current_page' => $items->currentPage(),
                    'next' => $items->nextPageUrl(),
                    'previous' => $items->previousPageUrl(),
                    'per_page' => $items->perPage(),   
                    );
            return $this->respondWithSuccess($json_data);    
        }else{
            return $this->respondWithSuccess($items);
        }
        
        
    }

    public function proposalListing(Request $request)
    {
        //$this->checkPermission("mfp_procurement_plan_view");
        $items = $this->service->proposalListing($request);
        $items = MfpProposalListingResource::collection($items);
        if(isset($request['page']) && !empty($request['page']))
        {
            $json_data = array(
                    "draw"            => intval($request['draw']),  
                    "recordsTotal"    => $items->total(),  
                    "recordsFiltered" => $items->total(), 
                    "data"            => $items,
                    'current_page' => $items->currentPage(),
                    'next' => $items->nextPageUrl(),
                    'previous' => $items->previousPageUrl(),
                    'per_page' => $items->perPage(),   
                    );
            return $this->respondWithSuccess($json_data);    
        }else{
            return $this->respondWithSuccess($items);
        }
        
        
    }
    public function proposalRecommendedListing(Request $request)
    {
        $user = Auth::user();
        $user_id=$user->id;
        $user_role=$user->role;
        $items = $this->service->proposalRecommendedListing($request);
        if($user_role==6 || $user->role == 4 ||$user->role == 2)
        {
            $items = MfpProposalListingResource::collection($items);
            
        }else{
            $items = MfpProposalConsolidateResource::collection($items);
        }
        
        if(isset($request['page']) && !empty($request['page']))
        {
            $json_data = array(
                    "draw"            => intval($request['draw']),  
                    "recordsTotal"    => $items->total(),  
                    "recordsFiltered" => $items->total(), 
                    "data"            => $items,
                    'current_page' => $items->currentPage(),
                    'next' => $items->nextPageUrl(),
                    'previous' => $items->previousPageUrl(),
                    'per_page' => $items->perPage(),   
                    );
            return $this->respondWithSuccess($json_data);    
        }else{
            return $this->respondWithSuccess($items);
        }
        
        
    }

    public function proposalApprovedListing(Request $request)
    {
        $user = Auth::user();
        $user_id=$user->id;
        $user_role=$user->role;
        $items = $this->service->proposalApprovedListing($request);
        
        $items = MfpProposalConsolidateResource::collection($items);
        
        
        if(isset($request['page']) && !empty($request['page']))
        {
            $json_data = array(
                    "draw"            => intval($request['draw']),  
                    "recordsTotal"    => $items->total(),  
                    "recordsFiltered" => $items->total(), 
                    "data"            => $items,
                    'current_page' => $items->currentPage(),
                    'next' => $items->nextPageUrl(),
                    'previous' => $items->previousPageUrl(),
                    'per_page' => $items->perPage(),   
                    );
            return $this->respondWithSuccess($json_data);    
        }else{
            return $this->respondWithSuccess($items);
        }
        
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->checkPermission("mfp_procurement_plan_add");
        //
        $valid = $this->service->validateCreate($request->all());

        if ($valid->fails()) {
            return $this->respondWithValidationError($valid);
        }

        try{
            $data = $valid->validated();
          
            if(isset($data['form_id']) && !empty($data['form_id']))
            {
               
                $items = $this->service->updateItem($data['form_id'], $data);         
            }else{
                $items = $this->service->createItem($data);
            }
            
            $item = ApiResource::make($items);
            
            return $this->respondWithSuccess($item);
        }catch(\Exception $th){
            return $this->respondWithError($th);
        }
        
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $this->checkPermission("mfp_procurement_plan_view");
        try {
            $item = $this->service->getOne($id);
            $item = ApiResource::make($item);
            return $this->respondWithSuccess($item);
        } catch (\Exception $th) {
            return $this->respondNotFound();
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->checkPermission("mfp_procurement_plan_edit");

        $valid = $this->service->validateUpdate($id, $request->all());

        if ($valid->fails()) {
            return $this->respondWithValidationError($valid);
        }

        $data = $valid->validated();
        try {

            if(isset($data['image']) &&!empty($data['image']))
            {
                $data['image']=$request->file('image')->store('public/mfp');     
            }
            $item = $this->service->updateItem($id, $data);
            $item = ApiResource::make($item);

            return $this->respondWithSuccess($item);
        } catch (\Throwable $th) {
            return $this->respondNotFound();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->checkPermission("master_management_status");

        try {
            $res = $this->service->deleteItem($id);

            if ($res) {
                /** If item is deleted successfully */
                return $this->respondWithSuccess('Item Deleted');
            }

            /** If failed to delete item from db */
            return $this->respondWithError('Could not delete item');
        } catch (\Throwable $th) {
            return $this->respondNotFound();
        }
    }

    
    public function mfpProcurementDetail($id)
    {
        //$this->checkPermission("mfp_procurement_plan_view");
        try {

            $item = $this->service->getOne($id);
            $item = MfpDetailViewResource::make($item);
            return $this->respondWithSuccess($item);
        } catch (\Exception $th) {
            return $this->respondNotFound();
        }
    }

    function deleteMfpCoverageBlockHaat(Request $request)
    {

        $item=$this->service->deleteMfpCoverageBlockHaat($request->all());
        return $this->respondWithSuccess($item);
    }
    function deleteCommodityHaat(Request $request)
    {
        
        $item=$this->service->deleteCommodityHaat($request->all());
        return $this->respondWithSuccess($item);
    }
    function deleteMfpCoverage(Request $request)
    {
        
        $item=$this->service->deleteMfpCoverage($request->all());
        return $this->respondWithSuccess($item);
    }
    function deleteSeasonality(Request $request)
    {
        
        $item=$this->service->deleteSeasonality($request->all());
        return $this->respondWithSuccess($item);
    }
    public function getSeasionalityQuarterWise($id)
    {
        $item = $this->service->getOne($id);
        $item=MfpSeasionalityQuarterWiseResource::make($item);
        $item=$this->getResourceData($item);
        $item=$this->service->getSeasionalityQuarterWise($item);
        return $this->respondWithSuccess($item);
    }

    public function getMfpQuarterWiseForSummary($id){
      
        $item = $this->service->getOne($id);
        $item=MfpSeasionalityQuarterWiseResource::make($item);
        $item=$this->getResourceData($item);
        $item=$this->service->getSeasionalityQuarterWise($item);
        $item = $this->service->getMfpQuarterWiseForSummary($item);
        return $this->respondWithSuccess($item);
    }

    public function getAllProposal(){
        $item = $this->service->getAllProposalIDs();
        return $this->respondWithSuccess($item);
    }
    
    
    public function approveMfpProcurement(Request $request)
    {
        try {
            $item=$this->service->approveMfpProcurement($request->all());
            $item = MfpDetailViewResource::make($item);
            return $this->respondWithSuccess($item);
        } catch (\Throwable $th) {
            return $this->respondNotFound();
        }
    }

    public function revertMfpProcurement(Request $request)
    {
        try {
            $item=$this->service->revertMfpProcurement($request->all());
            $item = MfpDetailViewResource::make($item);
            return $this->respondWithSuccess($item);
        } catch (\Throwable $th) {
            return $this->respondNotFound();
        }
    }
    public function rejectMfpProcurement(Request $request)
    {
        try {
            $item=$this->service->rejectMfpProcurement($request->all());
            $item = MfpDetailViewResource::make($item);
            return $this->respondWithSuccess($item);
        } catch (\Throwable $th) {
            return $this->respondNotFound();
        }
    }
    public function send_mfpprocurement_to_nextlevel(Request $request)
    {
        try {
            $valid = $this->service->validateProposalsIds($request->all());

            if ($valid->fails()) {
                return $this->respondWithValidationError($valid);
            }

            $data = $valid->validated();

            $item=$this->service->send_mfpprocurement_to_nextlevel($request->all());
            return $this->respondWithSuccess($item);
        } catch (\Throwable $th) {
            return $this->respondNotFound();
        }
    }
    public function consolidate_mfpprocurement(Request $request)
    {
        try {
            $valid = $this->service->validateProposalsIds($request->all());

            if ($valid->fails()) {
                return $this->respondWithValidationError($valid);
            }

            $data = $valid->validated();
            $year_arr=array();
            $state_arr=array();
            foreach ($request['proposals'] as $key => $proposal) 
            {
                $procurement= Mfp_procurement::where('ref_id', $proposal)->first();
                $state=$procurement->getUserDetails->getState->id;
                if(!in_array($state, $state_arr))
                {
                    $state_arr[]=$state;     
                }
                if(!in_array($procurement->year_id, $year_arr))
                {
                    $year=$procurement->year_id;
                    $year_arr[]=$year;     
                }
            }
            if(count($state_arr)>1)
            {
                return $this->respondWithError('Please select proposals of same state for consolidation');
            }
            if(count($year_arr)>1)
            {
                return $this->respondWithError('Please select proposals of same year for consolidation');
            }
            $item=$this->service->consolidate_mfpprocurement($request->all(),$state,$year);
            return $this->respondWithSuccess($item);
        } catch (\Throwable $th) {
            return $this->respondWithError($th);
        }
    }
    public function consolidate_references(Request $request)
    {
        try {
            $valid = $this->service->validateConsolidateIds($request->all());

            if ($valid->fails()) {
                return $this->respondWithValidationError($valid);
            }

            $data = $valid->validated();
            $year_arr=array();
            $state_arr=array();
            foreach ($request['consolidated_proposals'] as $key => $consolidateId) 
            {
                $consolidate= Mfp_procurement_consolidated::where('id', $consolidateId)->first();
                $state=$consolidate->state;
                if(!in_array($state, $state_arr))
                {
                    $state_arr[]=$state;     
                }
                if(!in_array($consolidate->year_id, $year_arr))
                {
                    $year=$consolidate->year_id;
                    $year_arr[]=$year;     
                }
            }
            if(count($state_arr)>1)
            {
                return $this->respondWithError('Please select same state for consolidation');
            }
            if(count($year_arr)>1)
            {
                return $this->respondWithError('Please select same year for consolidation');
            }
            $item=$this->service->consolidate_references($request->all());
            return $this->respondWithSuccess($item);
        } catch (\Throwable $th) {
           return $this->respondWithError($th);
        }
    }

    public function getConsolidatedProposals(Request $request)
    {
        //$this->checkPermission("mfp_procurement_plan_view");
        $items = $this->service->getConsolidatedProposals($request);
        
        $items = MfpProposalConsolidateResource::collection($items);
        if(isset($request['page']) && !empty($request['page']))
        {
            $json_data = array(
                    "draw"            => intval($request['draw']),  
                    "recordsTotal"    => $items->total(),  
                    "recordsFiltered" => $items->total(), 
                    "data"            => $items,
                    'current_page' => $items->currentPage(),
                    'next' => $items->nextPageUrl(),
                    'previous' => $items->previousPageUrl(),
                    'per_page' => $items->perPage(),   
                    );
            return $this->respondWithSuccess($json_data);    
        }else{
            return $this->respondWithSuccess($items);
        }
    }

    public function send_consolidated_to_next_level(Request $request)
    {
        try {
            
            $items = $this->service->send_consolidated_to_next_level($request);
        
            return $this->respondWithSuccess($items);
        }catch (\Throwable $th) {
            return $this->respondWithError($th);
        }
        
    }

    public function getConsolidatedProposal($id){
        try {
            $item = $this->service->getConsolidatedProposal($id);
            return $this->respondWithSuccess($item);
        } catch (\Throwable $th) {
              return $this->respondNotFound();
        }
    }

    public function approveConsolidatedMfpProcurement(Request $request)
    {
        try {
            $item=$this->service->verifyConsolidatdMfpProcurement($request->all());
            return $this->respondWithSuccess($item);
        } catch (\Throwable $th) {
             return $this->respondWithError($th);
        }
    }

    public function revertConsolidatedMfpProcurement(Request $request)
    {
        try {
            $item=$this->service->verifyConsolidatdMfpProcurement($request->all());
            return $this->respondWithSuccess($item);
        } catch (\Throwable $th) {
            return $this->respondNotFound();
        }
    }
    
    public function rejectConsolidatedMfpProcurement(Request $request)
    {
        try {
            $item=$this->service->verifyConsolidatdMfpProcurement($request->all());
           
            return $this->respondWithSuccess($item);
        } catch (\Throwable $th) {
            return $this->respondNotFound();
        }
    } 

    /*****
     * get all mfp list of proposal 
     */
    public function getProposalMfpList(Request $request){
        $items = $this->service->getProposalMfpList($request);
     
        $items = ProposalMfpListingResource::collection($items);
     
        if(isset($request['page']) && !empty($request['page']))
        {
            $json_data = array(
                    "draw"            => intval($request['draw']),  
                    "recordsTotal"    => $items->total(),  
                    "recordsFiltered" => $items->total(), 
                    "data"            => $items,
                    'current_page' => $items->currentPage(),
                    'next' => $items->nextPageUrl(),
                    'previous' => $items->previousPageUrl(),
                    'per_page' => $items->perPage(),   
                    );
            return $this->respondWithSuccess($json_data);    
        }else{
            return $this->respondWithSuccess($items);
        }
    }
    public function proposal_status_logs($ref_id)
    {
        $items = $this->service->proposal_status_logs($ref_id);   

        $items = ProposalMfpStatusLogResource::make($items);  
        return $this->respondWithSuccess($items);   
    }

    public function getProposalReverted(Request $request)
    {
        $items = $this->service->getProposalReverted($request);
        $items = MfpProposalListingResource::collection($items);
        if(isset($request['page']) && !empty($request['page']))
        {
            $json_data = array(
                    "draw"            => intval($request['draw']),  
                    "recordsTotal"    => $items->total(),  
                    "recordsFiltered" => $items->total(), 
                    "data"            => $items,
                    'current_page' => $items->currentPage(),
                    'next' => $items->nextPageUrl(),
                    'previous' => $items->previousPageUrl(),
                    'per_page' => $items->perPage(),   
                    );
            return $this->respondWithSuccess($json_data);    
        }else{
            return $this->respondWithSuccess($items);
        }
        
    }

    public function getProposalRejected(Request $request)
    {
        $items = $this->service->getProposalRejected($request);
        $items = MfpProposalListingResource::collection($items);
        if(isset($request['page']) && !empty($request['page']))
        {
            $json_data = array(
                    "draw"            => intval($request['draw']),  
                    "recordsTotal"    => $items->total(),  
                    "recordsFiltered" => $items->total(), 
                    "data"            => $items,
                    'current_page' => $items->currentPage(),
                    'next' => $items->nextPageUrl(),
                    'previous' => $items->previousPageUrl(),
                    'per_page' => $items->perPage(),   
                    );
            return $this->respondWithSuccess($json_data);    
        }else{
            return $this->respondWithSuccess($items);
        }
        
    }
    public function getProcurementCountsStatusWise(Request $request)
    {
        $data['pending'] = $this->service->proposalListing($request);
        $data['consolidated'] = $this->service->getConsolidatedProposals($request);
        $data['recommended'] = $this->service->proposalRecommendedListing($request);
        $data['reverted'] = $this->service->getProposalReverted($request);
        $data['rejected'] = $this->service->getProposalRejected($request);
        $data['approved'] = $this->service->proposalApprovedListing($request);
        return $this->respondWithSuccess($data);
    }

    /******
     * Add those mfp which was added by nodal level
     */
    public function addMfpForProcurement(Request $request){
        $this->checkPermission("mfp_details_add");
        $valid = $this->service->validateAddMfp($request->all());

        if ($valid->fails()) {
            return $this->respondWithValidationError($valid);
        }

        $data = $valid->validated();
        $item = $this->service->createMfp($data);
        //dd($item);
        $item = MfpResource::make($item);
        return $this->respondWithSuccess($item);
    }

    public function get_mfp_details(Request $request){
        $this->checkPermission("mfp_details_view");
        //for custom pagination
        $queryParams = [ 'per_page' => $request->query('per_page', 5),];
        
     	if (isset($queryParams['per_page'])) {
			$check = $this->service->checkPerpage($queryParams['per_page']);	
			
			 if ($check['status']==0) {
		 		return $this->respondWithValidationError($check['message']);
			}
        }
        //get only distinct mfps
        $item = $this->service->get_mfp_details($request,$queryParams);
        
        //get only mfps year data
        $mfp_year_data = $this->service->mfp_year_data($request);
        //dd($mfp_year_data); 
        //change data in array
        $item = json_encode($item);
        $array =  collect(json_decode($item, true));
        $item = $array->toArray();
        //dd($item);
        //create final response array
        $finalData = [];
        $year_data = [];
        foreach($mfp_year_data as $row){
            $year_data[$row['mfp']][]=$row;
        }
        //dd($item['data']);
        foreach($item['data'] as $row){
            $finalData[$row['mfp']] = array(
                'mfp_id'=>$row['get_mfp_name']['get_mfp_name']['title'],
                'created_by'=>$row['get_created_user_name']['name'].' '.$row['get_created_user_name']['last_name'],
                'user_state'=>$row['get_created_user_state']['get_state']['title'] ,
                'year_data'=>$year_data[$row['mfp']]??array()

            ); 
			
        }
       // $item['data'] = array_values($finalData);
        //dd($finalData);  
        $return = [
            'count' => count($item),
            'total' => $item['total'],
            'current_page' => $item['current_page'],
            'next' => $item['next_page_url'],
            'previous' => $item['prev_page_url'],
            'per_page' => $item['per_page'],
            'url' => $item['path'],
            'data' => array_values($finalData)
        ];

        return $this->respondWithSuccess($return);
    }

    public function getApprovedConsolidatedProposals(Request $request)
    {   
        $this->checkPermission("fund_management_approved_consolidate_view");
        $items = $this->service->getApprovedConsolidatedProposals($request);
        $items = MfpProcurementGenerateSanctionResource::collection($items);
        if(isset($request['page']) && !empty($request['page']))
        {
            $json_data = array(
                    "draw"            => intval($request['draw']),  
                    "recordsTotal"    => $items->total(),  
                    "recordsFiltered" => $items->total(), 
                    "data"            => $items,
                    'current_page' => $items->currentPage(),
                    'next' => $items->nextPageUrl(),
                    'previous' => $items->previousPageUrl(),
                    'per_page' => $items->perPage(),   
                    );
            return $this->respondWithSuccess($json_data);    
        }else{
            return $this->respondWithSuccess($items);
        }
    }

    public function getSeasonalityCommodityDetails($id)
    {
      //  $this->checkPermission("mfp_procurement_plan_view");
        /*$items = $this->service->getSeasonalityCommodityDetails($id);
        return $this->respondWithSuccess($items);*/
        $item = $this->service->getOne($id);
        $item=MfpSeasionalityQuarterWiseResource::make($item);
        $item=$this->getResourceData($item);
        $item=$this->service->getSeasonalityCommodityDetails($item);
        return $this->respondWithSuccess($item);
        
    }    


    public function get_proposal_mfp_details(Request $request,$id){
        $this->checkPermission("mfp_details_view");
        //for custom pagination
        $queryParams = [ 'per_page' => $request->query('per_page', 5),];
        
     	if (isset($queryParams['per_page'])) {
			$check = $this->service->checkPerpage($queryParams['per_page']);	
			
			 if ($check['status']==0) {
		 		return $this->respondWithValidationError($check['message']);
            }
            
        }
        //get only distinct mfps
        $item = $this->service->get_proposal_mfp_details($request,$id,$queryParams);

        //get only mfps year data
        $mfp_year_data = $this->service->mfp_year_data($request);
        //change data in array
        $item = json_encode($item);
        $array =  collect(json_decode($item, true));
        $item = $array->toArray();

        //create final response array
        $finalData = [];
        $year_data = [];
        foreach($mfp_year_data as $row){
            $year_data[$row['mfp']][]=$row;
        }
        foreach($item['data'] as $row){
            $finalData[$row['mfp']] =array(
                'mfp_id'=>$row['get_mfp_name']['title'],
                'created_by'=>$row['get_created_user_name']['name'].' '.$row['get_created_user_name']['last_name'],
                'user_state'=>$row['get_created_user_state'] ,
                'year_data'=>$year_data[$row['mfp']]

            ); 
        }
     
        $return = [
            'count' => count($item),
            'total' => $item['total'],
            'current_page' => $item['current_page'],
            'next' => $item['next_page_url'],
            'previous' => $item['prev_page_url'],
            'per_page' => $item['per_page'],
            'url' => $item['path'],
            'data' => array_values($finalData)
        ];

        return $this->respondWithSuccess($return);
    }

    public function getMfpValue($mfp_id){
        try {
            $item = $this->service->getMfpValue($mfp_id);
            //$item = ApiResource::make($item);
            return $this->respondWithSuccess($item);
        } catch (\Exception $th) {
            return $this->respondNotFound();
        }    

    }


    public function getMinScrutinyLevel(){
        try {
            $item = $this->service->getMinScrutinyLevel();
            return $this->respondWithSuccess($item);
        } catch (\Exception $th) {
            return $this->respondNotFound();
        }            
    }

    
    public function mfpProcurementCheckLastLevelUser($id)
    {
        try {
            $item = $this->service->mfpProcurementCheckLastLevelUser($id);
            return $this->respondWithSuccess($item);
        } catch (\Exception $th) {
            return $this->respondWithError($th);
        } 
    }
    public function mfpProcurementCheckConsolidatedLastLevelUser($id)
    {
        try {
            $item = $this->service->mfpProcurementCheckConsolidatedLastLevelUser($id);
            return $this->respondWithSuccess($item);
        } catch (\Exception $th) {
            return $this->respondWithError($th);
        } 
    }
    public function getConsolidatedProposalsList(Request $request)
    {
        $items = $this->service->getConsolidatedProposalsList($request);
        $items = MfpListingResource::collection($items);
        if(isset($request['page']) && !empty($request['page']))
        {
            $json_data = array(
                    "draw"            => intval($request['draw']),  
                    "recordsTotal"    => $items->total(),  
                    "recordsFiltered" => $items->total(), 
                    "data"            => $items,
                    'current_page' => $items->currentPage(),
                    'next' => $items->nextPageUrl(),
                    'previous' => $items->previousPageUrl(),
                    'per_page' => $items->perPage(),   
                    );
            return $this->respondWithSuccess($json_data);    
        }else{
            return $this->respondWithSuccess($items);
        }
        
        
    }
    public function getConsolidatedProposalsListRecommended(Request $request)
    {
        $items = $this->service->getConsolidatedProposalsListRecommended($request);
        $items = MfpListingResource::collection($items);
        if(isset($request['page']) && !empty($request['page']))
        {
            $json_data = array(
                    "draw"            => intval($request['draw']),  
                    "recordsTotal"    => $items->total(),  
                    "recordsFiltered" => $items->total(), 
                    "data"            => $items,
                    'current_page' => $items->currentPage(),
                    'next' => $items->nextPageUrl(),
                    'previous' => $items->previousPageUrl(),
                    'per_page' => $items->perPage(),   
                    );
            return $this->respondWithSuccess($json_data);    
        }else{
            return $this->respondWithSuccess($items);
        }
        
        
    }

    public function getSeasonalityDetails($id)
    {
        $item = $this->service->getOne($id);
        $item=MfpSeasionalityQuarterWiseResource::make($item);
        $item=$this->getResourceData($item);
        return $this->respondWithSuccess($item);
        
    }    

     public function getMfpDetails($id)
    {
        try {
            $item = $this->service->getMfpDetails($id);
            return $this->respondWithSuccess($item);
        } catch (\Exception $th) {
            return $this->respondWithError($th);
        } 
        
    }  
    
    public function getSecondLastRoleApprovedDetails($id){
        try {
            $item = $this->service->getSecondLastRoleApprovedDetails($id);
            return $this->respondWithSuccess($item);
        } catch (\Exception $th) {
            return $this->respondWithError($th);
        } 
    }
}
