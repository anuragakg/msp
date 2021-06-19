<?php

namespace App\Http\Controllers\Api\V1\Auction;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Api\V1\ApiController;
use App\Http\Resources\Api\Masters\WarehouseMasterResource;
//use App\Http\Resources\Api\UserResource;
use App\Http\Resources\Api\Auction\AuctionTransactionResource as ApiResource;
use App\Http\Resources\Api\Masters\MfpResource;
use App\Http\Resources\Api\Auction\AuctionTransactionDetailResource;
use App\Services\Auction\AuctionTransactionService;

class AuctionTransactionController extends ApiController
{
    protected $service;

    public function __construct(AuctionTransactionService $auctionTransactionService)
    {
        $this->service = $auctionTransactionService;
    }

    /**
     * Display a listing of the commitee members.
     *
     * @return \Illuminate\Http\Response
     */
    public function getUserDistrict()
    {
        try {
            $item = $this->service->getUserDistrict();
            return $this->respondWithSuccess($item);
        } catch (\Exception $th) {
            return $this->respondNotFound();
        }
    }
    public function getDistrictWarehouse(Request $request)
    {
        try {
            $item = $this->service->getDistrictWarehouse($request->all());
            $items = WarehouseMasterResource::collection($item);
            return $this->respondWithSuccess($items);
        } catch (\Exception $th) {
            return $this->respondNotFound();
        }
    }
    public function getStateMfp(Request $request)
    {
        try {
            $item = $this->service->getStateMfp($request->all());
            $items = MfpResource::collection($item);
            return $this->respondWithSuccess($items);
        } catch (\Exception $th) {
            return $this->respondNotFound();
        }
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->checkPermission("auction_view_transaction_detail");
        $items = $this->service->getAll($request);
        $items = AuctionTransactionDetailResource::collection($items);
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
        $this->checkPermission("auction_create_transaction_detail");
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
            
            
            $items = ApiResource::make($items);
            
            return $this->respondWithSuccess($items);
        }catch(\Exception $th){
            return $this->respondWithError($th);
        }
        
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $this->checkPermission("auction_view_transaction_detail");
        $items = $this->service->getOne($id);
        $items = ApiResource::make($items);
        return $this->respondWithSuccess($items);
    }

    public function getValueAddedProducts(Request $request)
    {
        $items = $this->service->getValueAddedProducts($request);
        return $this->respondWithSuccess($items);
    }
    public function getAuctionCommitteMfp(Request $request)
    {
        try{
            $items = $this->service->getAuctionCommitteMfp($request);
            $items = MfpResource::collection($items);
            return $this->respondWithSuccess($items);    
        }catch (\Exception $th) {
            return $this->respondWithError($th);
        }
    }
}
