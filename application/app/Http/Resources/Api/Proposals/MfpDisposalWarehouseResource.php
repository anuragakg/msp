<?php

namespace App\Http\Resources\Api\Proposals;

use Illuminate\Http\Resources\Json\JsonResource;
class MfpDisposalWarehouseResource extends JsonResource
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
            'warehouse_id'=>$this->warehouse_id,
            'qty'=>$this->qty,
            'value'=>$this->value,
            'months'=>$this->getMonths,
            'getWarehouseName'=>isset($this->getWarehouseName->getWarehouse->getPartOne->name)?$this->getWarehouseName->getWarehouse->getPartOne->name:null,
        ];
    }
}
