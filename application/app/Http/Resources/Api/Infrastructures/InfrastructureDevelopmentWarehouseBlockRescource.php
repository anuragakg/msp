<?php

namespace App\Http\Resources\Api\Infrastructures;

use Illuminate\Http\Resources\Json\JsonResource; 
class InfrastructureDevelopmentWarehouseBlockRescource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {   $block_data=$this->getBlockData;
        $block_name=$block_data->title; 
        return [
            'id' => $this->id,
            'warehouse_row_id' => $this->warehouse_row_id,    
            'block_id' => $this->block_id,    
            'block_name' => $block_name,
        ];
    }
}
