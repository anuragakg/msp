<?php

namespace App\Http\Resources\Api\Masters;

use Illuminate\Http\Resources\Json\JsonResource;

class TrainingMasterResource extends JsonResource
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
            'duration' => strip_tags($this->duration),
            'duration_unit' => $this->duration_unit,
            'description' => strip_tags($this->description),
            'mfp_id' => $this->mfp_id,
            'status' => $this->status,
        ];
    }
}
