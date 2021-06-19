<?php

namespace App\Http\Resources\Api\Auction;

use Illuminate\Http\Resources\Json\JsonResource;
//use App\Http\Resources\Api\Proposals\MfpCoverageResource;
class AuctionCommitteMemberResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {   
        $memberinfo=$this->getMemberDetails;
        return [
            'id' => $this->id,
            'member_id' => $this->member_id,
            'member_name' => isset($memberinfo->name)?$memberinfo->name:'',
            'member_designation' => $this->member_designation,
            'member_email' => $this->member_email,
            'member_phone' => $this->member_phone,
        ];
    }
}
