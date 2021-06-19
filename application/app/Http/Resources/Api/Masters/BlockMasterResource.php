<?php

namespace App\Http\Resources\Api\Masters;

use Illuminate\Http\Resources\Json\JsonResource;

class BlockMasterResource extends JsonResource
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
            'district_id' => $this->district_id,
            'title' => strip_tags($this->title),
            'district' =>  $this->district(),
            'status' => $this->status,
        ];
    }
}
