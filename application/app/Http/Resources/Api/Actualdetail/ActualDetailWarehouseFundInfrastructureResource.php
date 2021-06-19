<?php

namespace App\Http\Resources\Api\Actualdetail;

use Illuminate\Http\Resources\Json\JsonResource;
class ActualDetailWarehouseFundInfrastructureResource extends JsonResource
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
            'warehouse_id' => $this->warehouse_id,
            'warehouse_name' => isset($this->getwarehouseData->getWarehouse->getPartOne->name)?$this->getwarehouseData->getWarehouse->getPartOne->name:null,
            'actual_required_funds' => $this->actual_required_funds,
        ];
    }
}
