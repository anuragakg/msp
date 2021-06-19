<?php

namespace App\Http\Resources\Api;

use App\Http\Resources\Api\Masters\ViewOne\UserResource;
use Illuminate\Http\Resources\Json\JsonResource;

class SupervisorMoMappingResource extends JsonResource
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
            'name' => strip_tags($this->name),
            'email' => strip_tags($this->email),
            'supervisors' => UserResource::collection($this->getChildUsers)
        ];
    }
}
