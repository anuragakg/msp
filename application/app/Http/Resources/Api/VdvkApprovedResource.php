<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Resources\Json\JsonResource;

class VdvkApprovedResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */

    /*public function toArray($request)
    {

        $vdvkApprovedList = $this->getVdvkApprovedList;
        print_r($vdvkApprovedList['kendra_name']);

        return [
                "id" => $this['vdvk_id'],
                "vdvk_name" => ($state->exists) ? strip_tags($state->title) : null ,
                "status" => $this['status']
        ];
    }*/
}