<?php

namespace App\Http\Resources\Api\Proposals;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Api\Proposals\MfpCoverageResource;
class MfpDetailViewResource extends JsonResource
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
            'ref_id' => $this->ref_id,
            'proposal_id' => $this->proposal_id,
            'year_id' => $this->year_id,
            'is_step3_complete' => $this->is_step3_complete,
            'financialYear' => $financialYear,
            'mfp_coverage'=>MfpCoverageResource::collection($this->getMfpCoverage),
            'mfp_seasonality'=> MfpSeasonalityResource::collection($this->getMfpSeasonality),
            'getMfpDisposal'=>MfpProcurementDisposalResource::collection($this->getMfpDisposal),
            'getMfpCollectionLevel'=>MfpCollectionLevelResource::collection($this->getMfpCollectionLevel),
            'getMfpLabourCharges'=>MfpProcurementLabourChargesResource::collection($this->getMfpLabourCharges),
            'getMfpWeightmentCharges'=>MfpProcurementWeightmentChargesResource::collection($this->getMfpWeightmentCharges),
            'getMfpTransportationCharges'=>MfpProcurementTransportationChargesResource::collection($this->getMfpTransportationCharges),
            'getMfpServiceCharges'=>MfpProcurementServiceChargesResource::collection($this->getMfpServiceCharges),
            'getMfpWarhouseLabourCharges'=>MfpProcurementWarehouseLabourResource::collection($this->getMfpWarehouseLabourCharges),
            'getMfpWarhouseCharges'=>MfpProcurementWarehouseChargesResource::collection($this->getMfpWarehouseCharges),
            'getMfpEstimatedWastages'=>MfpProcurementEstimatedWastagesResource::collection($this->getEstimatedWastages),
            'getMfpOtherCosts'=>MfpProcurementOtherCostsResource::collection($this->getMfpOtherCosts),
            'getMfpServiceChargesDIA'=>MfpProcurementServiceChargesDiaResource::collection($this->getMfpServiceChargesDIA),
            'getMfpSummary'=>$this->getSummary,
            'mfp_seasonality_procurement'=>MfpProcurementDiaReleaseResource::collection($this->getDiaReleaseCommodity),
            'status' => $this->status,
            'status_text' => $status_text,
            'submission_status' => $this->submission_status,
            'submission_status_text' => $this->submission_status==1?'Finally Submitted':'Form not submitted',
            'can_update_status'=>$can_update_status,
            'consolidated_id' => $this->consolidated_id,
            'is_draft' => $this->is_draft,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
            'created_at' => date('d-M-Y H:i',strtotime($this->created_at)),
        ];
    }
}
