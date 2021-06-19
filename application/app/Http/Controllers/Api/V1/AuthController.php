<?php

namespace App\Http\Controllers\Api\V1;

use App\Channels\SmsChannel;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request; 
use App\Http\Controllers\Api\V1\ApiController;
use App\Lib\AesJs;
use App\Lib\AdditionalPermissions;
use App\Models\User; 
use App\Models\UsersActivity; 
use App\Models\RefreshToken; 
use App\Services\AuthService;

use App\Services\Masters\RoleService;
use App\Http\Resources\Api\UserProfileResource as UserResource;
use App\Http\Resources\Api\MentoringOrganisationProfileResource as MentoringOrganisationResource;
use App\Http\Resources\Api\SupervisorSurveyorProfileResource as SupervisorSurveyorResource;
use App\Lib\AuthHelpers;
use App\Models\Masters\StateRoleSubLevel;
use App\Notifications\ForgotPassword;
use App\Notifications\ResetPassword;
use Jenssegers\Agent\Agent;
use Illuminate\Support\Str;

use App\Services\UserService;

class AuthController extends ApiController 
{
		protected $service;
		protected $authHelper;

	    public function __construct(AuthService $authService, RoleService $roleService, UserService $userService)
	    {
	        $this->service = $authService;
	        $this->roleService = $roleService;
			$this->user_service=$userService;

			$this->authHelper = new AuthHelpers;
			
	    }
		/** 
	     * login api 
	     * 
	     * @return \Illuminate\Http\Response 
	     */ 
	    public function login(){ 

			$agent = new Agent();
			$path=env('OPENSSL_PATH');

			$isBlocked = $this->authHelper->isUserBlocked(request('username'));

			if ($isBlocked) {
				return $this->respondWithValidationError(
					sprintf('Too many failed attempts, Please try again after %s secs', $isBlocked)
				);
			}
			
			$private_key = openssl_pkey_get_private($path);
			$cipherTextUsername = request('username');
			$bin_cipherTextUsername = base64_decode($cipherTextUsername);
			$cipherTextPassword = request('password');
			$bin_cipherTextPassword = base64_decode($cipherTextPassword);

			openssl_private_decrypt($bin_cipherTextUsername, $username, $private_key, OPENSSL_PKCS1_PADDING); 
			openssl_private_decrypt($bin_cipherTextPassword, $password, $private_key, OPENSSL_PKCS1_PADDING);
	        if(Auth::attempt(['user_name' => $username, 'password' => $password])){ 
	            $user = Auth::user(); 

	            /*if($agent->isMobile()){
	            	if($user['role'] != 11 || $user['role'] != 12  ){
	            		return $this->respondWithValidationError("You are not Supervisor/Surveyor !!"); 
	            	}
				}*/
				if($user['role'] == 11 || $user['role'] == 12  ){
	            		//return $this->respondWithValidationError("You are not allowed on web application.Please use mobile app !!"); 
	            }

	            if ($user->status == 1) {
	            	$userDetails = $user->getUserDetails;
	            	// if(in_array($user['role'],array(2,3,4,5,6))){
	            	// 	$last_level=StateRoleSubLevel::where('state_id',$userDetails->getState->id)->orderBy('id','desc')->first();	
	            	// }
					
		            $success['id'] = $user['id'];
		            $success['user_name'] = $user['user_name'];
		            $success['name'] = $user['name'];
			        $success['email'] =  $user['email'];
					$success['role']  = $user['role']; 
					$success['level_id'] = $user['level_id'];	
			        $success['role_name']  = $user->getRole->title;
			        $success['state_id'] = $userDetails->getState->id ?? null;
			        $success['state'] = $userDetails->getState->title ?? null;
				
			        $success['district_id'] = $userDetails->getDistrict->id ?? null;
			        $success['district'] = $userDetails->getDistrict->title ?? null;

			        $success['block_id'] = $userDetails->getBlock->id ?? null;
			        $success['block'] = $userDetails->getBlock->title ?? null;
					$success['permissions'] = [];
					$success['warehouse']=isset($user->getUserWarehouse)?$user->getUserWarehouse->warehouse_id:null;
					$user_permission=$user->getUserPermissions->toArray();
					// if(in_array($user['role'],array(2,3,4,5,6))){
					// 	//if loggedin user highest role with highest level
					// 	if($last_level->sublevel_id == $user['level_id'] &&  $last_level->role_id == $user['role']){
					// 		$success['is_highest_role_level'] = true;
					// 	}
					// }
					
				
           
					if(!empty($user_permission))
					{
						foreach ($user_permission as $permissionObj) {

							if (!in_array($permissionObj['group'], $success['permissions'])) {
								$success['permissions'][] = $permissionObj['group'];
							}
							$success['permissions'][] = $permissionObj['alias'];				
						}	
					}else{
						foreach ($user->getPermissions as $permissionObj) {
							if (!in_array($permissionObj->group, $success['permissions'])) {
								$success['permissions'][] = $permissionObj->group;
							}
							$success['permissions'][] = $permissionObj->alias;				
						}	
					}
					

					$this->setAdditionalPermissions($user, $success['permissions']);

					$success['token'] =  $user->createToken('MyApp')->accessToken;
					
					//REFRESH TOKEN
					$unique_id = uniqid(); // Str::uuid();
					$hash_code = md5($unique_id);
					$expire_time = date('Y-m-d H:m:s', strtotime("+15 days"));
					$refresh_Token=array(
						'user_id'=>$user['id'],
						//'created_by'=>$user['id'],
						'expire_time'=>$expire_time,
					);
					$RefreshToken=new RefreshToken($refresh_Token);
        			$RefreshToken->save();
        			$reference = RefreshToken::findOrFail($RefreshToken->id);
        			$reference_id=$hash_code.$reference->id;
		        	$update_reference['hash_code']=$reference_id;
		        	$reference->update($update_reference);
		        	$success['refresh_token']=$reference_id;


					//===========USERS ACTIVITY=====
					$users_activity=array(
						'user_id'=>$user['id'],
						'ip_address'=>$_SERVER['REMOTE_ADDR'],
						'activity'=>'Login',
					);
					$user_activity=new UsersActivity($users_activity);
        			$user_activity->save();
					
					$user->unBlock();
					
		            return $this->respondWithSuccess($success);  
	            } elseif ($user->status == 0) {
	            	return $this->respondWithValidationError("Account Deactivated. Please contact Admin");
	            }
	        } 
	        else{

                $users_activity=array(
                    'user_id'=>0,
                    'ip_address'=>$_SERVER['REMOTE_ADDR'],
                    'activity'=>'Login Failed With Username :'. $username,
                );
                $user_activity=new UsersActivity($users_activity);
                $user_activity->save();

				$user = $this->authHelper->failedLoginAttempt(
					request('username')
				);
				if ($user) {
					$attemptsRemaining = $user->attemptsRemaining();
					return $this->respondWithValidationError(sprintf(
						"Username and password don\'t match, Remaining Attempts : %s",
						$attemptsRemaining
					));
				}				

				return $this->respondWithValidationError("Username and password don\'t match");
	            
	        } 
	    }

	    
	    public function logout(Request $request)
		{ 
			if ($request->user()) {
				$request->user()->token()->revoke();

			}
			//===========USERS ACTIVITY=====
			/*$users_activity=array(
						'user_id'=>$user['id'],
						'ip_address'=>$_SERVER['REMOTE_ADDR'],
						'activity'=>'Logout',
					);
			$user_activity=new UsersActivity($users_activity);
			$user_activity->save();*/
			//===============================
	        return $this->respondWithSuccess(['message' => 'User logged out.']);
		}
		

