<?php

namespace App\Http\Resources\Api\Actualdetail;

use Illuminate\Http\Resources\Json\JsonResource;
class ActualDetailInfrastructureResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {   
        $infra=$this->getInfraFormDetails; 
        $district = $infra->getUserDetails->getDistrict->title;
        $block = isset($infra->getUserDetails->getBlock->title)?$getUser->getUserDetails->getBlock->title:'';
       switch ($this->status) {
            case '1':
                $status_text='Submitted';
                break;
            case '2':
                $status_text='Reject';
                break;
            case '3':
                $status_text='Revert';
                break;    
            default:
                $status_text='Pending';
                break;
        }
        return [
            'id' => $this->id,
            'ref_id' => $this->ref_id,
            'txn_id' => $this->txn_id,
            'proposal_id' => $this->proposal_id,
            'consolidated_id' => $this->consolidated_id,
            'date' => date('d-M-Y',strtotime($this->date)),            
            'status' => $this->status,
            'district' => $district,
            'block' => $block,
            'status' => $this->status,
            'status_text' => $status_text,
            'logs_id' => $this->current_status_log_id,
            'logs' => $this->getStatusLogs,
            'fund_received' => $this->getInfraFormDetails['released_amount']??null,
            'release_acutal_fund' => $this->release_acutal_fund,
            'commission_amount' => $this->commission_amount,
            'is_assigned_next_level' => $this->is_assigned_next_level,
            'actual_haat' => ActualDetailHaatInfrastructureResource::collection($this->getActualHaat),
            'actual_warehouse' => ActualDetailWarehouseInfrastructureResource::collection($this->getActualWarehouse),
            'infra_data'    =>$infra,
            'created_at' => date('d-M-Y H:i',strtotime($this->created_at)),
            'updated_at' => date('d-m-Y H:i',strtotime($this->updated_at)),
        ];
    }
}
