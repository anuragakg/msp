<?php

namespace App\Http\Resources\Api\Proposals;

use Illuminate\Http\Resources\Json\JsonResource;
class ActualOverheadResource extends JsonResource
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
            'getActualOverheadCollectionLevel'=>ActualOverheadCollectionLevelResource::collection($this->getActualOverheadCollectionLevel),
            'getActualOverheadLabourCharges'=>MfpProcurementLabourChargesResource::collection($this->getActualOverheadLabourCharges),
            'getActualOverheadWeightmentCharges'=>MfpProcurementWeightmentChargesResource::collection($this->getActualOverheadWeightmentCharges),
            'getActualOverheadTransportationCharges'=>MfpProcurementTransportationChargesResource::collection($this->getActualOverheadTransportationCharges),
            'getActualOverheadServiceCharges'=>MfpProcurementServiceChargesResource::collection($this->getActualOverheadServiceCharges),
            'getActualOverheadWarhouseLabourCharges'=>MfpProcurementWarehouseLabourResource::collection($this->getActualOverheadWarehouseLabourCharges),
            'getActualOverheadWarhouseCharges'=>MfpProcurementWarehouseChargesResource::collection($this->getActualOverheadWarehouseCharges),
            'getActualOverheadEstimatedWastages'=>MfpProcurementEstimatedWastagesResource::collection($this->getActualOverheadEstimatedWastages),
            'getActualOverheadOtherCosts'=>MfpProcurementOtherCostsResource::collection($this->getActualOverheadOtherCosts),
            'getActualOverheadServiceChargesDIA'=>MfpProcurementServiceChargesDiaResource::collection($this->getActualOverheadServiceChargesDIA),
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
            'created_at' => date('d-M-Y H:i',strtotime($this->created_at)),
        ];
    }
}
