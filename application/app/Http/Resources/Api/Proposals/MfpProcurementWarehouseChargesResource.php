<?php

namespace App\Http\Resources\Api\Proposals;

use Illuminate\Http\Resources\Json\JsonResource;
use Helper;
class MfpProcurementWarehouseChargesResource extends JsonResource
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
        $unit_name = ($this->unit_id==1)?'Kg':'Qunital';
        return [
            'id' => $this->id,
            'mfp' => $this->mfp_id,
            'getMfpData'=>$MfpName,
            'warehouse'=> $this->warehouse_id,
            'warehouseData'=>$ware,
            'unit'=> $this->unit_id,
            'unit_name'=>$unit_name,
            'unit_storage_rate_per_month'=>Helper::decimalNumberFormat($this->unit_storage_rate),
            'estimated_quantity' => Helper::decimalNumberFormat($this->estimated_quantity),
            'estimation_duration_of_storage'=>Helper::decimalNumberFormat($this->estimation_duration_of_storage),
            'total_estimated_cost' => Helper::decimalNumberFormat($this->total_estimated_cost),
            'from_date'=> isset($this->from_date) ? date('d/m/Y',strtotime($this->from_date)):
            null,
            'to_date'=> isset($this->to_date) ? date('d/m/Y',strtotime($this->to_date)):
            null,
            
        ];
    }
}
