<?php

namespace App\Services;

use App\Services\Service;
use Illuminate\Support\Facades\Auth;
use App\Queries\UserQuery;
use App\Queries\InspectionQuery;
use App\Queries\EvaluationQuery;
use Illuminate\Support\Facades\Mail;

use App\Models\User as ServiceModel;
use App\Models\UsersMapping;
use App\Models\UserRole;
use App\Models\UserDetail;
use App\Models\UserBankDetail;
use App\Models\EmailTemplate;
use App\Models\UsersActivity;
use App\Models\UsersAllowedStates;
use App\Models\UserPermissionMapping;
use App\Models\UserHaatBazaarMapping;
use App\Models\Masters\HaatDetailsMaster;
use App\Models\Masters\PermissionMapping as PermissionMappingModel;
use App\Models\UserWarehouseMapping;
use App\Rules\ValidIdProof;
use App\Rules\ValidName;
use App\Rules\ValidUsername;
use App\Rules\ValidNameWithDot;
use App\Rules\UniqueUserRoleLevel;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Carbon\Carbon;
use App\Notifications\Email\UserCreation;
use DB;
class UserService extends Service
{
    private $userQuery;

    public function __construct(UserQuery $userQuery = null, InspectionQuery $inspectionQuery = null, EvaluationQuery $evaluationQuery = null) {
        $this->userQuery = $userQuery;
        $this->inspectionQuery = $inspectionQuery;
        $this->evaluationQuery = $evaluationQuery;
    }
    /**
     * Get all items from database
     *
     * @return mixed
     */
    public function getAll($request)
    {
        $columns = array( 
                    0 =>'id', 
                    1=> 'user_name',
                    2=> 'name',
                    3=> 'email',
                    4=> 'mobile_no',
            );
        $limit = $request['length'];
        

        $order = $columns[$request['order'][0]['column']];
        $dir = $request['order'][0]['dir'];
        
        

        $query= $this->userQuery->viewAllQuery($request);
        
        if(isset($request['search']['value']) && !empty($request['search']['value']))
        {
            $search = $request['search']['value'];         
            $query->where(DB::raw("CONCAT(`user_name`,`name`,IFNULL(`middle_name`,''),IFNULL(`last_name`,''),`email`,IFNULL(`mobile_no`,''))"), 'LIKE', "%".$search."%");
        }
        if(isset($columns[$request['order'][0]['column']]) && !empty($columns[$request['order'][0]['column']]))
        {
            $query->orderBy($order,$dir);
        }
        return $query->paginate($limit);
	}
    
