<?php

namespace App\Http\Controllers\Api\V1\Proposals;
use Illuminate\Support\Facades\Auth;
use App\Models\Proposals\Mfp_procurement;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\V1\ApiController;
use App\Http\Resources\Api\Proposals\MfpListingResource;
use App\Http\Resources\Api\ReleaseFund\MfpProcurementReleaseListResource;
use App\Http\Resources\Api\ReleaseFund\MfpProcurementReleaseDetailsResource;
use App\Http\Resources\Api\ReleaseFund\MfpProcurementFundReceivedHistoryResource;
use App\Http\Resources\Api\ReleaseFund\MfpProcurementFundReceivedProcurementAgentResource;
use App\Http\Resources\Api\ReleaseFund\MfpProcurementFundReceivedProcurementAgentDetailResource;
use App\Http\Resources\Api\ReleaseFund\MfpProcurementCommissionReceivedDetailResource;
use App\Http\Resources\Api\Masters\MfpResource;
use App\Http\Resources\Api\Proposals\TransactionResource;
use App\Http\Resources\Api\Proposals\MfpSeasionalityQuarterWiseResource;
use App\Http\Resources\Api\ReleaseFund\MfpProcurementReleaseHistory;
use App\Services\Proposals\MfpProcurementReleaseFundService;
use App\Services\Proposals\MfpProcurementService;
use App\Http\Resources\Api\UserResource;
class MfpProcurementReleaseController extends ApiController
{
    protected $service;

    public function __construct(MfpProcurementReleaseFundService $MfpProcurementReleaseFundService,MfpProcurementService $MfpProcurementService)
    {
        $this->service = $MfpProcurementReleaseFundService;
        $this->mfpProcurementService = $MfpProcurementService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->checkPermission("fund_management_release_fund");
        $items = $this->service->getAll($request);
        $items = MfpProcurementReleaseListResource::collection($items);
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
        $this->checkPermission("fund_management_release_fund");
        
        //try {
            $valid = $this->service->validateCreate($request->all());

            if ($valid->fails()) {
                return $this->respondWithValidationError($valid);
            }

            $data = $valid->validated();
            $items = $this->service->createItem($data);
            
            $item = MfpProcurementReleaseListResource::make($items);
            
            return $this->respondWithSuccess($item);
        //} catch (\Throwable $th) {
             return $this->respondWithError($th);
       // }
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $items = $this->service->getReleaseDetails($id);   

        $items = MfpProcurementReleaseListResource::make($items);  
        return $this->respondWithSuccess($items); 
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
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
    }

    
    public function getReleasedFundDetails($id)
    {
        $items = $this->service->getReleasedFundDetails($id);   

        $items = MfpProcurementReleaseDetailsResource::make($items);  
        return $this->respondWithSuccess($items); 
    }    

