<?php

namespace App\Imports;

use App\Models\User;
use App\Models\UserDetail;
use App\Models\UserBankDetail;
use App\Models\SurveyorSupervisor;

use App\Services\UserService;
use App\Services\UserBankDetailsService;
use App\Services\Masters\RoleService;
use App\Services\Masters\PhoneTypeService;
use App\Services\Masters\IdProofService;
use App\Services\Masters\StateService;
use App\Services\Masters\DistrictService;
use App\Services\Masters\BlockService;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Illuminate\Support\Facades\Auth;

class SurveyorSupervisorImport implements ToCollection
{
   private $data; public $records = [];

    public function __construct(array $data = [])
    {
        $this->data = $data; 
    }

    /**
* @param array $row
*/
    public function collection(Collection $array)
    {
        \DB::beginTransaction();
        $columns = ["user_name", "name", "middle_name", "last_name", "email", "mobile_no", "role", "user_type", "survey_for", "supervising_for", "alternate_no", "phone_type", 
                        "is_phone_self_owned","state" ,"district", "block","id_proof_type","id_proof_value", "bank_name", "branch_name", "bank_ac_no", "bank_mobile_no" , "ifsc_code"];
        $requiredColumnsIndex = [0,1,3,4,5,6,7,11,12,13,14,15,16,17,18,19,20,21,22];   
        $skipped = []; $emails = []; $bank_ac_nos = [];     
        try {
           
            for ($i=1; $i < count($array); $i++) {
                
                if (count($array[$i]) == 1 && array_values($array[$i])[0] == null) {
                    continue;
                }

                for ($j=0; $j < count($columns); $j++) {
                    $surveyorSupervisors[$columns[$j]] = isset($array[$i][$j])? $array[$i][$j] : Null;
                 }
                 foreach ($requiredColumnsIndex as $index) {
                    if (!isset($array[$i][$index]) || strlen(trim($array[$i][$index])) == 0) {
                        $skipped[$i][] = $columns[$index]." field is required.";
                    }
                }

                if (isset($skipped[$i])) {
                   // dd($skipped[$i][]);die;
                     throw new \Exception($skipped[$i][0]);
                  //  continue;
                }
                if ($surveyorSupervisors["email"]) {
                    $emails[] = $surveyorSupervisors["email"];
                }

                if ($surveyorSupervisors["bank_ac_no"]) {
                    $bank_ac_nos[] = $surveyorSupervisors["bank_ac_no"];
                }
                 
                $surveyorSupervisors["line"] = $i;
                $data[] = $surveyorSupervisors;
            }; 

            $userService = new UserService();
            $users = $userService->getUsersByEmail($emails)->groupBy(function($user) { return strtolower(trim($user->email)); });

            $userBankDetailsService = new UserBankDetailsService();
            $userBankDetails = $userBankDetailsService->getDetailsByAccountNo($bank_ac_nos)->groupBy(function($user) { return trim($user->bank_ac_no); });
            
            foreach ($data as $user) {
                if (isset($users[$user["email"]])) {
                    throw new \Exception( 'Email ' . $user["email"] . ' already exist');
                   // $skipped[$user["line"]][] = 'Email ' . $user["email"] . ' already exist';
                }
                if (isset($userBankDetails[intval($user['bank_ac_no'])])) {
                    throw new \Exception( 'Bank account number ' . $user["bank_ac_no"] . ' already exist');
                    //$skipped[$user["line"]][] = 'Bank account number ' . $user["bank_ac_no"] . ' already exist';
                }
            }
            if (count($skipped)) {
                $this->records =  [ "status" => 0, "failed_records" => $skipped  ];
                return $this->records;
            }
            foreach ($data as $data1) {
                $user = new User();
                $user_detail = new UserDetail();
                $user_bank_detail = new UserBankDetail();
                $surveyor_supervisor = new SurveyorSupervisor();

                $user->user_name = $data1['user_name'];
                $user->name = $data1['name'];
                $user->middle_name = $data1['middle_name'];
                $user->last_name = $data1['last_name'];
                $user->mobile_no = $data1['mobile_no'];
                $user->email = $data1['email'];
                $user->email_verify_token = 'testemailtoken1';
                    

                $roleService = new RoleService();
                $role = $roleService->getRoleByName($data1['role']);
                $user->role = $role['id'];
                $user->status = 1;
                $user->created_by = Auth::user()->id;
                $user->updated_by = Auth::user()->id;
                $user->save();

                
                #get userId
                $user_id = $user->id;

                // #saving user service
                $surveyor_supervisor->user_id = $user_id;
                $surveyor_supervisor->user_type = $data1['user_type'];

                if ($data1['user_type'] == 1) {
                    $surveyor_supervisor->survey_for = $data1['survey_for'];
                }
                if ($data1['user_type'] == 2) {
                    $surveyor_supervisor->supervising_for = $data1['supervising_for'];
                }

                $surveyor_supervisor->alternate_no = $data1['alternate_no'];

                $phoneTypeService = new PhoneTypeService();
                $phoneType = $phoneTypeService->getPhoneTypeByName($data1['phone_type']);

                $surveyor_supervisor->phone_type = $phoneType['id'];
                $surveyor_supervisor->is_phone_self_owned = $data1['is_phone_self_owned'];
                $surveyor_supervisor->created_by = Auth::user()->id;
                $surveyor_supervisor->updated_by = Auth::user()->id;
                $surveyor_supervisor->save();

                // #saving user details
                $user_detail->user_id = $user_id;

                $stateService    = new StateService();
                $districtService = new DistrictService();
                $blockService    = new BlockService();
                $idProofService = new IdProofService();

                $state    = $stateService->getStateByName($data1['state']);
                $district = $districtService->getDistrictByName($state['id'],$data1['district']);
                $block    = $blockService->getBlockByName($district['id'],$data1['block']);
                $idProof = $idProofService->getIdProofByName($data1['id_proof_type']);


                $user_detail->state = $state['id'];
                $user_detail->district = $district['id'];
                $user_detail->block = $block['id'];
                $user_detail->id_proof_type = $idProof['id'];
                $user_detail->id_proof_value = $data1['id_proof_value'];
                $user_detail->created_by = Auth::user()->id;
                $user_detail->updated_by = Auth::user()->id;
                $user_detail->save();

                // #saving bank details
                $user_bank_detail->user_id = $user_id;
                $user_bank_detail->bank_name = $data1['bank_name'];
                $user_bank_detail->branch_name = $data1['branch_name'];
                $user_bank_detail->bank_ac_no = $data1['bank_ac_no'];
                $user_bank_detail->mobile_no = $data1['bank_mobile_no'];
                $user_bank_detail->ifsc_code = $data1['ifsc_code'];
                $user_bank_detail->created_by = Auth::user()->id;
                $user_bank_detail->updated_by = Auth::user()->id;
                $user_bank_detail->save();

               
                /**
                 * Return user object to be used for ApiResource Further.
                 */
            }
            \DB::commit();
            $this->records =   [ "status" => 1,"message" => "Excel Imported Successfully"];
            return $this->records;
        } catch (\Exception $e) {
            // something went wrong
            throw $e;
        }

    }

    public function startCell() {
        return A1;
    }
}