		public function emailVerify(Request $request){ 
			$valid = $this->service->validateEmailVerification($request->all());

	        if ($valid->fails()) {
	            return $this->respondWithValidationError($valid);
	        }

	        $data = $valid->validated();

	        try {

	            $userVerified = $this->service->emailVerify($data);
		        if (!$userVerified) {
	                return $this->respondNotFound();
	            } else {
	                return $this->respondWithSuccess(['message' => 'Email Verified.']);
	            }
	        } catch (\Throwable $th) {
	            return $this->respondNotFound();
	        }
	    }


	    public function generatePassword(Request $request){ 

	    	$valid = $this->service->validateGeneratePassword($request->all());

	        if ($valid->fails()) {
	            return $this->respondWithValidationError($valid);
	        }

	        $data = $valid->validated();
	        try {

	            $userGenerated = $this->service->generatePasswrod($data);
		        if (!$userGenerated) {
	                return $this->respondNotFound();
	            } else {
	                return $this->respondWithSuccess(['message' => 'Password Created Successfully.']);
	            }
	        } catch (\Throwable $th) {
	            return $this->respondNotFound();
	        }
	    }

	    public function changePassword(Request $request){ 
	    	$valid = $this->service->validateChangePassword($request->all());

	        if ($valid->fails()) {
	            return $this->respondWithValidationError($valid);
	        }
			$data = $valid->validated();

	        try {

	            $status = $this->service->changePassword($data);
	            if ($status == 0) {
	                return $this->respondWithValidationError("Old Password doesn't match.");
	            } else if($status == 2){
	            	return $this->respondWithValidationError("The New Password can'be same as last three passwords.");
	            }else {
	            	$authId=Auth::user()->id;
		        	$user = User::where([
	                        'id' => $authId,
	                    ])->firstOrFail();
	                    
	            	$user->notify(new ResetPassword());
	                return $this->respondWithSuccess(['message' => "Password Changed Successfully."]);
	            }
	        } catch (\Throwable $th) {
	            return $this->respondNotFound();
	        }

		}
		
