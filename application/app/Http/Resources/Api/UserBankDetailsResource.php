<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Resources\Json\JsonResource;

class UserBankDetailsResource extends JsonResource
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
            'ac_holder_name' => strip_tags($this->ac_holder_name),
            'branch_name' => strip_tags($this->branch_name),
            'bank_name' => strip_tags($this->bank_name),
            'bank_ac_no' => strip_tags($this->bank_ac_no),
            'ifsc_code' => strip_tags($this->ifsc_code),
        ];
    }
}
