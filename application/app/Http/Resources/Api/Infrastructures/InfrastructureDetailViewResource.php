<?php

namespace App\Http\Resources\Api\Infrastructures;
use Illuminate\Support\Facades\Auth; 
use Illuminate\Http\Resources\Json\JsonResource; 
class InfrastructureDetailViewResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {   
         $financialYear=$this->getProposedFinancialYear->title;      
         $user_id = Auth::user()->id; 
         $can_update_status=0; 

        if($this->assigned_to==$user_id && ($this->current_status==0 || $this->current_status==2))
        {
            $can_update_status=1;             
        }
        return [
            'id' => $this->id,
            'ref_id' => $this->ref_id,
            'proposal_id' => $this->proposal_id,
            'year_id' => $this->year_id,
            'financialYear' => $financialYear,
            'can_update_status'=>$can_update_status, 
            'totalfund' => InfrastructureDevelopmentFundRescource::collection($this->TotalHaatFund),       
            'infra_haat'=>InfrastructureDevelopmentHaatBazaarResource::collection($this->getInfrastructureHaat),    
            'assessment_data'=>InfrastructureDevelopmentAssessmentResource::collection($this->getAssessment),
            'proposed_plan' =>InfrastructureDevelopmentProposedRescource::collection($this->getProposed),    
            'warehouse_facilities' =>InfrastructureDevelopmentWarehouseResource::collection($this->getWarehouse),    
            'summary' =>InfrastructureDevelopmentSummaryRecource::collection($this->getSummary), 
            'status' => $this->status,
            'is_completed' => $this->part_three? '1' : '0',
            'is_draft' => $this->is_draft,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
            'created_at' => date('d-M-Y H:i',strtotime($this->created_at)),
            'max_proposal_date' => date('m/d/Y',strtotime($this->created_at)),
        ];
    }
}
