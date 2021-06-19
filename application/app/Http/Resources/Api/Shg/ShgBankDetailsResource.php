<?php

namespace App\Http\Resources\Api\Shg;

use Illuminate\Http\Resources\Json\JsonResource;

class ShgBankDetailsResource extends JsonResource
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
            'bank_name' => strip_tags($this->name),
            'branch_name' => strip_tags($this->branch),
            'bank_ifsc' => strip_tags($this->ifsc_code),
            'bank_account_no' => strip_tags($this->account_no),
            'bank_mobile_no' => strip_tags($this->mobile_no),
            'is_self' => $this->is_self,
            'specify_other' => strip_tags($this->specify_other),
            'phone_type' => $this->phone_type,
        ];
    }
}
