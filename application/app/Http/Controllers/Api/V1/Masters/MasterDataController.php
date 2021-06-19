<?php

namespace App\Http\Controllers\Api\V1\Masters;
use App\Http\Resources\Api\Masters\BankMasterResource;
use App\Http\Resources\Api\Masters\CommodityMasterResource;
use App\Http\Resources\Api\Masters\CommonMasterResource;
use App\Http\Resources\Api\Masters\LevelMasterResource;
use App\Http\Resources\Api\Masters\ProcurementAgentResource;
use App\Http\Resources\Api\Masters\RoleMasterResource;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Api\V1\ApiController;
use App\Http\Resources\Api\Masters\CommonMasterResource as ApiResource;
//use App\Services\Masters\AccessRoadService;
//use App\Services\Masters\BoundaryWallService;
//use App\Services\Masters\BuiltUpAreaService;
use App\Services\Masters\CategoryService;
use App\Services\Masters\CommodityService;
use App\Services\Masters\CoordinatingAgencyService;
use App\Services\Masters\DepartmentService;
use App\Services\Masters\DesignationService;
use App\Services\Masters\EducationService;
use App\Services\Masters\IdProofService;
use App\Services\Masters\LevelService;
//use App\Services\Masters\MarketRegulationService;
//use App\Services\Masters\MarketTypeService;
use App\Services\Masters\MemberRelationService;
use App\Services\Masters\MFPUseService;
use App\Services\Masters\OccupationService;
use App\Services\Masters\OfficeBearerRoleService;
use App\Services\Masters\OrgTypeService;
//use App\Services\Masters\PeriodicityMasterService;
use App\Services\Masters\PhoneTypeService;
use App\Services\Masters\ProcurementAgentService;
use App\Services\Masters\RegulationService;
use App\Services\Masters\RoleService;
//use App\Services\Masters\RPMOwnershipService;
//use App\Services\Masters\TrainingStatusService;
//use App\Services\Masters\TransportationService;
use App\Services\Masters\UnitService;
use App\Services\Masters\VehicleService;
//use App\Services\Masters\WarehouseAgeService;
//use App\Services\Masters\WarehouseConditionService;
//use App\Services\Masters\WarehousePremisesService;
use App\Services\Masters\WarehouseTypeService;
use App\Services\Masters\YearService;
use App\Services\Masters\BankService;
use App\Services\Masters\FinancialYearService;

class MasterDataController extends ApiController
{
    //protected $accessRoadService;
    protected $boundaryWallService;
    protected $builtUpAreaService;
    protected $categoryService  ;
    protected $commodityService;
    protected $coordinatingAgencyService;
    protected $departmentService;
    protected $designationService;
    protected $educationService;
    protected $idProofService;
    protected $levelService;
    //protected $marketRegulationService;
    //protected $marketTypeService;
    protected $memberRelationService;
    protected $occupationService;
    protected $officeBearerRoleService;
    //protected $periodicityMasterService;
    protected $phoneTypeService;
    protected $procurementAgentService;
    protected $regulationService;
    protected $roleService;
    protected $rpmOwnershipService;
    protected $trainingStatusService;
    protected $transportationService;
    protected $unitService;
    protected $vehicleService;
    //protected $warehouseAgeService;
    //protected $warehouseConditionService;
    //protected $warehousePremisesService;
    protected $warehouseTypeService;
    protected $yearService;
    protected $bankService;
    protected $FinancialYearService;

