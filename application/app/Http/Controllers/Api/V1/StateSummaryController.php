<?php

namespace App\Http\Controllers\Api\V1;

use Illuminate\Http\Request;
use App\Http\Controllers\Api\V1\ApiController;
use App\Http\Resources\Api\StateSummaryResource;
use App\Services\StateSummaryService;
use App\Models\StateTeamLeaderDetails;
use App\Models\StateModelTraining;
use Illuminate\Http\Response;
class StateSummaryController extends ApiController
{
    protected $service;

    public function __construct(StateSummaryService $stateSummaryService)
    {
        $this->service = $stateSummaryService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->checkPermission('state_summary_view');
        $items = $this->service->viewAll();
        $items = StateSummaryResource::collection($items);
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
        $this->checkPermission('state_summary_add');
        $reqBody = $request->all();
        $valid = $this->service->validateCreate($reqBody);
        if ($valid->fails()) {
            return $this->respondWithValidationError($valid);
        }      
        $data = $valid->validated();
       /* $order_file = $request->file('order_file');
        if(!empty($order_file)){
        if(isset($order_file) && !empty($order_file)){
         $data['order_file'] =  $request->file('order_file')->store('orders');        
            }
        }*/
        $data['created_by'] = 0;
        $data['updated_by'] = 0;

        try {
            $item = $this->service->createItem($data);
            $item = StateSummaryResource::make($item);
            return $this->respondWithSuccess($item);
        } catch (\Throwable $th) {
            return $this->respondWithError($th);
        }
    }

    public function getAllVdvkdata(Request $request)
    {
        $this->checkPermission('state_summary_add');
        $item = $this->service->getVdvkAll($request->all());
         return $this->respondWithSuccess($item);
    }
    /**
     * Display the specified resource by state.
     *
     * @param  int  $id State ID
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    { 
        $this->checkPermission('state_summary_view');
        try {
            $item = $this->service->viewOne($id);

            /**
             * For preventing not found error in front end.
             */
            if (empty($item)) {
                return $this->respondWithSuccess([]);
            }

            $item = StateSummaryResource::make($item);
            return $this->respondWithSuccess($item);
        } catch (\Throwable $th) {
            return $this->respondNotFound($th);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $this->checkPermission('state_summary_add');
        $reqBody = $request->all();         
        $valid = $this->service->validateCreate($reqBody);
        if ($valid->fails()) {
            return $this->respondWithValidationError($valid);
        }      
        $data = $valid->validated();  
        $data['created_by'] = 0;
        $data['updated_by'] = 0;

        try {
            $item = $this->service->updateItem($data);
            $item = StateSummaryResource::make($item);
            return $this->respondWithSuccess($item);
        } catch (\Throwable $th) {
            return $this->respondWithError($th);
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
        return $this->respondNotFound();
    }
}
