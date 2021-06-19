<?php

namespace App\Services;

use Carbon\Carbon;
use App\Services\Service;
use App\Models\User as ServiceModel;
use App\Models\UserBankDetail;
use App\Models\ForgotPassword;
use App\Models\UserPasswordHistory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;

use Illuminate\Support\Facades\Storage;
use App\Rules\ValidName;

class AuthService extends Service
{
    /**
     * Email verify from the database
     *
     * @param number $id
     * @param Array $data
     * @return mixed
     */
    public function emailVerify($data)
    {   
        $user = ServiceModel::where('email_verify_token','=', $data['email_verify_token'])
                            ->firstOrFail();

        $user->email_verified_at = now();
        $user->save(); 

        return $user;
    }

    /**
     * Generate password for user
     *
     * @param number $id
     * @param Array $data
     * @return mixed
     */

    public function generatePasswrod($data)
    {
        $user = ServiceModel::where('email_verify_token','=', $data['email_verify_token'])
                            ->firstOrFail();

        $user->password = bcrypt($data['password']);
        $user->email_verify_token = NULL;
        $user->email_verified_at  = now();
        $user->save();

        $data = ['hash' => $user->password , 'user_id' => $user->id];
        $item = new UserPasswordHistory($data);
        $item->save();

        return $user;
    }


    public function changePassword($data)
    {
        $newPassword = hash('sha256',$data['password']);
        $oldPassword = hash('sha256', $data['old_password']);
        $authId = Auth::user()->id;
        $cryptedpassword = Auth::user()->password;
        $hashedPassword = Hash::make($newPassword);
        $passwords = UserPasswordHistory::where('user_id','=', $authId)
                                        ->orderBy('id','desc')->take(3)
                                        ->select('hash')->get()->toArray();

        if(Hash::check($oldPassword, $cryptedpassword)) {
          
            foreach ($passwords as $hashed) {
                  
               if(Hash::check($newPassword, $hashed['hash'])){
                 $status = 2;
                 return $status;
               }
            }
            return $this->updatePassword($authId,$newPassword);

        } else {
           $status = 0;
        }
        return $status;  

    }

     public function updatePassword($authId,$password)
    {
        $password = bcrypt($password);
        $user = ServiceModel::where('id','=', $authId)
                            ->firstOrFail();
        $user->password = $password;
        $user->save();
        
        $data = ['hash' => $password , 'user_id' => $authId];
        $item = new UserPasswordHistory($data);
        $item->save();
        
        $status = 1;

        return $status;

    }



    /**
     * Validates for email verify
     *
     * @param integer $id
     * @param Array $data
     * @return mixed
     */
    public function validateEmailVerification($data)
    {
        return Validator::make($data, [
            'email_verify_token' => 'required',
        ]);
    }

    /**
     * Validates for generate password
     *
     * @param integer $id
     * @param Array $data
     * @return mixed
     */
    public function validateGeneratePassword($data)
    {
        return Validator::make($data, [
            'email_verify_token' => 'required',
            'password'           => 'required',
        ]);
    }

    /**
     * Validates for generate password
     *
     * @param integer $id
     * @param Array $data
     * @return mixed
     */
    public function validateChangePassword($data)
    {
        return Validator::make($data, [
            'old_password'     => 'required',
            'password'         => [
                'required',
                'required_with:confirm_password',
                'same:confirm_password',
                'min:6',
                'regex:/^.*(?=.{3,})(?=.*[A-Z])(?=.*[a-z])(?=.*[0-9])(?=.*[\d\X])(?=.*[@!$#%]).*$/'
            ],
            'confirm_password' => 'required',
        ], [
            'confirm_password.required' => 'The New Password field is required.',
            'password.required' => 'The New Password field is required.',
            'password.regex' => 'The Password must contain Combination of 1. Lowercase characters {a-z}, 2. Uppercase characters {A-Z} , 3. Numbers {0-9} and special characters: @, #, $, %, &, and +'
        ]);
    }

    public function getUserData($id){
        return $userInst = ServiceModel::where('id',$id)->firstOrFail();
    }

