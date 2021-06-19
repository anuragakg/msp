<?php

namespace App\Http\Resources\Api\Auction;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Resources\Json\JsonResource;
//use App\Http\Resources\Api\Proposals\MfpCoverageResource;
class AuctionTransactionDetailResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {   
        $type=$this->getAuctionTransaction->type;
        $mfp_detail=$this->getMfpDetail;
        return [
            'id' => $this->id,
            'type' => $type,
            'ref_id' => $this->ref_id,
            'auction_transaction_id' => $this->auction_transaction_id,
            'district_id' => $this->district_id,
            'district_id_name' => $this->getDistrict->title,
            'warehouse_id' => $this->warehouse_id,
            'warehouse_name' => isset($this->getWarehouseDetail->getWarehouse->getPartOne->name)?$this->getWarehouseDetail->getWarehouse->getPartOne->name:'-',
            'mfp_id' => $this->mfp_id,
            'mfp_name' => isset($this->getMfpDetail->getMfpName->title)?$this->getMfpDetail->getMfpName->title:'',
            'value_added_product'=>$this->value_added_product,
            'value_added_product_name'=>isset($this->getValueAddedProductName->product_name)?$this->getValueAddedProductName->product_name:null,
            'document' => $this->document,
            'document_path' => !empty($this->document)?url(Storage::url($this->document)):null,
            'qty' => $this->qty,
            'value' => $this->value,
            'advance_amount' => $this->advance_amount,
            'balance_amount' => $this->balance_amount,
            'auction_date_form_format' => date('d/m/Y',strtotime($this->auction_date)),
            'auction_date' => date('d-M-Y',strtotime($this->auction_date)),

            'delivery_date_form_format' => date('d/m/Y',strtotime($this->delivery_date)),
            'delivery_date' => date('d-M-Y',strtotime($this->delivery_date)),
            'created_by' => $this->created_by,
            
            'created_at'=> date('d-M-Y',strtotime($this->created_at)),
            
        ];
    }
}