    /**
     * Creates a new item in table
     *
     * @param Array $data
     * @return mixed
     */
    public function createItem($data)
    {
        $user = new ServiceModel();
        $user_detail = new UserDetail();
        $user_bank_detail = new UserBankDetail();

        //transaction begin
        \DB::beginTransaction();
        try {
            #save user
            $user->user_name = $data['user_name'];
            $user->name = $data['name'];
            $user->middle_name = isset($data['middle_name']) ? $data['middle_name'] : null;
            $user->last_name = $data['last_name'];
            $user->email = $data['email'];
            $user->mobile_no = isset($data['mobile']) ? $data['mobile'] : null;
            $user->role = $data['role'];
            $user->level_id = $data['level_id'];
            $user->email_verify_token = $data['email']; // This should might change in future
            $user->created_by = $data['created_by'];
            $user->updated_by = $data['updated_by'];
            //$randomPassword='password';
            $randomPassword = \Illuminate\Support\Str::random(config('trifed.password_length')) ;
            $user->password = bcrypt(hash('sha256', $randomPassword));
            $user->save();

            #get userId
            $user_id = $user->id;

            /***** Now details should enter in user details table ******/
            #saving user details
            $user_detail->user_id = $user_id;
            $user_detail->state = $data['state'];
            $user_detail->district = $data['district'];
            $user_detail->block = 0;
            if (isset($data['dob'])) {
                $user_detail->dob = Carbon::createFromFormat('d/m/Y', $data['dob']);
            }
            $user_detail->landline_no = isset($data['landline_no']) ? $data['landline_no'] : null;
            $user_detail->id_proof_type = $data['id_proof_type'];
            $user_detail->id_proof_value = $data['id_proof_value'];
            $user_detail->official_address = $data['official_address'];
            $user_detail->department = $data['department'];
            $user_detail->designation = $data['designation'];
            $user_detail->created_by = $data['created_by'];
            $user_detail->updated_by = $data['updated_by'];
            $user_detail->save();

            #saving bank details
            if(isset($data['bankDept']) && $data['bankDept'] == 'on')
            {
                $user_bank_detail->user_id = $user_id;
                $user_bank_detail->ac_holder_name = $data['holder_name'];
                $user_bank_detail->bank_name = $data['bank_name'];
                $user_bank_detail->bank_ac_no = $data['bank_ac_no'];
                $user_bank_detail->ifsc_code = $data['ifsc_code'];
                $user_bank_detail->created_by = $data['created_by'];
                $user_bank_detail->updated_by = $data['updated_by'];
                $user_bank_detail->save();
            }     // dd($data['allowed_states']);      
            if($data['role']== 6 && isset($data['allowed_states']) && !empty($data['allowed_states']))
            {
                
                foreach ($data['allowed_states'] as $key => $state) 
                {
                    $UsersAllowedStates = new UsersAllowedStates();
                    $UsersAllowedStates['user_id']=$user_id;
                    $UsersAllowedStates['state']=$state;
                    $UsersAllowedStates['created_by']=$data['created_by'];
                    $UsersAllowedStates['updated_by']=$data['updated_by'];
                    $UsersAllowedStates->save();
                }
            }

            if($data['role']== 11 && isset($data['haat_bazaar']) && !empty($data['haat_bazaar']))
            {
                
                foreach ($data['haat_bazaar'] as $key => $haat_bazaar) 
                {
                    $UserHaatBazaarMapping = new UserHaatBazaarMapping();
                    $UserHaatBazaarMapping['user_id']=$user_id;
                    $UserHaatBazaarMapping['haat_bazaar_id']=$haat_bazaar;
                    $UserHaatBazaarMapping['created_by']=$data['created_by'];
                    $UserHaatBazaarMapping['updated_by']=$data['updated_by'];
                    $UserHaatBazaarMapping->save();
                }
            }
            if($data['role']== 9 && isset($data['warehouse']) && !empty($data['warehouse']))
            {
                $UserWarehouseMapping = new UserWarehouseMapping();
                $UserWarehouseMapping['user_id']=$user_id;
                $UserWarehouseMapping['warehouse_id']=$data['warehouse'];
                $UserWarehouseMapping['created_by']=$data['created_by'];
                $UserWarehouseMapping['updated_by']=$data['updated_by'];
                $UserWarehouseMapping->save();
            }
            
            \DB::commit();

            /**
             * Send Created notification
             */
            $user->notify(new UserCreation($user, $randomPassword));

            return $user;
        } catch (\Exception $e) {
            \DB::rollback();
            // something went wrong
            throw $e;
        }
    }

    /**
     * Get a single item from database
     *
     * @param number $id
     * @return mixed
     */
    public function getOne($id)
    {
        return ServiceModel::findOrFail($id);
    }

