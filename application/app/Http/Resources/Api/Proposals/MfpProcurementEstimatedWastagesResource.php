<?php

namespace App\Http\Resources\Api\Proposals;

use Illuminate\Http\Resources\Json\JsonResource;

class MfpProcurementEstimatedWastagesResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {   
        $mfpMasterData = $this->getMfpData;
        $MfpName = isset($mfpMasterData->getMfpName)?$mfpMasterData->getMfpName:null;
        $ware=$this->getwarehouseData; 
        return [
            'id' => $this->id,
            'mfp' => $this->mfp_id,
            'getMfpData'=>$MfpName,
            'warehouse'=> $this->warehouse_id,
            'warehouseData'=>$ware,
            'procurement_quantity'=> $this->procurement_quantity,
            'procurement_value' => $this->procurement_value,
            'estimated_driage_percentage'=>$this->estimated_driage_percentage,
            'estimated_driage_rs' => $this->estimated_driage_rs,
            
        ];
    }
}
