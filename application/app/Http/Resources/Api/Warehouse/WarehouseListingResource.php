<?php

namespace App\Http\Resources\Api\Warehouse;

use Illuminate\Http\Resources\Json\JsonResource;

class WarehouseListingResource extends JsonResource
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
        $surveyor_data=$this->getSurveyor;
        $state = $part_one->getState;
        $district = $part_one->getDistrict;
        $block = $part_one->getBlock;
        $village = $part_one->getVillage;
        $chamber_data = $this->getChamberDetails;
        return [
            'id' => $this->id,
            'name' => strip_tags($part_one->name),
            'address' => strip_tags($part_one->address),
            'state' => $part_one->state,
            'state_name' => strip_tags($state->title),
            'district' => $part_one->district,
            'district_name' => strip_tags($district->title),
            'block' => $part_one->block,
            'block_name' => strip_tags($block->title),
            'village' => $part_one->village,
            'village_name' => strip_tags($village->title),
            'status' => $this->status,
			'is_completed' => $this->part_three? '1' : '0',
            'surveyor'=> $surveyor_data['name']?? null,
            'linkageWarehouse'=>$this->getLinkageCount->count,
            'chamber_data'  => $chamber_data,
        ];
    }
}
