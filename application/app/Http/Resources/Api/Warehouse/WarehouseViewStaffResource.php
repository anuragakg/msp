<?php

namespace App\Http\Resources\Api\Warehouse;

use Illuminate\Http\Resources\Json\JsonResource;

class WarehouseViewStaffResource extends JsonResource
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
            'form_id' => $this->form_id,
            'name' => $this->name,
            'designation' => $this->designation,
            'qualification' => $this->qualification,
            'mobile' => $this->mobile,
            'phone_type_id' => $this->phone_type_id,
            'email' => strip_tags($this->email),
            'duties' => strip_tags($this->duties),


        ];
    }
}
