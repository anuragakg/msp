<?php

namespace App\Http\Resources\Api\ReleaseFund;

use Illuminate\Http\Resources\Json\JsonResource;

class MfpProcurementFundReceivedProcurementAgentDetailResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {   
        $mfp_procurement=$this->getMfpProcurement;
        return [
            'id' => $this->id,
            'mfp_procurement_id' => $this->mfp_procurement_id,
            'proposal_id' => $mfp_procurement->proposal_id,
            'procurement_agent' => $this->procurement_agent,
            'procurement_agent_details' => $this->getProcurementAgent,
            'total_mfp' => $this->total_mfp,
            'total_quantity' => $this->total_quantity,
            'total_value' => $this->total_value,
            'total_released_to_procurement_agent' => $this->total_released_to_procurement_agent,
            'commodity_details'=>MfpProcurementFundReceivedCommodityResource::collection($this->commodity_details),
            'bank_details'=>MfpProcurementFundReceivedBankResource::collection($this->bank_details),
            'created_by' => $this->getUser,
            'created_at' => date('d-M-Y H:i',strtotime($this->created_at)),
            
            
        ];
    }
}
