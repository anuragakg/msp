<?php

namespace App\Http\Resources\Api\Proposals;

use Illuminate\Http\Resources\Json\JsonResource; 
class MfpProcurementPlanResource extends JsonResource
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
            'mfp_storage'=>MfpProcurementStorageResource::collection($this->getMfpStoragePlan),
            'mfp_commodity'=>MfpProcurementCommodityResource::collection($this->getProcurementCommodity),
            'is_draft' => $this->is_draft,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
        ];
    }
}
