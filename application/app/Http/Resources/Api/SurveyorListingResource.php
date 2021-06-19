<?php

namespace App\Http\Resources\Api;

use App\Http\Resources\Api\Masters\ViewOne\BlockResource;
use App\Http\Resources\Api\Masters\ViewOne\DistrictResource;
use App\Http\Resources\Api\Masters\ViewOne\PhoneTypeResource;
use App\Http\Resources\Api\Masters\ViewOne\StateResource;
use App\Http\Resources\Api\Masters\ViewOne\UserResource;
use Illuminate\Http\Resources\Json\JsonResource;

class SurveyorListingResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $userDetails = $this->getUserDetails;
        $bankDetails = $this->getUserBankDetails;
        $additionalDetails = $this->getSurveyorSupervisorDetails;        

        $state = null;
        $district = null;
        $block = null;

        if ($userDetails) {

            $getState = $userDetails->getState;
            $getDistrict = $userDetails->getDistrict;
            $getBlock = $userDetails->getBlock;

            $state =  StateResource::make($getState);
            $district = DistrictResource::make($getDistrict);
            $block = BlockResource::make($getBlock);
        }

        /** Get the parent users */
        $mapSurveyor = null;
        if ($this->role == 12) {
            $mapSurveyor = UserResource::collection($this->getChildUsers);
        }
        
        return [
            'id' => $this->id,
            'name' => strip_tags($this->name),
            'user_name' => $this->user_name,
            'middle_name' => strip_tags($this->middle_name),
            'last_name' => strip_tags($this->last_name),
            'mobile' => strip_tags($this->mobile_no),
            'email' => strip_tags($this->email),
            'state' => $state,
            'district' => $district,
            'block' => $block,
            'user_type' => strip_tags($this->getRole->title),
            'bank_details' => [
                'branch_name' => strip_tags($bankDetails->branch_name),
                'bank_name' => strip_tags($bankDetails->bank_name),
                'bank_ac_no' => strip_tags($bankDetails->bank_ac_no),
                'ifsc_code' => strip_tags($bankDetails->ifsc_code),
                'bank_mobile_no' => strip_tags($bankDetails->mobile_no),
            ],
            'user_details' => [
                'state' => $userDetails->state,
                'district' => $userDetails->district,
                'block' => $userDetails->block,
                'id_proof_type' => $userDetails->id_proof_type,
                'id_proof_value' => $userDetails->id_proof_value,
            ],
            'additional_details' => [
                'user_type' => $additionalDetails->user_type,
                'survey_for' => $additionalDetails->survey_for,
                'supervising_for' => $additionalDetails->supervising_for,
                'alternate_no' => $additionalDetails->alternate_no,
                'phone_type' => PhoneTypeResource::make($additionalDetails->getPhoneType),
                'is_phone_self_owned' => $additionalDetails->is_phone_self_owned,
                'map_surveyor' => $mapSurveyor
            ]
        ];
    }
}
