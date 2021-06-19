<?php

namespace App\Http\Resources\Api\Proposals;

use Illuminate\Http\Resources\Json\JsonResource;

class MfpProcurementServiceChargesDiaResource extends JsonResource
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
        $MfpName = isset($mfpMasterData->getMfpName)?$mfpMasterData->getMfpName:null;
        return [
            'id' => $this->id,
            'mfp_id' => $this->mfp_id,
            'dia_id' => $this->dia_id,
            'district_name' => isset($this->getDistrict->title)?$this->getDistrict->title:'',
            'getMfpData' => $MfpName,
            'estimated_value_of_procurement'=>$this->estimated_value_of_procurement,
            'service_charges_percentage'=>$this->service_charges_percentage,
            'service_charge_value'=> $this->service_charge_value,
           
        ];
    }
}
