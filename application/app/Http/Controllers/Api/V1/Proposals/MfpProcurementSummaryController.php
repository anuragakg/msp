<?php

namespace App\Http\Controllers\Api\V1\Proposals;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Api\V1\ApiController;
use App\Http\Resources\Api\Proposals\MfpProcurementResource as ApiResource;
use App\Services\Proposals\MfpProcurementSummaryService;

class MfpProcurementSummaryController extends ApiController
{
    protected $service;

    public function __construct(MfpProcurementSummaryService $mfpProcurementSummaryService)
    {
        $this->service = $mfpProcurementSummaryService;
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
      
       
        if(isset($data['form_id']) && !empty($data['form_id']))
        {
            $items = $this->service->updateItem($data['form_id'], $data);         
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
        try {
            $item = $this->service->getOne($id);
            $item = ApiResource::make($item);
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
        //$this->checkPermission("master_management_status");

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

  
  }
