<?php

namespace App\Http\Controllers\Api\V1\Masters;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Api\V1\ApiController;
use App\Http\Resources\Api\Masters\CommodityMasterResource as ApiResource;
use App\Services\Masters\CommodityService;


/**
 * Commodity and MFP Master controller.
 * 
 */
class CommodityController extends ApiController
{

    protected $service;

    public function __construct(CommodityService $commodityService)
    {
        $this->service = $commodityService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->checkPermission("master_management_view");        
        $items = $this->service->getAll($request->all());

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
        $this->checkPermission("master_management_add");

        $valid = $this->service->validateCreate($request->all());

        if ($valid->fails()) {
            return $this->respondWithValidationError($valid);
        }

        $data = $valid->validated();

        $data['photo'] = '/';
        $data['quality'] = '/';

        if ($request->hasFile('photo')) {
            $data['photo'] = $request->file('photo')->store('masters/mfp');
        }
        if ($request->hasFile('quality')) {
            $data['quality'] = $request->file('quality')->store('masters/mfp');        
        }


        $data['status'] = 1; // By default status is 1.
        $data['created_by'] = Auth::user()->id;
        $data['updated_by'] = Auth::user()->id;

        $item = $this->service->createItem($data);

        $item = ApiResource::make($item);

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
        $this->checkPermission("master_management_view");
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
        $this->checkPermission("master_management_edit");

        $valid = $this->service->validateUpdate($id, $request->all());

        if ($valid->fails()) {
            return $this->respondWithValidationError($valid);
        }

        $data = $valid->validated();

        
        if ($request->hasFile('photo')) {
            $data['photo'] = $request->file('photo')->store('masters/mfp');
        }
        if ($request->hasFile('quality')) {
            $data['quality'] = $request->file('quality')->store('masters/mfp');
        }

        try {
            $data['status'] = 1;
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
    
    public function getCommodities()
    {
     
        $items = $this->service->getCommodities();

        $items = ApiResource::collection($items);

        return $this->respondWithSuccess($items);
    }
       
     public function getCommoditiesWiseState(Request $request)
    {
     
        $items = $this->service->getCommoditiesWiseState($request->all());

        $items = ApiResource::collection($items);

        return $this->respondWithSuccess($items);
    }    
}
