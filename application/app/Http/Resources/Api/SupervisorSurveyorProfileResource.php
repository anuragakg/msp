<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Resources\Json\JsonResource;

class SupervisorSurveyorProfileResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {

        $userDetails = $this->getSurveyorSupervisorDetails;
        $bankDetails = $this->getUserBankDetails;

        return [
                'name' => strip_tags($this->name),
                'middle_name' => strip_tags($this->middle_name),
                'last_name' => strip_tags($this->last_name),
                'email' => strip_tags($this->email),
                'mobile_no' => strip_tags($this->mobile_no),
                'alternate_no' => strip_tags($userDetails->alternate_no),
                'user_bank_details' => [
                    'bank_name' => strip_tags($bankDetails->bank_name) ,
                    'branch_name' => strip_tags($bankDetails->branch_name) ,
                    'ifsc_code' => strip_tags($bankDetails->ifsc_code) ,
                    'bank_ac_no' => strip_tags($bankDetails->bank_ac_no) ,
                    'mobile_no' => $bankDetails->mobile_no ,
                    'ac_holder_name' => strip_tags($bankDetails->ac_holder_name) ,
                    'bank_ac_no' => strip_tags($bankDetails->bank_ac_no) ,
                    'ifsc_code' => strip_tags($bankDetails->ifsc_code)
                ]
         ];
    }
}
