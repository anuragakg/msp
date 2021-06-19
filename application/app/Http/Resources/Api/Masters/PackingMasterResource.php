<?php

namespace App\Http\Resources\Api\Masters;

use Illuminate\Http\Resources\Json\JsonResource;

class PackingMasterResource extends JsonResource
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
            'bag_type' => $this->bag_type,
            'bag_name'=>$this->bag_name,
            'specifications' => $this->specifications,
            'status' => $this->status,
        ];
    }
}
