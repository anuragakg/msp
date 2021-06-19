<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Resources\Json\JsonResource;

class ScreenOneResourceDetail extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {

        $totalProposedAmt = 0;
        $vdvk_data=array();
        foreach ($this->vdvks as $vdvk) {
            $vdvk_data[]=array(
                'vdvk_id'=>$vdvk->id,
                'location_data'=>$vdvk->getProposedLocation,
                'district'=>$vdvk->getProposedLocation->getDistrict,
                'MO' => $this->name,
                'totalProposedAmt'=>$vdvk->getTotalProposedCost(),
            );
           
        }
        return $vdvk_data;
    }
}
