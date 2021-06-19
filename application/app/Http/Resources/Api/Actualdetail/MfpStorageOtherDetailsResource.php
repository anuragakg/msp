<?php

namespace App\Http\Resources\Api\Actualdetail;

use Illuminate\Http\Resources\Json\JsonResource;

class MfpStorageOtherDetailsResource extends JsonResource
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
            'mfp_action_detail_id' => $this->mfp_action_detail_id,
            'warehouse_id' => $this->warehouse_id,
            'getWarehouseName'=>isset($this->getWarehouseName->getWarehouse->getPartOne->name)?$this->getWarehouseName->getWarehouse->getPartOne->name:null,
            'haat_id' => $this->haat_id,
            'haat_data' => $this->getHaat->getHaatBazaarDetail->getPartOne->rpm_name,
            'qty' => $this->qty,
            'value' => $this->value, 
        ];
    }
}
