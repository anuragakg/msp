<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Api\ProposedLocationResource;
use App\Http\Resources\Api\ProposedShgResource;
use App\Http\Resources\Api\ProposedEquipmentsResource;
use App\Http\Resources\Api\ProposedHaatBazaarLinkageResource;
use App\Http\Resources\Api\ProposedWareHouseLinkageResource;
use App\Http\Resources\Api\ProposedBuyerTieUpsResource;
use App\Http\Resources\Api\ProposedFundsRequestResource;
use App\Http\Resources\Api\FundDistribution\PostMonitoringResource;

class ActualVdvkResource extends JsonResource
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
            'ProposedLocation' => ProposedLocationResource::make($this->getActualLocation),
            'ProposedShg' => ProposedShgResource::collection($this->getActualShg),
            'ProposedMFP' => ProposedMfpDetailResource::collection($this->getActualMfp),
            'ProposedValueAddition' => ProposedValueAdditionResourceNew::collection($this->getActualValueAddition),
            'ProposedEquipment' => ProposedEquipmentsResource::make($this->getActualEquipment),
            'HaatBazaarLinkage' => ProposedHaatBazaarLinkageResource::collection($this->getActualHaatBazaarLinkage),
            'WarehouseLinkage' => ProposedWareHouseLinkageResource::collection($this->getActualWarehouseLinkage),
            'BuyerTieUps' => ProposedBuyerTieUpsResource::collection($this->getActualBuyerTieUps),
            'FundHighlights' => ProposedHighlightResource::make($this->getActualHighlights),
            'ProjectedFinancials' => ProposedFinancialResource::make($this->getActualProjectedFinancials),
            'FundsRequest' => ProposedFundsRequestResource::collection($this->getActualFundsRequest),
            'PostMonitoringData' => PostMonitoringRemarks::make($this->getOtherPostMonitoring),
        ];
    }
}

class PostMonitoringRemarks extends JsonResource {

    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'vdvk_id' => $this->vdvk_id,
            'status' => $this->status,
            'created_by' => $this->created_by,
            'created_by' => $this->created_by,
            'other_remarks' => $this->getOtherRemarks,
            'entity_remarks' => $this->getEntityRemarks,
            'other_response' => $this->getOtherResponse,
        ];   
    }

}
