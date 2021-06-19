<?php

namespace App\Http\Resources\Api\Infrastructures;

use Illuminate\Http\Resources\Json\JsonResource; 
class InfrastructureDevelopmentHaatBlockRescource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {    $block_data=$this->getBlockData;
        $block_name=$block_data->title; 
        return [
            'id' => $this->id,
            'haat_bazaar_id' => $this->haat_bazaar_id,
            'haat_id' => $this->haat_id,    
            'block_id' => $this->block_id,    
            'block_name' => $block_name,
            'created_at' => date('d-M-Y H:i',strtotime($this->created_at)),
        ];
    }
}
