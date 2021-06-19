<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\User;
use App\Models\Proposed\Vdvk;
use App\Models\Masters\StateLevel;
class ProposedStatuslogResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        

        $getAssignedBy=$this->getAssignedBy;

        $VdvkLocation=$this->getVdvkLocation;
        //dd($VdvkLocation);
        $getAssignedTo=$this->getAssignedTo;
        $getMentoringOfficerId=$this->getMentoringOfficerId;
        $getRevertedTo=array();
        if($this->reverted_to)
        {
            $getRevertedTo=$this->getRevertedTo;
        }
        $mo_id=$getMentoringOfficerId->user_id;
        $user_details=User::Join('user_details', function($join) {
                      $join->on('users.id', '=', 'user_details.user_id');
            })
            ->leftJoin('states_master', function($join) {
                      $join->on('user_details.state', '=', 'states_master.id');
            })    
            ->leftJoin('districts_master', function($join) {
                      $join->on('user_details.district', '=', 'districts_master.id');
            })
            ->leftJoin('blocks_master', function($join) {
                      $join->on('user_details.block', '=', 'blocks_master.id');
            })
            ->where([
            'users.id'=>$mo_id])
            ->select('users.*','states_master.title as state_name','districts_master.title as district_name','blocks_master.title as block_name')    
            ->first();
            $userdata=$user_details->toArray();
            
        if(!empty($user_details))
        {
            $userdata=$user_details->toArray();
            
        }
        
        $is_last_level=$this->is_last_level($this->vdvk_id,$this->assigned_to);
        switch ($this->status) {
            case '0':
                $status_text='Pending';
                break;
            case '1':
                
                $status_text=$is_last_level=='1'?'Approved':'Recommended';
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
        switch ($this->is_assigned_next_level) {
            case '0':
                $reverted_text='Pending';
                break;
            case '1':
                
                $reverted_text='Reverted';
                break;
            
            default:
                $reverted_text='Reverted';
                break;
        }
        return [
            'id' => $this->id,
            'mo_id' => $mo_id,
            'mo_name' => isset($userdata['name'])? strip_tags($userdata['name']) :'',
            
            'state_name' => $VdvkLocation->getState->title,//isset($userdata['state_name'])? strip_tags($userdata['state_name']) :'',
            'district_name' => $VdvkLocation->getDistrict->title,//isset($userdata['district_name'])? strip_tags($userdata['district_name']) :'',
            'block_name' => $VdvkLocation->getBlock->title,//isset($userdata['block_name'])? strip_tags($userdata['block_name']) :'',
            'vdvk_name' => $VdvkLocation['kendra_name'],
            'reference_id' => $this->reference_id,
            'encoded_reference_id' => str_replace('-','_',$this->reference_id),
            'added_by' => $this->vdvk_id,
            'vdvk_id' => $this->vdvk_id,
            'level_id' => $this->level_id,
            'assigned_by' => $this->assigned_by,
            'assigned_by_name' => ($getAssignedBy->exists) ? $getAssignedBy->name : null,
            'assigned_by_role' => isset($getAssignedBy->getRole->title)? $getAssignedBy->getRole->title:'',
            'assigned_by_department' => isset($getAssignedBy->getUserDetails->getDepartment->title)? $getAssignedBy->getUserDetails->getDepartment->title:'',
            'assigned_by_designation' => isset($getAssignedBy->getUserDetails->getDesignation->title)? $getAssignedBy->getUserDetails->getDesignation->title:'',
            'assigned_to' => $this->assigned_to,
            'assigned_to_name' => ($getAssignedTo->exists) ? $getAssignedTo->name : null,
            'assigned_to_department' => isset($getAssignedTo->getUserDetails->getDepartment->title)? $getAssignedTo->getUserDetails->getDepartment->title:'',
            'assigned_to_designation' => isset($getAssignedTo->getUserDetails->getDesignation->title)? $getAssignedTo->getUserDetails->getDesignation->title:'',
            'assigned_to_role' => isset($getAssignedTo->getRole->title)? $getAssignedTo->getRole->title:'',

            'reverted_to' => $this->reverted_to,
            'reverted_to_name' => isset($getRevertedTo->name) ? $getRevertedTo->name : null,
            'reverted_to_department' => isset($getRevertedTo->getUserDetails->getDepartment->title)? $getRevertedTo->getUserDetails->getDepartment->title:'',
            'reverted_to_designation' => isset($getRevertedTo->getUserDetails->getDesignation->title)? $getRevertedTo->getUserDetails->getDesignation->title:'',
            'reverted_to_role' => isset($getRevertedTo->getRole->title)? $getRevertedTo->getRole->title:'',


            'status' => $this->status,
            'is_last_level'=>$is_last_level,
            'status_text' => $status_text,
            'reverted_text' => $reverted_text,
            'remarks' => $this->remarks,
            'reverted_remarks' => $this->reverted_remarks,
            'created_at' => date('d-M-Y H:i',strtotime($this->created_at)),
        ];
        
    }
    function is_last_level($vdvk_id,$authId)
    {
        $user_info= User::where([
                'id' => $authId
            ])->with([
                'getUserDetails'
            ])->first();
        $user_data=$user_info->toArray(); 

        $user_role_id=$user_data['role'];

        //$vdvk_data= Vdvk::where('id','=',$vdvk_id)->first();
        $vdvk = Vdvk::findOrFail($vdvk_id);

        $vdvk_user_info= User::where([
                'id' => $vdvk->user_id
            ])->with([
                'getUserDetails'
            ])->first();
        $vdvk_user=$vdvk_user_info->toArray();  

        $state_id=$vdvk_user['get_user_details']['state'];
        //get state of vdvk user
        $state_levels= StateLevel::where([
            'state_id' => $state_id
        ])->orderBy('id','desc')->get();

        $is_last_level=0;
        if(!empty($state_levels))
        {
            $state_levels_data=$state_levels->toArray();    

            foreach ($state_levels_data as $key => $state_level) 
            {
                $levelid=$state_level['level_id'];
                $roleid=$state_level['role_id'];
                $level_role_arr[$levelid]=$roleid;  
            }
            $last_key = array_key_last($level_role_arr); 

            $last_role=$level_role_arr[$last_key];
            //if user is on last level 
            if($last_role==$user_role_id)
            {
                $is_last_level=1;
            }else
            {
                //get next role id
                /*Follow step 3*/  
                $is_last_level=0;
            }
        }
        return $is_last_level;
            
    }
}
