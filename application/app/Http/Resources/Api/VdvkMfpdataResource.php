<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Resources\Json\JsonResource;

class VdvkMfpdataResource extends JsonResource
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
            'id' => $this->getCommodityData->id,
            'title' => strip_tags($this->getCommodityData->title),
            'status' => $this->getCommodityData->status,
        ];
    }
}
