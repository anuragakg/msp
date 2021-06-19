<?php

namespace App\Services\Proposals;
use App\Models\Masters\CommissionMaster;
use App\Models\Proposals\Mfp_procurement;
use App\Models\Proposals\Mfp_procurement_summary;
use App\Models\Proposals\Mfp_procurement_scrutiny_level_history;
use App\Models\Proposals\Mfp_procurement_status_log;
use App\Models\User;
use App\Services\Service;
use App\Queries\ProcurementQuery;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use App\Models\Masters\StateLevel;
use App\Models\Masters\StateRoleSubLevel;
use App\Notifications\MfpProcurementSubmission;
use DB;
class MfpProcurementSummaryService extends Service
{   
    private $procurementQuery;

    public function __construct(ProcurementQuery $procurementQuery = null) {
        $this->procurementQuery = $procurementQuery;
    }
    

    
    /**
     * Get a single item from database
     *
     * @param number $id
     * @return mixed
     */
    public function getOne($id)
    {
        return Mfp_procurement::where('ref_id', $id)->firstOrFail();
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
        DB::beginTransaction();
     
        try {
            $user = Auth::user();   
            $user_id= $user->id;
            $user_role=$user->role;
            $user_info= User::where([
                    'id' => $user_id
                ])->with([
                    'getUserDetails'
                ])->first();
            $user_data=$user_info->toArray();  
            $user_details=$user_data['get_user_details'];
            $user_state=$user_details['state'];
            if(isset($data['submit_type']) && $data['submit_type']=='submit')
            {
                $is_draft = '0';    
            }else{
                $is_draft = '1';    
            }
            $procurement = Mfp_procurement::where('ref_id', $data['form_id'])->firstOrFail();
            $this->canUpdateProposal($procurement);
            if(isset($data['submit_type']) && $data['submit_type']=='submit')
            {
                $procurement->submission_status = 1;
                //===Commission save=====
                $get_commission=CommissionMaster::where(['status'=>'1','state'=>$user_state,'role'=>$user_role])->first();
                if(!empty($get_commission))
                {
                    $procurement->commission=$get_commission->commission;
                    
                }else{
                    throw new \Exception("Commission not set for your role.Please contact to administrator.You can save your data as draft");
                }
                

                 //check is all previous steps completed 
                if($procurement->is_step1_complete == '0' && $procurement->is_step2_complete == '0' && $procurement->is_step3_complete == '0'){
                    throw new \Exception("Please save all previous steps data before final submit");
                }

            
            }else{
                $procurement->submission_status = 0;
                
            }
            
          
            Mfp_procurement_summary::where('mfp_procurement_id', $procurement->id)->delete();
            $mfp_procurement_summary = new Mfp_procurement_summary();
            $mfp_procurement_summary->mfp_procurement_id = $procurement->id;  
            $mfp_procurement_summary->any_other_available = $data['any_other_available'];
            $mfp_procurement_summary->old_fund_require = $data['old_fund_require'];
            $mfp_procurement_summary->total_fund_require = $data['total_fund_require'];
            $mfp_procurement_summary->is_draft = $is_draft;
            $mfp_procurement_summary->created_by = $user_id;
            $mfp_procurement_summary->updated_by = $user_id;
            $mfp_procurement_summary->save();

           
            if(isset($data['submit_type']) && $data['submit_type']=='submit')
            {
                //===Maintain scrutiny level history======    
                $state_level_scrutiny=array();
                $state_level=StateLevel::where('state_id',$user_state)->with('getSublevel')->get();

                if(!empty($state_level))
                {
                    Mfp_procurement_scrutiny_level_history::where('mfp_procurement_id',$procurement->id)->delete();
                    foreach ($state_level as $key => $level) 
                    {
                        if(isset($level['getSublevel']) && !empty($level['getSublevel']))
                        {
                            foreach ($level['getSublevel'] as $key => $sublevel) 
                            {

                                $state_level_scrutiny=array(
                                    'mfp_procurement_id'=>$procurement->id,
                                    'state_id'=>$level->state_id,
                                    'level_id'=>$level->level_id,
                                    'role_id'=>$level->role_id,
                                    'sublevel_id'=>$sublevel->sublevel_id,
                                );        
                                $scrutiny=new Mfp_procurement_scrutiny_level_history($state_level_scrutiny);
                                $scrutiny->save();
                            }
                        }
                        
                    }
                }
                //check which level user is submitting form
                $logged_in_user_level = User::where('id',Auth::user()->id)->first();          

                //=== Find next level of logged in user state ===========================
                $next_level=StateRoleSubLevel::where('state_id',$user_state)->first();
                
                if(!empty($next_level))
                {
                    $user=User::whereHas('getUserDetails', function (Builder $query) use ($next_level) {
                        $query->where('role', $next_level->role_id);
                        $query->where('state', $next_level->state_id);
                        $query->where('level_id', $next_level->sublevel_id);
                        
                    })->first();
                    /*
                        *AGAR NEXT ROLE BHI DIA HI HAI TO DIA K LEVEL SE UPPER LEVEL KA USER HONA CHAHIYE
                        *CONDITION ADDED ON 21-01-2021 AFTER DISCUSSION WITH ABHISHEK OVER CALL 
                    */
                    if($logged_in_user_level->role == $user->role && $logged_in_user_level->level_id > $user->level_id)
                    {
                        $nextleveldata=$this->getNextLevelUser($user_state,$next_level,$logged_in_user_level);
                        //dd($nextleveldata);
                        $next_level=$nextleveldata['next_level'];
                        $user=$nextleveldata['user'];
                    }
                    
                    //if form is submitted by same level user which already defined in scrutiny then skip that one for approval
                    if($logged_in_user_level->role == $user->role && $logged_in_user_level->level_id == $user->level_id){
                        $next_level=StateRoleSubLevel::where('state_id',$user_state)->skip(1)->take(1)->first();
                        $user = User::whereHas('getUserDetails', function (Builder $query) use ($next_level) {
                            $query->where('role', $next_level->role_id);
                            $query->where('state', $next_level->state_id);
                            $query->where('level_id', $next_level->sublevel_id);
                            
                        })->first();
                    }
                    if(!empty($user))
                    {
                        $procurement->current_scrutiny_level_id = $next_level->id;
                        $procurement->assigned_by = $user_id;
                        $procurement->assigned_to = $user->id;
                        $procurement->current_status = 0;    
                        $procurement->is_assigned_next_level = '0';    
                        
                        
                        $lookup=[
                                'mfp_procurement_id'=>$procurement->id,
                                'assigned_by'=>$user_id,
                                'assigned_to'=>$user->id,
                                'status'=>0
                            ];
                        $logs= Mfp_procurement_status_log::updateOrCreate(
                            $lookup,
                            [
                                'mfp_procurement_id'=>$procurement->id,
                                'assigned_by'=>$user_id,
                                'assigned_to'=>$user->id,
                                'status'=>0,  
                                'is_assigned_next_level'=>'0',
                                'created_by'=>$user_id,
                                'updated_by'=>$user_id,
                            ]
                        );
                        
                        $procurement->current_status_log_id = $logs->id; 
                        $procurement->status=0;
                        $procurement->assigned_date=date('Y-m-d H:i:s');
                        $procurement->submission_date=date('Y-m-d H:i:s');
                        $procurement->save();
                       
                        //==Add User Activity
                        $activity='Submitted MFP Procurement form of proposal id -'.$procurement->proposal_id;
                        $module='mfp_procurement';
                        $this->addUserActivity($activity,$module);
                        //===Send Notification========

                        $to = User::findOrFail($user->id);
                        $from = User::findOrFail($user_id);
                        $to->notify(new MfpProcurementSubmission($procurement,$from));
                    }else{
                        throw new \Exception("No user is find in next level of level ".$next_level->level_id);   
                    }
                }else{
                    throw new \Exception("No scrutiny level defined .Please contact administrator.You can save your data as draft");   
                }
                
                

            }
            
            DB::commit();
            
            return Mfp_procurement::where([
                'id' => $procurement->id
            ])->firstOrFail();
            
        }catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
    }
    public function getNextLevelUser($user_state,$next_level,$logged_in_user_level)
    {
        $next_level=StateRoleSubLevel::where(['state_id'=>$user_state])->where('id','>',$next_level->id)->first();

        $user = User::whereHas('getUserDetails', function (Builder $query) use ($next_level) {
            $query->where('role', $next_level->role_id);
            $query->where('state', $next_level->state_id);
            $query->where('level_id', $next_level->sublevel_id);
        })->first();

        if($logged_in_user_level->role == $user->role && $logged_in_user_level->level_id = $user->level_id)
        {
            return $this->getNextLevelUser($user_state,$next_level,$logged_in_user_level);
        }else if($logged_in_user_level->role == $user->role && $logged_in_user_level->level_id > $user->level_id){
            return $this->getNextLevelUser($user_state,$next_level,$logged_in_user_level);
        }else{
            $data=array(
                'next_level'=>$next_level,
                'user'=>$user,
            );
            return $data;
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
        $item->deleteDistricts();
       
        return $item->delete();
    }

    /**
     * Validates for creating a record.
     *
     * @param Array $data
     * @return mixed
     */
    public function validateCreate($data)
    {
      
        $required='nullable';
        if(isset($data['submit_type']) && $data['submit_type']=='submit')
        {
            $required='required';
        }
        return Validator::make($data, [
            'submit_type'=>'nullable',
            'form_id'=>'nullable|exists:mfp_procurement,ref_id',
            'any_other_available' => [
                $required,
            ],
            'old_fund_require' => [
                $required,'numeric','decimal_value'
            ],
            'total_fund_require' => [
                $required,'numeric','decimal_value'
            ],
            
        ]
        
        );
    }

   
    
    /**
     * Switch the status of the given user id.
     *
     * @param integer $id
     * @return string|integer
     */
    public function switchStatus($id)
    {
        $model = ServiceModel::where([
            'id' => $id
        ])->firstOrFail();
        $model->switchStatus();
        $model->save();
        return $model->status;
    }    
    
    
    }
