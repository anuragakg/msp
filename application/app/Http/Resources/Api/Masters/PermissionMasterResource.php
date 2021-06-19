<?php

namespace App\Http\Resources\Api\Masters;

use Illuminate\Http\Resources\Json\JsonResource;

class PermissionMasterResource extends JsonResource
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
            'alias' => strip_tags($this->alias),
        ];
    }
}
