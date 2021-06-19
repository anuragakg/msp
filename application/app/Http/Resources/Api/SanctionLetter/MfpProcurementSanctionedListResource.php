<?php

namespace App\Http\Resources\Api\SanctionLetter;

use Illuminate\Http\Resources\Json\JsonResource;

class MfpProcurementSanctionedListResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {   
        $consolidation=$this->getConsolidatedData;
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
            'approved_amount'=> $this->approved_amount,
            'sanctioned_amount' => $this->sanctioned_amount,
            'transaction_id' => $this->transaction_id,
            'transaction_date' =>date('d/m/Y',strtotime($this->transaction_date)),
            'created_by' => ucwords($this->getUser->name.' '.$this->getUser->middle_name.' '.$this->getUser->last_name),
            'created_at' => date('d-M-Y H:i',strtotime($this->created_at)),
            'created_at' => date('d-M-Y H:i',strtotime($this->created_at)),
            
        ];
    }
}
