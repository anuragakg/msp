<?php

namespace App\Http\Resources\Api\ReleaseFund;

use Illuminate\Http\Resources\Json\JsonResource;
use Helper;
class MfpProcurementCommissionReceivedDetailResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {   
       
        return [
            'id' => $this->id,
            'mfp_procurement_id' => $this->mfp_procurement_id,
            'procurement_agent_id' => $this->procurement_agent,
            'procurement_agent' => $this->getProcurementAgent->user_name,
            'proposal_id' => $this->getMfpProcurement->proposal_id,
           // 'transaction_date' => $this->transaction_date,
            'transaction_date' => date('d-M-Y',strtotime($this->transaction_date)),
            'release_amount' => $this->release_amount,
            'commission_amount' => $this->commission_amount,
            'commission_rate' => Helper::decimalNumberFormat($this->commission_rate),
            
        ];
    }

    
}
