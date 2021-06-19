<?php

namespace App\Http\Resources\Api\Masters;

use Illuminate\Http\Resources\Json\JsonResource;

class StateLevelRoleResource extends JsonResource
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
            'state_id' => $this->state_id,
            'state' => $this->getState,
            'level_id' => $this->level_id,
            'role_id' => $this->role_id,
            'Sublevel'=>$this->getSublevel
        ];
    }
}
