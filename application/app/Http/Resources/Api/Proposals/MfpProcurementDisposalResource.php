<?php

namespace App\Http\Resources\Api\Proposals;

use Illuminate\Http\Resources\Json\JsonResource;

class MfpProcurementDisposalResource extends JsonResource
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
            'mfp_id' => isset($this->mfp_id)?$this->mfp_id:null,
            'getMfpData'=>isset($this->getMfpData->getMfpName->title)?$this->getMfpData->getMfpName->title:null,
            'getWarehouseData'=>MfpDisposalWarehouseResource::collection($this->getWarehouseData)
            
        ];
    }
}