    public function updateUserProfile($id, $role, $data){

        $user = ServiceModel::where([
            'id' => $id,
        ])->firstOrFail(); 

        /**
         * Update All User
         */
        $middle_name = isset($data['middle_name']) ? $data['middle_name'] : null;
        $updateUser = [
            'name' => $data['name'],
            'middle_name' => $middle_name,
            'last_name' => $data['last_name']??null,
            'email' => $data['email'],
            'mobile_no' => $data['mobile_no'],
        ];
        $user->update($updateUser);

        
        /**
         * Update user details based on his role like Mo , Supervisor , Surveyor  And Rest will be Users.
         */
        switch($role):

            case 'mo':
                /**
                 * Update MO Details
                 */
            $regData=isset($data['mo_details']['registration_date']) ? Carbon::createFromFormat('d/m/Y', $data['mo_details']['registration_date']) : null;
            $regExp=isset($data['mo_details']['registration_expiry']) ? Carbon::createFromFormat('d/m/Y', $data['mo_details']['registration_expiry']) : null;
                $updateMoDetails = [
                    'chairman_name'         => $data['mo_details']['chairman_name'],
                    'chairman_mobile'       => $data['mo_details']['chairman_mobile'],
                    "chairman_email"        => $data['mo_details']['chairman_email'],
                    "secretary_name"        => $data['mo_details']['secretary_name'],
                    "secretary_mobile"      => $data['mo_details']['secretary_mobile'],
                    "secretary_email"       => $data['mo_details']['secretary_email'],
                    "registration_date"     => $regData,
                    "registration_expiry"   => $regExp, 
                    "gst_or_tan"            => $data['mo_details']['gst_or_tan']??null
                ];
              // print_r($updateMoDetails); die();
                $moDetails = $user->getMentoringOrganisationDetails;
                if ($moDetails) {
                    $moDetails->update($updateMoDetails);
                }
            break;

            /**
             * Update Supervisor Details
             */
            case 'supervisor':

                $updateSupervisorDetails = [
                    "alternate_no"          => isset($data['alternate_no']) ? $data['alternate_no'] : null
                ];
                $supervisorSurveyorDetails = $user->getSurveyorSupervisorDetails;
                if ($supervisorSurveyorDetails) {
                    $supervisorSurveyorDetails->update($updateSupervisorDetails);
                }
            break;

            /**
             * Update Surveyor Details
             */
            case 'surveyor':

                $updateSupervisorDetails = [
                    "alternate_no"          => isset($data['alternate_no']) ? $data['alternate_no'] : null
                ];
                $supervisorSurveyorDetails = $user->getSurveyorSupervisorDetails;
                if ($supervisorSurveyorDetails) {
                    $supervisorSurveyorDetails->update($updateSupervisorDetails);
                }
                break;

            default:
                /**
                 * Update User Details
                 */
                $updateUserDetails = [
                    'official_address' => $data['official_address'],
                    'landline_no'      => $data['landline_no']??null
                ];
                $getUserDetails = $user->getUserDetails;
                if ($getUserDetails) {
                    $getUserDetails->update($updateUserDetails);
                }

        endswitch;
        /**
         * Update Bank Details
         */
        if(isset($data['user_bank_details'])){
            
            $updateBankDetails = [
                'bank_name'         => $data['user_bank_details']['bank_name'],
                'branch_name'       => 'test',//$data['user_bank_details']['branch_name'],
                'ifsc_code'         => $data['user_bank_details']['ifsc_code'],
                'bank_ac_no'        => $data['user_bank_details']['bank_ac_no'],
                'mobile_no'         => '9874563210', //$data['user_bank_details']['mobile_no'],
                "ac_holder_name"    => $data['user_bank_details']['ac_holder_name']
            ];

            $getUserBankDetails = $user->getUserBankDetails;

            if ($getUserBankDetails) {   
                $getUserBankDetails->update($updateBankDetails);
            }else
            { 
                $user_bank_details = new UserBankDetail();
                $user_bank_details->user_id = $user['id'];
                $user_bank_details->ac_holder_name = $data['user_bank_details']['ac_holder_name'];
                $user_bank_details->branch_name = '';
                $user_bank_details->bank_name = $data['user_bank_details']['bank_name'];
                $user_bank_details->bank_ac_no = $data['user_bank_details']['bank_ac_no'];
                $user_bank_details->ifsc_code = $data['user_bank_details']['ifsc_code'];
                $user_bank_details->mobile_no = '';
                $user_bank_details->save();
                //$getUserBankDetails->save($updateBankDetails);
            }
        }

        return $user;

    }

    public function ValidateUpdateUserProfile($id, $data){    

        $validator = [
            'name'                             => ['required', 'max:20', new ValidName],
            'middle_name'                      => ['nullable', 'max:15', new ValidName],
            'last_name'                        => ['nullable', 'max:20', new ValidName],
            'email'                            => 'required|unique:users,id,'.$id,
            'mobile_no'                        => 'required|max:15',

            'official_address'                 => 'required|max:250',
            'landline_no'                      => 'nullable|digits_between:5,11',

            //'user_bank_details.branch_name'    => 'required|max:11',
            'user_bank_details.ac_holder_name' => 'nullable|max:20',
            'user_bank_details.bank_name'      => 'nullable|max:25',
            'user_bank_details.bank_ac_no'     => ['nullable', 'digits_between:1,20', Rule::unique('user_bank_details')->ignore($id, 'user_id')],
          //  'user_bank_details.mobile_no'      => 'required|max:15',
            'user_bank_details.ifsc_code'      => 'nullable|max:11',
        ];

        return Validator::make($data, $validator);
    }


