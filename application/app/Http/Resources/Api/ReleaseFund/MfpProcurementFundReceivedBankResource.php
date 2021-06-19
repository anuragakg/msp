<?php

namespace App\Http\Resources\Api\ReleaseFund;

use Illuminate\Http\Resources\Json\JsonResource;

class MfpProcurementFundReceivedBankResource extends JsonResource
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
            'mfp_procurement_id' => $this->mfp_procurement_id,
            'procurement_agent' => $this->procurement_agent,
            'bank_id' => $this->bank_id,
            'BankDetail' => $this->getBankDetail,
            'account_no' => $this->account_no,
            'release_amount' => $this->release_amount,
            'created_by' => ucwords($this->created_by),
            
            'transaction_date' => date('d-M-Y H:i',strtotime($this->transaction_date)),
            'created_at' => date('d-M-Y H:i',strtotime($this->created_at)),
            
            
        ];
    }
}