    /**
     * Update one item from database
     *
     * @param number $id
     * @param Array $data
     * @return mixed
     */
    public function updateItem($id, $data)
    {
        $user = ServiceModel::findOrFail($id);
        $user_detail = UserDetail::where('user_id', $id)->first();
        $user_bank_detail = UserBankDetail::where('user_id', $id)->first();

        //transaction begin
        \DB::beginTransaction();
        try {
            #save user
            $user->user_name = $data['user_name'];
            $user->name = $data['name'];
            $user->middle_name = isset($data['middle_name']) ? $data['middle_name'] : null;
            $user->last_name = $data['last_name'];
            $user->email = $data['email'];
            $user->level_id = $data['level_id'];
            $user->mobile_no = isset($data['mobile']) ? $data['mobile'] : null;
            // $user->role = $data['role'];
            $user->email_verify_token = $data['email']; // This should might change in future
            $user->updated_by = $data['updated_by'];
            $user->save();

            #get userId
            $user_id = $user->id;

            /***** Now details should enter in user details table ******/
            #saving user details
            $user_detail->user_id = $user_id;
            $user_detail->state = $data['state'];
            $user_detail->district = $data['district'];
            $user_detail->block = 0;
            if(isset($data['dob'])) {
                $user_detail->dob = Carbon::createFromFormat('d/m/Y', $data['dob']);
            }
            $user_detail->id_proof_type = $data['id_proof_type'];
            $user_detail->landline_no = isset($data['landline_no']) ? $data['landline_no'] : null;
            $user_detail->id_proof_value = $data['id_proof_value'];
            $user_detail->official_address = $data['official_address'];
            $user_detail->department = $data['department'];
            $user_detail->designation = $data['designation'];
            $user_detail->updated_by = $data['updated_by'];
            $user_detail->save();

            #saving bank details
            if(isset($data['bankDept']) && $data['bankDept'] == 'on')
            {
                if($user_bank_detail) {
                    $user_bank_detail->user_id = $user_id;
                    $user_bank_detail->ac_holder_name = $data['holder_name'];
                    $user_bank_detail->bank_name = $data['bank_name'];
                    $user_bank_detail->bank_ac_no = $data['bank_ac_no'];
                    $user_bank_detail->ifsc_code = $data['ifsc_code'];
                    $user_bank_detail->updated_by = $data['updated_by'];
                    $user_bank_detail->save();
                }else {
                    $user_bank_detail = new UserBankDetail();
                    $user_bank_detail->user_id = $id;
                    $user_bank_detail->ac_holder_name = $data['holder_name'];
                    $user_bank_detail->bank_name = $data['bank_name'];
                    $user_bank_detail->bank_ac_no = $data['bank_ac_no'];
                    $user_bank_detail->ifsc_code = $data['ifsc_code'];
                    $user_bank_detail->updated_by = $data['updated_by'];
                    $user_bank_detail->save();

                }
            }
            UsersAllowedStates::where('user_id',$user_id)->delete();
            if($user->role== 6 && isset($data['allowed_states']) && !empty($data['allowed_states']))
            {
                foreach ($data['allowed_states'] as $key => $state) 
                {
                    $UsersAllowedStates = new UsersAllowedStates();
                    $UsersAllowedStates['user_id']=$user_id;
                    $UsersAllowedStates['state']=$state;
                    $UsersAllowedStates['created_by']=$data['updated_by'];
                    $UsersAllowedStates['updated_by']=$data['updated_by'];
                    $UsersAllowedStates->save();
                }
            }
            UserHaatBazaarMapping::where('user_id',$user_id)->delete();
            if($user->role== 11 && isset($data['haat_bazaar']) && !empty($data['haat_bazaar']))
            {
                
                foreach ($data['haat_bazaar'] as $key => $haat_bazaar) 
                {
                    $UserHaatBazaarMapping = new UserHaatBazaarMapping();
                    $UserHaatBazaarMapping['user_id']=$user_id;
                    $UserHaatBazaarMapping['haat_bazaar_id']=$haat_bazaar;
                    $UserHaatBazaarMapping['created_by']=$data['updated_by'];
                    $UserHaatBazaarMapping['updated_by']=$data['updated_by'];
                    $UserHaatBazaarMapping->save();
                }
            }
            UserWarehouseMapping::where('user_id',$user_id)->delete();
            if($user->role== 9 && isset($data['warehouse']) && !empty($data['warehouse']))
            {
                    $UserWarehouseMapping = new UserWarehouseMapping();
                    $UserWarehouseMapping['user_id']=$user_id;
                    $UserWarehouseMapping['warehouse_id']=$data['warehouse'];
                    $UserWarehouseMapping['created_by']=$data['updated_by'];
                    $UserWarehouseMapping['updated_by']=$data['updated_by'];
                    $UserWarehouseMapping->save();
            }
            \DB::commit();
            return $user;
        } catch (\Exception $e) {
            \DB::rollback();
            // something went wrong
            throw $e;
        }
    }

    /**
     * Delete an item from database
     *
     * @param integer $id
     * @return boolean
     */
    public function deleteItem($id)
    {
        $item = ServiceModel::findOrFail($id);
        return $item->delete();
    }


