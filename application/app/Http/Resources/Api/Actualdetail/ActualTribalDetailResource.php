<?php

namespace App\Http\Resources\Api\Actualdetail;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Api\Proposals\MfpCoverageResource;
class ActualTribalDetailResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {   
        $amount_payable=$this->amount_payable;
        $total_amount_of_receipt_generated=$this->getReceiptGenerated->sum('amount');
        return [
            'id' => $this->id,
            'id_type' => $this->id_type,
            'id_type_name' => $this->getIdName->title,
            'id_value' => $this->id_value,
            'shg_id' => $this->shg_id,
            'name_of_tribal' => $this->name_of_tribal,
            'bank_account_no' => $this->bank_account_no,
            'village' => $this->village,
            'bank_ifsc' => $this->bank_ifsc,
            'address' => $this->address,
            'type' => $this->type==1?'Haat':'Procurement Center',
            'procurement_date' =>date('d-M-Y',strtotime( $this->procurement_date)),
            'procurement_date_dmy' =>date('d/m/Y',strtotime( $this->procurement_date)),
            'mfp_procurement_id' => $this->mfp_procurement_id,
            'proposal_id' => $this->getMfpProcurement->proposal_id,
            'amount_paid' => $this->amount_paid,
            'amount_payable' => $this->amount_payable,
            'has_receipt_generated' => $this->has_receipt_generated,
            'total_amount_of_receipt_generated' => $this->getReceiptGenerated->sum('amount'),
            'max_can_paid' => $amount_payable-$total_amount_of_receipt_generated,
            'commodity' => ActualTribalCommodityResource::collection($this->getActualDetailCommodity),
            'created_by' => $this->created_by,
            'created_at' => date('d-M-Y H:i',strtotime($this->created_at)),
            'is_procurement_details_submitted' =>$this->is_procurement_details_submitted,
            'is_overhead_details_submitted'=>$this->is_overhead_details_submitted
        ];
    }
}