		/**
		 * Sets additional permission base on custom logic
		 * for any specified user.
		 *
		 * @param \App\Models\User $user
		 * @param array $permissions
		 * @return void
		 */
		private function setAdditionalPermissions ($user, &$permissions) {
			(new AdditionalPermissions($user))->grantPermissions($permissions);
			$permissions = array_values($permissions);
		}

	    public function profile(Request $request){
	    	$authUser = Auth::user();
	    	$role = $this->roleService->getOne($authUser->role);

	    	if(!$role){
	    		return $this->respondNotFound();
	    	}

			$userData = $this->service->getUserData($authUser->id);

	    	switch($role->slug):
			    case 'mo':
					$items = MentoringOrganisationResource::make($userData);
			        break;

			    case 'supervisor':
					$items = SupervisorSurveyorResource::make($userData);
			        break;

			    case 'surveyor':
			        $items = SupervisorSurveyorResource::make($userData);
			        break;

			    default:
					$items = UserResource::make($userData);

			endswitch;

			return $this->respondWithSuccess($items);

	    }

	    public function updateProfile(Request $request){

	    	$authUser= Auth::user();
	    	$role = $this->roleService->getOne($authUser->role);
	    	
	    	switch($role->slug):
			    case 'mo':
			    	$valid = $this->service->ValidateUpdateMoProfile($authUser->id, $request->all());
			        break;

			    case 'supervisor':
			    	$valid = $this->service->ValidateUpdateSupervisorSurveyorProfile($authUser->id, $request->all());
			        break;

			    case 'surveyor':
			        $valid = $this->service->ValidateUpdateSupervisorSurveyorProfile($authUser->id, $request->all());
			        break;

			    default:
	    			$valid = $this->service->ValidateUpdateUserProfile($authUser->id, $request->all());	

			endswitch;

    		if($valid->fails()){
    			return $this->respondWithValidationError($valid);
    		}

    		$data = $valid->validated();
    		
	    	try{
		    	$updateProfile = $this->service->updateUserProfile($authUser->id, $role->slug, $data);
		    	return $this->respondWithSuccess(['message' => "User Profile Updated Successfully."]);
	    	} catch (\Throwable $th) {
	            return $this->respondNotFound();
	        }

	    }

