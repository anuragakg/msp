<?php

namespace App\Http\Controllers\Api\V1\Proposals;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Api\V1\ApiController;
use App\Http\Resources\Api\Proposals\MfpProcurementThirdStepResource as ApiResource;
use App\Http\Resources\Api\Proposals\MfpDetailViewResource;
use App\Services\Proposals\MfpProcurementDisposalService;

class MfpProcurementDisposalController extends ApiController
{
    protected $service;

    public function __construct(MfpProcurementDisposalService $mfpProcurementDisposalService)
    {
        $this->service = $mfpProcurementDisposalService;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $this->checkPermission("mfp_procurement_plan_add");
            //
            $valid = $this->service->validateCreate($request->all());

            if ($valid->fails()) {
                $errors=$valid->errors()->all();
                if(!empty($errors)){
                   $errors= implode('<br>',$errors);
                }
                return $this->respondWithValidationError($errors);
            }

            $data = $valid->validated();
            
           
            $items = $this->service->updateItem($data['form_id'], $data);         
            
            $item = ApiResource::make($items);
            
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
        $this->checkPermission("mfp_procurement_plan_view");
        try {
            $item = $this->service->getOne($id);
            $item = ApiResource::make($item);
            return $this->respondWithSuccess($item);
        } catch (\Exception $th) {
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

    public function getEstimatedValueOfProcurement($id,$mfp_id){
        //$this->checkPermission("mfp_procurement_plan_view");
        try {
            $item = $this->service->getEstimatedValueOfProcurement($id,$mfp_id);
            //$item = ApiResource::make($item);
            return $this->respondWithSuccess($item);
        } catch (\Exception $th) {
            return $this->respondNotFound();
        }    
    }

    public function getProcurementQtyValue($id,$mfp_id){
        try {
            $item = $this->service->getProcurementQtyValue($id,$mfp_id);
            //$item = ApiResource::make($item);
            return $this->respondWithSuccess($item);
        } catch (\Exception $th) {
            return $this->respondNotFound();
        }    
    }

    
    
}
