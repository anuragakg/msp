<?php

namespace App\Http\Resources\Api\ReleaseFund;

use Illuminate\Http\Resources\Json\JsonResource;
use Helper;
class InfrastructureCommissionReceivedDetailResource extends JsonResource
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
            'proposal_id' => $this->proposal_id,
            'transaction_date' => $this->date,
            'release_amount' => $this->release_acutal_fund,
            'commission_amount' => $this->commission_amount,
            'commission_rate' => Helper::decimalNumberFormat($this->commission_rate),
            
        ];
    }
}
