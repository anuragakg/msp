<?php

namespace App\Http\Controllers\Api\V1\Masters;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Api\V1\ApiController;
use App\Http\Resources\Api\Masters\StateLevelRoleResource as ApiResource;
use App\Http\Resources\Api\Masters\CommonMasterResource as RoleResource;
use App\Services\Masters\StateLevelRoleService;
use DB;
class StateLevelRoleController extends ApiController
{
    protected $service;

    public function __construct(StateLevelRoleService $StateLevelRoleService)
    {
        $this->service = $StateLevelRoleService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //$this->checkPermission("vdvk_approval_mapping_view");
        $request = $request->all();

        $items = $this->service->getListing($request);
       
        $data = array();
        foreach ($items as $key => $item) {
            $data[]=array(
                'state'=>$item->state,
                'state_levels'=>$this->get_state_level($item->state_id)
            );
        }
        
        $json_data = array(
            "draw"            => intval($request['draw']),  
            "recordsTotal"    => $items->total(),  
            "recordsFiltered" => $items->total(), 
            "data"            => $data,
            'current_page' => $items->currentPage(),
            'next' => $items->nextPageUrl(),
            'previous' => $items->previousPageUrl(),
            'per_page' => $items->perPage(),   
            );
        //echo '<pre>';print_r($data);die;

        return $this->respondWithSuccess($json_data);
        
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        DB::beginTransaction();
        try{
            //$this->checkPermission("vdvk_approval_mapping_add");
            $data = $request->all();

            $valid = $this->service->validateCreate($request->all());

            if ($valid->fails()) {
                return $this->respondWithValidationError($valid);
            }

            $data = $valid->validated();
            $insert_data = array();
            $state_id = $data['state_id'];
            $status = 1; 
            $created_by = 0;
            $updated_by = 0;

            //check is defined scrutiny contained dia ,nodal,ministry or not
            $haystack = $data['role_id'] ;
            $target = array(3,4,6);
            if(count(array_intersect($haystack, $target)) != count($target)){
                return $this->setStatusCode(422)->respondWithError("You can not skip DIA,Nodal,Minisry role");
            }
            //check is DIA on First and Minstry on last level or not
            $role_count = count($data['role_id']);
            $roles = array_values($data['role_id']);
           
            if($roles[0] != 6){
                return $this->setStatusCode(422)->respondWithError("Please select DIA role on first level");
            }

            if($roles[$role_count-1] != 3){
                return $this->setStatusCode(422)->respondWithError("Please select ministry role on last level");
            }
           

            $this->service->delete_state_level_role($state_id);
             
            foreach ($data['level_id'] as $key => $level)
            {
                $level_id = $level;
                $role_id = isset($data['role_id'][$key])?$data['role_id'][$key]:'0';
                /*if($level_id==1 && $role_id!=6)//dia
                {
                    return $this->respondWithValidationError('DIA should be on level 1');       
                }*/
                $insert_data=array(
                    'state_id'=>$state_id,
                    'level_id'=>$level_id,
                    'role_id'=>$role_id,
                    'status'=>$status,
                    'created_by'=>$created_by,
                    'updated_by'=>$updated_by,
                );
                // echo '<pre>';
                // print_r($insert_data);
                $item = $this->service->createItem($insert_data);
                if(isset($data['sublevel'][$key]) && !empty($data['sublevel'][$key]))
                {
                    foreach ($data['sublevel'][$key] as $key => $sublevel) 
                    {
                        $sublevel_data=array(
                            'statelevel_id'=>$item->id,
                            'state_id'=>$state_id,
                            'level_id'=>$level_id,
                            'role_id'=>$role_id,
                            'sublevel_id'=>$sublevel,
                            
                        );      
                        $subitem = $this->service->createSublevelItem($sublevel_data);
                    }
                }else{
                    return $this->respondWithValidationError('Please enter sublevel for level '.$level_id);       
                }
            }
           
            DB::commit();
            return $this->respondWithSuccess(['message' => 'Scrutiny Management added successfully']);
            
        }catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
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
        //$this->checkPermission("vdvk_approval_mapping_view");
        try {

            $items = $this->service->getStateLevel($id);
            $item=ApiResource::collection($items);
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
        DB::beginTransaction();
        try{
            //$this->checkPermission("vdvk_approval_mapping_edit");
            $valid = $this->service->validateUpdate($id, $request->all());

            if ($valid->fails()) {
                return $this->respondWithValidationError($valid);
            }

           
            $data = $valid->validated();
            //check is edited scrutiny flow is running for any proposal or not
            $is_completed = $this->service->is_proposal_completed($data);
            if($is_completed){
                return $this->setStatusCode(422)->respondWithError("This flow is using in proposal,you can't edit untill proposal completed");
            }

            $insert_data = array();
            $state_id = $data['state_id'];
            $status = 1; 
            $created_by = 0;
            $updated_by = 0;

            $this->service->delete_state_level_role($state_id);
            $this->service->delete_state_sublevellevel($state_id);

            //check is defined scrutiny contained dia ,nodal,ministry or not
            $haystack = $data['role_id'] ;
            $target = array(3,4,6);
          
            if(count(array_intersect($haystack, $target)) != count($target)){
                return $this->setStatusCode(422)->respondWithError("You can not skip DIA,Nodal,Minisry role");
            }
          
            //check is DIA on First and Minstry on last level or not
            $role_count = count($data['role_id']);
            $roles = array_values($data['role_id']);
            
            if($roles[0] != 6){
                return $this->setStatusCode(422)->respondWithError("Please select DIA role on first level");
            }

            if($roles[$role_count-1] != 3){
                return $this->setStatusCode(422)->respondWithError("Please select ministry role on last level");
            }
            
            foreach ($data['level_id'] as $key => $level)
            {
                $level_id = $level;
                $role_id = isset($data['role_id'][$key])?$data['role_id'][$key]:'0';
                /*if($level_id==1 && $role_id!=6)//dia
                {
                    return $this->respondWithValidationError('DIA should be on level 1');       
                }*/

                $insert_data=array(
                    'state_id'=>$state_id,
                    'level_id'=>$level_id,
                    'role_id'=>$role_id,
                    'status'=>$status,
                    'created_by'=>$created_by,
                    'updated_by'=>$updated_by,
                );

                $item = $this->service->createItem($insert_data);

                if(isset($data['sublevel'][$key]) && !empty($data['sublevel'][$key]))
                {
                    foreach ($data['sublevel'][$key] as $key => $sublevel) 
                    {
                        $sublevel_data=array(
                            'statelevel_id'=>$item->id,
                            'state_id'=>$state_id,
                            'level_id'=>$level_id,
                            'role_id'=>$role_id,
                            'sublevel_id'=>$sublevel,
                            
                        );      
                        $subitem = $this->service->createSublevelItem($sublevel_data);
                    }
                }else{
                    return $this->respondWithValidationError('Please enter sublevel for level '.$level_id);       
                }
            }
            DB::commit();    
            return $this->respondWithSuccess(['message' => 'Scrutiny Management Updated successfully']);     
        }catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
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
        //$this->checkPermission("vdvk_approval_mapping_status");

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
        //$this->checkPermission("vdvk_approval_mapping_status");
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

    public function get_state_level($state_id){
        if($state_id){
            $data = $this->service->get_state_data($state_id);
            return $data;
        }
       
        
    }
    
    // public function getScrutinyRoles(){
    //     try {

    //         $data = $this->service->scrutinyRoles();
    //         $items = RoleResource::collection($data);

    //         return $this->respondWithSuccess($items);
    //     } catch (\Exception $th) {
    //         return $this->respondNotFound();
    //     }
       
    // }
}
