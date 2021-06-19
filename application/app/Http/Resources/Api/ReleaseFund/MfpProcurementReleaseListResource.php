<?php

namespace App\Http\Resources\Api\ReleaseFund;

use Illuminate\Http\Resources\Json\JsonResource;

class MfpProcurementReleaseListResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {   
        $consolidation = $this->getConsolidatedData;
        $getUser = $this->getUser;
        return [
            'id' => $this->id,
            'consolidated_id' => $this->consolidated_id,
            'reference_number' => $consolidation->reference_number,
            'state' => $consolidation->state,
            'state_name' => $consolidation->getState->title,
            'year_id' => $consolidation->year_id,
            'year_name' => $consolidation->getProposedFinancialYear->title,
            'file_number' => $consolidation->file_number,
            'sanction_date' => date('d/m/Y',strtotime($this->sanction_date)),
            'approved_amount' => $this->approved_amount,
            'sanctioned_amount' => $this->sanctioned_amount,
            'max_can_release' => $this->max_can_release,
            'released_amount' => $this->released_amount,
            'commission_amount' => $this->commission_amount,
            'is_released' => $this->is_released,
            'balance_amount' => $this->max_can_release-($this->released_amount+$this->commission_amount),
            'created_by' => $getUser->name.' '.$getUser->middle_name.' '.$getUser->last_name,
            'created_at' => date('d/m/Y H:i',strtotime($this->created_at)),
            'created_at' => date('d/m/Y H:i',strtotime($this->created_at)),
            
        ];
    }
}
