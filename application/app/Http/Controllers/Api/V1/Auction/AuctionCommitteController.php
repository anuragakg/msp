<?php

namespace App\Http\Controllers\Api\V1\Auction;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Api\V1\ApiController;
use App\Http\Resources\Api\UserResource;
use App\Http\Resources\Api\Auction\AuctionCommitteListingResource;
use App\Http\Resources\Api\Auction\AuctionCommitteDetailResource;
use App\Services\Auction\AuctionCommitteService;

class AuctionCommitteController extends ApiController
{
    protected $service;

    public function __construct(AuctionCommitteService $auctionCommitteService)
    {
        $this->service = $auctionCommitteService;
    }

    /**
     * Display a listing of the commitee members.
     *
     * @return \Illuminate\Http\Response
     */
    public function getCommitteMember()
    {
        try {
            $item = $this->service->getCommitteMember();
            $item = UserResource::collection($item);
            return $this->respondWithSuccess($item);
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
        $this->checkPermission("auction_view_committe");
        $items = $this->service->getAll($request);
        $items = AuctionCommitteListingResource::collection($items);
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
        $this->checkPermission("auction_create_committe");
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
            
            
           // $item = ApiResource::make($items);
            
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
        $this->checkPermission("auction_view_committe");
        $items = $this->service->getOne($id);
        $items = AuctionCommitteDetailResource::make($items);
        return $this->respondWithSuccess($items);
    }
}
