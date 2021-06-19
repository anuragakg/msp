<?php

namespace App\Http\Controllers\Api\V1\Masters;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Api\V1\ApiController;
// use App\Http\Resources\Api\Masters\CommonMasterResource as ApiResource;
// use App\Http\Resources\Api\Masters\DistrictBlockMasterResource as DistrictApiResource;
use App\Http\Resources\Api\Masters\BlockStateMasterResource as BlockStateApiResource;
use App\Http\Resources\Api\Masters\BlockMasterResource as BlockApiResource;
use App\Http\Resources\Api\Masters\BlockApiMasterResource as BlockApiMasterResource;
use App\Services\Masters\BlockLocationService;

class BlockLocationController extends ApiController
{
    protected $service;

    public function __construct(BlockLocationService $blockLocationService)
    {
        $this->service = $blockLocationService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->checkPermission("master_management_view");
         $filters = $request->all();
        $queryParams = [
            'per_page' => $request->query('per_page', 20),
        ];
		if (isset($queryParams['per_page'])) {
			$check=$this->service->checkPerpage($queryParams['per_page']);	
			
			 if ($check['status']==0) {
				return $this->respondWithValidationError($check['message']);
			}
		}
        $items = $this->service->getAll($filters,$queryParams);
        $item = BlockApiResource::collection($items);
        $item = BlockStateApiResource::collection($items);

        $return = [
            'count' => $item->count(),
            'total' => $item->total(),
            'current_page' => $item->currentPage(),
            'next' => $item->nextPageUrl(),
            'previous' => $item->previousPageUrl(),
            'per_page' => $item->perPage(),
            'url' => $item->url(null),
            'records' => $item,
        ];

        return $this->respondWithSuccess($return);
    }

    public function show($id)
    {
        $this->checkPermission("master_management_view");
        
        try {

            $item = $this->service->getOne($id);
            $item = BlockApiMasterResource::make($item);
            return $this->respondWithSuccess($item);
        } catch (\Exception $th) {
            print_r($th);
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
        $this->checkPermission("master_management_status");
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
