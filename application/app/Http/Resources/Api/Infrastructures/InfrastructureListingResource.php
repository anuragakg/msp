<?php

namespace App\Http\Resources\Api\Infrastructures;

use Illuminate\Http\Resources\Json\JsonResource; 
class InfrastructureListingResource extends JsonResource
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
        $summary=$this->Summary;

        $total_fund_require =isset($summary->total_fund_require)?$summary->total_fund_require:0;

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
        $actual_fund=$this->totalAcutalFund($this->getActualDetails);
        if($this->released_amount>0){
            $total=($actual_fund/$this->released_amount)*100;
            $progress=round($total,4);
        }else
        {
            $progress=0;
        }
        return [
            'id' => $this->id,
            'proposal_id'=>$this->proposal_id,
            'ref_id' => $this->ref_id,
            'year_id' => $this->year_id,
            'financialYear' => $financialYear, 
            'added_by' => $added_by,
            'status' => $this->status,
            'status_text' => $status_text,
            'submission_status' => $this->submission_status,
            'released_amount' => $this->released_amount, 
            'progress'=>$progress,            
            'commission_amount'=>$this->commission_amount,
            'submission_status_text' => $this->submission_status==1?'Finally Submitted':'Form not submitted',
            'state'=> $state,
            'district'=> $district,
            'block'=> $block,
            'summary' =>InfrastructureDevelopmentSummaryRecource::collection($this->getSummary),             
            'total_fund_require' => $total_fund_require,
            'balance_amount' => round($total_fund_require-$this->released_amount,4),
            'is_draft' => $this->is_draft,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
            'created_at' => date('d-M-Y H:i',strtotime($this->created_at)),
        ];
    }

    public function totalAcutalFund($data)
    { $total=0;
        foreach ($data as  $row) {
           $total +=$row['release_acutal_fund'];
        }
        return $total;
    }
}
