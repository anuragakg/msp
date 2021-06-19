<?php

namespace App\Http\Resources\Api\Infrastructures;

use Illuminate\Http\Resources\Json\JsonResource; 
class InfrastructureDevelopmentAssessmentResource extends JsonResource
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
            'haat_id' => $this->haat_id,             
            'haat_value' => $this->haat_value,  
            'created_at' => date('d-M-Y H:i',strtotime($this->created_at)),
        ];
    }
}
