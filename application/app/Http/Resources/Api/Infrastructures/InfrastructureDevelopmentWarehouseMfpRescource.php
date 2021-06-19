<?php

namespace App\Http\Resources\Api\Infrastructures;

use Illuminate\Http\Resources\Json\JsonResource; 
class InfrastructureDevelopmentWarehouseMfpRescource extends JsonResource
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
            'warehouse_row_id' => $this->warehouse_row_id,    
            'mfp_id' => $this->mfp_id,    
            'mfp_name' => $this->getMfpdata->getMfpName->title,
        ];
    }
}