    /**
     * Checks for the user exists or not.
     *
     * @param integer $id
     * @param integer $role
     * @return integer
     */
    public function switchStatus($id)
    {
        $user = ServiceModel::findOrFail($id);
        $user->switchStatus();
        $user->save();
        return $user->status;
    }

    public function SearchSurveyor($filter)
    {   
        if(!empty($filter['keyword'])){
            $name=$filter['keyword'];
        }
        else
        {
            $name='';
        }         
        return ServiceModel::where('name','LIKE','%'.$name.'%')->whereIn('role',[11,8])->groupby('name')->distinct()->limit(50)->get();
    }

    /**
     * Validates for creating a record.
     *
     * @param Array $data
     * @return mixed
     */
    public function validateCreate($data)
    {
        $model = new ServiceModel();

        $if_state='';
        $if_district='';
        $roles=array(4,5,6,7,8,9,10,11);
        if (in_array($data['role'], $roles)) 
        {
            $if_state='required';
        }
        else
        {
            $if_state='nullable';
        }
        $district_role=array(6,7,8,9,10,11);
        if (in_array($data['role'], $district_role)) 
        {
            $if_district='required';
        }
        else
        {
            $if_district='nullable';
        }
        $level_role=array(2,3,4,5,6);
        if (in_array($data['role'], $level_role)) 
        {
            $level_required='required';
        }
        else
        {
            $level_required='nullable';
        }

        $haatbazaar=array(11);
        if (in_array($data['role'], $haatbazaar)) 
        {
            $haatbazaar_required='required';
        }
        else
        {
            $haatbazaar_required='nullable';
        }
        $warehouse = array(9); //IF logged in user is warehouse User
        if (in_array($data['role'], $warehouse)) 
        {
            $warehouse_required='required';
        }
        else
        {
            $warehouse_required='nullable';
        }
        return Validator::make(
            $data,
            [
                
                'role' => 'required|not_in:0|exists:user_roles,id',
                'level_id' => [$level_required,new UniqueUserRoleLevel($data)],
                'state' => [$if_state],
                'district' => [$if_district],
                'user_name' => ['required', 'max:150', new ValidUsername, Rule::unique('users', 'user_name')],
                //'name' => ['required', 'alpha_spaces','max:50', new ValidName],
                'name' => ['required', new ValidNameWithDot, 'max:250'],
                'middle_name' => ['nullable', 'alpha_spaces', 'max:250'],
                'last_name' => ['nullable', 'alpha_spaces', 'max:250'],
                'email' => 'required|max:191|unique:users|email:rfc,dns',
                'mobile' => 'required|digits_between:10,11',
                'alternate_no' => 'nullable|digits_between:10,11',
                'landline_no' => 'nullable|digits_between:5,11',
                'dob' => 'required|date_format:d/m/Y|olderThan:18',
                'id_proof_type' => 'required|not_in:0|exists:mysql2.id_proof_master,id',
                'id_proof_value' => ['nullable', 'max:17', new ValidIdProof($data['id_proof_type'])],
                'official_address' => 'required|max:250|restrict_first_special',
                'allowed_states' => 'nullable',
                'haat_bazaar.*' => [$haatbazaar_required,'exists:haat_bazaar_master,id'],
                'warehouse' => [$warehouse_required,'exists:warehouse_master,id'],
                'department' => 'required|exists:department_master,id|not_in:0',
                'designation' => 'required|exists:designation_master,id|not_in:0',
                'bankDept' => 'nullable|max:20',
                'holder_name' => 'nullable|max:100|required_if:bankDept,on|alpha_spaces',
                'bank_name' => 'nullable|max:100|required_if:bankDept,on|alpha_spaces',
                'bank_ac_no' => 'nullable|required_if:bankDept,on|unique:user_bank_details|digits_between:6,18',
                'ifsc_code' => 'nullable|required_if:bankDept,on|min:6|max:12|alpha_num'
                
            ],
            [
                'level_id.required'=> "The level ID field is ".$level_required,
                'dob.required' => 'Date of Birth field is required',
                'dob.older_than' => 'Your age should be greater than or equal to 18 years',
                'role.not_in' => 'Please Select The Role',
                'state.not_in' => 'Please Select State',
                'district.not_in' => 'Please Select District',
                'id_proof_type.not_in' => 'Please Select ID Proof',
                'department.not_in' => 'Please Select Department',
                'designation.not_in' => 'Please Select Designation',
                'bank_name.alpha_spaces' => 'Bank name may only contain letters and spaces',
                'name.alpha_spaces' => 'Name may only contain letters and spaces',
                'holder_name.alpha_spaces' => 'Account holder name may only contain letters and spaces',
                'official_address.restrict_first_special'=>'First character should not be special character'

            ]
        );
    }

