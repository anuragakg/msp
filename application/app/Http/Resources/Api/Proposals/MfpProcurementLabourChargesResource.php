<?php

namespace App\Http\Resources\Api\Proposals;

use Illuminate\Http\Resources\Json\JsonResource;

class MfpProcurementLabourChargesResource extends JsonResource
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
        // $haatMasterData = $this->getHaatData;
        // $haatName = isset($haatMasterData->getHaatBazaar)?$haatMasterData->getHaatBazaar:null;
        return [
            'id' => $this->id,
            'mfp' => $this->mfp_id,
            'getMfpData' => $MfpName,
            'haat'=> $this->haat_id,
            'haat_data' => $this->getHaatData,
            'unit_manday_rate'=> $this->unit_manday_rate,
            'estimated_mandays' => $this->estimated_mandays,
            'total_estimated_cost'=>$this->total_estimated_cost,
        ];
    }
}
