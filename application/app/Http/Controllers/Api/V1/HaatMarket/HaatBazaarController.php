<?php

namespace App\Http\Controllers\Api\V1\HaatMarket;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Api\V1\ApiController;
use App\Http\Resources\Api\HaatMarketAllResource;
use App\Http\Resources\Api\HaatMarketResource as ApiResource;
use App\Services\HaatBazaarService;

class HaatBazaarController extends ApiController
{

    protected $service;

    public function __construct(HaatBazaarService $haatBazaarService)
    {
        $this->service = $haatBazaarService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
       
    }


    /**
     * To get all Haat market from district
     */
    public function getAllHaatMarket($id)
    {
        try {
            $item = $this->service->getOne($id);
            return $this->respondWithSuccess($item);
        } catch (\Exception $th) {
             return $this->respondNotFound($th);
        }
    }


    /**
     * To get block of haat
     */
    public function getHaatBlock($id)
    {
        try {
            $item = $this->service->getHaatBlock($id);
            return $this->respondWithSuccess($item);
        } catch (\Exception $th) {
             return $this->respondNotFound($th);
        }
    }



    
}
