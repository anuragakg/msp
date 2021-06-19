<?php

namespace App\Http\Resources\Api\ReleaseFund;

use Illuminate\Http\Resources\Json\JsonResource;

class InfrastructureFundReceivedHistoryResource extends JsonResource
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
            'bank_name' => $this->bank_name,
            'bank_details' => $this->getBankDetails,
            'release_percent' => $this->release_percent,
            'account_number' => $this->account_number,
            'transaction_date' => date('d-M-Y',strtotime($this->transaction_date)) ,
            'released_amount' => $this->released_amount,
            'created_by' => $this->getUser,
            
            'created_at' => date('d-M-Y H:i',strtotime($this->created_at)),
            
        ];
    }
}
