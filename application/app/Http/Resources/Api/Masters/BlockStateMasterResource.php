<?php

namespace App\Http\Resources\Api\Masters;

use App\Http\Resources\Api\Masters\DistrictBlockMasterResource;
use Illuminate\Http\Resources\Json\JsonResource;

class BlockStateMasterResource extends JsonResource
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
            'district_id' => strip_tags($this->district_id),
            'title' => strip_tags($this->title),
            'code' => strip_tags($this->code),
            'district' => DistrictBlockMasterResource::make($this->district),
            'status' => $this->status,
            //'district' =>  $this->district($this->district_id)->with('state')->first(['id','title','state_id', 'code'])
        ];
    }
}
