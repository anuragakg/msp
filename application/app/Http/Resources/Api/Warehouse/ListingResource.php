<?php

namespace App\Http\Resources\Api\Warehouse;

use Illuminate\Http\Resources\Json\JsonResource;


class ListingResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {

        $state = $this->getState;
        $district = $this->getDistrict;
        $block = $this->getBlock;
        $village = $this->getVillage;
        return [
            'id' => $this->id,
            'name' => strip_tags($this->name),
            'address' => strip_tags($this->address),
            'state' => strip_tags($state->title) ?? null,
            'district' => strip_tags($district->title) ?? null,
            'block' => strip_tags($block->title) ?? null,
            'village' => strip_tags($village->title) ?? null,
        ];
    }
}
