<?php

namespace App\Http\Resources\Api\Infrastructures;

use Illuminate\Http\Resources\Json\JsonResource; 
class InfrastructureDevelopmentProposedRescource extends JsonResource
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
            'proposed_plan' => $this->proposed_plan,   
            'haat_data' =>InfrastructureDevelopmentFundRescource::collection($this->getHaats), 
            'created_at' => date('d-M-Y H:i',strtotime($this->created_at)),
        ];
    }
}
