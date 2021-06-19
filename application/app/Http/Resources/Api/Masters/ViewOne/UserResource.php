<?php

namespace App\Http\Resources\Api\Masters\ViewOne;

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
        return [
            'id' => $this->id,
            'name' => strip_tags($this->name).' '.strip_tags($this->last_name),
            'email' => strip_tags($this->email),
            'role' => strip_tags($this->getRole->title),
        ];
    }
}
