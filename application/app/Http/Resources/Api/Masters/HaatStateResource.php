<?php

namespace App\Http\Resources\Api\Masters;

use Illuminate\Http\Resources\Json\JsonResource;

class HaatStateResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return  $this->title;
            
            
        
    }
}
