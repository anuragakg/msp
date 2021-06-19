<?php

namespace App\Http\Controllers\Api\V1\HaatMarket;
use Illuminate\Support\Facades\Auth;

use App\Imports\HaatMarketOneImport;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\V1\ApiController;
use App\Http\Resources\Api\HaatMarketOneResource as ApiResource;
use App\Services\HaatMarketOneService;
use App\Imports\HaatMarketImport;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use Maatwebsite\Excel\Concerns\WithConditionalSheets;
use App\Models\HaatMarketOne;
use App\Models\HaatMarketTwo;
use App\Models\HaatMarketThree;
use App\Models\HaatMarketFour;
use App\Models\HaatMarketLinkages;
use App\Models\OtherHaatBazaar;
use App\Models\HaatWarehouseMfpCommodities;
use App\Models\HaatMarketAnnualExpenditure;
use App\Models\HaatMarketProcurementAgents;
use App\Models\HaatBazaarFormMapping;

use App\Services\Masters\StateService;
use App\Services\Masters\DistrictService;
use App\Services\Masters\BlockService;
use App\Services\Masters\VillageService;
use App\Services\Masters\RPMOwnershipService;
use App\Services\Masters\MarketRegulationService;
use App\Services\Masters\RegulationService;
use App\Services\Masters\MarketTypeService;
use App\Services\Masters\BoundaryWallService;
use App\Services\Masters\BuiltUpAreaService;
use App\Services\Masters\AccessRoadService;
use App\Services\Masters\TransportationService;

use Excel;
use Illuminate\Support\Facades\Storage;

class HaatMarketController extends ApiController
{
    
    protected $service;

    public function __construct(HaatMarketOneService $haatMarketOneService)
    {
        $this->service = $haatMarketOneService;
    }

    public function downloadExcel()
    {
        return Storage::download('HaatMarket/HaatMarket-Sample.xlsx');
    }
    
    /**
     * Haat market bulk upload.
     *
     * @return \Illuminate\Http\Response
     */
    public function importExcel(Request $request)
    {     
        $this->checkPermission();
        
        try{
            $fileName = $request->import_file->getClientOriginalName();
            $path = Storage::disk('local')->putFileAs('temp', $request->import_file, $fileName);
            $HaatMarketImport = new HaatMarketImport();
            Excel::import($HaatMarketImport, storage_path('app') . '/' . $path);
            // dd($x);
            Storage::disk('local')->delete($path);
            // dd($HaatMarketImport->data);
            $this->collectData();
            return $this->respondWithSuccess('Excel Imported Successfully');
        } catch (\Throwable $th) {
            return $th;
            return $this->respondNotFound();
        }    
    }

