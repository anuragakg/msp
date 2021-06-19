<?php

namespace App\Http\Controllers\Api\V1;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\Api\V1\ApiController;

use App\Http\Resources\Api\Commodity\ShgCommodityResource;
use App\Http\Resources\Api\Commodity\HaatMarketCommodityResource;
use App\Http\Resources\Api\Commodity\WarehouseCommodityResource;
use Illuminate\Http\Request;
use App\Services\Commodity\CommodityService;

class MisReportCommodityController extends ApiController
{


    private $service;

    public function __construct(CommodityService $commodityService)
    {
        $this->service = $commodityService;
    }

    public function getAllShgCommodity(Request $request){
        try {
            $item = $this->service->getAllShgMisReport($request->all());
            $item = ShgCommodityResource::collection($item);
            return $this->respondWithSuccess($item);
        } catch (\Exception $th) {
            return $this->respondNotFound($th);
        }
    }


        public function getAllHaatMarketCommodity(Request $request){

        try {
            $item = $this->service->getHaatMarketMisReport($request->all());
            $item = HaatMarketCommodityResource::collection($item);
            return $this->respondWithSuccess($item);
        } catch (\Exception $th) {
            return $this->respondNotFound($th);
        }
    }

    public function getWarehouseCommodity(Request $request){
        $this->checkPermission();
        try {
            $item = $this->service->getWarehouseMisReport($request->all());
            $item = WarehouseCommodityResource::collection($item);
            return $this->respondWithSuccess($item);
        } catch (\Exception $th) {
            return $this->respondNotFound($th);
        }
    }
}