    public function __construct()
    {
        //$this->accessRoadService =   new AccessRoadService();
        //$this->boundaryWallService = new BoundaryWallService();
        //$this->builtUpAreaService =  new BuiltUpAreaService();
        $this->categoryService   =   new CategoryService();
        $this->commodityService =   new CommodityService();
        //$this->coordinatingAgencyService =   new CoordinatingAgencyService();
        $this->departmentService =   new DepartmentService();
        $this->designationService =  new DesignationService();
        $this->educationService =    new EducationService();
        $this->idProofService =   new IdProofService();
        $this->levelService =   new LevelService();
        //$this->marketRegulationService = new MarketRegulationService();
        //$this->marketTypeService = new MarketTypeService();
        $this->memberRelationService = new MemberRelationService();
        $this->mfpUseService = new MFPUseService();
        $this->occupationService = new OccupationService();
        $this->officeBearerRoleService = new OfficeBearerRoleService();
        //$this->periodicityMasterService = new PeriodicityMasterService();
        $this->phoneTypeService = new PhoneTypeService();
        $this->procurementAgentService = new ProcurementAgentService();
        $this->regulationService = new RegulationService();
        $this->roleService = new RoleService();
        //$this->rpmOwnershipService = new RPMOwnershipService();
       // $this->trainingStatusService = new TrainingStatusService();
        //$this->transportationService = new TransportationService();
        $this->unitService = new UnitService();
        $this->vehicleService = new VehicleService();
        //$this->warehouseAgeService = new WarehouseAgeService();
        //$this->warehouseConditionService = new WarehouseConditionService();
        //$this->warehousePremisesService = new WarehousePremisesService();
        $this->warehouseTypeService = new WarehouseTypeService();
        $this->yearService = new YearService();
        $this->bankService = new BankService();
        $this->financialYearService = new FinancialYearService();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->checkPermission("master_management_view");
        
        //$accessRoad = $this->accessRoadService->getAll();
        //$boundaryWall = $this->boundaryWallService->getAll();
        //$builtUpArea = $this->builtUpAreaService->getAll();
        $category = $this->categoryService->getAll();
        $commodity = $this->commodityService->getAll();
        //$coordinatingAgency = $this->coordinatingAgencyService->getAll();
        $department = $this->departmentService->getAll();
        $designation = $this->designationService->getAll();
        $education = $this->educationService->getAll();
        $idProof = $this->idProofService ->getAll();
        $level = $this->levelService->getAll();
        //$marketRegulation = $this->marketRegulationService ->getAll();
        //$marketType = $this->marketTypeService ->getAll();
        $memberRelation = $this->memberRelationService->getAll();
        $mfpUse = $this->mfpUseService->getAll();
        $occupation = $this->occupationService->getAll();
        $officeBearerRole = $this->officeBearerRoleService->getAll();
        //$periodicityMaster = $this->periodicityMasterService ->getAll();
        $phoneType = $this->phoneTypeService->getAll();
        $procurementAgent = $this->procurementAgentService->getAll();
        $regulation = $this->regulationService->getAll();
        $role = $this->roleService->getAll();
        //$rpmOwnership = $this->rpmOwnershipService->getAll();
        //$trainingStatus = $this->trainingStatusService->getAll();
        //$transportation = $this->transportationService->getAll();
        $unit = $this->unitService->getAll();
        $vehicle = $this->vehicleService->getAll();
        //$warehouseAge = $this->warehouseAgeService->getAll();
        //$warehouseCondition = $this->warehouseConditionService->getAll();
        //$warehousePremises = $this->warehousePremisesService->getAll();
        $warehouseType = $this->warehouseTypeService->getAll();
        $year = $this->yearService->getAll();
        $bank = $this->bankService->getAll();
        $financial = $this->financialYearService->getAll();

        $items = [
            //'accessRoad' => CommonMasterResource::collection($accessRoad),
            //'boundaryWall' => CommonMasterResource::collection($boundaryWall),
            //'builtUpArea' => CommonMasterResource::collection($builtUpArea),
            'category' => CommonMasterResource::collection($category),
            'commodity' => CommodityMasterResource::collection($commodity),
            //'coordinatingAgency' => CommonMasterResource::collection($coordinatingAgency),
            //'accessRoad' => $accessRoad,
            'department' => CommonMasterResource::collection($department),
            'designation' => CommonMasterResource::collection($designation),
            'education' => CommonMasterResource::collection($education),
            'idProof' => CommonMasterResource::collection($idProof),
            'level' => LevelMasterResource::collection($level),
            //'marketRegulation' => CommonMasterResource::collection($marketRegulation),
            //'marketType' => CommonMasterResource::collection($marketType),
            'memberRelation' => CommonMasterResource::collection($memberRelation),
            'mfpUse' => CommonMasterResource::collection($mfpUse),
            'occupation' => CommonMasterResource::collection($occupation),
            'officeBearerRole' => CommonMasterResource::collection($officeBearerRole),
            //'periodicityMaster' => CommonMasterResource::collection($periodicityMaster),
            'phoneType' => CommonMasterResource::collection($phoneType),
            'procurementAgent' => ProcurementAgentResource::collection($procurementAgent),
            'regulation' => CommonMasterResource::collection($regulation),
            'role' => RoleMasterResource::collection($role),
            //'rpmOwnership' => CommonMasterResource::collection($rpmOwnership),
            //'trainingStatus' => CommonMasterResource::collection($trainingStatus),
            //'transportation' => CommonMasterResource::collection($transportation),
            'unit' => CommonMasterResource::collection($unit),
            'vehicle' => CommonMasterResource::collection($vehicle),
            //'warehouseAge' => CommonMasterResource::collection($warehouseAge),
            //'warehouseCondition' => CommonMasterResource::collection($warehouseCondition),
            //'warehousePremises' => CommonMasterResource::collection($warehousePremises),
            'warehouseType' => CommonMasterResource::collection($warehouseType),
            'year' => CommonMasterResource::collection($year),
			'bank' => BankMasterResource::collection($bank),
            'financial_year' => CommonMasterResource::collection($financial)
        ];

       
        return $this->respondWithSuccess($items);
    }
}
