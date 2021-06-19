<?php

namespace App\Http\Resources\Api\Proposals;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Api\Proposals\MfpCoverageResource;
class MfpListingResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {   
        $getUser=$this->getUser;
        $added_by=$getUser->name.' '.$getUser->middle_name.' '.$getUser->last_name;
        $state=$getUser->getUserDetails->getState->title;
        $district=$getUser->getUserDetails->getDistrict->title;
        $financialYear=$this->getProposedFinancialYear->title;
        $summary=$this->getSummary;
        $total_released_to_procurement_agent=$this->getDiaReleasedToProcurementsAgent->sum('total_released_to_procurement_agent');

        $total_fund_require =isset($summary->total_fund_require)?$summary->total_fund_require:0;


        //=====MFP Tribal Details Amount=====
        $total_progress_amount=0;
        

        $total_progress_amount=$this->actual_tribal_amount_paid + $this->total_mfp_storage_value+$this->total_overhead_paid_value;


        $total_progress=$total_released_to_procurement_agent? ($total_progress_amount/$total_released_to_procurement_agent)*100 :0;

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
        switch ($this->current_status) {
            case '1':
                $current_status_text='Recommended';
                break;
            case '2':
                $current_status_text='Reverted';
                break;
            case '3':
                $current_status_text='Rejected';
                break;    
            default:
                $current_status_text='Pending';
                break;
        }
        return [
            'id' => $this->id,
            'ref_id' => $this->ref_id,
            //'consolidated_id' => $this->consolidated_id,
            'consolidated_id' => $this->consolidated_id?$this->getConsolidated->reference_number:null,
            'year_id' => $this->year_id,
            'proposal_id' => $this->proposal_id,
            'financialYear' => $financialYear,
            'current_status_text' => $current_status_text,
            'current_status' => $this->current_status,
            'state' => $state,
            'district' => $district,
            'added_by' => $added_by,
            'status' => $this->status,
            'status_text' => $status_text,
            'submission_status' => $this->submission_status,
            'submission_status_text' => $this->submission_status==1?'Finally Submitted':'Form not submitted',
            'is_draft' => $this->is_draft,
            'mfps'=>$this->getMfpCoverage->count(),
            'quantity'=>$this->getMfpCommodity->sum('currentqty'),
            'value'=> $this->getMfpCommodity->sum('currentval'),
            'total_fund_require' => $total_fund_require,
            'is_released' => $this->is_released,
            'released_amount' => $this->released_amount,
            'balance_amount' => round($total_fund_require-$this->released_amount,4),
            'has_released_to_procurement_agent' => $this->has_released_to_procurement_agent,
            'total_released_to_procurement_agent' => $total_released_to_procurement_agent,
            'total_can_released_to_procurement_agent' => $this->released_amount-($total_released_to_procurement_agent+$this->commission_amount),
            'progress'=>round($total_progress,4),
            'commission_amount'=>$this->commission_amount,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
            'created_at' => date('d-M-Y H:i',strtotime($this->created_at)),
        ];
    }
}
