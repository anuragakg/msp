<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Resources\Json\JsonResource;

class TrainerResource extends JsonResource
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
            'gender' => $this->gender,
            'dob' => $this->dob,
            'address' => strip_tags($this->address),
            'mobile_no' => $this->mobile_no,
            'landline_no' => $this->landline_no,
            'state' => $this->state,
            'state_title' => strip_tags($this->getState->title),
            'district' => $this->district,
            'district_title' => strip_tags($this->getDistrict->title),
            'block' => $this->block,
            'block_title' => strip_tags($this->getBlock->title),
            'education' => $this->education,
            'education_title' => strip_tags($this->getEducation->title),
            'yoe' => $this->yoe,
            'trained_from' => $this->trained_from,
            'specialisation' => $this->specialisation,
            'specialisation_title' => strip_tags($this->getSpecialisation->title),
        ];
    }
}
