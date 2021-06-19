<?php

namespace App\Http\Resources\Api\MisReport;

use Illuminate\Http\Resources\Json\JsonResource;

class WarehouseMisReportResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $part_one = $this->getPartOne;

        $state = $part_one->getState;
        $district = $part_one->getDistrict;
        $block = $part_one->getBlock;
        $village = $part_one->getVillage;

        return [

            'name'          => strip_tags($part_one->name),
            'id'          => strip_tags($part_one->id),
            'type'          => $part_one->type,
            'mobile_no'     => strip_tags($part_one->mobile_no),
            'address'       => strip_tags($part_one->address),
            'state_name'    => ($state->exists) ? strip_tags($state->title) : null,
            'district_name' => ($district->exists) ? strip_tags($district->title) : null,
            'block_name'    => ($block->exists) ? strip_tags($block->title) : null,
            'village_name'  => ($village->exists) ? strip_tags($village->title) : null,
            'status'        => $this->status
        ];
    }
}
