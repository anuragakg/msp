<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Resources\Json\JsonResource;


class HaatMarketAllResource extends JsonResource
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
            'HaatMarketPartOne' => HaatMarketOneResource::make($this->getHaatMarketPartOne),
            'HaatMarketPartTwo' => HaatMarketTwoResource::make($this->getHaatMarketPartTwo),
            'HaatMarketPartThree' => HaatMarketThreeResource::make($this->getHaatMarketPartThree),
            'HaatMarketPartFour' => HaatMarketFourResource::make($this->getHaatMarketPartFour),
            'is_completed'=>$this->part_four?'1':'0',
        ];
    }
}
