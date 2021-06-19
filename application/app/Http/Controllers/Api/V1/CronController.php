<?php

namespace App\Http\Controllers\Api\V1;

use Illuminate\Http\Request;
use App\Http\Controllers\Api\V1\ApiController;
use App\Services\DashboardService;
use App\Http\Resources\Api\DashboardResource as ApiResource;
use App\Http\Resources\Api\MobileDashboardResource as MobileApiResource;
use DB;
class CronController extends ApiController
{
    protected $service;

    public function __construct(DashboardService $dashboardService)
    {
        $this->service = $dashboardService;
    }


     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function cronjob(Request $request)
    {
        $reqBody    = $request->all();
        $state_data=DB::connection('mysql2')->select('select * from states_master');
        
        return $this->respondWithSuccess($item);
    }

    
}
