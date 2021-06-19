<?php

namespace App\Http\Controllers\Api\V1\Masters;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

use App\Http\Controllers\Api\V1\ApiController;
use App\Http\Resources\Api\Masters\VillageMasterResource as ApiResource;
use App\Services\Masters\VillageService;
use App\Imports\VillagesImport;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
class VillageController extends ApiController
{
    protected $service;

    public function __construct(VillageService $villageService)
    {
        $this->service = $villageService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->checkPermission("master_management_view");

        $filters = $request->all();
        $queryParams = [
            'per_page' => $request->query('per_page', 20),
        ];
         $order    =array();
        if (isset($filters['OrderBy'])) {
            $order = $filters['OrderBy'];
        }
        if (isset($queryParams['per_page'])) {
            $check=$this->service->checkPerpage($queryParams['per_page']);  
            
             if ($check['status']==0) {
                return $this->respondWithValidationError($check['message']);
            }
        }
        $items = $this->service->getAll($filters,$queryParams,$order);

        $item = ApiResource::collection($items);

        $return = [
            'count' => $item->count(),
            'total' => $item->total(),
            'current_page' => $item->currentPage(),
            'next' => $item->nextPageUrl(),
            'previous' => $item->previousPageUrl(),
            'per_page' => $item->perPage(),
            'url' => $item->url(null),
            'records' => $item,
        ];

        return $this->respondWithSuccess($return);
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


    public function villageList($pincode)
    {
        //return $pincode;
        $item = $this->service->getVillageByPinCode($pincode);

        $item = ApiResource::collection($item);

        return $this->respondWithSuccess($item);
    }

    public function SearchVillage(Request $request)
    {
        $filters = $request->all();
         if(isset($filters['keyword'])){
        $item = $this->service->SearchVillage($filters);
        $item = ApiResource::collection($item);
        return $this->respondWithSuccess($item);
    }
    }

    public function SearchPincode(Request $request)    {
        //return $pincode;
        $filters = $request->all();
        if(isset($filters['keyword'])){
        $item = $this->service->SearchPincode($filters);
        $item = ApiResource::collection($item);    
        return $this->respondWithSuccess($item);
        }
    }

     public function downloadExcel()
    {    
    return Storage::download('Village/Village-sample.xlsx');
    ///die();
        //return Storage::download('Village/Village-sample.xlsx');
        //return response()->download(storage_path("app/Village/Village-sample.xlsx"));
        /*$path = storage_path().'/'.'app'.'/Village/Village-sample.xlsx';

        if (file_exists($path)) { 
            return Response::download($path);
        }*/
    }

    public function importExcel(Request $request)
    { 
        $fileName = $request->import_file->getClientOriginalName();
            $path = Storage::disk('local')->putFileAs('temp', $request->import_file, $fileName);

            Excel::import(new VillagesImport, storage_path('app') . '/' . $path);
            Storage::disk('local')->delete($path);
            return $this->respondWithSuccess('Excel Imported Successfully');
        try{


        } catch (\Throwable $th) {
            return $this->respondNotFound();
        }    
    }

    public function export()
    {  
         $items = $this->service->export();
        Excel::store($items, 'public/export-villages.xlsx');
        $data = [
            "file" => "mo/downloadExportedExcel"
        ];
        return $this->respondWithSuccess($data);
    }
}
