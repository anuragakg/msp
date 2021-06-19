<?php

namespace App\Http\Resources\Api\Auction;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;
//use App\Http\Resources\Api\Proposals\MfpCoverageResource;
class AuctionCommitteListingResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {   
        $can_edit=0;
        $user = Auth::user();
        $user_id =$user->id;
        if($user_id==$this->created_by)
        {
            $can_edit=1;
        }
        $mfp_detail=$this->getMfpDetail;
        return [
            'id' => $this->id,
            'auction_title' => $this->auction_title,
            'type' => $this->type,
            'reference_number ' => $this->reference_number ,
            'auction_date' => date('d-M-Y',strtotime($this->auction_date)),
            'venue' => $this->venue,
            'hour' => $this->hour,
            'minute' => $this->minute,
            'state_id ' => $this->state_id ,
            'mfp_count'=>$mfp_detail->count(),
            'qty_sum'=>$mfp_detail->sum('qty'),
            'created_at'=> date('d-M-Y',strtotime($this->created_at)),
            'can_edit'=>$can_edit
            
        ];
    }
}
