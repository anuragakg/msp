<?php

namespace App\Http\Controllers\Api\V1\Masters;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

use Illuminate\Http\Request;
use App\Http\Controllers\Api\V1\ApiController;
use App\Http\Resources\Api\Masters\PackingMasterResource as ApiResource;
use App\Services\Masters\PackingService;

use DB;
class PackingMasterController extends ApiController
{
    protected $service;

    public function __construct(PackingService $packingService)
    {
        $this->service = $packingService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->checkPermission("master_management_view");
        
        $items = $this->service->getAll($request);
        $items = ApiResource::collection($items);

        return $this->respondWithSuccess($items);
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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->checkPermission('master_management_add');
        $valid = $this->service->validateCreate($request->all());

        if ($valid->fails()) {
            return $this->respondWithValidationError($valid);
        }

        $data = $valid->validated();
       /// Log::info($data);
        $insert_data = array();
        
        $authUser = Auth::user();
        
        $created_by = $authUser->id;
        $updated_by = $authUser->id;
        try {
            DB::beginTransaction();
            foreach ($data['bag_type'] as $key => $bag_type)
            {
                $bag_type = $bag_type;
                $bag_name = $data['bag_name'][$key];
                $specifications = $data['specifications'][$key];
                $insert_data = array(
                    'bag_type'=>$bag_type,
                    'bag_name'=>$bag_name,
                    'specifications'=>$specifications,
                    'created_by'=>$created_by,
                    'updated_by'=>$updated_by,
                );

                $item = $this->service->createItem($insert_data);
            }
            DB::commit();
            return $this->respondWithSuccess(['message' => 'Packing Master updated successfully']);
        }catch (\Throwable $th) {
            DB::rollBack();
            return $this->respondWithError(['message' => $th]);
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
            //Log::info($data);

            $item = $this->service->updateItem($id, $data);
            $item = ApiResource::make($item);

            return $this->respondWithSuccess($item);
        }catch(\Exception $th){
            return $this->respondWithError($th);
        }
    }



    public function getPackingListing(Request $request)
    {
        //$this->checkPermission('master_management_view');
        
         $request=$request->all();
       try {
            
            $items = $this->service->getPackingListing($request);
            $items = ApiResource::collection($items);
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
            
        } catch (\Exception $th) {
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
        
        $this->checkPermission('master_management_status');
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

    function checkBagName(Request $request)
    {
        $request=$request->all();
        $res = $this->service->checkBagName($request);
        if($res)
        { $msg=['status' => '1'];
           return $msg;
        }
        else
        { $msg=['status' => '0'];
            return $msg;
        }
    }
}
