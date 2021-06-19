<?php

namespace App\Http\Controllers\Api\V1\Masters;

use App\Http\Resources\Api\Masters\CommonMasterResource;
use App\Http\Controllers\Api\V1\ApiController;
use App\Http\Resources\Api\Masters\BlockMasterResource;
use App\Http\Resources\Api\Masters\CommissionMasterResource;
use App\Http\Resources\Api\Masters\DistrictMasterResource;
use App\Http\Resources\Api\Masters\HaatBazaarItemResource;
use App\Http\Resources\Api\Masters\HaatMasterResource;
use App\Http\Resources\Api\Masters\MfpResource;
use App\Http\Resources\Api\Masters\MultipurposeProcurementResource;
use App\Http\Resources\Api\Masters\PackingMasterResource;
use App\Http\Resources\Api\Masters\StateMasterResource;
use App\Http\Resources\Api\Masters\VillageMasterResource;
use App\Http\Resources\Api\Masters\WarehouseItemResource;
use App\Http\Resources\Api\Masters\WarehouseMasterResource;
use App\Models\Masters\Department;
use App\Models\Masters\Designation;
use App\Services\Masters\BlockService;
use App\Services\Masters\CommissionMasterService;
use App\Services\Masters\DepartmentService;
use App\Services\Masters\DesignationService;
use App\Services\Masters\DistrictService;
use App\Services\Masters\FinancialYearService;
use App\Services\Masters\HaatItemService;
use App\Services\Masters\HaatMasterService;
use App\Services\Masters\MfpService;
use App\Services\Masters\MultipurposeProcurementService;
use App\Services\Masters\PackingService;
use App\Services\Masters\StateService;
use App\Services\Masters\VillageService;
use App\Services\Masters\WarehouseItemService;
use App\Services\Masters\WarehouseService;

class MasterController extends ApiController
{
    protected $commission;
    protected $packing;
    protected $haatMaster;
    protected $warehouseItem;
    protected $warehouse;
    protected $multipurposeProcurementItem;
    protected $haatItem;
    protected $financialYearService;
    protected $designtion;
    protected $department;
    protected $state;
    protected $district;
    protected $block;
    protected $village;
 
    public function __construct()
    {
        $this->commissionService = new CommissionMasterService();
        $this->packingService = new PackingService();
        $this->haatMasterService = new HaatMasterService();
        $this->warehouseService = new WarehouseService();
        $this->mfpService = new MfpService();
        $this->haatItemService = new HaatItemService();
        $this->warehouseItemService = new WarehouseItemService();
        $this->multipurposeProcurementService = new MultipurposeProcurementService();
        $this->financialYearService = new FinancialYearService();
        $this->designationService = new DesignationService();
        $this->departmentService = new DepartmentService();
        $this->stateService = new StateService();
        $this->districtService = new DistrictService();
        $this->blockService = new BlockService();
        $this->villageService = new VillageService();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    { 
        $this->checkPermission("master_management_view");
        
        $commission = $this->commissionService->getAll();
        $packing = $this->packingService->getAll();
        $haatMaster = $this->haatMasterService->getAll();
        $warehouse = $this->warehouseService->getAllData();
        $mfp = $this->mfpService->getAllData();
        $haatItem =  $this->haatItemService->getAllData();
        $warehouseItem = $this->warehouseItemService->getAll();
        $multipurposeProcurementItem = $this->multipurposeProcurementService->getAll();
        $financial = $this->financialYearService->getAll();
        $designation = $this->designationService->getAll(1);
        $department = $this->departmentService->getAll();
        // $state = $this->stateService->getAllData();
        // $district = $this->districtService->getAllData();
        // $block = $this->blockService->getAllData();
        // $village = $this->villageService->getAllData();
      

        $items = [
            'commission' => CommissionMasterResource::collection($commission),
            'packing' => PackingMasterResource::collection($packing),
            'haatMaster' => HaatMasterResource::collection($haatMaster),
            'warehouse'=> WarehouseMasterResource::collection($warehouse),
            'mfp'=>MfpResource::collection($mfp),
            'haatItem'=>HaatBazaarItemResource::collection($haatItem),
            'warehouseItem'=>WarehouseItemResource::collection($warehouseItem),
            'procurementItem' =>MultipurposeProcurementResource::collection($multipurposeProcurementItem),
            'financial_year' => CommonMasterResource::collection($financial),
            'designation'=>CommonMasterResource::collection($designation),
            'department'=>CommonMasterResource::collection($department),
            // 'state'=>StateMasterResource::collection($state),
            // 'district'=>DistrictMasterResource::collection($district),
            // 'block'=> BlockMasterResource::collection($block),
            // 'village'=>VillageMasterResource::collection($village),

        ];
        return $this->respondWithSuccess($items);
    }
}
