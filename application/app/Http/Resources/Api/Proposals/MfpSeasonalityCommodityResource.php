<?php

namespace App\Http\Resources\Api\Proposals;

use Illuminate\Http\Resources\Json\JsonResource;
class MfpSeasonalityCommodityResource extends JsonResource
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
            'mfp_procurement_id'=>$this->mfp_procurement_id,
            'mfp_seasonality_id' => $this->mfp_seasonality_id,
            'mfp_id' => $this->mfp_id,
            'getMfp' => $this->getMfp,
            'qty' => $this->qty,
            'value' => $this->value,
            'month' => $this->getMfpMonths,
            
            
        ];
    }
}
