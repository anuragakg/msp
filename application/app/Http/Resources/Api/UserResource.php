<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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

        $state = null;
        $district = null;
        $block = null;
        $idProof = null;
        $department = null;
        $designation = null;
        $idProofValue = null;
        $officialAddress = null;

        if ($userDetails) {

            $getState = $userDetails->getState;
            $getDistrict = $userDetails->getDistrict;
            $getBlock = $userDetails->getBlock;
            $getIdProof = $userDetails->getIdProof;
            $getDepartment = $userDetails->getDepartment;
            $getDesignation = $userDetails->getDesignation;
            $idProofValue = $userDetails->id_proof_value;
            $officialAddress = $userDetails->official_address;

            $state =  isset($getState) ? $getState->title : null;
            $district = isset($getDistrict) ? $getDistrict->title : null;
            $block = isset($getBlock) ? $getBlock->title : null;
            $idProof = isset($getIdProof) ? $getIdProof->title : null;
            $department = isset($getDepartment) ? $getDepartment->title : null;
            $designation = isset($getDesignation) ? $getDesignation->title : null;
        }
        
        return [
            'id' => $this->id,
            'level_id' => $this->level_id,    
            'role' => strip_tags($this->getRole->title),
            'user_name' => strip_tags($this->user_name),
            'status' => $this->status,
            'name' => strip_tags($this->name),
            'last_name' => $this->last_name??'',
            'middle_name' => $this->middle_name??'',
            'mobile' => strip_tags($this->mobile_no),
            'email' => strip_tags($this->email),
            'state' => strip_tags($state),
            'district' => strip_tags($district),
            'block' => strip_tags($block),
            'id_proof_value' => strip_tags($idProofValue),
            'official_address' => strip_tags($officialAddress),
            'department_name' => strip_tags($department),
            'designation_name' => strip_tags($designation),
            'role_value' => $this->getRole->id,
        ];
    }
}
