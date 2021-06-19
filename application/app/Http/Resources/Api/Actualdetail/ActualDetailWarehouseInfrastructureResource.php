<?php

namespace App\Http\Resources\Api\Actualdetail;

use Illuminate\Http\Resources\Json\JsonResource;
class ActualDetailWarehouseInfrastructureResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {   
        $item=$this->getItem;
        return [
            'id' => $this->id,
            'actual_id' => $this->actual_id,            
            'item_id' => $this->item_id, 
            'item_name' => $item['item_name'], 
            'spacification' => $this->spacification,
            'unit' => $this->unit,
            'cost' => $this->cost,
            'fund' => ActualDetailWarehouseFundInfrastructureResource::collection($this->getActualWarehouseFund),
        ];
    }
}
