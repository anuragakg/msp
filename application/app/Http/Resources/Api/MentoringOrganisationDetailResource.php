<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Resources\Json\JsonResource;
use Carbon\Carbon;

class MentoringOrganisationDetailResource extends JsonResource
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
        $additionalDetails = $this->getMentoringOrganisationDetails; 
       
        
        $state = null;
        $district = null;
        $block = null;

        if ($userDetails) {

            $getState = $userDetails->getState;
            $getDistrict = $userDetails->getDistrict;
            $getBlock = $userDetails->getBlock;

            $state =  isset($getState->title) ? strip_tags($getState->title) : null;
            $district = isset($getDistrict->title) ? strip_tags($getDistrict->title) : null;
            $block = isset($getBlock->title) ? strip_tags($getBlock->title) : null;
        }

        if ($additionalDetails) {
            $getOrgType = $additionalDetails->getOrgType;
            $orgType =  isset($getOrgType) ? strip_tags($getOrgType->title) : null;
        }

        /** Get the parent users */
        $mapSurveyor = null;
        if ($this->role == 8) {
            $mapSurveyor = $this->getParentUsers->modelKeys();
        }

        $IfregDate= Carbon::parse($additionalDetails->registration_date)->format('d/m/Y');
        $regData = isset($additionalDetails->registration_date) ? $IfregDate : null;
        $IfexpDate=Carbon::parse($additionalDetails->registration_expiry)->format('d/m/Y');
        $regExp= isset($additionalDetails->registration_expiry) ?  $IfexpDate : null; 
           
        return [
            'id' => $this->id,
            'name' => strip_tags($this->name),
            'user_name' => strip_tags($this->user_name),
            'middle_name' => strip_tags($this->middle_name),
            'last_name' => strip_tags($this->last_name),
            'mobile' => strip_tags($this->mobile_no),
            'status' => $this->status,
            'email' => strip_tags($this->email),
            'state' => $state,
            'district' => $district,
            'block' => $block,
            'user_type' => strip_tags($this->getRole->title),
            'org_type' => $orgType,
            'user_details' => [
                'state'    => $userDetails->state, 
                'district' => $userDetails->district,
                'block'    => $userDetails->block,
                'official_address'    => strip_tags($userDetails->official_address),
                'pin_code'    => $userDetails->pin_code,
            ],
            'additional_details' => [
                'org_type' => $additionalDetails->org_type,
                'registration_no' => strip_tags($additionalDetails->registration_no),
                'registration_date' => $regData,
                'registration_expiry' => $regExp,
                'registration_certificate' => $additionalDetails->registration_certificate,
                'chairman_name' => strip_tags($additionalDetails->chairman_name),
                'chairman_mobile' => strip_tags($additionalDetails->chairman_mobile),
                'chairman_email' => strip_tags($additionalDetails->chairman_email),
                'secretary_name' => strip_tags($additionalDetails->secretary_name),
                'secretary_mobile' => strip_tags($additionalDetails->secretary_mobile),
                'secretary_email' => strip_tags($additionalDetails->secretary_email),
                'gst_or_tan' => strip_tags($additionalDetails->gst_or_tan),
            ]
        ];
    }
}