    /**
     * Validates for updating a record in databse
     *
     * @param integer $id
     * @param Array $data
     * @return mixed
     */
    public function validateUpdate($id, $data)
    {
        $model = new ServiceModel();
        $user=ServiceModel::findOrFail($id);
        $role= $user->role;
        $data['role']=$role;
        $level_role=array(2,3,4,5,6);
        if (in_array($data['role'], $level_role)) 
        {
            $level_required='required';
        }
        else
        {
            $level_required='nullable';
        }
        $haatbazaar=array(11);
        if (in_array($data['role'], $haatbazaar)) 
        {
            $haatbazaar_required='required';
        }
        else
        {
            $haatbazaar_required='nullable';
        }
        $warehouse=array(9);
        if (in_array($data['role'], $warehouse)) 
        {
            $warehouse_required='required';
        }
        else
        {
            $warehouse_required='nullable';
        }
        return Validator::make(
            $data,
            [
                'level_id' => [$level_required,new UniqueUserRoleLevel($data,$id)],
                'state' => [Rule::requiredIf(UserRole::where('role', [4, 6, 7, 8, 9, 10, 13,14,19,20,21,22,23,24,25,26]))],
                'district' => [Rule::requiredIf(UserRole::where('role', [13,14,21,22,25,26]))],
                'user_name' => ['required', 'max:150', new ValidUsername, Rule::unique($model->getTable())->ignore($id)],
                //'name' => ['required', 'alpha_spaces', 'max:50', new ValidName], commenting by naresh on 2 june 2020
                'name' => ['required', new ValidNameWithDot, 'max:250'],
                'middle_name' => ['nullable', 'alpha_spaces', 'max:250'],
                'last_name' => ['nullable', 'alpha_spaces', 'max:250'],
                'email' => ['required', 'email:rfc,dns' ,Rule::unique($model->getTable())->ignore($id)],
                'mobile' => 'required|digits_between:10,11',
                'landline_no' => 'nullable|digits_between:5,11',
                'alternate_no' => 'nullable|digits_between:10,11',
                'id_proof_type' => 'not_in:0|required|exists:mysql2.id_proof_master,id',
                'id_proof_value' => ['nullable', 'max:17', new ValidIdProof($data['id_proof_type'])],
                'official_address' => 'required|max:250|restrict_first_special',
                'allowed_states' => 'nullable',
                'haat_bazaar.*' => [$haatbazaar_required,'exists:haat_bazaar_master,id'],
                'warehouse' => [$warehouse_required,'exists:warehouse_master,id'],
                'dob' => 'required|date_format:d/m/Y|olderThan:18',
                'department' => 'required|exists:department_master,id',
                'designation' => 'required|exists:designation_master,id',
                'bankDept' => 'nullable|max:20',
                'holder_name' => 'nullable|alpha_spaces|max:100|required_if:bankDept,on',
                'bank_name' => 'nullable|alpha_spaces|max:100|required_if:bankDept,on',
                'bank_ac_no' => ['required_if:bankDept,on','nullable', 'digits_between:6,18',Rule::unique('user_bank_details')->ignore($id, 'user_id')],
                'ifsc_code' => 'nullable|min:6|max:12|required_if:bankDept,on|alpha_num'
            ],
            [
                'dob.required' => 'Date of Birth field is required',
                'dob.older_than' => 'Your age should be greater than or equal to 18 years',
                'id_proof_type.not_in' => 'Select ID Proof Type.',
                'bank_name.alpha_spaces' => 'Bank name may only contain letters and spaces',
                'name.alpha_spaces' => 'Name may only contain letters and spaces',
                'holder_name.alpha_spaces' => 'Account holder name may only contain letters and spaces',
                'official_address.restrict_first_special'=>'First character should not be special character'
            ]
        );
    }

