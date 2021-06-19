<?php

namespace App\Http\Controllers\Api\V1\Masters;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

use Illuminate\Http\Request;
use App\Http\Controllers\Api\V1\ApiController;
use App\Http\Resources\Api\Masters\HaatMasterResource as ApiResource;
use App\Services\Masters\HaatMasterService;


class HaatBazaarMasterController extends ApiController
{
    protected $service;

    public function __construct(HaatMasterService $haatService)
    {
        $this->service = $haatService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $request = $request->all();
       
        //try {
            
            $items = $this->service->getHaatMasterListing($request);
            //dd($items);
            $items = ApiResource::collection($items);
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
                
                /*echo json_encode($json_data);die;*/
                return $this->respondWithSuccess($json_data);    
            }else{
                return $this->respondWithSuccess($items);
            }
            
        // } catch (\Exception $th) {
             return $this->respondNotFound();
         //}
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
        ///dd($data);
        $insert_data = array();
        
        $authUser = Auth::user();
        
        $created_by = $authUser->id;
        $updated_by = $authUser->id;
     
        //Log::info($data);die;
        foreach ($data['haatbazaar'] as $row)
        {
          
            $insert_data = array(
                'state_id'=>$row['state'],
                'district_id'=>$row['district'],
                'haat_bazaar_id'=> $row['haat_bazaar'],
                'nature_of_operation'=>$row['nature_of_operation'],
                'created_by'=>$created_by,
                'updated_by'=>$updated_by,
            );

            $haat_master = $this->service->createItem($insert_data);

            foreach($row['block'] as  $block_id){
                $insert_data = array( 'haat_detail_id'=> $haat_master['id'],
                                      'block_id'=>(int) $block_id );
    
                $this->service->createHaatBlocks($insert_data);
            }

            foreach($row['operating_day'] as  $operating_day_row){
                $insert_data = array( 'haat_detail_id'=>$haat_master['id'],
                                      'operating_day'=>$operating_day_row );
    
                $this->service->createHaatOperatingDays($insert_data);
            }
        }


        return $this->respondWithSuccess(['message' => 'Haat Bazaar Master Added successfully']);
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
        // dd($request);
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
}
