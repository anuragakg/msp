<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Resources\Json\JsonResource;
use Carbon\Carbon;

class MentoringOrganisationProfileResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $bankDetails = $this->getUserBankDetails;
        $moDetails = $this->getMentoringOrganisationDetails;

         $IfregDate= Carbon::parse($moDetails->registration_date)->format('d/m/Y');
        $regData = isset($moDetails->registration_date) ? $IfregDate : null;
        $IfexpDate=Carbon::parse($moDetails->registration_expiry)->format('d/m/Y');
        $regExp= isset($moDetails->registration_expiry) ?  $IfexpDate : null; 
        return [
                'name' => strip_tags($this->name),
                'middle_name' => strip_tags($this->middle_name),
                'last_name' => strip_tags($this->last_name),
                'email' => strip_tags($this->email),
                'mobile_no' => strip_tags($this->mobile_no),
                'mo_details'        => [
					"registration_date" => $regData,
					"registration_expiry" => $regExp,
					"chairman_name" => strip_tags($moDetails->chairman_name),
					"chairman_mobile" => strip_tags($moDetails->chairman_mobile),
					"chairman_email" => strip_tags($moDetails->chairman_email),
					"secretary_name" => strip_tags($moDetails->secretary_name),
					"secretary_mobile" => strip_tags($moDetails->secretary_mobile),
					"secretary_email" => strip_tags($moDetails->secretary_email),
					"gst_or_tan" => strip_tags($moDetails->gst_or_tan),
                    "registration_certificate"=> url($moDetails->registration_certificate),
                    "registration_certificate_name" => basename($moDetails->registration_certificate)
				],
                // 'user_bank_details' => [
                //     'bank_name' => $bankDetails->bank_name ,
                //     'branch_name' => $bankDetails->branch_name ,
                //     'ifsc_code' => $bankDetails->ifsc_code ,
                //     'bank_ac_no' => $bankDetails->bank_ac_no ,
                //     'mobile_no' => $bankDetails->mobile_no ,
                //     'ac_holder_name' => $bankDetails->ac_holder_name ,
                // ]
         ];
    }
}