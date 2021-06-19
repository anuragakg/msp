<?php

namespace App\Http\Resources\Api\Infrastructures;

use Illuminate\Http\Resources\Json\JsonResource; 
class InfrastructureProposalListingResource extends JsonResource
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
        $state = $getUser->getUserDetails->getState->title;
        $district = $getUser->getUserDetails->getDistrict->title;
        $block = isset($getUser->getUserDetails->getBlock->title)?$getUser->getUserDetails->getBlock->title:'';
        $financialYear=$this->getProposedFinancialYear->title;
        switch ($this->status) {
            case '1':
                $status_text='Approved';
                break;
            case '2':
                $status_text='Revert';
                break;
            case '3':
                $status_text='Reject';
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
                $current_status_text='Revert';
                break;
            case '3':
                $current_status_text='Reject';
                break;    
            default:
                $current_status_text='Pending';
                break;
        }
        return [
            'id' => $this->id,
            'ref_id' => $this->ref_id,
            'proposal_id' => $this->proposal_id,
            'consolidated_id'=>!empty($this->consolidated_id)?$this->getConsolidated->reference_number:'-',
            'year_id' => $this->year_id,
            'financialYear' => $financialYear, 
            'added_by' => $added_by,
            'status' => $this->status,
            'status_text' => $status_text,
            'current_status_text' => $current_status_text,
            'current_status' => $this->current_status,
            'total_value'=>$this->Summary->total_fund_require,
            'submitted_on' => $this->submission_date?date('d-M-Y',strtotime($this->submission_date)):date('d-M-Y',strtotime($this->created_at)),
            'submission_status' => $this->submission_status,
            'submission_status_text' => $this->submission_status==1?'Finally Submitted':'Form not submitted',
            'state'=> $state,
            'district'=> $district,
            'block'=> $block,
            'summary' =>InfrastructureDevelopmentSummaryRecource::collection($this->getSummary), 
            'is_draft' => $this->is_draft,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
            'created_at' => date('d-M-Y H:i',strtotime($this->created_at)),
        ];
    }
}
