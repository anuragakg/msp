<?php

namespace App\Http\Controllers\Api\V1\Proposals;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Api\V1\ApiController;
use App\Http\Resources\Api\Proposals\ActualOverheadResource;
use App\Http\Resources\Api\Proposals\ActualOverheadListingResource;
use App\Services\Proposals\ActualOverheadDetailsService;
class ActualOverheadController extends ApiController
{
    protected $service;

    public function __construct(ActualOverheadDetailsService $actualOverheadService)
    {
        $this->service = $actualOverheadService;
    }
  

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->checkPermission("mfp_procurement_actual_details_add");
        
        $valid = $this->service->validateCreate($request->all());

        if ($valid->fails()) {
            return $this->respondWithValidationError($valid);
        }

        $data = $valid->validated();
        
        $items = $this->service->updateItem($data['form_id'], $data);         
        
        //$item = ApiResource::make($items);
        
        return $this->respondWithSuccess($items);
    }


    

    public function overheadDetail($id)
    {
        $this->checkPermission("mfp_procurement_actual_details_view");
        //try {
            $item = $this->service->getOne($id);
            $item = ActualOverheadResource::make($item);
           
            return $this->respondWithSuccess($item);
        // } catch (\Exception $th) {
        //     return $this->respondNotFound();
        // }
    }

    public function overheadAmountSpentDetail($id)
    {
        try {
            $item = $this->service->getOne($id);
            $item = ActualOverheadListingResource::make($item);
           
            return $this->respondWithSuccess($item);
         } catch (\Exception $th) {
             return $this->respondNotFound();
         }
    }

    public function getCostOfPackagingMaterial($id)
    {
        $item = $this->service->getCostOfPackagingMaterial($id);
        return $this->respondWithSuccess($item);
    }

    public function list(Request $request){
        $this->checkPermission("mfp_procurement_actual_details_view");
        $items = $this->service->getListing($request);
        //dd($items);
        $items = ActualOverheadListingResource::collection($items);
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
     * Update Status of the resource
     *
     * @param integer $id
     * @return \Illuminate\Http\Response
     */
    function updateStatus($id)
    {
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

