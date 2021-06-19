<?php

namespace App\Http\Resources\Api\Infrastructures;

use Illuminate\Http\Resources\Json\JsonResource; 
class InfrastructureDevelopmentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {  /* 
        $array=array();
        $total=array();
        $unitHaat=$this->TotalHaatFund;
        foreach ($unitHaat as $key => $value) { 
            if (isset($total[$value['haat_id']])) {
               $total[$value['haat_id']] += $value['estimated_funds'];
            }
            else
            {
                $total[$value['haat_id']] = $value['estimated_funds'];


                $array[]=array(
                    'haat_id' => $value['haat_id'],
                    'fund' => $value['estimated_funds'],
                     );
            }

            
        }*/

    

        return [
            'id' => $this->id,
            'ref_id' => $this->ref_id,
            'year_id' => $this->year_id,      
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
        ];
    }

     
}
