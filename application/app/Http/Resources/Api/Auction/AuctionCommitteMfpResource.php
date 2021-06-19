<?php

namespace App\Http\Resources\Api\Auction;

use Illuminate\Http\Resources\Json\JsonResource;
//use App\Http\Resources\Api\Proposals\MfpCoverageResource;
class AuctionCommitteMfpResource extends JsonResource
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
            'mfp' => $this->mfp,
            'mfp_name' => isset($this->getMfpData->getMfpName->title)?$this->getMfpData->getMfpName->title:'',
            'qty' => $this->qty,
            'value_added_product_name' => $this->value_added_product_name,
            'value_added_product_qty' => $this->value_added_product_qty,
        ];
    }
}
