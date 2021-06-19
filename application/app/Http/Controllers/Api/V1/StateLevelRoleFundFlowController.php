<?php

namespace App\Http\Controllers\Api\V1;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Api\V1\ApiController;
use App\Http\Resources\Api\StateLevelFundFlowResource as ApiResource;
use App\Services\StateLevelRoleFundFlowService;

class StateLevelRoleFundFlowController extends ApiController
{
    protected $service;

    public function __construct(StateLevelRoleFundFlowService $StateLevelRoleFundFlowService)
    {
        $this->service = $StateLevelRoleFundFlowService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->checkPermission('fund_flow_level_mapping_view');
        $items = $this->service->getAll();
        //$items = ApiResource::collection($items);
        $data=array();
        foreach ($items as $key => $item) {
            $data[$item->state][]=array(
                'role_id'=>$item->role_id,
                'role_name'=>$item->role_name,
                'level_id'=>$item->level_id,
                'level'=>$item->level,
                'state_id'=>$item->state_id,
                'state'=>$item->state,
            );
        }
        //echo '<pre>';print_r($data);die;

        return $this->respondWithSuccess($data);
        
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->checkPermission('fund_flow_level_mapping_add');
        $data=$request->all();

        $valid = $this->service->validateCreate($request->all());

        if ($valid->fails()) {
            return $this->respondWithValidationError($valid);
        }

        $data = $valid->validated();
        
        $insert_data=array();
        $state_id=$data['state_id'];
        $status = 1; 
        $created_by = 0;
        $updated_by = 0;

        $this->service->delete_state_level_role($state_id);
         
        foreach ($data['level_id'] as $key => $level)
        {
            $level_id=$level;
            $role_id=isset($data['role_id'][$key])?$data['role_id'][$key]:'0';
            $insert_data=array(
                'state_id'=>$state_id,
                'level_id'=>$level_id,
                'role_id'=>$role_id,
                'status'=>$status,
                'created_by'=>$created_by,
                'updated_by'=>$updated_by,
            );
            $item = $this->service->createItem($insert_data);
        }
        
        if(isset($item)){
           // $item = ApiResource::make($item);    
        }

        return $this->respondWithSuccess(['message' => 'Role mapping updated successfully']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $this->checkPermission('fund_flow_level_mapping_view');
        try {

            $item = $this->service->get_state_data($id);
            
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
        $this->checkPermission('fund_flow_level_mapping_edit');
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
        $this->checkPermission('fund_flow_level_mapping_status');

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
