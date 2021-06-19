<?php

namespace App\Http\Resources\Api\Proposals;

use Illuminate\Http\Resources\Json\JsonResource;

class MfpProcurementOtherCostsResource extends JsonResource
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
            'mfp_id' => $this->mfp_id,
            'getMfpData' => $MfpName,
            'other_cost'=> $this->other_costs,
            'remarks'=> $this->remarks,
           
        ];
    }
}
