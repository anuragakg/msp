<?php

namespace App\Http\Resources\Api\Masters;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Api\Masters\DistrictBlockMasterResource;

class BlockApiMasterResource extends JsonResource
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
            'code' => strip_tags($this->code),
            'district' => DistrictBlockMasterResource::make($this->distict),
            'district_data' =>  $this->district($this->district_id)->with('state')->first(['id','title','state_id'])
        ];
    }
}
