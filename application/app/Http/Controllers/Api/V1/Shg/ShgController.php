<?php

namespace App\Http\Controllers\Api\V1\Shg;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Api\V1\ApiController;
use App\Http\Resources\Api\Shg\ShgResource as ApiResource;
use App\Http\Resources\Api\ShgAllResource;
use App\Services\ShgService;
use Excel;
use Illuminate\Support\Facades\Storage;
use App\Exports\ShgMasterExport;

class ShgController extends ApiController
{

    protected $service;

    public function __construct(ShgService $shgService)
    {
        $this->service = $shgService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $this->checkPermission('shg_management_view');
  
        $items = $this->service->getAllVerified();

        $items = ApiResource::collection($items);

        return $this->respondWithSuccess($items);
    }

    public function getAll(Request $request)
    {
        //$this->checkPermission('shg_management_view');
        
        $filters = $request->all();
        if (isset($filters['per_page'])) {
            $check=$this->service->checkPerpage($filters['per_page']);  
            
             if ($check['status']==0) {
                return $this->respondWithValidationError($check['message']);
            }
        }
        $items = $this->service->getAll($filters);
        $items = ApiResource::collection($items);

        $return = [
            'count' => $items->count(),
            'total' => $items->total(),
            'current_page' => $items->currentPage(),
            'next' => $items->nextPageUrl(),
            'previous' => $items->previousPageUrl(),
            'per_page' => $items->perPage(),
            'url' => $items->url(null),
            'gatherers' => $items,
        ];

        return $this->respondWithSuccess($return);
    }

    public function getAllShg($id)
    {
        //$this->checkPermission('shg_management_view');
        try {

            $item = $this->service->getOne($id);
            $item = ShgAllResource::make($item);

            return $this->respondWithSuccess($item);
        } catch (\Exception $th) {
            return $this->respondNotFound($th);
        }
    }

    public function getUnassignedShg(Request $request)
    {
        $this->checkPermission('shg_management_view');

        $queryParams = [
            'per_page' => $request->query('per_page', 20),
        ];

        $items = $this->service->getAllUnassigned($queryParams);

        $records = ApiResource::collection($items);

        $return = [
            'count' => $items->count(),
            'total' => $items->total(),
            'current_page' => $items->currentPage(),
            'next' => $items->nextPageUrl(),
            'previous' => $items->previousPageUrl(),
            'per_page' => $items->perPage(),
            'url' => $items->url(null),
            'records' => $records,
        ];

        return $this->respondWithSuccess($return);
    }

    /**
     * @param $id
     * @return mixed
     * @throws \Exception
     */
    public function destroy($id)
    {

        try {
            $response = $this->service->deleteItem($id);

            if ($response) {
                /** If item is deleted successfully */
                return $this->respondWithSuccess('Item Deleted');
            }

            /** If failed to delete item from db */
            return $this->respondWithError('This shg belongs to Shg Group, So it Could not deleted');
        } catch (\Throwable $th) {
            return $this->respondNotFound();
        }
    }
    /**
     * 
     * Function to export mis report
     */
    public function export()
    {
       
        $this->checkPermission('shg_management_view');
        $items = $this->service->export();
        //return Excel::download($items, 'shg.xlsx');
        Excel::store($items, 'public/export-shg.xlsx');
        $data = [
            "file" => "shg/downloadExportedExcel"
        ];
        return $this->respondWithSuccess($data);
    }

    public function downloadExportedExcel()
    {
        // $this->checkPermission('shg_management_view');
        return Storage::download('public/export-shg.xlsx');
    }

    public function masterExport() 
    {
        Excel::store(new ShgMasterExport, 'public/shg-master.xlsx');
        $data = [
            "file" => "shg/downloadMasterExcel"
        ];
        return $this->respondWithSuccess($data);   
    }

    public function downloadMasterExcel()
    {
        return Storage::download('public/shg-master.xlsx');
    }
    public function getStatewiseShg(Request $request)
    {
        $filters = $request->all();        
        $items = $this->service->getStatewiseShg($filters);
        return $this->respondWithSuccess($items);
    }
    public function getDistrictwiseShg(Request $request)
    {
        $filters = $request->all();       

        $items = $this->service->getDistrictwiseShg($filters);
        return $this->respondWithSuccess($items);
    }
    public function getBlockwiseShg(Request $request)
    {
        $filters = $request->all();       
        
        $items = $this->service->getBlockwiseShg($filters);
        return $this->respondWithSuccess($items);
    }
     public function getShgGroupTotal(Request $request)
    {
       
        $items = $this->service->getShgTotalState($request->all());
        return $this->respondWithSuccess($items);
    }
}
