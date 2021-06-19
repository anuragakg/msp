<?php

namespace App\Http\Resources\Api\Warehouse;

use Illuminate\Http\Resources\Json\JsonResource;

class WarehouseViewOneResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {

        $state = $this->getState;
        $district = $this->getDistrict;
        $block = $this->getBlock; 
        $village = $this->getVillage;
        $chamber_data = $this->getChamberDetails;
        return [
            'id' => $this->id,
            'name' => strip_tags($this->name),
            'type' => $this->type,
            'address' => strip_tags($this->address),
            'mobile_no' => strip_tags($this->mobile_no),
            //'name_private' => $this->name_private,
            'landline_no' => strip_tags($this->landline_no),
            //'address_private' => $this->address_private,
            'state' =>$this->state,
            'state_name' => ($state->exists) ? strip_tags($state->title) : null,
            'district' => $this->district,
            'district_name' => ($district->exists) ? strip_tags($district->title) : null,
            'block' => $this->block,
            'block_name' => ($block->exists) ? strip_tags($block->title) : null,
            'village' =>$this->village,
            'village_name' => ($village->exists) ? strip_tags($village->title) : null,
            'pin_code' => $this->pin_code,
            'gram_panchayat' => strip_tags($this->gram_panchayat),
            'registration_no' => ($this->registration_no),
            'registration_date' => date('d/m/Y',strtotime($this->registration_date)),
            'authority' => $this->authority,
            'length' => $this->length,
            'max_stack_height' => $this->max_stack_height,
            'width' => $this->width,
            'capacity' => $this->capacity,
            'warehouse_area' => $this->warehouse_area,
            'capacity_utilization' => $this->capacity_utilization,
            'is_cold_storage_available' => $this->is_cold_storage_available,
            //'is_ca_storage_available' => $this->is_ca_storage_available,
            'closed_days' => explode(',', $this->closed_days),
            'open_time' => $this->open_time,
            'close_time' => $this->close_time,
            'is_generator' => $this->is_generator,
            'generator_capacity' => $this->generator_capacity,
            'cold_storage_capacity' => $this->cold_storage_capacity,
            'chamber_wise_capacity' => $this->chamber_wise_capacity,
            'chamber_data'  => $chamber_data,
            'indemnification_available' => $this->indemnification_available,
            'is_stuffing_facility' => $this->is_stuffing_facility,
            'is_open_yard_facility' => $this->is_open_yard_facility,
            'drying_facility' => $this->drying_facility,
            //'is_quality_agent' => $this->is_quality_agent,
            'is_commodities_stored' => $this->is_commodities_stored,
            'is_weightment' => $this->is_weightment,


            /* To View Details */
            'type_name' => strip_tags($this->getPremises->title),
        ];
    }
}
