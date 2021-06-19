<?php

namespace App\Http\Resources\Api;
use App\Http\Resources\Api\UserHaatResource;
use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class UserDetailWithHaatResource extends JsonResource
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
        $allowed_states = $this->getUsersAllowedStates;
        

        $state = null;
        $district = null;
        $block = null;
        $idProof = null;
        $department = null;
        $designation = null;

        if ($userDetails) {

            $userBankDetail = $this->getUserBankDetails;


            $getIdProof = $userDetails->getIdProof;
            $getDepartment = $userDetails->getDepartment;
            $getDesignation = $userDetails->getDesignation;

            $state =  isset($getState) ? $getState->title : null;
            $district = isset($getDistrict) ? $getDistrict->title : null;
            $block = isset($getBlock) ? $getBlock->title : null;

            $idProof = isset($getIdProof) ? $getIdProof->title : null;
            $department = isset($getDepartment) ? $getDepartment->title : null;
            $designation = isset($getDesignation) ? $getDesignation->title : null;
        }

        // dd(var_dump($userDetails->dob));
        
        return [
            'id'                 => $this->id,
            'level_id'           => $this->level_id,
            'user_name'          => strip_tags($this->user_name),
            'name'               => strip_tags($this->name),
            'middle_name'        => strip_tags($this->middle_name),
            'last_name'          => strip_tags($this->last_name),
            'mobile'             => $this->mobile_no,
            'email'              => strip_tags($this->email),
            'role_id'            => $this->role,
            'role'               => strip_tags($this->getRole->title),

            /****** User Details *******/

            'dob'                => isset($userDetails->dob) ? $userDetails->dob : null,
            'state_id'           => $userDetails->state,
            'state'              => strip_tags($state),
            'district_id'        => $userDetails->district,
            'district'           => strip_tags($district),
            'block_id'           => $userDetails->block,
            'block'              => strip_tags($block),
            'landline_no'        => strip_tags($userDetails->landline_no),
            'id_proof_type'      => $userDetails->id_proof_type,
            'id_proof_type_name' => strip_tags($idProof),
            'id_proof_value'     => strip_tags($userDetails->id_proof_value),
            'official_address'   => strip_tags($userDetails->official_address),
            'department'         => $userDetails->department,
            'department_name'    => strip_tags($department),
            'designation'        => $userDetails->designation,
            'designation_name'   => strip_tags($designation),
            'allowed_states'     => $allowed_states,
            'UserHaatBazaar'     => UserHaatResource::collection($this->getUserHaatBazaar),

            /****** User Bank Details  *******/

            'holder_name'        => isset($userBankDetail->ac_holder_name) ? strip_tags($userBankDetail->ac_holder_name) : null,
            'bank_name'          => isset($userBankDetail->bank_name) ? strip_tags($userBankDetail->bank_name) : null,
            'bank_ac_no'         => isset($userBankDetail->bank_ac_no) ? strip_tags($userBankDetail->bank_ac_no) : null,
            'ifsc_code'          => isset($userBankDetail->ifsc_code) ? strip_tags($userBankDetail->ifsc_code) : null,
        ];
    }
}
