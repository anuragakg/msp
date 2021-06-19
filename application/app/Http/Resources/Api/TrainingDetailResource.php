<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Resources\Json\JsonResource;

class TrainingDetailResource extends JsonResource
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
            'title' => strip_tags($this->title),
            'duration' => $this->duration,
            'mfp_id' => $this->mfp_id,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'description' => strip_tags($this->description),
            'state' => $this->state,
            'state' => strip_tags($this->getState->title),
            'district' => $this->district,
            'state' => strip_tags($this->getDistrict->title),
            'block' => $this->block,
            'state' => strip_tags($this->getBlock->title),
            'address' => strip_tags($this->address),
            'remarks' => strip_tags($this->remarks),
            'training_status' => $this->training_status,
            'training_status_title' => strip_tags($this->getTrainingStatus->title),
        ];
    }
}
