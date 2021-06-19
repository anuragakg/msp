<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Resources\Json\JsonResource;

class MobileDashboardResource extends JsonResource
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
            'pending' => [
                'shg_gatherers' => $this->when(!is_null($this['shg_gatherers_pending']), $this['shg_gatherers_pending']),
                'haat_bazaar' => $this->when(!is_null($this['haat_bazaar_pending']), $this['haat_bazaar_pending']),
                'warehouse' => $this->when(!is_null($this['warehouse_pending']), $this['warehouse_pending']),
            ],
            'approved' => [
                'shg_gatherers' => $this->when(!is_null($this['shg_gatherers_approved']), $this['shg_gatherers_approved']),
                'haat_bazaar' => $this->when(!is_null($this['haat_bazaar_approved']), $this['haat_bazaar_approved']),
                'warehouse' => $this->when(!is_null($this['warehouse_approved']), $this['warehouse_approved']),
            ]
        ];
    }
}
