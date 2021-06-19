<?php

namespace App\Http\Controllers\Api\V1\Infrastructures;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Api\V1\ApiController;
use App\Http\Resources\Api\SanctionLetter\InfrastructureGenerateSanctionResource;
use App\Http\Resources\Api\SanctionLetter\InfrastructureSanctionedListResource;
use App\Http\Resources\Api\SanctionLetter\InfrastructureSanctionLetterResource;
use App\Services\Infrastructures\InfrastructureSanctionService;

class InfrastructureSanctionController extends ApiController
{
    protected $service;

    public function __construct(InfrastructureSanctionService $InfrastructureSanctionService)
    {
        $this->service = $InfrastructureSanctionService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->checkPermission("fund_management_view_sanction_letter");
        $items = $this->service->getAll($request);
        $items = InfrastructureSanctionedListResource::collection($items);
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
        $this->checkPermission("fund_management_generate_sanction_letter");
        
        try {
            $valid = $this->service->validateCreate($request->all());

            if ($valid->fails()) {
                return $this->respondWithValidationError($valid);
            }

            $data = $valid->validated(); 
            $items = $this->service->createItem($data);
            
            $item = InfrastructureGenerateSanctionResource::make($items);
            
            return $this->respondWithSuccess($item);
        } catch (\Throwable $th) {
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
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
    }

    
    

    /**
     * Get Consolidated details for showing in MFP
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getSanctionDetails($id)
    {
        $this->checkPermission("fund_management_generate_sanction_letter");
        try {
            $item = $this->service->getConsolidateDetails($id);
            $item = InfrastructureGenerateSanctionResource::make($item);
            return $this->respondWithSuccess($item);
        } catch (\Exception $th) {
            return $this->respondNotFound();
        }
    }

    public function addStateSanctionLetter(Request $request)
    {
        $this->checkPermission("fund_management_generate_sanction_letter");
        
        try {
            $valid = $this->service->validateStateSanctionLetter($request->all());

            if ($valid->fails()) {
                return $this->respondWithValidationError($valid);
            }

            $data = $valid->validated();
            $items = $this->service->addStateSanctionLetter($data);
            
            $item = InfrastructureGenerateSanctionResource::make($items);
            
            return $this->respondWithSuccess($item);
        } catch (\Throwable $th) {
             return $this->respondWithError($th);
        }
    }
 

    public function getInfrastructureReleaseList(Request $request)
    {
        
    }
    public function getReleaseDetails($id)
    {
          
    }
    public function getUserSanctionedList($consolidated_id)
    {
          $items = $this->service->getUserSanctionedList($consolidated_id);   

        $items = InfrastructureSanctionLetterResource::collection($items);  
        return $this->respondWithSuccess($items);   
    }
       public function viewInfrastructureSanctionHistory($id)
    {
        $items = $this->service->viewInfrastructureSanctionHistory($id);   

        $items = InfrastructureSanctionLetterResource::collection($items);  
        return $this->respondWithSuccess($items);   
    }
}
