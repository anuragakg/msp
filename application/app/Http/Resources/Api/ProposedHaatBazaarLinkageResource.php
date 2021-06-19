<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Resources\Json\JsonResource;

class ProposedHaatBazaarLinkageResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $haatDetails = $this->getHaatDetails;

        $partOne = optional($haatDetails)->getPartOne;

        return [
            'id' => $this->id ?? '',
            'haat_bazaar_id' => $this->haat_bazaar_id ?? '',
            'haat_bazaar_name' => $partOne ? strip_tags($partOne->rpm_name) : '',
            'address' => isset($this->address) ? strip_tags($this->address) : '',
            'distance_vkvd' => isset($this->distance_vkvd) ? strip_tags($this->distance_vkvd) : '',
            'unit' => isset($this->unit) ?  strip_tags($this->distance_vkvd) : '',
        ];
    }
}
