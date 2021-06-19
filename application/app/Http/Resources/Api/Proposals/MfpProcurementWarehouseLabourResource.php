<?php

namespace App\Http\Resources\Api\Proposals;

use Illuminate\Http\Resources\Json\JsonResource;
use Helper;
class MfpProcurementWarehouseLabourResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {   
        $mfpMasterData=$this->getMfpData;
        $MfpName=isset($mfpMasterData->getMfpName)?$mfpMasterData->getMfpName:null;
        $ware=$this->getwarehouseData; 
        return [
            'id' => $this->id,
            'mfp' => $this->mfp_id,
            'getMfpData'=>$MfpName,
            'warehouse'=> $this->warehouse_id,
            'warehouseData'=>$ware,
            'qty' => Helper::decimalNumberFormat($this->qty),
            'unit_rate'=>Helper::decimalNumberFormat($this->unit_rate),
            'total_estimated_cost' => Helper::decimalNumberFormat($this->total_estimated_cost),
            
        ];
    }
}
