<?php

namespace App\Http\Resources\Api\Masters;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\Haatbazaar\HaatMarketOne;

class HaatBazarPartOneResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return  HaatBazarNameResource::collection(HaatMarketOne::select('rpm_name')->where('id',$this->part_one)->get());
            
            
        
    }
}