    public function ValidateUpdateSupervisorSurveyorProfile($id, $data){

        $validator = [
            'name'                             => ['required', 'max:20', new ValidName],
            'middle_name'                      => ['nullable', 'max:15', new ValidName],
            'last_name'                        => ['required', 'max:20', new ValidName],
            'email'                            => 'required|unique:users,id,'.$id,
            'mobile_no'                        => 'required|digits_between:10,11',

            'alternate_no'                     => 'nullable|digits_between:10,11',

            //'user_bank_details.branch_name'    => 'required|max:11',
            'user_bank_details.ac_holder_name' => 'nullable|max:20',
            'user_bank_details.bank_name'      => 'nullable|max:25',
            'user_bank_details.bank_ac_no'     => ['nullable', 'digits_between:1,20', Rule::unique('user_bank_details')->ignore($id, 'user_id')],
           // 'user_bank_details.mobile_no'      => 'required|max:15',
            'user_bank_details.ifsc_code'      => 'required|max:11',
        ];

        return Validator::make($data, $validator);
    }

    public function ValidateUpdateMoProfile($id, $data){

        $validator = [
            'name'                             => ['required', 'max:20', new ValidName],
            'middle_name'                      => ['nullable', 'max:15', new ValidName],
            'last_name'                        => ['required', 'max:20', new ValidName],
            'email'                            => 'required|unique:users,id,'.$id,
            'mobile_no'                        => 'required|max:15',

            'mo_details.chairman_name'         => 'required|max:25',
            'mo_details.chairman_mobile'       => 'required|digits_between:10,11',
            'mo_details.chairman_email'        => 'required|max:25',
            'mo_details.secretary_name'        => 'required|max:25',
            'mo_details.secretary_mobile'      => 'required|digits_between:10,11',
            'mo_details.secretary_email'       => 'required|max:25',
            'mo_details.registration_date'     => 'nullable|date_format:d/m/Y',
            'mo_details.registration_expiry'   => 'nullable|date_format:d/m/Y',
            'mo_details.gst_or_tan'            => 'nullable|max:25',

            // 'user_bank_details.branch_name'    => 'required|max:11',
            // 'user_bank_details.ac_holder_name' => 'required|max:20',
            // 'user_bank_details.bank_name'      => 'required|max:25',
            // 'user_bank_details.bank_ac_no'     => ['required', 'digits_between:1,20', Rule::unique('user_bank_details')->ignore($id, 'user_id')],
            // 'user_bank_details.mobile_no'      => 'required|max:15',
            // 'user_bank_details.ifsc_code'      => 'required|max:11',
        ];

        return Validator::make($data, $validator);
    }

    public function validateFileUpload($data)
    {
        return Validator::make($data, [
            'registration_certificate' => 'nullable|mimes:pdf|max:2048',
        ]);
    }

    public function updateMoCertificate($id, $file){
        if(isset($file)){

            $file_original_name = $file->getClientOriginalName();

            Storage::disk('local')->putFileAs('MO/registration_certificate', $file, $file_original_name);
            $updateMoDetails=[
                'registration_certificate' => 'MO/registration_certificate/' . $file_original_name
            ];

            $user = ServiceModel::where([
                'id' => $id,
            ])->firstOrFail();


            $moDetails = $user->getMentoringOrganisationDetails;

            if ($moDetails) {
                $moDetails->update($updateMoDetails);
            }

            return $user;

        }

        return $file;
    }

    /**
     * Validates for forgot password
     *
     * @param integer $id
     * @param Array $data
     * @return mixed
     */
    public function validateForgotPassword($data)
    {   $model = new ServiceModel();
        return Validator::make($data, [
            'otp_option'=>'required',
            'email' => 'nullable|required_if:otp_option,email|exists:users,email',
            'mobile_no' => 'nullable|required_if:otp_option,mobile|exists:users,mobile_no'
        ],
            [
                'email.exists' => 'Email account does not exist.',
                'mobile_no.exists' => 'Mobile number does not exist.', 

            ]);
    }

    public function setForgotPasswordToken($user , $token=null)
    {
        $userExists = ForgotPassword::where('email' , $user->email)->first();
        if($userExists){            
            $userExists->token = $token;
            $userExists->created_at = now();
            $userExists->save();
            return $userExists;
        }
        else{
            $resetPassword = new ForgotPassword();
            $resetPassword->email = $user->email;
            $resetPassword->token = $token; 
            $resetPassword->created_at = now();
            $resetPassword->save();
            return $resetPassword;
        }
        
    }

    public function validateResetPassword($data)
    {
        return Validator::make($data, [
            'token'    => 'required',
            'password' => 'required'
        ]);
    }

    public function resetPassword($data)
    {
        $forgot = ForgotPassword::where('token','=', $data['token'])->firstOrFail();
        $forgot->token = NULL;
        $forgot->save();

        $user_data= ServiceModel::where('email','=', $forgot->email)->firstOrFail();
        $user_data->password = bcrypt(hash('sha256', $data['password']));
        $user_data->updated_at  = now();
        $user_data->save();

        $data = ['hash' => $user_data->password , 'user_id' => $user_data->id];
        $item = new UserPasswordHistory($data);
        $item->save();
        return $user_data;
    }

}
