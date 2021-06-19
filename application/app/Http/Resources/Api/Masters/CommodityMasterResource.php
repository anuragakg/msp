<?php

namespace App\Http\Resources\Api\Masters;

use Illuminate\Http\Resources\Json\JsonResource;

class CommodityMasterResource extends JsonResource
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
            'title' => strip_tags($this->title),
            'unit' => $this->unit,
            'unit_name' => strip_tags($this->getUnit->title) ?? null,
            'state' => strip_tags($this->state),
            'state_name' => strip_tags($this->getState->title) ?? null,
            'session' => $this->session,
            'common_name' => strip_tags($this->common_name),
            'lab_name' => strip_tags($this->lab_name),
            'quality' => strip_tags($this->quality),
            'msp' => $this->msp,
            'photo' => $this->photo,
        ];
    }
}
