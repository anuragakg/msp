<?php

namespace App\Http\Controllers\Api\V1\Shg;

use App\Http\Resources\Api\Shg\ShgGroupGathererResource;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Api\V1\ApiController;
use Illuminate\Http\Request;
use App\Http\Resources\Api\Shg\ShgGroupResource as ApiResource;
use App\Services\ShgGroupService;
use App\Imports\ShgGroupImport;
use Excel;
use Illuminate\Support\Facades\Storage;


class ShgGroupController extends ApiController
{


    private $service;

    public function __construct(ShgGroupService $shgGroupService)
    {
        $this->service = $shgGroupService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->checkPermission('shg_group_management_view');
        try {
            $data = $this->service->viewAll();
            $data = ApiResource::collection($data);

            return $this->respondWithSuccess($data);
        } catch (\Throwable $th) {

            return $this->respondWithError($th);
        }
    }

    public function indexListing(Request $request)
    {
        $this->checkPermission('shg_group_management_view');

        $queryParams = [
            'state' => $request->query('state'),
            'district' => $request->query('district'),
            'block' => $request->query('block'),
            'per_page' => $request->query('per_page', 20),
            'q' => $request->get('q')
        ];

        try {
            
            $items = $this->service->viewListing($queryParams);
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
        } catch (\Throwable $th) {
            return $this->respondWithError($th);
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function unassignedShgGroup(Request $request, $id)
    {
        $this->checkPermission('shg_group_management_view');
        try {
            $data = $this->service->viewAllUnassined($id);
            $data = ApiResource::collection($data);

            return $this->respondWithSuccess($data);
        } catch (\Throwable $th) {

            return $this->respondWithError($th);
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function unassignedActualShgGroup(Request $request, $id)
    {
        $this->checkPermission('shg_group_management_view');
        try {
            $data = $this->service->viewAllActualUnassined($id);
            $data = ApiResource::collection($data);

            return $this->respondWithSuccess($data);
        } catch (\Throwable $th) {

            return $this->respondWithError($th);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->checkPermission('shg_group_management_add');
        $valid = $this->service->validateCreate($request->all());

        if ($valid->fails()) {
            return $this->respondWithValidationError($valid);
        }

        $data = $valid->validated();

        try {
            $res = $this->service->createShgGroup($data);
            $res = ApiResource::make($res);
            return $this->respondWithSuccess($res);
        } catch (\Throwable $th) {
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
        $this->checkPermission('shg_group_management_view');
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
        $this->checkPermission('shg_group_management_edit');
        $already_using=$this->service->is_using_in_proposal($id);
        if($already_using)
        {
        	return $this->respondWithValidationError('This group is already using in Proposal.You can not edit this');
        }
        $valid = $this->service->validateUpdate($id, $request->all());

        if ($valid->fails()) {
            return $this->respondWithValidationError($valid);
        }

        $data = $valid->validated();


        try {
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
        $this->checkPermission('shg_group_management_status');
        $already_using=$this->service->is_using_in_proposal($id);
        if($already_using)
        {
        	return $this->respondWithValidationError('This group is already using in Proposal.You can not delete this');
        }
        try {
            $response = $this->service->deleteItem($id);


            if ($response) {
                /** If item is deleted successfully */
                return $this->respondWithSuccess('Item Deleted');
            }

            /** If failed to delete item from db */
            return $this->respondWithError('This shg Group contain shg Gatherer, So it Could not deleted');
        } catch (\Throwable $th) {
            return $this->respondNotFound();
        }
        //
    }

    public function importExcel(Request $request)
    {
        $this->checkPermission('shg_group_management_add');
        try {
            $fileName = $request->import_file->getClientOriginalName();
            $path = Storage::disk('local')->putFileAs('temp', $request->import_file, $fileName);

            Excel::import(new ShgGroupImport, storage_path('app') . '/' . $path);
            Storage::disk('local')->delete($path);
            return $this->respondWithSuccess('Excel Imported Successfully');
        } catch (\Throwable $th) {
            return $this->respondNotFound();
        }
    }

    public function downloadExcel()
    {
        return Storage::download('ShgGroup/ShgGroup-sample.xlsx');
    }

    public function getShgGroupGatherers()
    {
        $this->checkPermission('shg_group_management_view');
        try {

            $item = $this->service->getShgGroupGatherers();
            $item = ApiResource::collection($item);

            return $this->respondWithSuccess($item);
        } catch (\Exception $th) {
            // var_dump($th); die;
            return $this->respondNotFound();
        }
    }

    public function getGroupGatherer(Request $request, $id)
    {
        $this->checkPermission('shg_group_management_view');

        try {

            $item = $this->service->getGroupGatherers($request->id);
            $item = ApiResource::collection($item);

            return $this->respondWithSuccess($item);
        } catch (\Exception $th) {
            return $this->respondNotFound();
        }
    }


    public function detachGroupGatherer(Request $request, $id)
    {
        $this->checkPermission('shg_group_management_add');
        $data = $request->all();

        try {
            $res = $this->service->removeShgGatherers($id, $data['shg_ids']);

            return $this->respondWithSuccess($res);
        } catch (\Throwable $th) {
            return $this->respondWithError($th);
        }
    }

    public function attachGroupGatherer(Request $request, $id)
    {

        $data = $request->all();

        try {
            $data['group_id'] = $id;
            $valid = $this->service->validateAttach($data);

            if ($valid->fails()) {
                return $this->respondWithValidationError($valid);
            }

            $res = $this->service->addShgGatherers($id, $data['shg_ids']);

            return $this->respondWithSuccess($res);
        } catch (\Throwable $th) {
            return $this->respondWithError($th);
        }
    }

    public function getShgGroupGatherer(Request $request)
    {
        $this->checkPermission('shg_group_management_view');
        try {

            $item = $this->service->getShgGroupGatherer($request->all());
            //$item = ApiResource::collection($item);

            return $this->respondWithSuccess($item);
        } catch (\Exception $th) {
            return $this->respondNotFound();
        }
    }

    /**
     *
     * Function to export mis report
     */
    public function export()
    {
        $items = $this->service->export();

        Excel::store($items, 'public/export-shg-group.xlsx');
        $data = [
            "file" => "shg-group/downloadExportedExcel"
        ];
        return $this->respondWithSuccess($data);
    }

    public function downloadExportedExcel()
    {
        return Storage::download('public/export-shg-group.xlsx');
    }
}
