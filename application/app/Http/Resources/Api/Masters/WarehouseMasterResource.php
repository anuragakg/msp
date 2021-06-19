<?php

namespace App\Http\Resources\Api\Masters;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;
class WarehouseMasterResource extends JsonResource
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
            'state_id' => $this->state_id,
            'state'=>$this->getState->title,       
            'district_id'=>$this->district_id,       
            'district_name'=>$this->getDistrict->title,       
            'warehouse_id'=>$this->warehouse,       
            'warehouse_name'=>isset($this->getWarehouse->getPartOne->name)?$this->getWarehouse->getPartOne->name:'',       
            'WarehouseBlocksDetails'=>WarehouseBlockResource::collection($this->getWarehouseBlocks),       
            'corresponding_hats_id'=>$this->corresponding_hats,       
            'corresponding_hats_name'=>isset($this->getHaatBazaar->getPartOne->rpm_name)?$this->getHaatBazaar->getPartOne->rpm_name:'',       
            'storage_type'=>$this->storage_type,       
            'storage_capacity'=>$this->storage_capacity,               
            'status' => $this->status,
            'created_at'=>date('d-M-y H:m',strtotime($this->created_at)),
        ];
    }
}
