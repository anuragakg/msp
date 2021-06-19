<?php

namespace App\Http\Resources\Api\Actualdetail;

use Illuminate\Http\Resources\Json\JsonResource;
class ActualDetailHaatFundInfrastructureResource extends JsonResource
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
            'haat_id' => $this->haat_id,
            'haat_name' => $this->getHaat->getHaatBazaarDetail->getPartOne->rpm_name,
            'actual_required_funds' => $this->actual_required_funds,
        ];
    }
}
