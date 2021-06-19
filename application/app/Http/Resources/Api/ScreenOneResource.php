<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Resources\Json\JsonResource;

class ScreenOneResource extends JsonResource
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

        foreach ($this->vdvks as $vdvk) {
            $totalProposedAmt += $vdvk->getTotalProposedCost();
        }

        return [
           'mo_id' => $this->id,
           'MO' => $this->name,
           'proposed_amount' =>  $totalProposedAmt,
           'vdvks' => $this->vdvks()->count()
        ];
    }
}
