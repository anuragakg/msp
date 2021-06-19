<?php

namespace App\Http\Controllers\Api\V1\Proposals;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Api\V1\ApiController;
use App\Services\Proposals\MfpProcurementGenerateReceiptService;
use App\Http\Resources\Api\Actualdetail\ProcurementReceiptResource as ApiResource;

class MfpProcurementGenerateReceiptController extends ApiController
{
    protected $service;

    public function __construct(MfpProcurementGenerateReceiptService $mfp_procurement_generate_receipt)
    {
        $this->service = $mfp_procurement_generate_receipt;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->checkPermission("mfp_procurement_actual_details_view_generated_receipt");
        $items = $this->service->getAll($request);
        $items = ApiResource::collection($items);
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
        $this->checkPermission("mfp_procurement_actual_details_generate_receipt");
        //
        $valid = $this->service->validateCreate($request->all());

        if ($valid->fails()) {
            return $this->respondWithValidationError($valid);
        }

        try{
            $data = $valid->validated();
          
            $item = $this->service->createItem($data);
            
            //$item = ApiResource::make($item);
            
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
        $this->checkPermission("mfp_procurement_actual_details_view_generated_receipt");
        try {
            $item = $this->service->getOne($id);
            $item = ApiResource::make($item);
            return $this->respondWithSuccess($item);
        }catch(\Exception $th){
            return $this->respondWithError($th);
        }
    }

    
}
