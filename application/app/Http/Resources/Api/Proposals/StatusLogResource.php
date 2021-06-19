<?php

namespace App\Http\Resources\Api\Proposals;
use App\Models\User;
use App\Models\Proposals\Mfp_procurement;
use App\Models\Masters\StateRoleSubLevel;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Resources\Json\JsonResource;

class StatusLogResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {   
        $is_last_level_user=$this->is_last_level_user($this->mfp_procurement_id,$this->assigned_to);
        $assigned_by=$this->getAssignedBy;
        $assigned_to=$this->getAssignedTo;
        switch ($this->status) {
            case '1':
                $status_text=$is_last_level_user==1?'Approved':'Recommended';
                break;
            case '2':
                $status_text='Reverted';
                break;
            case '3':
                $status_text='Rejected';
                break;
            
            default:
                $status_text='Pending';
                break;
        }
        return [
            'id' => $this->id,
            'mfp_procurement_id' => $this->mfp_procurement_id,
            'consolidated_id' => $this->consolidated_id,
            'consolidated_details' => $this->getConsolidatedDetails,
            'assigned_by' => $this->assigned_by,
            'assigned_by_name' => $assigned_by->name.' '.$assigned_by->middle_name.' '.$assigned_by->last_name,
            'assigned_by_level' => $assigned_by->level_id??'-',
            'assigned_by_role' => $assigned_by->getRole->title,
            'assigned_by_department' => isset($assigned_by->getUserDetails->getDepartment->title)?$assigned_by->getUserDetails->getDepartment->title:'-',

            'assigned_to' => $this->assigned_to,
            'assigned_to_name' => $assigned_to->name.' '.$assigned_to->middle_name.' '.$assigned_to->last_name,
            'assigned_to_level' => $assigned_to->level_id??'-',
            'assigned_to_role' => $assigned_to->getRole->title,
            'assigned_to_department' => isset($assigned_to->getUserDetails->getDepartment->title)?$assigned_to->getUserDetails->getDepartment->title:'-',

            'status' => $this->status,
            'status_text' => $status_text,
            'is_last_level_user' => $is_last_level_user,
            'remarks' => $this->remarks??'-',
            'created_at' => date('d-M-Y H:i',strtotime($this->created_at)),
        ];
    }
    private function is_last_level_user($mfp_procurement_id,$assigned_to)
    {
        $user=User::where('id',$assigned_to)->first();   
        $user_id=$assigned_to;
        $current_user_level_id=$user->level_id;
        
        $user_info= User::where([
                    'id' => $user_id
                ])->with([
                    'getUserDetails'
                ])->first();
        $user_data=$user_info->toArray();  
        
        $user_details=$user_data['get_user_details'];
        
        $procurement= Mfp_procurement::where('id', $mfp_procurement_id)->first();
        $dia_user=$procurement->created_by;
        $is_last_level=0;
        //====getLastLeval of scrutiny level====
        if(in_array($user->role, [1,2,3]))//ministry user
        {
            $user_state=$procurement->getUserDetails->getState->id;
        }else{
            $user_state=$user_details['state'];
        }
        //======================================
        if(!empty($procurement))
        {
            //===get last level user id====
            $last_level=StateRoleSubLevel::where('state_id',$user_state)->orderBy('id','desc')->first();
           
            $last_level_user=User::whereHas('getUserDetails', function (Builder $query) use ($last_level,$user) {
                    $query->where('role', $last_level->role_id);
                    if(!in_array($user->role, [1,2,3]))//ministry user
                    {
                        $query->where('state', $last_level->state_id);    
                    }
                    $query->where('level_id', $last_level->sublevel_id);
            })->first();
           
            if(!empty($last_level_user))
            {   
                if($user_id==$last_level_user->id)//last level user
                {
                    $is_last_level=1; 
                }
            }
            //=============================
            
        }
        return $is_last_level;  
    }
}
