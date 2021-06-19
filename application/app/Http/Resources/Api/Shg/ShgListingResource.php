<?php

namespace App\Http\Resources\Api\Shg;

use Illuminate\Http\Resources\Json\JsonResource;

class ShgListingResource extends JsonResource
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
        $bankDetails = $this->getBankDetails;

        return [
            'id' => $this->id,
            'name_of_tribal' => strip_tags($this->name_of_tribal),
            'gender' => $this->gender,
            'dob' => $this->dob,
            'id_value' => strip_tags($this->id_value),
            'status' => $this->status == 1 ? 'Approved' : 'Pending',
            'state' => ($state->exists) ? strip_tags($state->title) : null,
            'district' => ($district->exists) ? strip_tags($district->title) : null,
            'block' => ($block->exists) ? strip_tags($block->title) : null,
            'village' => ($village->exists) ? strip_tags($village->title) : null,
            'mobile' => strip_tags($bankDetails->mobile_no) ?? null,

        ];
    }
}
