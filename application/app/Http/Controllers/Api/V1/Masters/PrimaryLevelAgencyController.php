<?php

namespace App\Http\Controllers\Api\V1\Masters;

use Illuminate\Http\Request;
use App\Http\Controllers\Api\V1\ApiController;
use App\Http\Resources\Api\Masters\PrimaryLevelAgencyResource as ApiResource;
use App\Services\Masters\PrimaryLevelAgencyService;



class PrimaryLevelAgencyController extends ApiController
{
    protected $service;

    public function __construct(PrimaryLevelAgencyService $primaryLevelAgency)
    {
        $this->service = $primaryLevelAgency;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
          $this->checkPermission('master_management_view');
        
          $request = $request->all();
          try {
               
               $items = $this->service->getAll($request);
               $items = ApiResource::collection($items);
               return $this->respondWithSuccess($items);
               
            } catch (\Exception $th) {
                return $this->respondNotFound();
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
        //$this->checkPermission("master_management_view");
        try {

            $item = $this->service->getOne($id);
            $item = ApiResource::make($item);

            return $this->respondWithSuccess($item);
        } catch (\Exception $th) {
             return $this->respondNotFound();
        }
    }

}


