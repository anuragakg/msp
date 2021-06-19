<?php

namespace App\Http\Resources\Api\Shg;

use Illuminate\Http\Resources\Json\JsonResource;

class ShgViewOnePartTwoResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        if($this->is_gathering_mfp==''){
            $is_gathering_mfp=null;
        }else{
            $is_gathering_mfp=(int)$this->is_gathering_mfp;
        }    
        return [
            'shg_id' => $this->id,
            'no_of_members' => $this->no_of_members,
            'latitude' => isset($this->latitude) ? strip_tags($this->latitude) : null,
            'longitude' => isset($this->longitude) ? strip_tags($this->longitude) : null,
            'members' => ShgMembersResource::collection($this->getHouseHoldMembers),
            'yearly_usage' => ShgYearlyUsageResource::collection($this->getMfpYearlyGatherings),
            'is_gathering_mfp' => $is_gathering_mfp,
        ];
    }
}
