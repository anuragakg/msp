<?php

namespace App\Http\Resources\Api\SanctionLetter;

use Illuminate\Http\Resources\Json\JsonResource;

class InfrastructureGenerateSanctionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {   
        $consolidation=$this->getConsolidationdata;
        $assignedToUser=$this->getAssignedToUser;
        return [
            'id' => $this->id,
            'consolidated_id' => $consolidation->id,
            'reference_number' => $consolidation->reference_number,
            'file_number' => $consolidation->file_number,
            'sanction_date' => date('d/m/Y',strtotime($consolidation->sanction_date)),
            //'consolidation'=>$consolidation,
            'is_state_share'=>$this->is_state_share,
            // 'transaction_id' => $this->transaction_id,
            // 'transaction_date' => date('d/m/Y',strtotime($this->transaction_date)),
            'total_sanctioned_amount' => $consolidation->sanctioned_amount,
            'total_balance_amount' => $consolidation->balance_amount,
            'state' => $consolidation->state,
            'state_name' => $consolidation->getState->title,
            'year_id' => $consolidation->year_id,
            'is_sanctioned' => $this->is_sanctioned,
            'approved_amount' => $this->approved_amount,
            'sanctioned_amount' => $this->sanctioned_amount,
            'balance_amount' => $this->balance_amount,
            'maximum_sanction_percent' => $this->maximum_sanction_percent,
            'year_name' => $consolidation->getProposedFinancialYear->title,
            'assignedToUser' => $assignedToUser->user_name.'('.$assignedToUser->name.' '.$assignedToUser->last_name.')' ,


            
        ];
    }
}
