<?php

namespace App\Http\Controllers\Api\V1\MspMarketPrice;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Api\V1\ApiController;
use App\Http\Resources\Api\MspMarketPrice\MarketPriceResource as ApiResource;
use App\Http\Resources\Api\MspMarketPrice\MarketPriceLogResource;
use App\Services\MfpMarketPriceService;

class MfpMarketPriceController extends ApiController
{
    protected $service;

    public function __construct(MfpMarketPriceService $MfpMarketPriceService)
    {
        $this->service = $MfpMarketPriceService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //$this->checkPermission("master_management_view");
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
        //$this->checkPermission("master_management_add");
        //
        $valid = $this->service->validateCreate($request->all());

        if ($valid->fails()) {
            return $this->respondWithValidationError($valid);
        }

        $data = $valid->validated();
        
        if(isset($data['form_id']) && !empty($data['form_id']) && $data['form_id']!=0)
        {
            $items = $this->service->updateItem($data['form_id'], $data);         
        }else{
            $items = $this->service->createItem($data);
        }
        
        $items = MarketPriceLogResource::make($items);
        return $this->respondWithSuccess($items);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //$this->checkPermission("master_management_view");
        try {

            $item = $this->service->getOne($id);
            $item = MarketPriceLogResource::make($item);

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
        //$this->checkPermission("master_management_edit");

        $valid = $this->service->validateCreate($request->all());

        if ($valid->fails()) {
            return $this->respondWithValidationError($valid);
        }

        $data = $valid->validated();
        try {
            $item = $this->service->updateItem($id, $data);
            $item = MarketPriceLogResource::make($item);
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

    /**
     * Update Status of the resource
     *
     * @param integer $id
     * @return \Illuminate\Http\Response
     */
    function updateStatus(Request $request)
    {
        //$this->checkPermission("master_management_status");
       // try {
            $item = $this->service->changeStatus($request->all());
            $items = ApiResource::make($item);
            return $this->respondWithSuccess($items);
       // } catch (\Throwable $th) {
            return $this->respondNotFound($th);
        //}
    }

    function getLogs(Request $request)
    {
        try {
            $item = $this->service->getLogs($request->all());
            $items = MarketPriceLogResource::collection($item);
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
                        'total_page'=>$items->lastPage(),
                        );
                
                return $this->respondWithSuccess($json_data);
            }else{
                return $this->respondWithSuccess($items);
            }
        }catch (\Throwable $th) {
            return $this->respondNotFound($th);
        }
    }

    public function getPendingMspMarketPriceList(Request $request)
    {
        $items = $this->service->getPendingMspMarketPriceList($request);
        $items = MarketPriceLogResource::collection($items);
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
                    'total_page'=>$items->lastPage(),
                    );
            
            return $this->respondWithSuccess($json_data);
        }else{
            return $this->respondWithSuccess($items);
        }
    }
    public function getApprovedMspMarketPriceList(Request $request)
    {
        $items = $this->service->getApprovedMspMarketPriceList($request);
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
                    'total_page'=>$items->lastPage(),
                    );
            
            return $this->respondWithSuccess($json_data);
        }else{
            return $this->respondWithSuccess($items);
        }
    }
    public function getPendingForApprovalMspMarketPriceList(Request $request)
    {
        $items = $this->service->getPendingForApprovalMspMarketPriceList($request);
        $items = MarketPriceLogResource::collection($items);
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
                    'total_page'=>$items->lastPage(),
                    );
            
            return $this->respondWithSuccess($json_data);
        }else{
            return $this->respondWithSuccess($items);
        }
    }
}
