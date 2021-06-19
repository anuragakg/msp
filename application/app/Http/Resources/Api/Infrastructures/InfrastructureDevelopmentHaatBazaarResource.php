<?php

namespace App\Http\Resources\Api\Infrastructures;

use Illuminate\Http\Resources\Json\JsonResource;
use Helper; 
class InfrastructureDevelopmentHaatBazaarResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {   $haat_data=$this->getHaat; 
        $haat_name=$haat_data->getHaatBazaar->getPartOne->rpm_name;  
        return [
            'id' => $this->id,
            'infra_id' => $this->infra_id,
            'haat_id' => $this->haat_id,   
            'haat_name' => $haat_name,       
            'operation_day' => $this->operation_day,
            'nature_of_operation' => $this->nature_of_operation,
            'requirement_fund_summary' => $this->requirement_fund_summary,
            'mfp_data' =>InfrastructureDevelopmentMfpRescource::collection($this->getMfpData), 
            'block_data' =>InfrastructureDevelopmentHaatBlockRescource::collection($this->getBlockData), 
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
            'created_at' => date('d-M-Y H:i',strtotime($this->created_at)),
        ];
    }
}
