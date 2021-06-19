<?php

namespace App\Http\Controllers\Api\V1\Infrastructures;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Api\V1\ApiController;
use App\Http\Resources\Api\Infrastructures\InfrastructureDevelopmentResource as ApiResource; 
use App\Http\Resources\Api\Infrastructures\InfrastructureListingResource;
use App\Http\Resources\Api\Infrastructures\InfrastructureProposalListingResource;
use App\Http\Resources\Api\Infrastructures\InfrastructureDetailViewResource;
use App\Http\Resources\Api\Infrastructures\InfraProposalConsolidateResource;
use App\Http\Resources\Api\Infrastructures\ProposalInfrastructureStatusLogResource;
use App\Http\Resources\Api\Infrastructures\TransactionStatusLogResource;
use App\Http\Resources\Api\SanctionLetter\InfrastructureGenerateSanctionResource;
use App\Services\Infrastructures\InfrastructuredevelopmentService;
use App\Models\Infrastructures\Infrastructure_development;
use App\Models\Infrastructures\Infrastructure_Development_consolidated;
use App\Models\Actualdetail\Infrastructure_development_actual_detail;

class InfrastructureController extends ApiController
{
    protected $service;

    public function __construct(InfrastructuredevelopmentService $InfrastructuredevelopmentService)
    {
        $this->service = $InfrastructuredevelopmentService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->checkPermission("infrastructure_development_view");
        $items = $this->service->getAll($request);
        $items = InfrastructureListingResource::collection($items);
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
        //$this->checkPermission("infrastructure_development_view");
        $items = $this->service->proposalListing($request);
        $items = InfrastructureProposalListingResource::collection($items);
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
        if($user_role==6)
        {
            $items = InfrastructureProposalListingResource::collection($items);
            
        }else{
            $items = InfraProposalConsolidateResource::collection($items);
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

      public function getProposalReverted(Request $request)
    {
        $items = $this->service->getProposalReverted($request->all());
        $items = InfrastructureProposalListingResource::collection($items);
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
        $this->checkPermission("infrastructure_development_add");
        $valid = $this->service->validateCreate($request->all()); 

        if ($valid->fails()) {
            return $this->respondWithValidationError($valid);
        }

        $data = $valid->validated();  

        if(isset($data['form_id']) && !empty($data['form_id']))
        {  
            $items = $this->service->updateItem($data['form_id'], $data);         
        }else{  
            $items = $this->service->createItem($data);
        }
        
        $item = ApiResource::make($items);
        
        return $this->respondWithSuccess($item);
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $this->checkPermission("infrastructure_development_view");
        //try {
            $item = $this->service->getOne($id);
            $item = ApiResource::make($item);
            return $this->respondWithSuccess($item);
        //} catch (\Exception $th) {
            //return $this->respondNotFound();
        //}
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
        $this->checkPermission("infrastructure_development_edit");

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
        $this->checkPermission("infrastructure_development_status");

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

    
    public function getinfrastructureDetail($id)
    {
        // $this->checkPermission("infrastructure_development_view");
      //  try {

            $item = $this->service->getOne($id);
            $item = InfrastructureDetailViewResource::make($item);
            return $this->respondWithSuccess($item);
     //   } catch (\Exception $th) {
            //return $this->respondNotFound();
       // }
    }
    
     
     public function submittedproposalListing(Request $request)
    {
        $items = $this->service->submittedproposalListing($request);
        $items = InfrastructureProposalListingResource::collection($items);
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

    public function approveInfrastructure(Request $request)
    {
     //   try {
            $item=$this->service->approveInfrastructure($request->all());
            return $this->respondWithSuccess($item);
        //} catch (\Throwable $th) {
           // return $this->respondNotFound();
        //}
    }

    public function revertInfrastructure(Request $request)
    {
        try {
            $item=$this->service->revertInfrastructure($request->all());
            return $this->respondWithSuccess($item);
        } catch (\Throwable $th) {
            return $this->respondNotFound();
        }
    }
    public function rejectInfrastructure(Request $request)
    {
        try {
            $item=$this->service->rejectInfrastructure($request->all());
            return $this->respondWithSuccess($item);
        } catch (\Throwable $th) {
            return $this->respondNotFound();
        }
    }

      public function send_infrastructure_to_nextlevel(Request $request)
    {
        try {
            $valid = $this->service->validateProposalsIds($request->all());

            if ($valid->fails()) {
                return $this->respondWithValidationError($valid);
            }

            $data = $valid->validated();

            $item=$this->service->send_infrastructure_to_nextlevel($request->all());
            return $this->respondWithSuccess($item);
        } catch (\Throwable $th) {
            return $this->respondNotFound();
        }
    }
    public function consolidate_infrastructure(Request $request)
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
                $infra= Infrastructure_development::where('ref_id', $proposal)->first();
                $state=$infra->getUserDetails->getState->id;
                if(!in_array($state, $state_arr))
                {
                    $state_arr[]=$state;     
                }
                if(!in_array($infra->year_id, $year_arr))
                {
                    $year=$infra->year_id;
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
            $item=$this->service->consolidate_infrastructure($request->all(),$state,$year);
            return $this->respondWithSuccess($item);
        } catch (\Throwable $th) {
            return $this->respondWithError($th);
        }
    }

     public function consolidate_references(Request $request)
    {
        //try {
            $valid = $this->service->validateConsolidateIds($request->all());

            if ($valid->fails()) {
                return $this->respondWithValidationError($valid);
            }

            $data = $valid->validated();
            $year_arr=array();
            $state_arr=array();
            foreach ($request['consolidated_proposals'] as $key => $consolidateId) 
            {
                $consolidate= Infrastructure_Development_consolidated::where('id', $consolidateId)->first();
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
        //} catch (\Throwable $th) {
            return $this->respondNotFound();
        //}
    }

    public function getConsolidatedProposals(Request $request)
    { 
        $items = $this->service->getConsolidatedProposals($request);        
        $items = InfraProposalConsolidateResource::collection($items);
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


    public function getConsolidatedProposal($id){
       try {
            $item = $this->service->getConsolidatedProposal($id);
            return $this->respondWithSuccess($item);
        } catch (\Throwable $th) {
             return $this->respondNotFound();
        }
    }

     public function proposal_status_logs($ref_id)
    {
        $items = $this->service->proposal_status_logs($ref_id);   
        $items = ProposalInfrastructureStatusLogResource::make($items);  
        return $this->respondWithSuccess($items);   
    }

     public function approveConsolidated(Request $request)
    {
        try {
            $item=$this->service->verifyConsolidate($request->all());
            return $this->respondWithSuccess($item);
        } 
        catch (\Throwable $th) {
             return $this->respondNotFound();
        }
    }

    public function revertConsolidated(Request $request)
    {
        try {
            $item=$this->service->verifyConsolidate($request->all());
            return $this->respondWithSuccess($item);
        } catch (\Throwable $th) {
            return $this->respondNotFound();
        }
    }

     public function rejectConsolidate(Request $request)
    {
        try {
            $item=$this->service->verifyConsolidate($request->all());
           
            return $this->respondWithSuccess($item);
        } catch (\Throwable $th) {
            return $this->respondNotFound();
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

    public function getApprovedConsolidatedProposals(Request $request)
    {
        $this->checkPermission("fund_management_approved_consolidate_view");
        $items = $this->service->getApprovedConsolidatedProposals($request);
        $items = InfrastructureGenerateSanctionResource::collection($items);
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

    public function getAllSelectedMfps($id){
        $item = $this->service->getAllSelectedMfps($id);
     
        //change data in array
        $item = json_encode($item);
        $array =  collect(json_decode($item, true));
        $item = $array->toArray();
        //print_r($item); die;
        //dd($item);
        //create final response array
        $finalData = [];
        foreach($item['get_infrastructure_haat'] as $row){ 
            foreach($row['get_mfp_data'] as $row1){  
                $finalData[$row1['mfp_id']] = $row1['get_mfp_namedata']['get_mfp_name']['title']; 
            }
            
         }
        return $this->respondWithSuccess($finalData);    
    }

      public function infrastructureCheckLastLevelUser($id)
    {
        try {
            $item = $this->service->infrastructureCheckLastLevelUser($id);
            return $this->respondWithSuccess($item);
        } catch (\Exception $th) {
            return $this->respondWithError($th);
        } 
    }
    public function infrastructureCheckConsolidatedLastLevelUser($id)
    {
        try {
            $item = $this->service->infrastructureCheckConsolidatedLastLevelUser($id);
            return $this->respondWithSuccess($item);
        } catch (\Exception $th) {
            return $this->respondWithError($th);
        } 
    }


     public function consolidate_infrastructure_transaction(Request $request)
    {
       try {
            //$valid = $this->service->validateProposalsIds($request->all());
            $valid = $this->service->validateTransactionIds($request->all());

            if ($valid->fails()) {
                return $this->respondWithValidationError($valid);
            }

            $data = $valid->validated(); 
            $year_arr=array();
            $state_arr=array();
            foreach ($request['proposals'] as $key => $proposal) 
            {
                $infra= Infrastructure_development_actual_detail::where('id', $proposal)->first();
                $state=$infra->getInfraFormDetails->getUserDetails->getDistrict->id; 
                if(!in_array($state, $state_arr))
                {
                    $state_arr[]=$state;     
                }
                if(!in_array($infra->getInfraFormDetails->year_id, $year_arr))
                {
                    $year=$infra->getInfraFormDetails->year_id;
                    $year_arr[]=$year;     
                }
            }
            $proposal_id=$infra->proposal_id;  
            if(count($state_arr)>1)
            {
                return $this->respondWithError('Please select transactions of same district for consolidation');
            }
            if(count($year_arr)>1)
            {
                return $this->respondWithError('Please select transactions of same year for consolidation');
            } 
            
            $item=$this->service->consolidate_infrastructure_transaction($request->all(),$state,$year,$proposal_id);
            return $this->respondWithSuccess($item);
        } catch (\Throwable $th) {
            return $this->respondWithError($th);
        }
    }

    public function getConsolidatedProposalsList(Request $request)
    {
        $items = $this->service->getConsolidatedProposalsList($request);
        $items = InfrastructureListingResource::collection($items);
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
        $items = InfrastructureListingResource::collection($items);
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

     public function approveInfrastructureProgress(Request $request)
    {
        try {
            $item=$this->service->approveInfrastructureProgress($request->all());
            return $this->respondWithSuccess($item);
        } catch (\Throwable $th) {
            return $this->respondNotFound();
        }
    }

    public function revertInfrastructureProgress(Request $request)
    {
        try {
            $item=$this->service->revertInfrastructureProgress($request->all());
            return $this->respondWithSuccess($item);
        } catch (\Throwable $th) {
            return $this->respondNotFound();
        }
    }
    public function rejectInfrastructureProgress(Request $request)
    {
        try {
            $item=$this->service->rejectInfrastructureProgress($request->all());
            return $this->respondWithSuccess($item);
        } catch (\Throwable $th) {
            return $this->respondNotFound();
        }
    }

    public function transaction_status_logs($ref_id)
    {
        $items = $this->service->transaction_status_logs($ref_id);   
        $items = TransactionStatusLogResource::make($items);  
        return $this->respondWithSuccess($items);   
    }

     public function getProposalRejected(Request $request)
    {
        $items = $this->service->getProposalRejected($request);
        $items = InfrastructureProposalListingResource::collection($items);
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
    
    public function getInfrastructureCountsStatusWise(Request $request)
    {
        $data['pending'] = $this->service->proposalListing($request);
        $data['consolidated'] = $this->service->getConsolidatedProposals($request);
        $data['recommended'] = $this->service->proposalRecommendedListing($request);
        $data['reverted'] = $this->service->getProposalReverted($request);
        $data['rejected'] = $this->service->getProposalRejected($request);        
        $data['approved'] = $this->service->proposalApprovedListing($request);
        return $this->respondWithSuccess($data);
    }

    public function getSecondLastRoleApprovedDetails($id){
        try {
            $item = $this->service->getSecondLastRoleApprovedDetails($id);
            return $this->respondWithSuccess($item);
        } catch (\Exception $th) {
            return $this->respondWithError($th);
        } 
    }

     public function proposalApprovedListing(Request $request)
    {
        $user = Auth::user();
        $user_id=$user->id;
        $user_role=$user->role;
        $items = $this->service->proposalApprovedListing($request);        
        $items = InfraProposalConsolidateResource::collection($items);        
        
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
}