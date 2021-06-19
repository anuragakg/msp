<?php

namespace App\Http\Resources\Api\Masters;

use App\Http\Resources\Api\Masters\ViewOne\StateResource;
use Illuminate\Http\Resources\Json\JsonResource;

class DistrictMasterResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => strip_tags($this->title),
            'code' => strip_tags($this->code),
            'state_id' => $this->state_id,
// 'districts' => $this->districts()->with('blocks')->get(['id','title'])
            'state' => $this->state($this->state_id)->get(['id','title', 'code']),
            'status' => $this->status,

        ];
    }
}