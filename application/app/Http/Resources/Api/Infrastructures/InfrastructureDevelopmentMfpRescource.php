<?php

namespace App\Http\Resources\Api\Infrastructures;

use Illuminate\Http\Resources\Json\JsonResource; 
class InfrastructureDevelopmentMfpRescource extends JsonResource
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
            'haat_bazaar_id' => $this->haat_bazaar_id,
            'haat_id' => $this->haat_id,    
            'mfp_id' => $this->mfp_id,    
            'mfp_name' => $this->getMfpNamedata->getMfpName->title,
            'created_at' => date('d-M-Y H:i',strtotime($this->created_at)),
        ];
    }
}
