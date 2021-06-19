<?php

namespace App\Http\Resources\Api\Masters;

use Illuminate\Http\Resources\Json\JsonResource;

class ProcurementAgentResource extends JsonResource
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
            'name' => strip_tags($this->name),
            'mobile_no' => strip_tags($this->mobile_no),
            'landline_no' => strip_tags($this->landline_no),
            'address' => strip_tags($this->address),
            'state' => $this->state,
            'state_name' => isset($this->getState->title) ? strip_tags($this->getState->title) : null,
            'district' => $this->district,
            'district_name' => isset($this->getDistrict->title)? strip_tags($this->getDistrict->title) : null,
            'block' => $this->block,
            'block_name' => isset ($this->getBlock->title) ? strip_tags($this->getBlock->title) : null,
            'status' => $this->status,
        ];
    }
}