    public function getUsersByEmail($emails)
    {
        $q = ServiceModel::whereIn("email", $emails)->get();
        return $q;
    }

    public function getInspectionUser(){
        // $q = ServiceModel::where('role',9)->get();
        $q = $this->inspectionQuery->viewAllQuery();
        return $q;
    }

    public function getAdminUser(){
        $q = ServiceModel::where('role',2)->get();
        return $q;
    }

    public function getMo(){
        $q = ServiceModel::where('role',8)->get();
        return $q;
    }

    public function getEvaluation(){
        // $query = ServiceModel::where('role',10)->get();
        $query = $this->evaluationQuery->viewAllQuery();
        return $query;
    }


    public function getSupervisor($id){
        $s = UsersMapping::where('parent_id',$id)->select('child_id')->get();
        $i=0;
        $r = array();
        if(!empty($s)){
            foreach($s as $supervisor){
                $r[$i] = ServiceModel::find($supervisor['child_id']);
                $i++;
            }
        }
        
        return $r;
    }

    public function getUserByEmail($email)
    {
        return ServiceModel::where("email", $email)->first();
    }

    public function sendMail($user,$page){

        return Mail::send([], [], function ($message ) use ($user, $page) {

            $host_url   = env('APP_URL');
            $email_data = $this->emailTemplate();

            $message->to($user->email)->subject($email_data->subject)->setBody('<h1>Hi, welcome '.$user->name.'!</h1>'.$email_data->description.'</br><p>Please Click On below link For Password Generate</p>'.$host_url.'/TRIFED-FrontEnd/auth/'.$page.'?email_verify_token='.$user->email_verify_token , 'text/html');
        });
    }

    public function emailTemplate(){
        return EmailTemplate::all()->first();
    }

    public function sendForgotMail($user,$page){

        return Mail::send([], [], function ($message ) use ($user, $page) {
            $host_url   = env('APP_URL');
            $email_data = $this->emailTemplate();
            
            $message->to($user->email)->subject($email_data->subject)->setBody('<h1>Hi, welcome '.$user->email.'!</h1>'.$email_data->description.'</br><p>Please Click On below link For Change Password</p>'.$host_url.'/TRIFED-FrontEnd/auth/'.$page.'?token='.$user->token , 'text/html');
        });

    }

    public function getUserByMobile($mobile){
        return ServiceModel::where('mobile_no',$mobile)->first();
    }

    public function getUserActivityLog()
    {
        $where=array();
        $user = Auth::user();
        if($user->role != 1) 
        {
            $where['user_id']=$user->id;
        }
        $query= UsersActivity::leftJoin('users', function($join) {
                  $join->on('users_activity.user_id', '=', 'users.id');
                })
                ->where($where)
                ->orderBy('users_activity.id','DESC')
                ->select('users.user_name','users_activity.*')->paginate();
        return $query;    
    }

    public function getSndSio()
    {
        $where=array();
        $role_arr=array('4','7','8');
        $q = ServiceModel::whereIn("role", $role_arr)->where('users.status','1')->get();
        return $q;
    }

    public function getUserslistWiseState($filters)
    {   
        $where = array();        
        if (isset($filters['state_id'])) {
            $where['user_details.state'] = $filters['state_id'];
        }
        $query= ServiceModel::Join('user_details', function($join) {
                  $join->on('users.id', '=', 'user_details.user_id');
                })
                ->join('user_roles', function($join) {
                  $join->on('users.role', '=', 'user_roles.id');
                })
                ->leftJoin('department_master', function($join) {
                  $join->on('user_details.department', '=', 'department_master.id');
                })
                 ->leftJoin('designation_master', function($join) {
                  $join->on('user_details.designation', '=', 'designation_master.id');
                })
                 ->leftJoin('states_master', function($join) {
                  $join->on('user_details.state', '=', 'states_master.id');
                })
                ->where($where)
                ->select('users.name','department_master.title as department','states_master.title as state_name','user_roles.title')->get();
        return $query;
       
    }