    public function getMfpProcurementFundReceivedList(Request $request)
    {
        $this->checkPermission("fund_management_view_mfp_procurement_received_fund");
        $items = $this->service->getMfpProcurementFundReceivedList($request);   
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

    public function getMfpProcurementReceivedFundLogs($id)
    {
        $this->checkPermission("fund_management_view_mfp_procurement_received_fund");
        $items = $this->service->getMfpProcurementReceivedFundLogs($id);   
        $items = MfpProcurementFundReceivedHistoryResource::collection($items);
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
    public function getMfpProcurementReceivedCommission($id)
    {
        //$this->checkPermission("fund_management_view_mfp_procurement_received_fund");
        $items = $this->service->getMfpProcurementReceivedCommission($id);   
        $items = MfpProcurementCommissionReceivedDetailResource::collection($items);
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
    public function getAllMfpProcurementCommission(Request $request)
    {
        //$this->checkPermission("fund_management_view_dia_commission_details");
        $items = $this->service->getAllMfpProcurementCommission($request);   
        $items = MfpProcurementCommissionReceivedDetailResource::collection($items);
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
    public function getSiaMfpProcurementCommission(Request $request)
    {
        //$this->checkPermission("fund_management_view_dia_commission_details");
        $items = $this->service->getSiaMfpProcurementCommission($request);   
        $items = MfpProcurementReleaseHistory::collection($items);
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
    public function getMfpProcurementReceivedFundData($id)
    {
        $this->checkPermission("fund_management_view_mfp_procurement_received_fund");
        $items = $this->service->getMfpProcurementReceivedFundData($id);   
        $items = MfpListingResource::make($items);       
        return $this->respondWithSuccess($items);      
        
    } 

      public function getProcurementAgentList()
    {
        //$this->checkPermission("user_management_view");
        $items = $this->service->getProcurementAgentList();   
        $items = UserResource::collection($items);
        return $this->respondWithSuccess($items);
    } 
    public function addDiaReleaseFundToProcurementAgent(Request $request)
    {
        $user = Auth::user();
        $user_id=$user->id;
        $this->checkPermission("fund_management_release_fund");
        
        try {
            $valid = $this->service->validateCreateDiaReleaseFund($request->all());
            if ($valid->fails()) {
                return $this->respondWithValidationError($valid);
            }
            $data = $valid->validated();
            
            $procurement=Mfp_procurement::where(['ref_id'=>$data['id'],'created_by'=>$user_id])->first();

            $seasonalibility=MfpSeasionalityQuarterWiseResource::make($procurement);
            $seasonalibility=$this->getResourceData($seasonalibility);
            $seasonalibility=$this->mfpProcurementService->getSeasonalityCommodityDetails($seasonalibility);
            
            $item = $this->service->addDiaReleaseFundToProcurementAgent($data,$procurement,$seasonalibility);
            
            //$item = MfpProcurementReleaseListResource::make($items);
            
            return $this->respondWithSuccess($item);
        } catch (\Throwable $th) {
             return $this->respondWithError($th);
        }
    }
    public function fundReceivedProcurementAgent(Request $request)
    {
        $this->checkPermission("fund_management_view_procurement_agent_fund_details");
        $items = $this->service->getFundReceivedProcurementAgent($request);   
        $items = MfpProcurementFundReceivedProcurementAgentResource::collection($items);
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


    public function fundReceivedProcurementAgentDetail(Request $request)
    {
        $this->checkPermission("fund_management_view_procurement_agent_fund_details");
        $summary = $this->service->getFundReceivedProcurementAgentDetail($request);   
        $mfp_procurement_id=$summary['mfp_procurement_id'];
        $procurement_agent=$summary['procurement_agent'];
        $data['procurement_agent_name']=$summary['procurement_agent_name'];

        
        $items = $this->service->getReleaseCommodityCount($mfp_procurement_id,$procurement_agent,$request);   
        $items = MfpProcurementFundReceivedProcurementAgentDetailResource::collection($items);
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
            $data['result']=$json_data;
            return $this->respondWithSuccess($data);    
        }else{
            return $this->respondWithSuccess($items);
        }
     }
     public function getMfpProcurementPAFundReceivedList(Request $request)
    {
        $this->checkPermission("fund_management_view_procurement_agent_received_fund");
        $items = $this->service->getMfpProcurementPAFundReceivedList($request);   
        $items = MfpProcurementFundReceivedProcurementAgentResource::collection($items);

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
    public function getMfpProcurementAgentReleasedetail($id)
    {
    	$this->checkPermission("fund_management_view_procurement_agent_fund_details");
        $items = $this->service->getFundReleaseDetail($id);   
        $items = MfpProcurementFundReceivedProcurementAgentDetailResource::make($items);
        
        return $this->respondWithSuccess($items);    
        

    }
    public function getMfpProcurementAgentMfpList($id)
    {
    	$items = $this->service->getMfpProcurementAgentMfpList($id);   
        $items = MfpResource::collection($items);
        
        return $this->respondWithSuccess($items); 
    }

       public function getMfpProcurementReceivedFund($id)
    { 
        $items = $this->service->getMfpProcurementReceivedFund($id);   
        $items = MfpListingResource::make($items);       
            return $this->respondWithSuccess($items);      
        
    } 

    public function getWarehouseTransactionList(Request $request){
        $items = $this->service->getWarehouseTransactionList($request);
        $items = TransactionResource::collection($items);    
        //$items = WarehouseTransactionListingResource::collection($items);       
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
     * Get Released
     * 
     */
    public function getReleasedDetailsToProcurementagent($id){
        $items = $this->service->getReleasedDetailsToProcurementagent($id);  
        return $this->respondWithSuccess($items);     
    }
}
