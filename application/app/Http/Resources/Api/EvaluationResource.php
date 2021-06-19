<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Resources\Json\JsonResource;
use Carbon\Carbon;

class EvaluationResource extends JsonResource
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
            'vdvk_id' => $this->vdvk_id,
            'mo_id' => $this->mo_id,
            'name' => $this->getMOName->first_name.' '.$this->getMOName->last_name,
            'date_of_inspection' => Carbon::parse($this->date_of_inspection)->format('d/m/Y'),
            'actual_observation' => $this->actual_observation,
            'recommendation' => $this->recommendation,
            'evaluation' => $this->evaluation,
            'upload_supporting_documents' => $this->upload_supporting_documents,
        ];
    }
}
