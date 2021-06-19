<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Resources\Json\JsonResource;

class ProposedWareHouseLinkageResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        /**
         * Providing default values
         */
        $warehouseId = 0;
        $warehouseName = '';
        $warehouseMapping = $this->getWarehouseMapping;

        if ($warehouseMapping) {
            $warehouseId = $warehouseMapping->id;
            $warehousePartOne = $warehouseMapping->getPartOne;
            if ($warehousePartOne) {
                $warehouseName = $warehousePartOne->name;
            }
        }
        
        return [
            'id' => $this->id ?? '',
            'warehouse_id' => $warehouseId,
            'warehouse_name' =>strip_tags($warehouseName),
            'address' =>isset($this->address) ? strip_tags($this->address) : '',
            'distance_vkvd' => $this->distance_vkvd ?? '',
            'unit' => $this->unit ?? ''
        ];
    }
}
