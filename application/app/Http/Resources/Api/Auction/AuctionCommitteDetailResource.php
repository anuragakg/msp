<?php

namespace App\Http\Resources\Api\Auction;

use Illuminate\Http\Resources\Json\JsonResource;
//use App\Http\Resources\Api\Proposals\MfpCoverageResource;
class AuctionCommitteDetailResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {   
        $mfp_detail=$this->getMfpDetail;
        return [
            'id' => $this->id,
            'auction_title' => $this->auction_title,
            'type' => $this->type,
            'reference_number' => $this->reference_number ,
            'auction_date_form_format' => date('d/m/Y',strtotime($this->auction_date)),
            'auction_date' => date('d-M-Y',strtotime($this->auction_date)),
            'venue' => $this->venue,
            'hour' => $this->hour,
            'minute' => $this->minute,
            'state_id' => $this->state_id,
            'state' => $this->getState->title,
            'committe_detail'=>AuctionCommitteMemberResource::collection($this->getCommitteMember),
            'mfp_detail'=>AuctionCommitteMfpResource::collection($this->getMfpDetail),
            'created_at'=> date('d-M-Y',strtotime($this->created_at)),
            
        ];
    }
}
