<?php

namespace App\Imports;

use App\Models\User;
use App\Models\UserDetail;
use App\Models\UserBankDetail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use App\Services\Masters\RoleService;
use App\Services\Masters\StateService;
use App\Services\Masters\DistrictService;
use App\Services\Masters\IdProofService;
use App\Services\Masters\DesignationService;
use App\Services\Masters\DepartmentService;
use Carbon\Carbon;
use App\Services\UserService;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Concerns\Importable;

class UserManagementImport implements ToModel, WithHeadingRow 
{
    /**
     * @param array $row
     *
     * @return User|null
     */
    use Importable;
    private $row = 1;
    public function model(array $data)
    {
        $row_num=++$this->row;
        $user = new User();
        $user_detail = new UserDetail();
        $user_bank_detail = new UserBankDetail();
        $stateService    = new StateService();
        $districtService = new DistrictService();
        $idProofService  = new IdProofService();
        $departmentService  = new DepartmentService();
        $designationService  = new DesignationService();
        $roleService = new RoleService();
        $userService = new UserService();
        $user_data=array();
        //transaction begin
        \DB::beginTransaction();
        try {
            
            #saving user
            $role = $roleService->getRoleByName($data['role']);
            $state           = $stateService->getStateByName($data['state']);    
            $district        = $districtService->getDistrictByName($state['id'],$data['district']);
            $idProofType     = $idProofService->getIdProofByName($data['id_proof_type']);
            $departmentType  = $departmentService->getDepartmentByName($data['department']);
            $designationType = $designationService->getDesignationByName($data['designation']);

            //========validation data============
            $user_data['role'] =$role['id'];
            $user_data['state'] =$state['id'];
            $user_data['district'] =$district['id'];
            $user_data['user_name'] =$data['user_name'];
            $user_data['name'] =$data['name'];
            $user_data['middle_name'] =$data['middle_name'];
            $user_data['last_name'] =$data['last_name'];
            $user_data['last_name'] =$data['last_name'];
            $user_data['email'] =$data['email'];
            $user_data['mobile'] =$data['mobile'];
            $user_data['alternate_no'] ='';//$data['alternate_no'];
            $user_data['landline_no'] =$data['landline_no'];
            $user_data['dob'] =!empty($data['dob'])?date('d/m/Y',strtotime($data['dob'])):'';
            $user_data['id_proof_type'] =$data['id_proof_type'];
            $user_data['id_proof_value'] =$data['id_proof_value'];
            $user_data['official_address'] =$data['official_address'];
            $user_data['department'] =$departmentType['id'];
            $user_data['designation'] =$designationType['id'];
            if($data['ac_holder_name']!='')
            {
                $user_data['bankDept'] ='on';
            }else{
                $user_data['bankDept'] ='';
            }
            
            $user_data['holder_name'] = $data['ac_holder_name'];
            $user_data['bank_name'] = $data['bank_name'];
            $user_data['bank_ac_no'] = $data['bank_ac_no'];
            $user_data['ifsc_code'] = $data['ifsc_code']; 


            //return new User($user_data);
            //return $user_data;
            //dd($user_data);
            $valid = $userService->validateCreate($user_data);
            //dd($valid);
                if ($valid->fails()) {
                    
                    $partOne_Error= $valid->errors()->all();
                    $partOne_Error=implode(',',$partOne_Error);
                    $response['status']=0;
                    //$user->error_code=$partOne_Error;
                    $message= "In row number ".$row_num." ".$partOne_Error ;
                    throw new \Exception($message);
                    
                }
            $data = $valid->validated();
            //dd($data);

            $user->role = $role['id'];

            $user->user_name = $data['user_name'];
            $user->name = $data['name'];
            $user->middle_name = $data['middle_name'];
            $user->last_name = $data['last_name'];

            $user->email = $data['email'];
            $user->mobile_no = $data['mobile'];
            $user->email_verify_token = $data['email'];
            $user->created_by = Auth::user()->id;
            $user->updated_by = Auth::user()->id;
            $user->save();
            
            #get userId
            $user_id = $user->id;

            // #saving user details
            $user_detail->user_id = $user_id;

            

            $user_detail->state = $data['state'];
            $user_detail->district = $data['district'];
            $user_detail->block = 0;
            $user_detail->dob = Carbon::parse($data['dob'])->format('Y-m-d');
            $user_detail->landline_no = $data['landline_no'];
            $user_detail->id_proof_type = $data['id_proof_type'];
            $user_detail->id_proof_value = $data['id_proof_value'];
            $user_detail->official_address = $data['official_address'];
            $user_detail->department = $data['department'];
            $user_detail->designation = $data['designation'];
            $user_detail->created_by = Auth::user()->id;
            $user_detail->updated_by = Auth::user()->id;
            $user_detail->save();

            // #saving bank details
            if(isset($data['bankDept']) && $data['bankDept'] == 'on')
            {
                $user_bank_detail->user_id = $user_id;
                $user_bank_detail->ac_holder_name = $data['holder_name'];
                $user_bank_detail->bank_name = $data['bank_name'];
                $user_bank_detail->bank_ac_no = $data['bank_ac_no'];
                $user_bank_detail->ifsc_code = $data['ifsc_code'];
                $user_bank_detail->created_by = Auth::user()->id;
                $user_bank_detail->updated_by = Auth::user()->id;
                $user_bank_detail->save();    
            }
            

            \DB::commit();

            return $user;
        } catch (\Exception $e) {
            // something went wrong
            throw $e;
        }
    }
    
    public function startCell() {
        return A1;
    }
}