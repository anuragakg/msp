<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Resources\Json\JsonResource;

class DashboardResource extends JsonResource
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
            'tribal_gatherers' => $this['tribal_gatherers'],
            'ware_houses' => $this['ware_houses'],
            'haat_market' => $this['haat_market'],
            'pending_count' => $this['pending_count'],
            'approved_count' => $this['approved_count'],
            'pmdvy_approved' => $this['pmdvy_approved'],
            'sanction_amount' => $this['sanction_amount'],
            'released_amount' => $this['released_amount'],
            'shg_group' => $this['shg_group'],
            'surveyor' => $this['surveyor'],
            'supervisor' => $this['supervisor'],
            'sanctionReleased' => SanctionedResources::collection($this['sanctionReleased']),

        ];
    }
}

class SanctionedResources extends JsonResource
{

    public function toArray($request)
    {

        $state = $this->getState;

        return [
                "state" => $this['state_id'],
                "state_name" => ($state->exists) ? strip_tags($state->title) : null ,
                "sanctioned_sum" => $this['sanctioned_sum']
        ];
    }
}