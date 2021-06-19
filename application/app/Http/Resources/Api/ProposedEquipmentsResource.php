<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Resources\Json\JsonResource;

class ProposedEquipmentsResource extends JsonResource
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
            'status' => $this->status,
            'proposed_mfps' => ProposedMfps::collection($this->getMfps),            
        ];
    }
}


class ProposedMfps extends JsonResource {
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $equipmentsMaster=$this->getEquipmentsMfp;
        return [
            'id' => $this->shg_id,
            'mfp_name' => isset($equipmentsMaster['title'])? strip_tags($equipmentsMaster['title']) :'',
            'equipments' => ProposedEquipmentsMfpJoin::collection($this->getEquipments)
        ];
    }
}

class ProposedEquipmentsMfpJoin extends JsonResource {
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $equipmentsMaster=$this->getEquipmentsMaster;

        return [
            'id' => $this->equipment_id,
            'equipmentsMaster' => isset($equipmentsMaster['title'])? strip_tags($equipmentsMaster['title']) :'',
            'attribute_type' => $this->attribute_type ?? '',
            'attribute_value' => $this->attribute_value ?? '',
            'attribute_width' => $this->width ?? '',
            'attribute_height' => $this->height ?? '',
            'model' => $this->model ?? '',
        ];
    }
}