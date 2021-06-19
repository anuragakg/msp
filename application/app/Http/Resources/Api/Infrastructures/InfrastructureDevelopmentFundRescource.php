<?php

namespace App\Http\Resources\Api\Infrastructures;

use Illuminate\Http\Resources\Json\JsonResource; 
class InfrastructureDevelopmentFundRescource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {    $haat_data=$this->getHaatName; 
        $haat_name=$haat_data->getHaatBazaar->getPartOne->rpm_name; 
        return [
            'id' => $this->id,
            'proposed_id' => $this->proposed_id,
            'haat_id' => $this->haat_id,
            'haat_name' => $haat_name,
            'estimated_funds' => $this->estimated_funds,    
            'created_at' => date('d-M-Y H:i',strtotime($this->created_at)),
        ];
    }
}
