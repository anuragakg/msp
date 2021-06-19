<?php

namespace App\Http\Controllers\Api\V1\Proposals;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Api\V1\ApiController;
use App\Http\Resources\Api\Proposals\MfpProcurementPlanResource as ApiResource;
use App\Services\Proposals\MfpProcurementPlanService;
use App\Http\Resources\Api\Proposals\MfpPlanDetailViewResource;

class MfpProcurementPlanController extends ApiController
{
    protected $service;

    public function __construct(MfpProcurementPlanService $MfpProcurementPlanService)
    {
        $this->service = $MfpProcurementPlanService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->checkPermission("mfp_procurement_plan_view");
        $items = $this->service->getAll($request);
        $items = ApiResource::collection($items);
         
            return $this->respondWithSuccess($items); 
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->checkPermission("mfp_procurement_plan_add");
        //
        $valid = $this->service->validateCreate($request->all());       

        if ($valid->fails()) {
            return $this->respondWithValidationError($valid);
        }

        $data = $valid->validated(); 
        $plan_data=$this->service->getOne($data['form_id']);
        if(isset($plan_data) && !empty($plan_data))
        {   
            $items = $this->service->updateItem($data['form_id'], $data);         
        }else{                
            $items = $this->service->createItem($data);

        }
        $item = ApiResource::make($items);
       
        return $this->respondWithSuccess($item);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $this->checkPermission("mfp_procurement_plan_view"); 
            $item = $this->service->getOne($id); 
           if($item){
                $item = ApiResource::make($item);
            }
            return $this->respondWithSuccess($item); 
    }

     public function mfpProcurementPlanDetail($id)
    { 
        //$this->checkPermission("mfp_procurement_plan_view");
        try { 
            $item = $this->service->getAnother($id);
            $item = MfpPlanDetailViewResource::make($item);
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
        $this->checkPermission("mfp_procurement_plan_edit");

        $valid = $this->service->validateUpdate($id, $request->all());

        if ($valid->fails()) {
            return $this->respondWithValidationError($valid);
        }

        $data = $valid->validated();
        try {

            if(isset($data['image']) &&!empty($data['image']))
            {
                $data['image']=$request->file('image')->store('public/mfp');     
            }
            $item = $this->service->updateItem($id, $data);
            $item = ApiResource::make($item);

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
    function updateStatus($id)
    {
        $this->checkPermission("master_management_status");
        try {
            $res = $this->service->switchStatus($id);
            return $this->respondWithSuccess([
                'message' => ($res == 1) ? 'Activated' : 'Deactivated',
                'status' => (int) $res
            ]);
        } catch (\Throwable $th) {
            return $this->respondNotFound($th);
        }
    }

    function getWarehouseHaatmarket(Request $request)
    {
        $item=$this->service->getWarehouseHaatmarket($request->all());
        return $this->respondWithSuccess($item);
    }

    public function getAllCommodity($id)
    {  
        $item = $this->service->getAllCommodity($id);
        return $this->respondWithSuccess($item);
    }
    public function getCostOfPackagingMaterial($id)
    {
        $item=$this->service->getCostOfPackagingMaterial($id);
        return $this->respondWithSuccess($item);
    }
    
    public function getEstimatedProcurement($id){
        $item=$this->service->getEstimatedProcurement($id);
        return $this->respondWithSuccess($item);
    }
}
