<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Resources\Json\JsonResource;

class MentoringOrganisationMembersDetailResource extends JsonResource
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
            'chairman_name' => strip_tags($this->chairman_name),
            'chairman_mobile' => strip_tags($this->chairman_mobile),
            'chairman_email' => strip_tags($this->chairman_email),
            'secretary_name' => strip_tags($this->secretary_name),
            'secretary_mobile' => strip_tags($this->secretary_mobile),
            'secretary_email' => strip_tags($this->secretary_email),
        ];
    }
}