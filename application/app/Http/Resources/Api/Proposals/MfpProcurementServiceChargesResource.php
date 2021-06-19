<?php

namespace App\Http\Resources\Api\Proposals;

use Illuminate\Http\Resources\Json\JsonResource;

class MfpProcurementServiceChargesResource extends JsonResource
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
        return [
            'id' => $this->id,
            'mfp' => $this->mfp_id,
            'getMfpData' => $MfpName,
            'haat'=> $this->haat_id,
            'qty_of_mfp'=> $this->qty_of_mfp,
            'primary_level_agency' => $this->primary_level_agency,
            'primary_level_agency_name' => isset($this->getPrimaryLevelAgency)?$this->getPrimaryLevelAgency->title:null,
            'estimated_value_of_mfp_procurement'=>$this->estimated_value_of_mfp_procurement,
            'estimated_service_charge_primary_level_agency'=> $this->estimated_service_charge_primary_level_agency,
            'service_charge_in_total_value_of_procurement' => $this->service_charge_in_total_value_of_procurement
        ];
    }
}
