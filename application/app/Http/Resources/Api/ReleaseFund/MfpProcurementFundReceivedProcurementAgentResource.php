<?php

namespace App\Http\Resources\Api\ReleaseFund;

use App\Http\Resources\Api\Actualdetail\ActualTribalDetailResource;
use Illuminate\Http\Resources\Json\JsonResource;

class MfpProcurementFundReceivedProcurementAgentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {   
        $mfp_procurement=$this->getMfpProcurement;
        $tribal_details = ActualTribalDetailResource::collection($this->getActualTribalDetails);
        
        return [
            'id' => $this->id,
            'ref_id' => $this->ref_id,
            'mfp_procurement_id' => $this->mfp_procurement_id,
            'proposal_id' => $mfp_procurement->proposal_id,
            'actual_tribal_amount_paid' => $mfp_procurement->actual_tribal_amount_paid,
            'total_mfp_storage_value' => $mfp_procurement->total_mfp_storage_value,
            'total_overhead_paid_value' => $mfp_procurement->total_overhead_paid_value,
            'proposal_ref_id' => $mfp_procurement->ref_id,
            'procurement_agent' => $this->procurement_agent,
            'procurement_agent_details' => $this->getProcurementAgent,
            'actual_detail_tribal_count' => $this->getActualTribalDetails->count(),
            'actual_overhead_details'=>$this->getActualOverheadDetails,
            'total_mfp' => $this->total_mfp,
            'total_quantity' => $this->total_quantity,
            'total_value' => $this->total_value,
            'total_released_to_procurement_agent' => $this->total_released_to_procurement_agent,
            'released_on' => date('d-M-Y h:s:a', strtotime($this->created_at)),
            'fund_utilized' => $mfp_procurement->total_mfp_storage_value + $mfp_procurement->total_overhead_paid_value+$mfp_procurement->actual_tribal_amount_paid,
            //'is_overhead_submitted'=>isset($mfp_procurement->is_actual_overhead_submitted)?$mfp_procurement->is_actual_overhead_submitted:'',
            'is_procurement_details_submitted'=> count($tribal_details)?$tribal_details[0]->is_procurement_details_submitted:0,
            'is_overhead_details_submitted'=>count($tribal_details)?$tribal_details[0]->is_overhead_details_submitted:0,
            'created_by' => $this->getUser,
            'created_at' => date('d-M-Y H:i',strtotime($this->created_at)),
        ];
    }
}
