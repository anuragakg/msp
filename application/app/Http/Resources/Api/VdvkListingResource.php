<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Resources\Json\JsonResource;

class VdvkListingResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $location = $this->getProposedLocation;
        $state = $location->getState;
        $district = $location->getDistrict;
        $block = $location->getBlock;

        return [
                "vdvk_id" => $location->vdvk_id,
                "kendra_name" => strip_tags($location->kendra_name),
                'state'       => ($state->exists) ? strip_tags($state->title) : null,
                'district'    => ($district->exists) ? strip_tags($district->title) : null,
                'block'       => ($block->exists) ? strip_tags($block->title) : null,
                'status'      => $this->status,
        ];
    }
}