	    public function updateMoProfileCertificate(Request $request){

	    	$authUser= Auth::user();
	    	$role = $this->roleService->getOne($authUser->role);

		    if($role->slug === 'mo'){
	    		$valid = $this->service->validateFileUpload($request->all());
		    }
    		if($valid->fails()){
				return $this->respondWithValidationError($valid);
			}
		    
			$data = $request->file('registration_certificate');

	    	try{
		    	$user = $this->service->updateMoCertificate($authUser->id, $data);
		    	return $this->respondWithSuccess(['message' => "Registraton Certificate Updated Successfully."]);

	    	} catch (\Throwable $th) {
	            return $this->respondNotFound();
	        }
	    }

	    public function forgotPassword(Request $request){

	    	$valid = $this->service->validateForgotPassword($request->all());
	    	
	        if ($valid->fails()) {
	            return $this->respondWithValidationError($valid);
	        }

	        $data = $valid->validated();

	       // try{

		        if ( isset($data['mobile_no']) && $data['mobile_no'] !="" && $data['otp_option'] =="mobile"){

		        	$user = $this->user_service->getUserByMobile($data['mobile_no']);
			        if(!empty($user)){
			        	$otp = rand(100000, 999999);			        
						$this->service->setForgotPasswordToken($user, $otp); 
						$user->notify(new ForgotPassword([SmsChannel::class], ['otp' => $otp]));
						return $this->respondWithSuccess(['message' => 'Otp is sent to your registered no.']);
					}else{
						return $this->respondWithSuccess(['message' => 'Otp is sent to your registered no.']);
					}
			        
		        }

		        if ( isset($data['email']) && $data['email'] !="" && $data['otp_option'] =="email"){		        	
					$user = $this->user_service->getUserByEmail($data['email']);
					if(!empty($user))
					{
						$token = Str::random();
			        	$this->service->setForgotPasswordToken($user, $token);
						$user->notify(new ForgotPassword(['mail'], ['token' => $token]));
				        return $this->respondWithSuccess(['message' => "Reset Password Link Sent Successfully."]);	
					}else{
						return $this->respondWithSuccess(['message' => "Reset Password Link Sent Successfully."]);	
					}
					
		        }

		   // } catch (\Throwable $th) {
	            return $this->respondNotFound();
	        //}
	    }

	    public function resetPassword(Request $request){ 
	    	$valid = $this->service->validateResetPassword($request->all());

	        if ($valid->fails()) {
	            return $this->respondWithValidationError($valid);
	        }

	        $data = $valid->validated();
	        try {

	        	$userGenerated = $this->service->resetPassword($data);
		        if (!$userGenerated) {
					return $this->respondWithError('OTP is incorrect');
	            } else {
	                return $this->respondWithSuccess(['message' => 'Password Reset Successfully.']);
	            }

	        } catch (\Throwable $th) {
				return $this->respondWithError('OTP is incorrect');
	        }
	    }

	    public function refreshToken(Request $request)
	    {
	    	$refresh_token=request('refresh_token');
	    	if($refresh_token!='')
	    	{
	    		$current_time= date('Y-m-d H:m:s');
		    	$token_data=RefreshToken::where('hash_code', $refresh_token)->firstOrFail();
		    	if($token_data)
		    	{
		    		if(strtotime($token_data->expire_time) < strtotime($current_time))
		    		{
		    			return $this->respondWithError('Token is expired,Kindly login again');
		    		}else{
		    			$user_id=$token_data->user_id;	
		    			$user = $this->user_service->getOne($user_id);
		    			$success['token'] =  $user->createToken('MyApp')->accessToken;
		    			return $this->respondWithSuccess($success);  
		    		}
		    	}else{
		    		return $this->respondWithError('Invalid Token');
		    	}
		    }else{
		    	return $this->respondWithError('Please enter refresh token');
		    }
	    	
	    	
	    }

