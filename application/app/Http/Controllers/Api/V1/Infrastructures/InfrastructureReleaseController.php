<?php

namespace App\Http\Controllers\Api\V1\Infrastructures;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Api\V1\ApiController;
use App\Http\Resources\Api\ReleaseFund\InfrastructureReleaseListResource;
use App\Http\Resources\Api\ReleaseFund\InfrastructureReleaseFundDetailsResource;
use App\Http\Resources\Api\ReleaseFund\InfrastructureFundReceivedHistoryResource;
use App\Http\Resources\Api\ReleaseFund\ReceivedFundListingResource;
use App\Http\Resources\Api\ReleaseFund\InfrastructureCommissionReceivedDetailResource;

use App\Http\Resources\Api\ReleaseFund\InfrastructureReleaseHistory;
use App\Http\Resources\Api\Actualdetail\ActualDetailInfrastructureResource;
use App\Services\Infrastructures\InfrastructureReleaseFundService;


class InfrastructureReleaseController extends ApiController
{
    protected $service;

    public function __construct(InfrastructureReleaseFundService $infrastructureReleaseFundService)
    {
        $this->service = $infrastructureReleaseFundService;
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
        $items = InfrastructureReleaseListResource::collection($items);
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
        
        try {
            $valid = $this->service->validateCreate($request->all());

            if ($valid->fails()) {
                return $this->respondWithValidationError($valid);
            }

            $data = $valid->validated();
            $items = $this->service->createItem($data);
            
            $item = InfrastructureReleaseListResource::make($items);
            
            return $this->respondWithSuccess($item);
        } catch (\Throwable $th) {
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
        $items = $this->service->getReleaseDetails($id);   

        $items = InfrastructureReleaseListResource::make($items);  
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
        $items = InfrastructureReleaseFundDetailsResource::make($items);  
        return $this->respondWithSuccess($items); 
    }    

    public function getFundReceivedList(Request $request)
    {
        $this->checkPermission("fund_management_infrastructure_development_received_fund");
        $items = $this->service->getFundReceivedList($request);   
        $items = ReceivedFundListingResource::collection($items);
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


    public function getReceivedFundLogs($id)
    {
        $this->checkPermission("fund_management_infrastructure_development_received_fund");
        $items = $this->service->getReceivedFundLogs($id);   
        $items = InfrastructureFundReceivedHistoryResource::collection($items);
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
    

    public function addInfraActualDetails(Request $request)
    {  
        $this->checkPermission("fund_management_release_fund");        
       // try {
            $valid = $this->service->validateActualDetails($request->all());

            if ($valid->fails()) {
                return $this->respondWithValidationError($valid);
            }
            $data = $valid->validated();                     
            $items = $this->service->addInfraActualDetails($data);
            $item = ActualDetailInfrastructureResource::make($items);            
            return $this->respondWithSuccess($item);
        // } catch (\Throwable $th) {
        //      return $this->respondWithError($th);
        // }
    }

    public function getInfraActualDetails($id)
    { 
       $items = $this->service->getInfraActualDetails($id); 
        $item = ActualDetailInfrastructureResource::make($items);  
        return $this->respondWithSuccess($item); 
    }
    
    public function getInfraProgressList(Request $request)
    { 
       $items = $this->service->getInfraProgressList($request); 
        $items = ActualDetailInfrastructureResource::collection($items);  
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
    

      public function getInfraTransactionList(Request $request)
    { 
       $items = $this->service->getInfraTransactionList($request); 
        $items = ActualDetailInfrastructureResource::collection($items);  
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

    
      public function getInfraConsolidatedProposalList(Request $request)
    { 
       $items = $this->service->getInfraConsolidatedProposalList($request); 
        $items = ActualDetailInfrastructureResource::collection($items);  
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

      public function getConsolidatedTransactionList(Request $request)
    { 
       $items = $this->service->getConsolidatedTransactionList($request); 
        $items = ActualDetailInfrastructureResource::collection($items);  
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

      public function getActualProposalList(Request $request)
    { 
       $items = $this->service->getActualProposalList($request->all()); 
        $items = ActualDetailInfrastructureResource::collection($items);  
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

    public function editInfraActualDetails(Request $request)
    {
        $this->checkPermission("fund_management_release_fund");        
        try {
            $valid = $this->service->validateEditActualDetails($request->all());

            if ($valid->fails()) {
                return $this->respondWithValidationError($valid);
            }
            $data = $valid->validated();  
            //$ActualInfra=$this->service->getActualInfraOne($data['id']); 
            $items = $this->service->updateInfraActualDetails($data['id'], $data);   
            $item = ActualDetailInfrastructureResource::make($items);            
            return $this->respondWithSuccess($item);
         } catch (\Throwable $th) {
              return $this->respondWithError($th);
         }
    }

    public function getInfrastructureReceivedCommission($id)
    {
        //$this->checkPermission("fund_management_view_mfp_procurement_received_fund");
        $items = $this->service->getInfrastructureReceivedCommission($id);   
        $items = InfrastructureCommissionReceivedDetailResource::collection($items);
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

      public function getAllInfrastructureCommission(Request $request)
    {
       // $this->checkPermission("fund_management_view_dia_commission_details");
        $items = $this->service->getAllInfrastructureCommission($request);   
        $items = InfrastructureCommissionReceivedDetailResource::collection($items);
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

     public function getSiaInfrastructureCommission(Request $request)
    {  
        //$this->checkPermission("fund_management_view_dia_commission_details");
        $items = $this->service->getSiaInfrastructureCommission($request);   
        $items = InfrastructureReleaseHistory::collection($items);
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

