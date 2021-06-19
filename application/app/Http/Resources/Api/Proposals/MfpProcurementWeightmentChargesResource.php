<?php

namespace App\Http\Resources\Api\Proposals;

use Illuminate\Http\Resources\Json\JsonResource;

class MfpProcurementWeightmentChargesResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {   
        switch ($this->type) {
            case 'H':
                $type_name='Haat';
                $type_data = isset($this->getHaat->getHaatBazaar->getPartOne->rpm_name)?$this->getHaat->getHaatBazaar->getPartOne->rpm_name:null;
                break;
            case 'P':
                $type_name='Procurement Centre';
                $type_data = isset($this->getProcurementCenter)?$this->getProcurementCenter->procurement_center_name:null;
                break;
            
            default:
                $type_name='';
                $type_data ='' ;
                break;
        }
      
        return [
            'id' => $this->id,
            'mfp' => $this->mfp_id,
            'mfp_name' => isset($this->getMfpData->getMfpName->title)?$this->getMfpData->getMfpName->title:null,
            'type'=> $this->type,
            'type_name'=> $type_name,
            'haat_id'=> $this->haat_id,
            'HaatName'=>$type_data,
            'procurement_center_id'=> $this->procurement_center_id,
            //'procurement_name'=> $this->getProcurementCenter->,
            'total_estimated_cost'=>$this->total_estimated_cost,
        ];
    }
}
