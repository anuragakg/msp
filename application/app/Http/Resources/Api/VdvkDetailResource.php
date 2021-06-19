<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Api\ProposedLocationResource;
use App\Http\Resources\Api\ProposedShgResource;
use App\Http\Resources\Api\ProposedMfpDetailResource;
use App\Http\Resources\Api\ProposedEquipmentsResource;
use App\Http\Resources\Api\ProposedHaatBazaarLinkageResource;
use App\Http\Resources\Api\ProposedWareHouseLinkageResource;
use App\Http\Resources\Api\ProposedBuyerTieUpsResource;
use App\Http\Resources\Api\ProposedFundsRequestResource;

class VdvkDetailResource extends JsonResource
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
            'ProposedLocation' => ProposedLocationResource::make($this->getProposedLocation),
            'ProposedShg' => ProposedShgResource::collection($this->getProposedShg),
            'ProposedMFP' => ProposedMfpDetailResource::collection($this->getProposedMfp),
            'ProposedEquipment' => ProposedEquipmentsResource::make($this->getProposedEquipment),
            'HaatBazaarLinkage' => ProposedHaatBazaarLinkageResource::collection($this->getProposedHaatBazaarLinkage),
            'WarehouseLinkage' => ProposedWareHouseLinkageResource::collection($this->getProposedWarehouseLinkage),
            'BuyerTieUps' => ProposedBuyerTieUpsResource::collection($this->getProposedBuyerTieUps),
            'FundHighlights' => ProposedHighlightResource::make($this->getProposedHighlights),
            'ProjectedFinancials' => ProposedFinancialResource::make($this->getProposedProjectedFinancials),
            'BuyerTieUps' => ProposedBuyerTieUpsResource::collection($this->getProposedBuyerTieUps),
            'FundsRequest' => ProposedFundsRequestResource::collection($this->getProposedFundsRequest),
        ];
    }
}
