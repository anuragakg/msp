<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Resources\Json\JsonResource;


class ShgAllResource extends JsonResource
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
            'ShgPartOne' => Shg\ShgViewOneResource::make($this),
            'ShgPartTwo' => Shg\ShgViewOnePartTwoResource::make($this),
            'is_completed'=> $this->no_of_members === null?'0':'1'
        ];
    }
}
