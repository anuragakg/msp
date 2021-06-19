<?php

namespace App\Http\Resources\Api\Infrastructures;

use Illuminate\Http\Resources\Json\JsonResource;

class TxnStatusLogResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {   
        $assigned_by=$this->getAssignedBy;
        $assigned_to=$this->getAssignedTo;
        switch ($this->status) {
            case '1':
                $status_text='Recommended';
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
            'infra_id' => $this->actual_infra_id,
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
            'remarks' => $this->remarks??'-',
            'created_at' => date('d-M-Y H:i',strtotime($this->created_at)),
        ];
    }
}
