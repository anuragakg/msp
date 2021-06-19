<?php

namespace App\Http\Controllers\Api\V1\Masters;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Api\V1\ApiController;
use App\Http\Resources\Api\Masters\CommonMasterResource as ApiResource;
use App\Services\Masters\RoleService;


class RoleController extends ApiController
{
    protected $service;

    public function __construct(RoleService $RoleService)
    {
        $this->service = $RoleService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
      
        $this->checkPermission("role_view");
        
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
        $this->checkPermission("role_view");
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
        $this->checkPermission('role_add');
        $valid = $this->service->validateCreate($request->all());


        if ($valid->fails()) {
            return $this->respondWithValidationError($valid);
        }

        $data = $valid->validated();

        $authUser = Auth::user();
        
        $data['created_by'] = $authUser->id;
        $data['updated_by'] = $authUser->id;
        // dd($data);
        $item = $this->service->createItem($data);

        $item = ApiResource::make($item);
        
        return $this->respondWithSuccess($item);
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
        $this->checkPermission("role_edit");
        $valid = $this->service->validateUpdate($id, $request->all());

        if ($valid->fails()) {
            return $this->respondWithValidationError($valid);
        }

        $data = $valid->validated();
        $post_data=$request->all();
        
        try {

            $data['status'] = $post_data['status'];
            $item = $this->service->updateItem($id, $data);
            $item = ApiResource::make($item);

            return $this->respondWithSuccess($item);
        } catch (\Throwable $th) {
            return $this->respondNotFound();
        }
    }

    public function getRoleMappingRoles()
    {
        $this->checkPermission('role_view');
        try {

            $items = $this->service->fetchRoleMappingList();
            $items = ApiResource::collection($items);

            return $this->respondWithSuccess($items);
        } catch (\Exception $th) {
            return $this->respondNotFound();
        }
    }

    public function getRolesListing(Request $request)
    {
        $this->checkPermission('role_view');
         $request=$request->all();
        try {

            $items = $this->service->getRolesListing($request);
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


   
    public function getUserManagementRoles()
    {
        $this->checkPermission('role_view');
        try {

            $items = $this->service->fetchUserManagementList();
            $items = ApiResource::collection($items);

            return $this->respondWithSuccess($items);
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
        $this->checkPermission('role_status');
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

      /**
     * Display a listing of the role for .
     *
     * @return \Illuminate\Http\Response
     */
    public function getCommissionMasterList()
    {
        
        $this->checkPermission("role_view");
        
        $items = $this->service->getCommissionMasterList();
      
        $items = ApiResource::collection($items);

        return $this->respondWithSuccess($items);
    }
}
