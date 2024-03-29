<?php

namespace App\Http\Resources\Api\Masters;

use Illuminate\Http\Resources\Json\JsonResource;

class LevelMasterResource extends JsonResource
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
            'id'          => $this->id,
            'title'       => strip_tags($this->title),
            'slug'        => strip_tags($this->slug),
            'description' => strip_tags($this->description),
            'status'      => $this->status,
        ];
    }
}
