<?php

namespace App\Http\Resources\Api\Auction;

use Illuminate\Http\Resources\Json\JsonResource;
//use App\Http\Resources\Api\Proposals\MfpCoverageResource;
class AuctionTransactionResource extends JsonResource
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
            'type' => $this->type,
            'auction_date_form_format' => date('d/m/Y',strtotime($this->auction_date)),
            'auction_date' => date('d-M-Y',strtotime($this->auction_date)),
            'detail_data' =>AuctionTransactionDetailResource::collection($this->getTransactionDetail),
            'created_at'=> date('d-M-Y',strtotime($this->created_at)),
            'created_by' => $this->created_by,
            'created_by_username' => $this->getUser->user_name,
            
        ];
    }
}