    public function collectData(){
        $haatOneData = $GLOBALS['haatOneData'];
        $haatTwoData = $GLOBALS['haatTwoData'];
        $haatThreeData = $GLOBALS['haatThreeData'];
        $haatFourData = $GLOBALS['haatFourData'];
        $haatOtherHaatBazaarData = $GLOBALS['haatOtherHaatBazaarData'];
        $haatMfpData = $GLOBALS['haatMfpData'];
        $haatExpdData = $GLOBALS['haatExpdData'];
        $haatAgentData = $GLOBALS['haatAgentData'];
        
        $this->saveData($haatOneData,$haatTwoData,$haatThreeData,$haatFourData,$haatOtherHaatBazaarData,$haatMfpData,$haatExpdData,$haatAgentData);
    }
    public function saveData($haatOneData,$haatTwoData,$haatThreeData,$haatFourData,$haatOtherHaatBazaarData,$haatMfpData,$haatExpdData,$haatAgentData){
        //saving haat part one
        // $haatBazaarFormMapping = new HaatBazaarFormMapping();
        //transaction begin
        
            $x=0;
            foreach($haatOneData as $haatOne){  
                $haatMarketOne = new HaatMarketOne();
                $haatMarketLinkage = new HaatMarketLinkages();
                
                $stateService    = new StateService();
                $districtService = new DistrictService();
                $blockService = new BlockService();
                $villageService = new VillageService();
                $rpmOwnershipService = new RPMOwnershipService();
                $marketRegulationService = new MarketRegulationService();
                $regulationService = new RegulationService();

                $statePartOne    = $stateService->getStateByName($haatOneData[$x]['state']);
                $districtPartOne = $districtService->getDistrictByName($statePartOne['id'],$haatOneData[$x]['district']);
                $blockPartOne = $blockService->getBlockByName($districtPartOne['id'],$haatOneData[$x]['block']);
                $villagePartOne = $villageService->getVillageByName($haatOneData[$x]['village']);
                $rpmOwnership = $rpmOwnershipService->getOwnershipByName($haatOneData[$x]['rpm_ownership']);
                $market_regulation = $marketRegulationService->getRegulationByName($haatOneData[$x]['market_regulation']);
                $regulation = $regulationService->getRegulationByName($haatOneData[$x]['regulation_type']);
                // dd($regulation);
                $rpm_premises = $haatOneData[$x]['premises_rpm'];
                if($rpm_premises=='Owned'){
                    $rpm_premises=1;
                }elseif($rpm_premises=='Leased'){
                    $rpm_premises=2;
                }else {
                    $rpm_premises=0;
                }
                $is_on_rent = $haatOneData[$x]['is_on_rent'];
                if($is_on_rent=='Yes'){
                    $is_on_rent=1;
                }elseif($is_on_rent=='No'){
                    $is_on_rent=2;
                }else {
                    $is_on_rent=0;
                }

                \DB::beginTransaction();
                try {         
                    $reference_id = $haatOneData[$x]['reference_id'];
                    $haatMarketOne->rpm_name = $haatOneData[$x]['rpm_name'];
                    $haatMarketOne->rpm_location = $haatOneData[$x]['rpm_location'];
                    $haatMarketOne->address = $haatOneData[$x]['address'];
                    $haatMarketOne->state = $statePartOne['id'];
                    $haatMarketOne->district_id = $districtPartOne['id'];
                    $haatMarketOne->block_id = $blockPartOne['id'];
                    $haatMarketOne->gram_panchayat = $haatOneData[$x]['gram_panchayat'];
                    $haatMarketOne->village_id = $villagePartOne['id'];
                    $haatMarketOne->pin_code = $haatOneData[$x]['pin_code'];
                    $haatMarketOne->rpm_ownership = $rpmOwnership['id'];
                    $haatMarketOne->operating_rpm = $haatOneData[$x]['operating_rpm'];
                    $haatMarketOne->premises_rpm = $rpm_premises;
                    $haatMarketOne->is_on_rent = $is_on_rent;
                    $haatMarketOne->rate_per_annum = $haatOneData[$x]['rate_per_annum'];
                    $haatMarketOne->market_regulation = $market_regulation['id'];
                    $haatMarketOne->regulation_type = $regulation['id'];
                    $haatMarketOne->periodicity = 1;
                    $haatMarketOne->working_days = $haatOneData[$x]['working_days'];
                    $haatMarketOne->sale_start_time = $haatOneData[$x]['sale_start_time'];
                    $haatMarketOne->sale_end_time = $haatOneData[$x]['sale_end_time'];
                    $haatMarketOne->staff_size = $haatOneData[$x]['staff_size'];
                    $haatMarketOne->created_by = Auth::user()->id;
                    $haatMarketOne->updated_by = Auth::user()->id;
                    $haatMarketOne->save();

                    $lastInsId = $haatMarketOne->id;

                    //haat market 1 form mapping
                    $haatBazaarFormMapping = new HaatBazaarFormMapping();
                    $haatBazaarFormMapping->part_one = $lastInsId;
                    $haatBazaarFormMapping->save();

                    //save form linkage
                    $haatMarketLinkage->form_id = $lastInsId;
                    if(!empty($haatOneData[$x]['nearest_railway_station'])){
                        $haatMarketLinkage->nearest_railway_station = $haatOneData[$x]['nearest_railway_station'];
                    }
                    if(!empty($haatOneData[$x]['railway_distance'])){
                        $haatMarketLinkage->railway_distance = $haatOneData[$x]['railway_distance'];
                    }
                    if(!empty($haatOneData[$x]['nearest_highway'])){
                        $haatMarketLinkage->nearest_highway = $haatOneData[$x]['nearest_highway'];
                    }
                    if(!empty($haatOneData[$x]['highway_distance'])){
                        $haatMarketLinkage->highway_distance = $haatOneData[$x]['highway_distance'];
                    }
                    if(!empty($haatOneData[$x]['nearest_apmc_market'])){
                        $haatMarketLinkage->nearest_apmc_market = $haatOneData[$x]['nearest_apmc_market'];
                    }
                    if(!empty($haatOneData[$x]['apmc_distance'])){
                        $haatMarketLinkage->apmc_distance = $haatOneData[$x]['apmc_distance'];
                    }
                    if(!empty($haatOneData[$x]['nearest_bus_stand'])){
                        $haatMarketLinkage->nearest_bus_stand = $haatOneData[$x]['nearest_bus_stand'];
                    }
                    if(!empty($haatOneData[$x]['agmarknet_node'])){
                        if($haatOneData[$x]['agmarknet_node']=='Yes'){
                            $haatOneData[$x]['agmarknet_node']=1;
                        }elseif($haatOneData[$x]['agmarknet_node']=='No'){
                            $haatOneData[$x]['agmarknet_node']=2;
                        }else {
                            $haatOneData[$x]['agmarknet_node']=0;
                        }
                        $haatMarketLinkage->agmarknet_node = $haatOneData[$x]['agmarknet_node'];
                    }

                    $haatMarketLinkage->created_by = Auth::user()->id;
                    $haatMarketLinkage->save();

                    //save other haat bazaar(excel sheet 4)
                    $ox=0;
                    foreach($haatOtherHaatBazaarData as $haatOther){
                        $other_reference_id = $haatOtherHaatBazaarData[$ox]['reference_id'];      
                        $otherHaatBazaar = new OtherHaatBazaar();
                        $otherHaatBazaar->entity_id = 0;
                        $otherHaatBazaar->form_type = 0;
                        $otherHaatBazaar->form_id = $lastInsId;
                        $otherHaatBazaar->haat_bazaar_name = $haatOtherHaatBazaarData[$ox]['name'];
                        $otherHaatBazaar->haat_bazaar_distance = $haatOtherHaatBazaarData[$ox]['distance'];
                        $otherHaatBazaar->premises_warehouse_id = 0;
                        $otherHaatBazaar->created_by = Auth::user()->id;
                        $otherHaatBazaar->updated_by = Auth::user()->id;
                        if($reference_id==$other_reference_id){
                            $otherHaatBazaar->save();
                        }
                        $ox++;
                    }    
                    //save other haat bazaar part 2(excel sheet 1)
                    $x2=0;
                    foreach($haatTwoData as $haatTwo){  
                        $reference_id_haat_two = $haatTwoData[$x2]['reference_id'];
                        $haatMarketTwo = new HaatMarketTwo();

                        $marketTypeService = new MarketTypeService();
                        $marketType    = $marketTypeService->getMarketTypeByName($haatTwoData[$x2]['market_type']);
                        $boundaryWallService = new BoundaryWallService();
                        $boundaryWall    = $boundaryWallService->getBoundryWallByName($haatTwoData[$x2]['boundary_wall']);
                        $builtupService = new BuiltUpAreaService();
                        $builtup    = $builtupService->getBuiltUpByName($haatTwoData[$x2]['built_up_area']);
                        $accessRoadService = new AccessRoadService();
                        $accessRoad    = $accessRoadService->getAccessRoadByName($haatTwoData[$x2]['access_road']);
                        $internalRoad    = $accessRoadService->getAccessRoadByName($haatTwoData[$x2]['internal_road']);
                        $is_godown_secured = $haatTwoData[$x2]['is_godown_secured'];
                        if($is_godown_secured=='Yes'){
                            $is_godown_secured=1;
                        }elseif($is_godown_secured=='No'){
                            $is_godown_secured=2;
                        }else {
                            $is_godown_secured=0;
                        }
                        $weigbridge = $haatTwoData[$x2]['weigbridge'];
                        if($weigbridge=='Yes'){
                            $weigbridge=1;
                        }elseif($weigbridge=='No'){
                            $weigbridge=2;
                        }else {
                            $weigbridge=0;
                        }
                        $electronic_weighing_scale = $haatTwoData[$x2]['electronic_weighing_scale'];
                        if($electronic_weighing_scale=='Yes'){
                            $electronic_weighing_scale=1;
                        }elseif($electronic_weighing_scale=='No'){
                            $electronic_weighing_scale=2;
                        }else {
                            $electronic_weighing_scale=0;
                        }
                        $manual_weighing_scale = $haatTwoData[$x2]['manual_weighing_scale'];
                        if($manual_weighing_scale=='Yes'){
                            $manual_weighing_scale=1;
                        }elseif($manual_weighing_scale=='No'){
                            $manual_weighing_scale=2;
                        }else {
                            $manual_weighing_scale=0;
                        }
                        $is_demarcated_area = $haatTwoData[$x2]['is_demarcated_area'];
                        if($is_demarcated_area=='Yes'){
                            $is_demarcated_area=1;
                        }elseif($is_demarcated_area=='No'){
                            $is_demarcated_area=2;
                        }else {
                            $is_demarcated_area=0;
                        }
                        $transportationService = new TransportationService();
                        $transportExplode = explode(',',$haatTwoData[$x2]['transportation']);
                        $ti=0;
                        $transportArray = array();
                        foreach($transportExplode as $transp){
                            $transport    = $transportationService->getTransportationByName($transportExplode[$ti]);
                            array_push($transportArray,$transport['id']);
                            $ti++;
                        }
                        $haatMarketTwo->market_type = $marketType['id'];
                        $haatMarketTwo->market_charges = $haatTwoData[$x2]['market_charges'];
                        $haatMarketTwo->market_fees = $haatTwoData[$x2]['market_fees'];
                        $haatMarketTwo->broker_fees = $haatTwoData[$x2]['broker_fees'];
                        $haatMarketTwo->sitting_charges = $haatTwoData[$x2]['sitting_charges'];
                        $haatMarketTwo->commission_agency_charges = $haatTwoData[$x2]['commission_agency_charges'];
                        $haatMarketTwo->weighing_charges = $haatTwoData[$x2]['weighing_charges'];
                        $haatMarketTwo->user_charges = $haatTwoData[$x2]['user_charges'];
                        $haatMarketTwo->other_charges = $haatTwoData[$x2]['other_charges'];
                        $haatMarketTwo->boundary_wall = $boundaryWall['id'];
                        $haatMarketTwo->built_up_area = $builtup['id'];
                        $haatMarketTwo->access_road = $accessRoad['id'];
                        $haatMarketTwo->internal_road = $internalRoad['id'];
                        $haatMarketTwo->is_godown_secured = $is_godown_secured;
                        $haatMarketTwo->tonnage = $haatTwoData[$x2]['tonnage'];
                        $haatMarketTwo->godown_area = $haatTwoData[$x2]['godown_area'];
                        $haatMarketTwo->weigbridge = $weigbridge;
                        $haatMarketTwo->electronic_weighing_scale = $electronic_weighing_scale;
                        $haatMarketTwo->manual_weighing_scale = $manual_weighing_scale;
                        $haatMarketTwo->number = $haatTwoData[$x2]['number'];
                        $haatMarketTwo->is_demarcated_area = $is_demarcated_area;
                        $haatMarketTwo->cleaning_area = $haatTwoData[$x2]['cleaning_area'];
                        $haatMarketTwo->other_infrastructure = $haatTwoData[$x2]['other_infrastructure'];
                        $haatMarketTwo->transportation = implode(',',$transportArray);
                        $haatMarketTwo->created_by = Auth::user()->id;
                        $haatMarketTwo->updated_by = Auth::user()->id;
                        if($reference_id==$reference_id_haat_two){
                            $haatMarketTwo->save();
                            $partTwoInsId = $haatMarketTwo->id;
                            //haat market 2 form mapping
                            $item = HaatBazaarFormMapping::where('part_one', $lastInsId)->firstOrFail();
                            $item->part_two = $partTwoInsId;
                            $item->save();
                        }
                        
                        $x2++;
                    }
                    
                    //save other haat bazaar part 3(excel sheet 2)
                    $x3=0;
                    foreach($haatThreeData as $haatThree){ 
                        $reference_id_haat_three = $haatThreeData[$x3]['reference_id'];
                        $haatMarketThree = new HaatMarketThree();

                        $office = $haatThreeData[$x3]['office'];
                        if($office=='Yes'){
                            $office="1";
                        }elseif($office=='No'){
                            $office="0";
                        }else {
                            $office="0";
                        }

                        $drinking_water = $haatThreeData[$x3]['drinking_water'];
                        if($drinking_water=='Yes'){
                            $drinking_water="1";
                        }elseif($drinking_water=='No'){
                            $drinking_water="0";
                        }else {
                            $drinking_water="0";
                        }

                        $notice_board = $haatThreeData[$x3]['notice_board'];
                        if($notice_board=='Yes'){
                            $notice_board="1";
                        }elseif($notice_board=='No'){
                            $notice_board="0";
                        }else {
                            $notice_board="0";
                        }

                        $urinal_toilet = $haatThreeData[$x3]['urinal_toilet'];
                        if($urinal_toilet=='Yes'){
                            $urinal_toilet="1";
                        }elseif($urinal_toilet=='No'){
                            $urinal_toilet="0";
                        }else {
                            $urinal_toilet="0";
                        }

                        $electricity = $haatThreeData[$x3]['electricity'];
                        if($electricity=='Yes'){
                            $electricity="1";
                        }elseif($electricity=='No'){
                            $electricity="0";
                        }else {
                            $electricity="0";
                        }

                        $garbage_system = $haatThreeData[$x3]['garbage_system'];
                        if($garbage_system=='Yes'){
                            $garbage_system="1";
                        }elseif($garbage_system=='No'){
                            $garbage_system="0";
                        }else {
                            $garbage_system="0";
                        }

                        $parking = $haatThreeData[$x3]['parking'];
                        if($parking=='Yes'){
                            $parking="1";
                        }elseif($parking=='No'){
                            $parking="0";
                        }else {
                            $parking="0";
                        }

                        $input_sundry = $haatThreeData[$x3]['input_sundry'];
                        if($input_sundry=='Yes'){
                            $input_sundry="1";
                        }elseif($input_sundry=='No'){
                            $input_sundry="0";
                        }else {
                            $input_sundry="0";
                        }

                        $hygienic = $haatThreeData[$x3]['hygienic'];
                        if($hygienic=='Yes'){
                            $hygienic="1";
                        }elseif($hygienic=='No'){
                            $hygienic="0";
                        }else {
                            $hygienic="0";
                        }

                        $bank = $haatThreeData[$x3]['bank'];
                        if($bank=='Yes'){
                            $bank="1";
                        }elseif($bank=='No'){
                            $bank="0";
                        }else {
                            $bank="0";
                        }

                        $post_office = $haatThreeData[$x3]['post_office'];
                        if($post_office=='Yes'){
                            $post_office="1";
                        }elseif($post_office=='No'){
                            $post_office="0";
                        }else {
                            $post_office="0";
                        }

                        $assaying_lab = $haatThreeData[$x3]['assaying_lab'];
                        if($assaying_lab=='Yes'){
                            $assaying_lab="1";
                        }elseif($assaying_lab=='No'){
                            $assaying_lab="0";
                        }else {
                            $assaying_lab="0";
                        }

                        $packaging = $haatThreeData[$x3]['packaging'];
                        if($packaging=='Yes'){
                            $packaging="1";
                        }elseif($packaging=='No'){
                            $packaging="0";
                        }else {
                            $packaging="0";
                        }

                        $drying_yards = $haatThreeData[$x3]['drying_yards'];
                        if($drying_yards=='Yes'){
                            $drying_yards="1";
                        }elseif($drying_yards=='No'){
                            $drying_yards="0";
                        }else {
                            $drying_yards="0";
                        }

                        $bagging = $haatThreeData[$x3]['bagging'];
                        if($bagging=='Yes'){
                            $bagging="1";
                        }elseif($bagging=='No'){
                            $bagging="0";
                        }else {
                            $bagging="0";
                        }

                        $loading = $haatThreeData[$x3]['loading'];
                        if($loading=='Yes'){
                            $loading="1";
                        }elseif($loading=='No'){
                            $loading="0";
                        }else {
                            $loading="0";
                        }

                        $conditioning = $haatThreeData[$x3]['conditioning'];
                        if($conditioning=='Yes'){
                            $conditioning="1";
                        }elseif($conditioning=='No'){
                            $conditioning="0";
                        }else {
                            $conditioning="0";
                        }

                        $pack_house = $haatThreeData[$x3]['pack_house'];
                        if($pack_house=='Yes'){
                            $pack_house="1";
                        }elseif($pack_house=='No'){
                            $pack_house="0";
                        }else {
                            $pack_house="0";
                        }

                        $storage_capacity = $haatThreeData[$x3]['storage_capacity'];
                        if($storage_capacity=='Yes'){
                            $storage_capacity="1";
                        }elseif($storage_capacity=='No'){
                            $storage_capacity="0";
                        }else {
                            $storage_capacity="0";
                        }

                        $primary_processing = $haatThreeData[$x3]['primary_processing'];
                        if($primary_processing=='Yes'){
                            $primary_processing="1";
                        }elseif($primary_processing=='No'){
                            $primary_processing="0";
                        }else {
                            $primary_processing="0";
                        }

                        $info_display = $haatThreeData[$x3]['info_display'];
                        if($info_display=='Yes'){
                            $info_display="1";
                        }elseif($info_display=='No'){
                            $info_display="0";
                        }else {
                            $info_display="0";
                        }

                        $it_infra = $haatThreeData[$x3]['it_infra'];
                        if($it_infra=='Yes'){
                            $it_infra="1";
                        }elseif($it_infra=='No'){
                            $it_infra="0";
                        }else {
                            $it_infra="0";
                        }

                        $storage = $haatThreeData[$x3]['storage'];
                        if($storage=='Yes'){
                            $storage="1";
                        }elseif($storage=='No'){
                            $storage="0";
                        }else {
                            $storage="0";
                        }

                        $public_address = $haatThreeData[$x3]['public_address'];
                        if($public_address=='Yes'){
                            $public_address="1";
                        }elseif($public_address=='No'){
                            $public_address="0";
                        }else {
                            $public_address="0";
                        }

                        $extension = $haatThreeData[$x3]['extension'];
                        if($extension=='Yes'){
                            $extension="1";
                        }elseif($extension=='No'){
                            $extension="0";
                        }else {
                            $extension="0";
                        }

                        $boarding_lodging = $haatThreeData[$x3]['boarding_lodging'];
                        if($boarding_lodging=='Yes'){
                            $boarding_lodging="1";
                        }elseif($boarding_lodging=='No'){
                            $boarding_lodging="0";
                        }else {
                            $boarding_lodging="0";
                        }

                        $standardisation = $haatThreeData[$x3]['standardisation'];
                        if($standardisation=='Yes'){
                            $standardisation="1";
                        }elseif($standardisation=='No'){
                            $standardisation="0";
                        }else {
                            $standardisation="0";
                        }

                         #saving Haat market form three
                        $haatMarketThree->office = $office;
                        $haatMarketThree->drinking_water = $drinking_water;
                        $haatMarketThree->notice_board = $notice_board;
                        $haatMarketThree->urinal_toilet = $urinal_toilet;
                        $haatMarketThree->electricity = $electricity;
                        $haatMarketThree->garbage_system = $garbage_system;
                        $haatMarketThree->parking = $parking;
                        $haatMarketThree->input_sundry = $input_sundry;
                        $haatMarketThree->hygienic = $hygienic;
                        $haatMarketThree->bank = $bank;
                        $haatMarketThree->bank_name = $haatThreeData[$x3]['bank_name'];
                        $haatMarketThree->post_office = $post_office;
                        $haatMarketThree->post_office_name = $haatThreeData[$x3]['post_office_name'];
                        $haatMarketThree->assaying_lab = $assaying_lab;
                        $haatMarketThree->assaying_lab_remarks = $haatThreeData[$x3]['assaying_lab_remarks'];
                        $haatMarketThree->packaging = $parking;
                        $haatMarketThree->packaging_remarks = $haatThreeData[$x3]['packaging_remarks'];
                        $haatMarketThree->drying_yards = $drying_yards;
                        $haatMarketThree->drying_yards_remarks = $haatThreeData[$x3]['drying_yards_remarks'];
                        $haatMarketThree->bagging = $bagging;
                        $haatMarketThree->bagging_remarks = $haatThreeData[$x3]['bagging_remarks'];
                        $haatMarketThree->loading = $loading;
                        $haatMarketThree->loading_remarks = $haatThreeData[$x3]['loading_remarks'];
                        $haatMarketThree->conditioning = $conditioning;
                        $haatMarketThree->conditioning_remarks = $haatThreeData[$x3]['conditioning_remarks'];
                        $haatMarketThree->pack_house = $pack_house;
                        $haatMarketThree->pack_house_remarks = $haatThreeData[$x3]['pack_house_remarks'];
                        $haatMarketThree->storage_capacity = $storage_capacity;
                        $haatMarketThree->storage_capacity_remarks = $haatThreeData[$x3]['storage_capacity_remarks'];
                        $haatMarketThree->standardisation = $standardisation;
                        $haatMarketThree->primary_processing = $primary_processing;
                        $haatMarketThree->primary_processing_remarks = $haatThreeData[$x3]['primary_processing_remarks'];
                        $haatMarketThree->info_display = $info_display;
                        $haatMarketThree->info_display_remarks = $haatThreeData[$x3]['info_display_remarks'];
                        $haatMarketThree->it_infra = $it_infra;
                        $haatMarketThree->it_infra_remarks = $haatThreeData[$x3]['it_infra_remarks'];
                        $haatMarketThree->storage = $storage;
                        $haatMarketThree->storage_remarks = $haatThreeData[$x3]['storage_remarks'];
                        $haatMarketThree->public_address = $public_address;
                        $haatMarketThree->public_address_remarks = $haatThreeData[$x3]['public_address_remarks'];
                        $haatMarketThree->extension = $extension;
                        $haatMarketThree->extension_remarks = $haatThreeData[$x3]['extension_remarks'];
                        $haatMarketThree->boarding_lodging = $boarding_lodging;
                        $haatMarketThree->status = '1';
                        $haatMarketThree->created_by = Auth::user()->id;
                        $haatMarketThree->updated_by = Auth::user()->id;
                        if($reference_id==$reference_id_haat_three){
                            $haatMarketThree->save();
                            $partThreeInsId = $haatMarketThree->id;
                            //haat market 3 form mapping
                            $item = HaatBazaarFormMapping::where('part_one', $lastInsId)->firstOrFail();
                            $item->part_three = $partThreeInsId;
                            $item->save();
                        }
                        $x3++;
                    }   
                    
                    //save other haat bazaar part 4(excel sheet 3)
                    $x4=0;
                    foreach($haatFourData as $haatFour){ 
                        $reference_id_haat_four = $haatFourData[$x4]['reference_id'];
                        $haatMarketFour = new HaatMarketFour();

                        $cleaning_and_sanitation = $haatFourData[$x4]['cleaning_and_sanitation'];
                        if($cleaning_and_sanitation=='Yes'){
                            $cleaning_and_sanitation="1";
                        }elseif($cleaning_and_sanitation=='No'){
                            $cleaning_and_sanitation="0";
                        }else {
                            $cleaning_and_sanitation="0";
                        }

                        $garbage_collection = $haatFourData[$x4]['garbage_collection'];
                        if($garbage_collection=='Yes'){
                            $garbage_collection="1";
                        }elseif($garbage_collection=='No'){
                            $garbage_collection="0";
                        }else {
                            $garbage_collection="0";
                        }

                        $waste_utilization = $haatFourData[$x4]['waste_utilization'];
                        if($waste_utilization=='Yes'){
                            $waste_utilization="1";
                        }elseif($waste_utilization=='No'){
                            $waste_utilization="0";
                        }else {
                            $waste_utilization="0";
                        }

                        $other_facility = $haatFourData[$x4]['other_facility'];
                        if($other_facility=='Yes'){
                            $other_facility="1";
                        }elseif($other_facility=='No'){
                            $other_facility="0";
                        }else {
                            $other_facility="0";
                        }

                        $haatMarketFour->form_id = 0;
                        $haatMarketFour->cleaning_and_sanitation = $cleaning_and_sanitation;
                        $haatMarketFour->garbage_collection = $garbage_collection;
                        $haatMarketFour->waste_utilization = $waste_utilization;
                        $haatMarketFour->other_facility = $other_facility;
                        $haatMarketFour->remarks = $haatFourData[$x4]['remarks'];
                        $haatMarketFour->annual_income = $haatFourData[$x4]['annual_income'];
                        $haatMarketFour->latitude = $haatFourData[$x4]['latitude'];
                        $haatMarketFour->longitude = $haatFourData[$x4]['longitude'];
                        $haatMarketFour->nearest_apmc_distance = $haatFourData[$x4]['nearest_apmc_distance'];
                        $haatMarketFour->created_by = Auth::user()->id;
                        $haatMarketFour->updated_by = Auth::user()->id;
                        if($reference_id==$reference_id_haat_four){
                            $haatMarketFour->save();
                            $formFourInsId = $haatMarketFour->id;
                            //haat market 4 form mapping
                            $item = HaatBazaarFormMapping::where('part_one', $lastInsId)->firstOrFail();
                            $item->part_four = $formFourInsId;
                            $item->save();
                            //save mfp data(excel sheet 6)
                            $xmfp=0;
                            foreach($haatMfpData as $haatMfp){ 
                                $reference_id_haat_mfp = $haatMfpData[$xmfp]['reference_id'];
                                $haatWarehouseMfpCommodities = new HaatWarehouseMfpCommodities();

                                $stateProcurementService    = new StateService();
                                $districtProcurementService = new DistrictService();
                                $blockProcurementService = new BlockService();

                                $stateProcurement    = $stateProcurementService->getStateByName($haatWarehouseMfpCommodities[$xmfp]['state']);
                                $districtProcurement = $districtProcurementService->getDistrictByName($stateProcurement['id'],$haatWarehouseMfpCommodities[$xmfp]['district']);
                                $blockProcurement = $blockProcurementService->getBlockByName($districtProcurement['id'],$haatWarehouseMfpCommodities[$xmfp]['block']);

                                $haatWarehouseMfpCommodities->form_id = $formFourInsId;
                                $haatWarehouseMfpCommodities->type = 0;
                                $haatWarehouseMfpCommodities->entity_id = 0;
                                $haatWarehouseMfpCommodities->commodity = $haatMfpData[$xmfp]['commodity'];
                                $haatWarehouseMfpCommodities->annual_quantity = $haatMfpData[$xmfp]['annual_quantity'];
                                $haatWarehouseMfpCommodities->created_by = Auth::user()->id;
                                $haatWarehouseMfpCommodities->updated_by = Auth::user()->id;
                                if($reference_id==$reference_id_haat_mfp){
                                    $haatWarehouseMfpCommodities->save();
                                }
                                $xmfp++;
                            }
                            
                            //save expenditure data(excel sheet 5)
                            $xexp=0;
                            foreach($haatExpdData as $haatExp){ 
                                $reference_id_haat_exp = $haatExpdData[$xexp]['reference_id'];
                                $haatMarketAnnualExpenditure = new HaatMarketAnnualExpenditure();
                                $haatMarketAnnualExpenditure->form_id = $formFourInsId;
                                $haatMarketAnnualExpenditure->haat_bazaar_id = 0;
                                $haatMarketAnnualExpenditure->expenditure_no = $haatExpdData[$xexp]['expenditure_no'];
                                $haatMarketAnnualExpenditure->head_of_expenditure = $haatExpdData[$xexp]['head_of_expenditure'];
                                $haatMarketAnnualExpenditure->amount = $haatExpdData[$xexp]['amount'];
                                $haatMarketAnnualExpenditure->created_by = Auth::user()->id;
                                $haatMarketAnnualExpenditure->updated_by = Auth::user()->id;
                                if($reference_id==$reference_id_haat_exp){
                                    $haatMarketAnnualExpenditure->save();
                                }
                                $xexp++;
                            }
                            
                            //save procurement agent data(excel sheet 7)
                            $xag=0;
                            foreach($haatAgentData as $haatAgent){ 
                                $reference_id_agent = $haatAgentData[$xag]['reference_id'];
                                $haatMarketProcurementAgents = new HaatMarketProcurementAgents();

                                $marketTypeServices = new MarketTypeService();
                                $marketTypes    = $marketTypeServices->getMarketTypeByName($haatAgentData[$xag]['category_ids']);


                                $stateAgentService    = new StateService();
                                $districtAgentService = new DistrictService();
                                $blockAgentService = new BlockService();

                                $stateAgent    = $stateAgentService->getStateByName($haatAgentData[$xag]['state']);
                                $districtAgent = $districtAgentService->getDistrictByName($stateAgent['id'],$haatAgentData[$xag]['district']);
                                $blockAgent = $blockAgentService->getBlockByName($districtAgent['id'],$haatAgentData[$xag]['block']);

                                $haatMarketProcurementAgents->form_id = $formFourInsId;
                                $haatMarketProcurementAgents->name = $haatAgentData[$xag]['name'];
                                $haatMarketProcurementAgents->mobile_no = $haatAgentData[$xag]['mobile_no'];
                                $haatMarketProcurementAgents->landline_no = $haatAgentData[$xag]['landline_no'];
                                $haatMarketProcurementAgents->address = $haatAgentData[$xag]['address'];
                                $haatMarketProcurementAgents->category_ids = $marketTypes['id'];
                                $haatMarketProcurementAgents->state = $stateAgent['id'];
                                $haatMarketProcurementAgents->district = $districtAgent['id'];
                                $haatMarketProcurementAgents->block = $districtAgent['id'];
                                $haatMarketProcurementAgents->created_by = Auth::user()->id;
                                $haatMarketProcurementAgents->updated_by = Auth::user()->id;
                                if($reference_id==$reference_id_agent){
                                    $haatMarketProcurementAgents->save();
                                }
                                $xag++;
                            }    
                        }
                        $x4++;
                    }    

                    \DB::commit();
                } catch (\Exception $e) {
                    \DB::rollback();
                    // something went wrong
                    throw $e;
                }
                $x++;
            }
    }    
}