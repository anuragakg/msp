<?php

namespace App\Http\Resources\Api\Actualdetail;

use Illuminate\Http\Resources\Json\JsonResource;

class ProcurementReceiptResource extends JsonResource
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
            'ref_id' =>$this->ref_id,
            'name_of_tribal' =>$this->name_of_tribal,
            'receipt_id' =>$this->receipt_id,
            'amount' =>$this->amount,
            'rest_amount' =>$this->rest_amount,
            'amount_of_rupees' =>$this->amount_of_rupees,
            'dated' =>date('d-M-Y',strtotime( $this->dated)),
            'commodity' => ActualTribalCommodityResource::collection($this->getActualDetailCommodity),
            'created_by' => $this->created_by,
            'created_at' => date('d-M-Y H:i',strtotime($this->created_at)),
        ];
    }
}
