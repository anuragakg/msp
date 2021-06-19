<?php

namespace App\Http\Resources\Api\MspMarketPrice;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class MarketPriceLogResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        switch ($this->status) {
            case '1':
                $status_text='Approved';
                break;
            case '2':
                $status_text='Reverted';
                break;
            case '3':
                $status_text='Rejected';
                break;
            
            default:
                $status_text='Pending';
                break;
        }
        return [
            'id' => $this->id,
            'haat_master_id'=>$this->haat_master_id,       
            'haat_master_name'=>isset($this->getHaat->getHaatBazaarDetail->getPartOne->rpm_name)?$this->getHaat->getHaatBazaarDetail->getPartOne->rpm_name:null,       
            'mfp_id'=>$this->mfp_id,       
            'mfp_name'=>isset($this->getMfpData->getMfpName->title)?$this->getMfpData->getMfpName->title:'',       
            'msp_price'=>$this->getMfpData->msp_price,
            'market_price'=>$this->market_price,
            'status'=>$this->status,
            'status_text'=>$status_text,
            'remarks'=>$this->remarks,
            'status_update_date'=>$this->status_update_date?date('d/m/Y',strtotime($this->status_update_date)):null,
            'status_changed_by_id'=>$this->status_changed_by,
            'status_changed_by_name'=>isset($this->getStatusChangedBy->user_name)?$this->getStatusChangedBy->user_name:null,
            'submission_date'=>date('d/m/Y',strtotime($this->created_at)),
        ];
    }
}
