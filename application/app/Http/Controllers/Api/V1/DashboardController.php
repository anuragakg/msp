<?php

namespace App\Http\Controllers\Api\V1;

use Illuminate\Http\Request;
use App\Http\Controllers\Api\V1\ApiController;
use App\Services\DashboardService;
use App\Http\Resources\Api\DashboardResource as ApiResource;
use App\Http\Resources\Api\MobileDashboardResource as MobileApiResource;

class DashboardController extends ApiController
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
    public function index(Request $request)
    {
        $reqBody    = $request->all();
        $valid      = $this->service->validateData($reqBody);

        if ($valid->fails()) {
            return $this->respondWithValidationError($valid);
        }
        
        $data = $valid->validated();
        $item = $this->service->getItem($data);
        $item = ApiResource::make($item);

        return $this->respondWithSuccess($item);
    }

    public function mobileDashboard(Request $request)
    {
        $item = $this->service->mobileDashboard();
        $item = MobileApiResource::make($item);

        return $this->respondWithSuccess($item);
    }
      public function captureDashboard(Request $request)
    {
        $item = $this->service->captureDashboard(); 
        return $this->respondWithSuccess($item);
    }
    public function public_dashboard(Request $request)
    {
        $reqBody    = $request->all();
        $valid      = $this->service->validateData($reqBody);

        if ($valid->fails()) {
            return $this->respondWithValidationError($valid);
        }
        
        $data = $valid->validated();
        $item = $this->service->get_public_dashboard($data);
        $item = ApiResource::make($item);

        return $this->respondWithSuccess($item);
    }
    public function vdvk_rolewise(Request $request)
    {
        $data=array();
        $reqBody    = $request->all();
        $valid      = $this->service->validate_rolewise_filter($reqBody);

        if ($valid->fails()) {
            return $this->respondWithValidationError($valid);
        }
        
        $data = $valid->validated();

        $item = $this->service->vdvk_rolewise($data);
        //$item = ApiResource::make($item);

        return $this->respondWithSuccess($item);
    }
    public function vdvk_role_statewise(Request $request)
    {
        $data=array();
        $reqBody    = $request->all();
        $valid      = $this->service->validate_role_statewise_filter($reqBody);

        if ($valid->fails()) {
            return $this->respondWithValidationError($valid);
        }
        
        $data = $valid->validated();

        $item = $this->service->vdvk_role_statewisewise($data);
        //$item = ApiResource::make($item);

        return $this->respondWithSuccess($item);
    }
    public function vdvk_role_districtwise(Request $request)
    {
        $data=array();
        $reqBody    = $request->all();
        $valid      = $this->service->validate_role_districtwise_filter($reqBody);

        if ($valid->fails()) {
            return $this->respondWithValidationError($valid);
        }
        
        $data = $valid->validated();

        $item = $this->service->vdvk_role_districtwise($data);
        //$item = ApiResource::make($item);

        return $this->respondWithSuccess($item);
    }
    public function vdvk_role_blockwise(Request $request)
    {
        $data=array();
        $reqBody    = $request->all();
        $valid      = $this->service->validate_role_blockwise_filter($reqBody);

        if ($valid->fails()) {
            return $this->respondWithValidationError($valid);
        }
        
        $data = $valid->validated();

        $item = $this->service->vdvk_role_blockwise($data);
        //$item = ApiResource::make($item);

        return $this->respondWithSuccess($item);
    }
    public function rolewise_vdvk_list(Request $request)
    {
        $data=array();
        $reqBody    = $request->all();
        $valid      = $this->service->validate_rolewise_vdvk_filter($reqBody);

        if ($valid->fails()) {
            return $this->respondWithValidationError($valid);
        }
        
        $data = $valid->validated();

        $item = $this->service->rolewise_vdvk_list($data);
        //$item = ApiResource::make($item);

        return $this->respondWithSuccess($item);
    }
    public function vdvk_statewise(Request $request)
    {
        $data=array();
        $reqBody    = $request->all();
        $valid      = $this->service->validate_statewise_filter($reqBody);

        if ($valid->fails()) {
            return $this->respondWithValidationError($valid);
        }
        
        $data = $valid->validated();

        $item = $this->service->vdvk_statewise($data);
        //$item = ApiResource::make($item);

        return $this->respondWithSuccess($item);
    }

    public function vdvk_districtwise(Request $request)
    {
        $data=array();
        $reqBody    = $request->all();
        $valid      = $this->service->validate_districtwise_filter($reqBody);
        
        if ($valid->fails()) {
            return $this->respondWithValidationError($valid);
        }
        
        $data = $valid->validated();
        
        $item = $this->service->vdvk_districtwise($data);
        //$item = ApiResource::make($item);

        return $this->respondWithSuccess($item);
    }

    public function vdvk_blockwise(Request $request)
    {
        $data=array();
        $reqBody    = $request->all();
        $valid      = $this->service->validate_blockwise_filter($reqBody);
        
        if ($valid->fails()) {
            return $this->respondWithValidationError($valid);
        }
        
        $data = $valid->validated();
        
        $item = $this->service->vdvk_blockwise($data);
        //$item = ApiResource::make($item);

        return $this->respondWithSuccess($item);
    }

    public function warehouse_statewise(Request $request)
    {
        $data=array();
        $reqBody    = $request->all();
        $valid      = $this->service->validate_warehouse_statewise_filter($reqBody);

        if ($valid->fails()) {
            return $this->respondWithValidationError($valid);
        }
        
        $data = $valid->validated();

        $item = $this->service->warehouse_statewise($data);
        //$item = ApiResource::make($item);
       
        return $this->respondWithSuccess($item);
    }
    public function haatbazaar_statewise(Request $request)
    {
        $data=array();
        $reqBody    = $request->all();
        $valid      = $this->service->validate_haatbazaar_statewise_filter($reqBody);

        if ($valid->fails()) {
            return $this->respondWithValidationError($valid);
        }
        
        $data = $valid->validated();

        $item = $this->service->haatbazaar_statewise($data);
        //$item = ApiResource::make($item);

        return $this->respondWithSuccess($item);
    }
    public function dashboard_states(Request $request)
    {
        $items = $this->service->get_dashboard_states();
        //$items = ApiResource::collection($items);

        return $this->respondWithSuccess($items);
    }
    public function dashboard_districts(Request $request)
    {
        $reqBody    = $request->all();
        $state_id=$reqBody['state_id'];
        if($state_id)
        {
            $items = $this->service->get_dashboard_districts($state_id);
            //$items = ApiResource::collection($items);

            return $this->respondWithSuccess($items);        
        }
        
    }
    public function dashboard_blocks(Request $request)
    {
        $reqBody    = $request->all();
        $district_id=$reqBody['district_id'];
        if($district_id)
        {
            $items = $this->service->get_dashboard_blocks($district_id);
            //$items = ApiResource::collection($items);

            return $this->respondWithSuccess($items);        
        }
        
    }
    public function sanctioned_sndwise(Request $request)
    {
        $reqBody    = $request->all();
        $items = $this->service->sanctioned_sndwise($reqBody);
        return $this->respondWithSuccess($items);        
    }

    public function view_sanctioned_sndwise(Request $request)
    {
        $reqBody    = $request->all();
        $items = $this->service->view_sanctioned_sndwise($reqBody);
        return $this->respondWithSuccess($items);        
    }

    public function sanctioned_releasewise(Request $request)
    {
        $reqBody    = $request->all();
        $items = $this->service->sanctioned_releasewise($reqBody);
        return $this->respondWithSuccess($items);        
    }

    public function view_sanctioned_releasewise(Request $request)
    {
        $reqBody    = $request->all();
        $items = $this->service->view_sanctioned_releasewise($reqBody);
        return $this->respondWithSuccess($items);        
    }

    public function statewise_surveyor(Request $request)
    {
        $reqBody    = $request->all();
        $items = $this->service->statewise_surveyor($reqBody);
        return $this->respondWithSuccess($items);        
    }
    public function statewise_supervisor(Request $request)
    {
        $reqBody    = $request->all();
        $items = $this->service->statewise_supervisor($reqBody);
        return $this->respondWithSuccess($items);        
    }
    public function state_shg_gatherer(Request $request)
    {
        $reqBody    = $request->all();
        $items = $this->service->state_shg_gatherer($reqBody);
        
        if($items!='401'){
            return $this->respondWithSuccess($items);  
        }
        return $this->respondWithError('You are not allowed to see SHG group');        
    }
    public function district_shg_group(Request $request)
    {
        $reqBody    = $request->all();
        $items = $this->service->district_shg_group($reqBody);
        
        if($items!='401'){
            return $this->respondWithSuccess($items);  
        }
        return $this->respondWithError('You are not allowed to see SHG group');        
    }
    public function block_shg_group(Request $request)
    {
        $reqBody    = $request->all();
        $items = $this->service->block_shg_group($reqBody);
        
        if($items!='401'){
            return $this->respondWithSuccess($items);  
        }
        return $this->respondWithError('You are not allowed to see SHG group');        
    }
}
