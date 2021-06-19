<?php

namespace App\Http\Resources\Api\Proposals;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Api\Proposals\MfpCoverageResource;
class MfpProcurementResource extends JsonResource
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
            'ref_id' => $this->ref_id,
            'year_id' => $this->year_id,
            'is_step3_complete'=>$this->is_step3_complete,
            'mfp_coverage'=>MfpCoverageResource::collection($this->getMfpCoverage),
            'mfp_seasonality'=>MfpSeasonalityResource::collection($this->getMfpSeasonality),
            'status' => $this->status,
            'is_completed' => $this->part_three? '1' : '0',
            'is_draft' => $this->is_draft,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
            'created_at' => date('d-M-Y H:i',strtotime($this->created_at)),
        ];
    }
}
