<?php

namespace App\Http\Resources\Api\ReleaseFund;

use Illuminate\Http\Resources\Json\JsonResource;

class MfpProcurementFundReceivedCommodityResource extends JsonResource
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
            'mfp_procurement_dia_release_id' => $this->mfp_procurement_dia_release_id,
            'mfp_procurement_id' => $this->mfp_procurement_id,
            'procurement_agent' => $this->procurement_agent,
            'mfp_id' => $this->mfp_id,
            'mfp_name' => $this->getMfpName->getMfpName->title,
            'qty' => $this->qty,
            'value' => $this->value,
            'created_by' => $this->created_by,
            
            'created_at' => date('d/m/Y H:i',strtotime($this->created_at)),
            
            
        ];
    }
}
