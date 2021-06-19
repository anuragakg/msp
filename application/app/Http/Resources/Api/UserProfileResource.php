<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Resources\Json\JsonResource;
use Carbon\Carbon;
class UserProfileResource extends JsonResource
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
        //$bankDetails = $this->getUserBankDetails;

        if ($userDetails) {
            $userBankDetail = $this->getUserBankDetails;
        }

        return [
                'name' => strip_tags($this->name),
                'middle_name' => strip_tags($this->middle_name),
                'last_name' => strip_tags($this->last_name),
                'email' => strip_tags($this->email),
                'mobile_no' => strip_tags($this->mobile_no),
                'official_address' => strip_tags($userDetails->official_address),
                'landline_no' => strip_tags($userDetails->landline_no),
                'role' => strip_tags($this->getRole->title),
                'dob' => $userDetails->dob?date('d-m-Y',strtotime($userDetails->dob)):null,
                'age_year'=>Carbon::parse($userDetails->dob)->diff(Carbon::now())->format('%y'),
                'age_month'=>Carbon::parse($userDetails->dob)->diff(Carbon::now())->format('%m'),
                'age_days'=>Carbon::parse($userDetails->dob)->diff(Carbon::now())->format('%d'),
                'user_bank_details' => [
                    'ac_holder_name'        => isset($userBankDetail->ac_holder_name) ? strip_tags($userBankDetail->ac_holder_name) : null,
                    'branch_name'           => isset($userBankDetail->branch_name) ? strip_tags($userBankDetail->branch_name) : null,
                    'bank_name'          => isset($userBankDetail->bank_name) ? strip_tags($userBankDetail->bank_name) : null,
                    'bank_ac_no'         => isset($userBankDetail->bank_ac_no) ? strip_tags($userBankDetail->bank_ac_no) : null,
                    'ifsc_code'          => isset($userBankDetail->ifsc_code) ? strip_tags($userBankDetail->ifsc_code): null,
                    'mobile_no'         => isset($userBankDetail->mobile_no) ? strip_tags($userBankDetail->mobile_no) : null
                ]
         ];
    }
}
