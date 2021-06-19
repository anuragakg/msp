<?php

namespace App\Http\Resources\Api\Shg;

use Illuminate\Http\Resources\Json\JsonResource;

class ShgYearlyUsageResource extends JsonResource
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
            'id' => $this->id,
            'commodity' => $this->commodity,
            'quantity' => $this->quantity,
            'mfp_use' => $this->mfp_use,
            'title' => isset($this->getCommodity->title) ? strip_tags($this->getCommodity->title) : null,
            'mfp' => $this->getmfp($this->mfp_use),


        ];
    }
}
