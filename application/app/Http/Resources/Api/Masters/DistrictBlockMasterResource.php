<?php

namespace App\Http\Resources\Api\Masters;

use App\Http\Resources\Api\Masters\ViewOne\StateResource;
use Illuminate\Http\Resources\Json\JsonResource;

class DistrictBlockMasterResource extends JsonResource
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
            'title' => strip_tags($this->title),
            'state' => StateResource::make($this->state),
            'status' => isset($this->status)?$this->status:null,
        ];
    }
}
