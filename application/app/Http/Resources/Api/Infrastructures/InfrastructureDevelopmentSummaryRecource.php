<?php

namespace App\Http\Resources\Api\Infrastructures;

use Illuminate\Http\Resources\Json\JsonResource; 
class InfrastructureDevelopmentSummaryRecource extends JsonResource
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
            'infra_id' => $this->infra_id,
            'estimated_requirement_funds' => $this->estimated_requirement_funds,    
            'other_information' => $this->other_information,    
            'total_warehouse_facilities' => $this->total_warehouse_facilities,    
            'total_multipurpose_procurement' => $this->total_multipurpose_procurement,    
            'old_fund_available' => $this->old_fund_available,    
            'total_fund_require' => $this->total_fund_require,    
            'created_at' => date('d-M-Y H:i',strtotime($this->created_at)),
        ];
    }
}
