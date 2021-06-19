<?php

namespace App\Http\Resources\Api\Proposals;

use Illuminate\Http\Resources\Json\JsonResource; 
class MfpPlanDetailViewResource extends JsonResource
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
            'id' => isset($this->id)?$this->id:'',              
            'mfp_commodity'=>MfpProcurementCommodityResource::collection($this->getProcurementCommodity),
            'mfp_storage'=>MfpProcurementStorageResource::collection($this->getMfpStoragePlan),
            'is_draft' => $this->is_draft,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
        ];
    }
}
