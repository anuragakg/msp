<?php

namespace App\Http\Resources\Api\Masters;

use Illuminate\Http\Resources\Json\JsonResource;

class StateMasterResource extends JsonResource
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
            'code' => strip_tags($this->code),
            'code' => strip_tags($this->code),
            'districts' => $this->districts()->get(['id','title']),
            'status' => $this->status,
        ];
    }
}