	    public function mobile_login(){ 

			$agent = new Agent();

			$isBlocked = $this->authHelper->isUserBlocked(request('username'));

			if ($isBlocked) {
				return $this->respondWithValidationError(
				sprintf('Too many failed attempts, Please try again after %s secs', $isBlocked)
				);
			}
			$password = hash('sha256', request('password'));
			//echo $password;
	        if(Auth::attempt(['user_name' => request('username'), 'password' => $password])){ 
	            $user = Auth::user(); 

	            if($agent->isMobile()){
	            	if($user['role'] != 11 || $user['role'] != 12  ){
	            		//return $this->respondWithValidationError(""); 
	            	}
				}

	            if ($user->status == 1) {
	            	$userDetails = $user->getUserDetails;
		            $success['id'] = $user['id'];
		            $success['user_name'] = $user['user_name'];
		            $success['name'] = ucwords($user['name']);
			        $success['email'] =  $user['email'];
			        $success['role']  = $user['role']; 
			        $success['role_name']  = $user->getRole->title;
			        $success['state_id'] = $userDetails->getState->id ?? null;
			        $success['state'] = $userDetails->getState->title ?? null;

			        $success['district_id'] = $userDetails->getDistrict->id ?? null;
			        $success['district'] = $userDetails->getDistrict->title ?? null;

			        $success['block_id'] = $userDetails->getBlock->id ?? null;
			        $success['block'] = $userDetails->getBlock->title ?? null;
					$success['permissions'] = [];
					
					foreach ($user->getPermissions as $permissionObj) {
						if (!in_array($permissionObj->group, $success['permissions'])) {
							$success['permissions'][] = $permissionObj->group;
						}
						$success['permissions'][] = $permissionObj->alias;				
					}

					$this->setAdditionalPermissions($user, $success['permissions']);

					$success['token'] =  $user->createToken('MyApp')->accessToken;
					
					//REFRESH TOKEN
					$unique_id = uniqid(); // Str::uuid();
					$hash_code = md5($unique_id);
					$expire_time = date('Y-m-d H:m:s', strtotime("+15 days"));
					$refresh_Token=array(
						'user_id'=>$user['id'],
						//'created_by'=>$user['id'],
						'expire_time'=>$expire_time,
					);
					$RefreshToken=new RefreshToken($refresh_Token);
        			$RefreshToken->save();
        			$reference = RefreshToken::findOrFail($RefreshToken->id);
        			$reference_id=$hash_code.$reference->id;
		        	$update_reference['hash_code']=$reference_id;
		        	$reference->update($update_reference);
		        	$success['refresh_token']=$reference_id;


					//===========USERS ACTIVITY=====
					$users_activity=array(
						'user_id'=>$user['id'],
						'ip_address'=>$_SERVER['REMOTE_ADDR'],
						'activity'=>'Login',
					);
					$user_activity=new UsersActivity($users_activity);
        			$user_activity->save();
					
					$user->unBlock();
					
		            return $this->respondWithSuccess($success);  
	            } elseif ($user->status == 0) {
	            	return $this->respondWithValidationError("Account Deactivated. Please contact Admin");
	            }
	        } 
	        else{
				$user = $this->authHelper->failedLoginAttempt(
					request('username')
				);
				if ($user) {
					$attemptsRemaining = $user->attemptsRemaining();
					return $this->respondWithValidationError(sprintf(
						"Username and password don\'t match, Remaining Attempts : %s",
						$attemptsRemaining
					));
				}

				return $this->respondWithValidationError("Username and password don\'t match");
	            
	        } 
	    }
}
