<?php

namespace App\Http\Controllers\Api\V1\Infrastructures;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\V1\ApiController; 
use App\Http\Resources\Api\Infrastructures\InfrastructureDevelopmentResource as ApiResource; 
use App\Services\Infrastructures\InfrastructureSummaryService;

class InfrastructureSummaryController extends ApiController
{
    protected $service;

    public function __construct(InfrastructureSummaryService $InfrastructureSummaryService)
    {
        $this->service = $InfrastructureSummaryService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->checkPermission("infrastructure_development_view");
        $items = $this->service->getAll($request);
        $items = MfpListingResource::collection($items);
        if(isset($request['page']) && !empty($request['page']))
        {
            $json_data = array(
                    "draw"            => intval($request['draw']),  
                    "recordsTotal"    => $items->total(),  
                    "recordsFiltered" => $items->total(), 
                    "data"            => $items,
                    'current_page' => $items->currentPage(),
                    'next' => $items->nextPageUrl(),
                    'previous' => $items->previousPageUrl(),
                    'per_page' => $items->perPage(),   
                    );
            return $this->respondWithSuccess($json_data);    
        }else{
            return $this->respondWithSuccess($items);
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
        $this->checkPermission("infrastructure_development_add");
        $valid = $this->service->validateCreate($request->all()); 
        if ($valid->fails()) {
            return $this->respondWithValidationError($valid);
        } 
        $data = $valid->validated();   
        if(isset($data['form_id']) && !empty($data['form_id']))
        {  
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
        $this->checkPermission("infrastructure_development_view");
        //try {
            $item = $this->service->getOne($id);
            $item = ApiResource::make($item);
            return $this->respondWithSuccess($item);
        //} catch (\Exception $th) {
            //return $this->respondNotFound();
        //}
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
        $this->checkPermission("infrastructure_development_edit");

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
        $this->checkPermission("infrastructure_development_status");

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
