<?php

namespace App\Http\Resources\Api;

use App\Http\Resources\Api\Masters\ViewOne\UserResource;
use Illuminate\Http\Resources\Json\JsonResource;

class EvaluationMOMappingResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return  $this->getUserDetails;
    }
}

