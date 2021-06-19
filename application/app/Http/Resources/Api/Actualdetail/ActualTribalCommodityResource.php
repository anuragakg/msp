<?php

namespace App\Http\Resources\Api\Actualdetail;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Api\Proposals\MfpCoverageResource;
class ActualTribalCommodityResource extends JsonResource
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
            'action_detail_id' => $this->action_detail_id,
            'mfp_id' => $this->mfp_id,
            'mfp_name' => $this->getMfpName->getMfpName->title,
            'qty' => $this->qty,
            'value' => $this->value,
        ];
    }
}
