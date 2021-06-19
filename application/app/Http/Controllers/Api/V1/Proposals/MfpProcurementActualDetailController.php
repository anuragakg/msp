<?php

namespace App\Http\Controllers\Api\V1\Proposals;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Api\V1\ApiController;
use App\Http\Resources\Api\Actualdetail\ActualTribalDetailListingResource; 
use App\Http\Resources\Api\Actualdetail\MfpStorageDetailsResource; 
use App\Http\Resources\Api\Actualdetail\ActualTribalDetailResource;
use App\Http\Resources\Api\Actualdetail\ConsolidatedTransactionResource;
use App\Http\Resources\Api\Actualdetail\ProcurementTransactionResource;
use App\Http\Resources\Api\Shg\ShgViewOneResource;
use App\Http\Resources\Api\Masters\MfpResource;
use App\Services\Proposals\MfpProcurementActualDetailService;
use App\Http\Resources\Api\UserResource;
use App\Models\Actualdetail\Mfp_procurement_actual_detail;
use App\Models\Proposals\Mfp_procurement;
use App\Models\Proposals\Mfp_procurement_transaction;

class MfpProcurementActualDetailController extends ApiController
{
    protected $service;

    public function __construct(MfpProcurementActualDetailService $MfpProcurementActualDetailService)
    {
        $this->service = $MfpProcurementActualDetailService;
    }
    public function getTribalDetailFromIdProof(Request $request)
    {
        try{
            $items = $this->service->getTribalDetailFromIdProof($request);
            $items=ShgViewOneResource::make($items);    
            return $this->respondWithSuccess($items); 
        }catch (\Throwable $th) {
             return $this->respondWithError('Tribal person related to this is is not present,Please try right ID');
        }
        
        
    }

    public function getTribalDetailFromName(Request $request)
    {
        try{
            $items = $this->service->getTribalDetailFromName($request);
            $items=ShgViewOneResource::collection($items);    
            return $this->respondWithSuccess($items); 
        }catch (\Throwable $th) {
             return $this->respondWithError('Tribal person related to this is is not present,Please try right ID');
        }
        
        
    }

    public function getFundAvailable(Request $request)
    {
        try{
            $items = $this->service->getFundAvailableAtPa($request);
            return $this->respondWithSuccess($items); 
        }catch (\Throwable $th) {
             return $this->respondWithError($th);
        }
        
        
    }


