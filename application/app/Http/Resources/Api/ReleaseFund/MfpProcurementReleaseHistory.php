<?php


namespace App\Http\Resources\Api\ReleaseFund;
use App\Models\Mfp_procurement_fund_released;
use App\Http\Resources\Api\UserResource;
use Illuminate\Http\Resources\Json\JsonResource;

class MfpProcurementReleaseHistory extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {   
        $total_released_amount=$this->getUserMaxReleasedAmount($this->consolidated_id,$this->created_by);
        return [
            'id' => $this->id,
            'consolidated_id' => $this->consolidated_id,
            'reference_number' => $this->getConsolidatedData->reference_number,
            'bank_name' => $this->bank_name,
            'bank_details' => $this->getBankDetails,
            'release_percent' => $this->release_percent,
            'account_number' => $this->account_number,
            'transaction_date' => date('d-m-Y',strtotime($this->transaction_date)) ,
            'release_amount' => $this->release_amount,
            'commission_amount' => $this->commission_amount,
            'commission_rate' => $this->commission_rate,
            
            'total_released_amount' => $total_released_amount,
            'created_by_id' => $this->created_by,
            'created_by' => UserResource::make($this->getUser),
            
            'created_at' => date('d-M-Y H:i',strtotime($this->created_at)),
            
        ];
    }
    private function getUserMaxReleasedAmount($consolidated_id,$assigned_to)
    {
        $history=Mfp_procurement_fund_released::where(['consolidated_id'=>$consolidated_id,'assigned_to'=>$assigned_to])->first();

        return $history->max_can_release;
    }
}
