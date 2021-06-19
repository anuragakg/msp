<?php

namespace App\Http\Controllers\Api\V1\Masters;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Api\V1\ApiController;
use App\Http\Resources\Api\Masters\PermissionMappingMasterResource as ApiResource;
use App\Services\Masters\PermissionMappingService;
use DB;

class PermissionMappingController extends ApiController
{
    protected $service;

    public function __construct(PermissionMappingService $PermissionMappingService)
    {
        $this->service = $PermissionMappingService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->checkPermission("admin_permission_management");
        $items = $this->service->getAll();

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
        $this->checkPermission("admin_permission_management");
        //
        $valid = $this->service->validateCreate($request->all());

        if ($valid->fails()) {
            return $this->respondWithValidationError($valid);
        }

        $data = $valid->validated();
        try {
            $res = $this->service->createItem($data);

            return $this->respondWithSuccess($res);
        }catch (\Throwable $th) {
            return $this->respondWithError('Error Creating Resource');
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
        $this->checkPermission("admin_permission_management");
        try {

            $item = $this->service->getOne($id);

            

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
        $this->checkPermission("admin_permission_management");
        $data=$request->all();
        
        $valid = $this->service->validateUpdate( $data);

        if ($valid->fails()) {
            return $this->respondWithValidationError($valid);
        }

        $data = $valid->validated();
        try {
            $res = $this->service->createItem($data);

            return $this->respondWithSuccess($res);
        }catch (\Throwable $th) {
            return $this->respondWithError('Error Creating Resource');
        }
    }

    public function destroy($id)
    {
        $this->checkPermission("admin_permission_management");

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
        $this->checkPermission("admin_permission_management");
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
    
}