    public function getProcurementAgentProposals($id)
    {
        try{
            $items = $this->service->getProcurementAgentProposals($id);
           
            return $this->respondWithSuccess($items); 
        }catch (\Throwable $th) {
             return $this->respondWithError($th);
        }
    }
    public function getProcurementAgentProposalsMfp($id)
    {
        try{
            $items = $this->service->getProcurementAgentProposalsMfp($id);
            $items=MfpResource::collection($items);
            return $this->respondWithSuccess($items); 
        }catch (\Throwable $th) {
             return $this->respondWithError($th);
        }
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->checkPermission("mfp_procurement_actual_details_view");
        try {
            $items = $this->service->getAll($request);
            $items = ActualTribalDetailListingResource::collection($items);
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
        }catch (\Throwable $th) {
             return $this->respondWithError($th);
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
        $this->checkPermission("mfp_procurement_actual_details_add");
        
        try {
            $valid = $this->service->validateCreate($request->all());

            if ($valid->fails()) {
                return $this->respondWithValidationError($valid);
            }

            $data = $valid->validated();
            $item = $this->service->createItem($data);
            
           // $item = MfpProcurementReleaseListResource::make($items);
            
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
        $this->checkPermission("mfp_procurement_actual_details_view");
        try {
            $item = $this->service->getOne($id);
            $item = ActualTribalDetailResource::make($item);
            return $this->respondWithSuccess($item);
        } catch (\Exception $th) {
            return $this->respondNotFound();
        }
    }
    public function addMfpStorageDetails(Request $request)
    {
       // $this->checkPermission("mfp_procurement_actual_details_add");
        try {
            $valid = $this->service->validateMfpStorage($request->all());

            if ($valid->fails()) {
                return $this->respondWithValidationError($valid);
            }

            $data = $valid->validated();         
            $item = $this->service->addMfpStorageDetails($data); 
            return $this->respondWithSuccess($item);
        } catch (\Throwable $th) {
             return $this->respondWithError($th);
        }

    }

    public function viewMfpStorageDetails($id)
    { 
       try{
            $items = $this->service->getMfpStorageDetails($id);
           // $item = MfpStorageDetailsResource::make($items);
           $item = MfpStorageDetailsResource::collection($items);
            return $this->respondWithSuccess($item); 
        }catch (\Throwable $th) {
             return $this->respondWithError($th);
        }
    }

    public function transactionDetailsList(Request $request){
        $items = $this->service->getTransactionDetails($request);
        //$items = ActualTribalDetailListingResource::collection($items);
        $items = ProcurementTransactionResource::collection($items);
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

    /****
     * Consolidate transaction of procurement
     * 
     */

    public function consolidateTransaction(Request $request)
    {
        //try {
            $valid = $this->service->validateTransactionIds($request->all());

            if ($valid->fails()) {
                return $this->respondWithValidationError($valid);
            }

            $data = $valid->validated();
            $year_arr = array();
            $district_arr = array();
            $proposal_ids_arr = array();
            foreach ($request['transactions'] as $key => $transaction) {
                $procurement = Mfp_procurement_transaction::where('transaction_id', $transaction)->first();
                $district = $procurement->district_id;
           
                if (!in_array($district, $district_arr)) {
                    $district_arr[] = $district;
                }
                if (!in_array($procurement->year_id, $year_arr)) {
                    $year = $procurement->year_id;
                    $year_arr[] = $year;
                }
                if (!in_array($procurement->mfp_procurement_id, $proposal_ids_arr)) {
                     $proposal_ids_arr[] = $procurement->id;
                }

            }
            if (count($district_arr) > 1) {
                return $this->respondWithError('Please select transactions of same district for consolidation');
            }
            if (count($year_arr) > 1) {
                return $this->respondWithError('Please select transactions of same year for consolidation');
            }
            if (count($proposal_ids_arr) > 1) {
                 return $this->respondWithError('Please select transactions of same proposal id for consolidation');
            }
            $item = $this->service->consolidate_procurement_transaction($request->all(), $district, $year);
            return $this->respondWithSuccess($item);
       // } catch (\Throwable $th) {
            return $this->respondWithError($th);
        //}
    }

    public function getConsolidatedTransactionList(Request $request){
        $items = $this->service->getConsolidatedTransactionList($request);
        $items = ConsolidatedTransactionResource::collection($items);
       // $items = ActualTribalDetailListingResource::collection($items);
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

    public function approveRevertRejectTransaction(Request $request){
        $items = $this->service->approveRevertRejectTransaction($request->all());
        return $this->respondWithSuccess($items);
    }
    
      public function editMfpStorageDetails(Request $request)
    { 
          try {
            $valid = $this->service->validateMfpStorage($request->all());

            if ($valid->fails()) {
                return $this->respondWithValidationError($valid);
            }

            $data = $valid->validated();  
            $ActualDetails=$this->service->getMfpStoragedata($data['id']);
            $item = $this->service->updateMfpStorageDetails($ActualDetails['id'], $data);         
     
            return $this->respondWithSuccess($item);
        } catch (\Throwable $th) {
             return $this->respondWithError($th);
        }

    }

    public function deleteMfpStorageDetails(Request $request)
    {
        $item=$this->service->deleteMfpStorageDetails($request->all());
        return $this->respondWithSuccess($item);
    }

    public function consolidateTribalTransaction(Request $request){
        
        try {
            $valid = $this->service->validateTribalTransactionIds($request->all());

            if ($valid->fails()) {
                return $this->respondWithValidationError($valid);
            }

            $item = $this->service->consolidate_tribal_transaction($request->all());
            $procurement = Mfp_procurement::where('id',$item->mfp_procurement_id)->first();
            $item->proposal_ref_id = $procurement->ref_id;
            return $this->respondWithSuccess($item);
        } catch (\Throwable $th) {
            return $this->respondWithError($th);
        }
    }

    public function uploadWarehouseReceipt(Request $request){
       
        //$this->checkPermission("mfp_procurement_actual_details_generate_warehouse_receipt");
        //try {
            $valid = $this->service->validateReceipt($request->all());

            if ($valid->fails()) {
                return $this->respondWithValidationError($valid);
            }
    
            $data = $valid->validated();
            
            if(isset($data['receipt']) &&!empty($data['receipt']))
            {
                $data['receipt'] = $request->file('receipt')->store('public/warehouse');     
            }
            $item = $this->service->upload_receipt($data);
            
           // $item = ApiResource::make($items);
           
            return $this->respondWithSuccess($item);
            //$item = $this->service->upload_receipt($request->all());
            //return $this->respondWithSuccess($item);
        // } catch (\Throwable $th) {
        //     return $this->respondWithError($th);
        // }   
    }
}
