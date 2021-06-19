<?php

namespace App\Http\Resources\Api\Masters;

use Illuminate\Http\Resources\Json\JsonResource;

class MultipurposeProcurementResource extends JsonResource
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
            'item_name' => $this->item_name,            
            'specification' => $this->specification,
            'unit'=>$this->unit,
            'cost'=>$this->cost,
            'status'=>$this->status,
        ];
    }
}
