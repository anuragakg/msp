<?php

namespace App\Http\Controllers\Api\V1\Shg;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\Api\V1\ApiController;
use App\Http\Resources\Api\Shg\ShgListingResource;
use Illuminate\Http\Request;
use App\Http\Resources\Api\Shg\ShgViewOneResource;
use App\Services\ShgFormService;
//use App\Services\ShgImportService;
use Excel;
use Illuminate\Support\Facades\Storage;
use App\Imports\ShgGathererImport;
use App\Exports\ShgGathererExport;
use App\Models\Shg\ShgGathererGroupsRelation;
use App\Models\Shg\ShgGatherers;
use App\Models\Shg\ShgBankDetails;
use App\Models\Shg\ShgHouseholdMember;
use App\Models\Shg\ShgMfpYearlyGathering;

use App\Services\ShgGroupService;
use App\Services\Masters\StateService;
use App\Services\Masters\YearService;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

use App\Models\User;
use Illuminate\Support\Facades\Notification;
use App\Notifications\Email\SurveyFormVerify;
class ShgPartOne extends ApiController
{


    private $service;

    public function __construct(ShgFormService $shgFormService)
    {
        $this->service = $shgFormService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->checkPermission('shg_management_view');
        try {
            $data = $this->service->viewAllPartOne();
            $data = ShgListingResource::collection($data);

            return $this->respondWithSuccess($data);
        } catch (\Throwable $th) {

            return $this->respondWithError($th);
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
        //$this->checkPermission('shg_management_add');

        $shgID = $request->get('id');

        $ifExists = $this->service->ifExistsPartOne($shgID);
        $getId=$this->service->ifExistsPartOneData($shgID);
        if ($ifExists) { 
            $already_using=$this->service->is_using_in_proposal($getId['id']);
            if($already_using)
            {
                return $this->respondWithValidationError('This gather is already using in Proposal.You can not edit this');
            }  
            $valid = $this->service->validateUpdate($getId['id'], $request->all());
        } else { 
            $valid = $this->service->validateCreate($request->all());
        }

        if ($valid->fails()) {
            return $this->respondWithValidationError($valid);
        }

        $data = $valid->validated();  
 
             $results = $this->checkDataCombination($data, $getId['id']);

             if ($results) {
                 return $this->respondWithError("Either Name Of Tribal 'or' DOB 'or' Father Name 'or' Mother Name Already Exists !!");
             }

        /**
         * Image is required in create api
         * and will store in public folder
         */
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('public/users/avatars');
        }


        if ($request->hasFile('tribal_image')) {
            $data['tribal_image'] = $request->file('tribal_image')->store('public/users/avatars');
        }

        try {
            if ($ifExists) {   
                $data['updated_by'] = Auth::user()->id;
                $res = $this->service->updatePartOne($getId['id'],$shgID, $data);
            } else {
                $data['created_by'] = Auth::user()->id;
                $data['updated_by'] = Auth::user()->id;
                $res = $this->service->createPartOne($data,$shgID);
            }
            $res = ShgViewOneResource::make($res);
            return $this->respondWithSuccess($res);
        } catch (\Throwable $th) {
            return $this->respondWithError($th);
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
        $this->checkPermission('shg_management_view');
        try {

            $data = $this->service->viewOnePartOne($id);
            $data = ShgViewOneResource::make($data);

            return $this->respondWithSuccess($data);
        } catch (\Throwable $th) {
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
        $this->checkPermission('shg_management_edit');
        $already_using=$this->service->is_using_in_proposal($id);
        if($already_using)
        {
            return $this->respondWithValidationError('This gather is already using in Proposal.You can not edit this');
        }
        $valid = $this->service->validateUpdate($id, $request->all());

        if ($valid->fails()) {
            return $this->respondWithValidationError($valid);
        }

        $data = $valid->validated();

        /**
         * Image is optional in case of update and will store in the same folder
         */
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('public/users/avatars');
        }

        try {
            $res = $this->service->updatePartOne($id, $data);
            $res = ShgViewOneResource::make($res);
            return $this->respondWithSuccess($res);
        } catch (\Throwable $th) {
            return $this->respondWithError('Error Creating Resource');
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
        //
    }

    public function updateStatus (Request $request, $id) {
        $this->checkPermission('shg_management_status');
        try {

            $user = Auth::user();
            $status=$request->status;
            $shg = ShgGatherers::findOrFail($id);
            $shg->status = $status;
            $shg->save();

            if($user->role == 12)
            {
                $to = User::findOrFail($shg->created_by);
                Notification::send($to, new SurveyFormVerify($user,"SHG Gatherer",$status));
            }

            return $this->respondWithSuccess([
                'message' => 'Successfully Changed',
                'status' => $status
            ]);
        } catch (\Throwable $th) {
                return $this->respondNotFound();
        }
    }

    public function importExcel(Request $request)
    {
        $this->checkPermission('shg_management_add');
        try {

            $state_id = $request->state;   // Get State ID From Request
            $stateService    = new StateService();
            $state = $stateService->checkState($state_id);
            if ($state == 0) {
                return $this->respondNotFound();
            }

            $fileName = $request->import_file->getClientOriginalName();
            $path = Storage::disk('local')->putFileAs('temp', $request->import_file, $fileName);

            $shgGathererImport = new ShgGathererImport;

            Excel::import($shgGathererImport, storage_path('app') . '/' . $path);
            if(empty($GLOBALS['shgPartOneData']))
            {
                return $this->respondWithValidationError("Key Missing In Sheet SHG Gatherer One Header.");
            }
            if(empty($GLOBALS['shgMembersData']))
            {
                return $this->respondWithValidationError("Key Missing In Sheet SHG Member Header.");
            }
            if(empty($GLOBALS['yearlyUsageData']))
            {
                return $this->respondWithValidationError("Key Missing In Sheet Yearly MFP Usage Header.");
            }
            Storage::disk('local')->delete($path);
            return $validate = $this->collectData($state_id);
            // return $this->respondWithSuccess('Excel Imported Successfully');
        } catch (\Throwable $th) {
            // var_dump($th->getMessage()); die;
            return $this->respondWithError($th);
        }
    }
    public function downloadExcel()
    {
        // $this->checkPermission('shg_management_view');
        return Storage::download('ShgGatherer/ShgGatherer-sample.xlsx');
    }

    public function export() 
    {
        // $this->checkPermission('shg_management_view');
        // return Excel::download(new ShgGathererExport, 'shg-gatherers.xlsx');
    }

    public function collectData($state_id){
        $shgPartOneData = $GLOBALS['shgPartOneData'];
        $shgMembersData = $GLOBALS['shgMembersData'];
        $yearlyUsageData = $GLOBALS['yearlyUsageData'];
        
        $validate =  $this->validateData($shgPartOneData,$shgMembersData,$yearlyUsageData, $state_id);
        if($validate == null){
            $this->saveData($shgPartOneData,$shgMembersData,$yearlyUsageData,$state_id);
            return $this->respondWithSuccess('Excel Imported Successfully');
        } else {
            return $validate;
        }
    }

    public function validateData($shgPartOneData, $shgMembersData, $yearlyUsageData, $state_id) {

        //validate shg part one
        /* $valid = $this->import_service->validateShgIdProof($shgPartOneData);
        if ($valid->fails()) {
            return $this->respondWithValidationError("ID Value is Duplicate.");
        } */
        $x=0;
        foreach($shgPartOneData as $shgOne){
            $valid = $this->import_service->validateShgPartOne($shgOne,($x+2),'Shg Part One', $state_id);
            if ($valid->fails()) {
                $validationMessage = 
                    $valid->errors()->first() 
                    . ' on line ' . ($x + 3) 
                    . ', sheet ( Shg Part One )';
                return $this->respondWithValidationError($validationMessage);
            }
            $data = $valid->validated();

             $results = $this->checkDataCombination($data, null);

             if ($results) {
                 return $this->respondWithError("Either Name Of Tribal 'or' DOB 'or' Father Name 'or' Mother Name Already Exists on line ". ($x + 3) .", sheet ( Shg Part One )");
             }
            $x++;
        }

        //validate shg members
        $y=0;
        foreach($shgMembersData as $shgMember){  
            $valid = $this->import_service->validateShgMembers($shgMember,($y+2),'Shg Members');
            if ($valid->fails()) {
                $validationMessage =
                    $valid->errors()->first()
                    . ' on line ' . ($y + 3)
                    . ', sheet ( Shg Members )';
                return $this->respondWithValidationError($validationMessage);
            }
            $y++;
        }

        //validate yearly usage
        $z=0;
        foreach($yearlyUsageData as $yearlyUsage){  
            $valid = $this->import_service->validateYearlyUsage($yearlyUsage,($z+2),'year usage');
            if ($valid->fails()) {
                $validationMessage =
                    $valid->errors()->first()
                    . ' on line ' . ($z + 3)
                    . ', sheet ( Shg Year Usage )';
                return $this->respondWithValidationError($validationMessage);
            }
            $z++;
        }
    }

    public function saveData($shgPartOneData,$shgMembersData,$yearlyUsageData, $state_id){
           
            $x=0;
            foreach($shgPartOneData as $shgOne){  
                $shgGroupRelation = new ShgGathererGroupsRelation();
                $shgGatherer = new ShgGatherers();
                $shgBankDetails = new ShgBankDetails();
                //$shgGroupService = new ShgGroupService();
                // \DB::beginTransaction();
                try {
                    
                    //.....................Shg Part One Data........................//
                    $reference_id = $shgPartOneData[$x]['reference_id'];
                    $shgGatherer->name_of_tribal = $shgPartOneData[$x]['name_of_tribal'];
                    $shgGatherer->gender = $shgPartOneData[$x]['gender'];

                    if (isset($shgPartOneData[$x]['dob'])) {
                        $dobObj = Carbon::createFromFormat('d/m/Y', $shgPartOneData[$x]['dob']);
                        $shgGatherer->dob = $dobObj->format('Y-m-d');
                        $shgAge = $dobObj->age;
                    } else {
                        //$shgGatherer->dob = Carbon::now()->subYear(18);
                        $shgGatherer->dob = null;
                        $shgAge = date('Y') - $shgPartOneData[$x]['birth_year'];
                    }

                    $yearService    = new YearService();
                    $birth_year     = $yearService->getYearByName($shgPartOneData[$x]['birth_year']);

                    $shgGatherer->birth_year = $birth_year['id'] ?? 0;
                    $shgGatherer->age = $shgAge;
                                         

                    $state    = $state_id;
                    $district = $shgPartOneData[$x]['district'];
                    $block    = $shgPartOneData[$x]['block'];
                    $village  = $shgPartOneData[$x]['village'];
                    $idProof  = $shgPartOneData[$x]['id_type'];
                    $scheduledTribes = $shgPartOneData[$x]['st_name'];

                    
                    $shgGatherer->id_type = $idProof;
                    $shgGatherer->id_value = $shgPartOneData[$x]['id_value'];
                    $shgGatherer->father = $shgPartOneData[$x]['father'] ?? null;
                    $shgGatherer->mother = $shgPartOneData[$x]['mother'];
                    $shgGatherer->address = $shgPartOneData[$x]['address'] ?? '';
                    $shgGatherer->state = $state_id;
                    $shgGatherer->status = '1';
                    $shgGatherer->district = $district;
                    $shgGatherer->block = $block;
                    $shgGatherer->village = $village;
                    $shgGatherer->pin_code = $shgPartOneData[$x]['pin_code'];
                    $shgGatherer->gram_panchayat = $shgPartOneData[$x]['gram_panchayat'];

                    $occupation = $shgPartOneData[$x]['occupation'];
                    $education = $shgPartOneData[$x]['education'];
                    
                    $shgGatherer->occupation = $occupation;
                    $shgGatherer->education = $education;
                    $shgGatherer->existing_membership = $this->getBooleanValue($shgPartOneData[$x]['existing_membership']);
                    $shgGatherer->shg_name = $shgPartOneData[$x]['shg_name'] ?? null;
                    $shgGatherer->shg_nrlm_id = $shgPartOneData[$x]['shg_nrlm_id'] ?? null;
                    $shgGatherer->shg_other_id = $shgPartOneData[$x]['shg_other_id'] ?? null;
                    $shgGatherer->is_office_bearer = $this->getBooleanValue($shgPartOneData[$x]['is_office_bearer']);


                    $bearerRole    = $shgPartOneData[$x]['bearer_role'];
                    $category  = $shgPartOneData[$x]['category'];
                    
                    $shgGatherer->bearer_role = $bearerRole;
                    $shgGatherer->category = $category;

                    $vehicleType    = $shgPartOneData[$x]['vehicle_type'];
                    
                    $shgGatherer->is_ews = $this->getBooleanValue($shgPartOneData[$x]['is_ews']);

                    if ($category == 1) {
                        $shgGatherer->st_name = $scheduledTribes;
                    } else {
                        $shgGatherer->st_name = null;
                    }

                    
                    $shgGatherer->is_gathering_mfp = $this->getBooleanValue($shgPartOneData[$x]['is_gathering_mfp']);
                    // $shgGatherer->is_married = strtolower($shgPartOneData[$x]['is_married']) == "yes" ? '1' : '0';
                    
                    $shgGatherer->vehicle_type = $vehicleType;
                    $shgGatherer->no_of_members = strval($shgPartOneData[$x]['no_of_members']);
                    $shgGatherer->name_of_proposed = strval($shgPartOneData[$x]['name_of_proposed']);
                    $shgGatherer->financial_year = strval($shgPartOneData[$x]['financial_year']);
                    $shgGatherer->latitude = strval($shgPartOneData[$x]['latitude']);
                    $shgGatherer->longitude = strval($shgPartOneData[$x]['longitude']);
                    $shgGatherer->created_by = Auth::user()->id;
                    $shgGatherer->updated_by = Auth::user()->id;
                    $shgGatherer->is_mobile = '0';
                    $shgGatherer->save();

                    //.........................SHG Gatherer Group Relation Data........//

                    if(false)
                    {                       
                        $group = $shgGroupService->getGroupByName($shgPartOneData[$x]['group_name']);
                        $shgGroupRelation->group_id = $group['id'];
                        $shgGroupRelation->shg_id = $shgGatherer->id;
                        $shgGroupRelation->created_by = Auth::user()->id;
                        $shgGroupRelation->updated_by = Auth::user()->id;
                        $shgGroupRelation->save();
                    }

                    //.........................Shg Bank Data...........................//

                    $shgBankDetails->shg_id = $shgGatherer->id;
                    $shgBankDetails->name   = $shgPartOneData[$x]['bank_name'] ?? null;
                    $shgBankDetails->branch = $shgPartOneData[$x]['branch_name'] ?? null;
                    $shgBankDetails->ifsc_code = $shgPartOneData[$x]['bank_ifsc'] ?? null;
                    $shgBankDetails->account_no = $shgPartOneData[$x]['bank_account_no'] ?? null;
                    $shgBankDetails->mobile_no = $shgPartOneData[$x]['bank_mobile_no'] ?? null;
                    $shgBankDetails->landline_no = $shgPartOneData[$x]['landline_no'] ?? null;
                    $shgBankDetails->is_self = $this->getBooleanValue($shgPartOneData[$x]['is_self']) ?? null;
                    $shgBankDetails->specify_other = $shgPartOneData[$x]['specify_other'] ?? null;

                    $phoneType = $shgPartOneData[$x]['phone_type'] ?? null;

                    $shgBankDetails->phone_type = $phoneType ?? '';
                    $shgBankDetails->created_by = Auth::user()->id;
                    $shgBankDetails->updated_by = Auth::user()->id;
                    $shgBankDetails->save();                

                /** Create Shg Members */
                    $sm=0;
                    foreach($shgMembersData as $shgMember){

                        if (!$shgMembersData[$sm]['name']) {
                            continue;
                        }

                        $other_reference_id = $shgMembersData[$sm]['reference_id'];      
                        $shgHouseholdMember = new ShgHouseholdMember();
                        
                        $shgHouseholdMember->shg_id = $shgGatherer->id;
                        $shgHouseholdMember->name   = $shgMembersData[$sm]['name'];
                        $shgHouseholdMember->gender = $shgMembersData[$sm]['gender'];
                        $dobObj = Carbon::createFromFormat('d/m/Y', $shgMembersData[$sm]['dob']);
                        $shgHouseholdMember->dob    = $dobObj->format('Y-m-d');
                        $shgHouseholdMember->age    = $dobObj->age;

                        $occupationMember = $shgMembersData[$sm]['occupation'];
                        $educationMember = $shgMembersData[$sm]['education'];

                        $memberRelation = $shgMembersData[$sm]['relationship_with_member'];
                        $shgHouseholdMember->occupation = $occupationMember;
                        $shgHouseholdMember->education  = $educationMember;
                        $shgHouseholdMember->relationship_with_member = $memberRelation;
                        $shgHouseholdMember->is_gathering_mfp = $this->getBooleanValue($shgMembersData[$sm]['is_gathering_mfp']);

                        $shgHouseholdMember->created_by = Auth::user()->id;
                        $shgHouseholdMember->updated_by = Auth::user()->id;
                        if($reference_id==$other_reference_id){
                            $shgHouseholdMember->save();
                        }
                        $sm++;
                    }   

                 /** Create Shg Members */
                    $yu=0;
                    foreach($yearlyUsageData as $yearlyUsage){
                        $yearly_usage_reference_id = $yearlyUsageData[$yu]['reference_id'];      
                        $shgMfp = new ShgMfpYearlyGathering();
                        
                        $shgMfp->shg_id = $shgGatherer->id;

                        $commodity = $yearlyUsageData[$yu]['commodity'] ?? 0;

                        $mfpUse = $yearlyUsageData[$yu]['mfp_use'];
                        

                        $shgMfp->commodity   = $commodity;
                        $shgMfp->quantity = $yearlyUsageData[$yu]['quantity'];
                        $shgMfp->mfp_use    = $mfpUse;
                        $shgMfp->created_by = Auth::user()->id;
                        $shgMfp->updated_by = Auth::user()->id;
                        if($reference_id == $yearly_usage_reference_id){
                            $shgMfp->save();
                        }
                        $yu++;
                    }           

                }
                catch (\Exception $e) {
                    DB::rollback();
                    // something went wrong
                    throw $e;
                }
                $x++;
            }
    }

    private function getBooleanValue ($value) {
        $states = [
            'yes' => 1,
            'no' => 0,
        ];

        $value = strtolower($value);

        return isset($states[$value]) ? $states[$value] : 'no'; 
    }

    public function checkDataCombination($data, $shgID)
    {
        $where = [
            'name_of_tribal' => $data['name_of_tribal'],
            'father' => $data['father'],
            'mother' => $data['mother']
        ];

        if (!empty($data['dob'])) {
            $date = Carbon::createFromFormat('d/m/Y', $data['dob']);
            $dob_format = $date->format('Y-m-d');
            $where['dob'] = $dob_format;
        }

        $count = ShgGatherers::where($where)->where('id', '!=', $shgID)->count();

        return $count;
    }

    public function getShgGatherers()
    {
     
        $items = $this->service->getShgGatherers();

        $items = ApiResource::collection($items);

        return $this->respondWithSuccess($items);
    }

}
