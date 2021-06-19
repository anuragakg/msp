<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Resources\Json\JsonResource;

class ProposedVdvkFundResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {

        $vdvkName = $this->getVdvk->getProposedLocation->kendra_name;

        return [
            'ref_id' => $this->ref_id,
            'vdvk_id' =>  $this->vdvk_id,
            'vdvk_name' => strip_tags($vdvkName),
            'user_id' =>  $this->user_id,
            'proposed_amount' =>  (double) strip_tags($this->proposed_amount),
            'approved_amount' =>  (double) strip_tags($this->approved_amount),
            'released_amount' =>  (double) strip_tags($this->released_amount),
            'to_released_amount' =>  (double) strip_tags($this->to_released_amount),
            'balance_amount'  =>  (double) strip_tags($this->balance_amount),
            'proposed_shg'   =>  ShgGroupDetailResource::collection($this->getShgGroups),
        ];
    }
}

class ShgGroupDetailResource extends JsonResource
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
            'shg_group' => $this->getShgGroup->getShgGatherers->count(),
        ];
    }
}
