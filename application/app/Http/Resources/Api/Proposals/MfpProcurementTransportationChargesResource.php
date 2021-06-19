<?php

namespace App\Http\Resources\Api\Proposals;

use Illuminate\Http\Resources\Json\JsonResource;

class MfpProcurementTransportationChargesResource extends JsonResource
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
        if($this->type_of_transport==1){
            $transport_name = 'Truck';
        }
        else if($this->type_of_transport==2){
            $transport_name = 'Train';
        }else{
            $transport_name = '';
        }
        return [
            'id' => $this->id,
            'mfp' => $this->mfp_id,
            'getMfpData' => $MfpName,
            'haat'=> $this->haat_id,
            'haat_data' => $this->getHaatData,
            'approx_distance'=> $this->approx_distance,
            'type_of_transport' => $this->type_of_transport,
            'type_of_transport_name' => $transport_name,
            'qty' => $this->qty,
            'charges_per_qunital'=>$this->charges_per_qunital,
            'estimated_total_cost_of_transportation'=>$this->estimated_total_cost_of_transportation,
        ];
    }
}
