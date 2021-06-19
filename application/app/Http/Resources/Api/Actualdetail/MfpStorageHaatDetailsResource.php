<?php

namespace App\Http\Resources\Api\Actualdetail;

use Illuminate\Http\Resources\Json\JsonResource;

class MfpStorageHaatDetailsResource extends JsonResource
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
            'mfp_storage_actua_other_id' => $this->mfp_action_detail_id,
            'haat_id' => $this->haat_id,
            'haat_name' => $this->getHaatName->getHaatBazaarDetail->getPartOne->rpm_name,
        ];
    }
}