    public function validateUserPermissionCreate($data)
    {
        return Validator::make($data, [
            'user_id' =>'required|exists:users,id',
            'permission_id.*' =>'nullable|distinct|exists:permissions,id'
        ],
            [
                'user_id.required' => 'user id not defined',

            ]);
    }
    public function addUserPermissions($data)
    {
        $authUser = Auth::user();
        $item = [];

        DB::beginTransaction();
        try {
             /*==========Add Permissiosn Details========*/
            $permission_data=array();
            UserPermissionMapping::where('user_id', $data['user_id'])->delete();
            if(isset($data['permission_id']) && !empty($data['permission_id']))
            {
                //Master Management
                if(in_array("2", $data['permission_id']) || in_array("3", $data['permission_id']))
                {
                    if(!in_array("1", $data['permission_id']))
                    {
                        $data['permission_id'][]="1";    
                    }
                }

                if(in_array("6", $data['permission_id']) || in_array("7", $data['permission_id']))
                {
                    if(!in_array("5", $data['permission_id']))
                    {
                        $data['permission_id'][]="5";    
                    }
                }
                if(in_array("10", $data['permission_id']) || in_array("11", $data['permission_id']))
                {
                    if(!in_array("9", $data['permission_id']))
                    {
                        $data['permission_id'][]="9";    
                    }
                }
                if(in_array("13", $data['permission_id']) || in_array("14", $data['permission_id']))
                {
                    if(!in_array("15", $data['permission_id']))
                    {
                        $data['permission_id'][]="15";    
                    }
                }
                if(in_array("19", $data['permission_id']) || in_array("20", $data['permission_id']))
                {
                    if(!in_array("18", $data['permission_id']))
                    {
                        $data['permission_id'][]="18";    
                    }
                }
                if(in_array("23", $data['permission_id']) || in_array("24", $data['permission_id']))
                {
                    if(!in_array("22", $data['permission_id']))
                    {
                        $data['permission_id'][]="22";    
                    }
                }
                if(in_array("26", $data['permission_id']))
                {
                    if(!in_array("27", $data['permission_id']))
                    {
                        $data['permission_id'][]="27";    
                    }
                }
                if(in_array("28", $data['permission_id']) || in_array("29", $data['permission_id']) || in_array("30", $data['permission_id']) || in_array("31", $data['permission_id'])|| in_array("32", $data['permission_id'])|| in_array("33", $data['permission_id'])|| in_array("34", $data['permission_id'])|| in_array("35", $data['permission_id']))
                {
                    if(!in_array("18", $data['permission_id']))
                    {
                        $data['permission_id'][]="18";    
                    }
                }
                 if(in_array("37", $data['permission_id']) || in_array("38", $data['permission_id']))
                {
                    if(!in_array("36", $data['permission_id']))
                    {
                        $data['permission_id'][]="36";    
                    }
                }
                foreach ($data['permission_id'] as $key => $permission_id) 
                {
                    $permission_data=array(
                        'user_id'=>$data['user_id'],
                        'permission_id'=>$permission_id,
                        'created_by'=>$authUser->id,
                    );
                    $permission =new UserPermissionMapping($permission_data);
                    $permission->save(); 
                }
            }
            $item = $this->getOne($data['user_id']);
            //===================================
            DB::commit();
            return $item;
        }catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
    }

    public function getUserPermissions($user_id)
    {
        return UserPermissionMapping::where('user_id',$user_id)->get();
    }

     public function getUserPermissionsRoleBasis($user_id)
    {   
         $user = ServiceModel::where('id',$user_id)->first();;
         $user_permission = UserPermissionMapping::where('user_id',$user_id)->get();
         $role_permission= PermissionMappingModel::where('role_id', $user['role'])->get();
         $user_permission_and_role_permission = array('user_permission' => $user_permission,'role_permission'=>$role_permission );
         return $user_permission_and_role_permission ;
    }
     public function getCurrentUserHaatInfo()
    {
        $user = Auth::user();
        $usersHaatIds= UserHaatBazaarMapping::where('user_id',$user->id)->pluck('haat_bazaar_id');
        
        return HaatDetailsMaster::whereIn('id',$usersHaatIds)->get();    
        
        

    }
}
