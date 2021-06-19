<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Resources\Json\JsonResource;


class HaatMarketOneResource extends JsonResource
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
        $linkage = optional($this->getLinkage);
        $other_haat_bazaar['haat_data'] = $this->getOtherHaatBazaar;
        return [
            'id' => $this->id,
            'part_one_id' => $this->id,
            'rpm_name' => strip_tags($this->rpm_name),
            'rpm_location' => strip_tags($this->rpm_location),
            'address' => strip_tags($this->address),
            'state' => $state->id,
            'state_name' => strip_tags($state->title),
            'district' => $district->id,
            'district_name' => strip_tags($district->title),
            'block' => $block->id,
            'block_name' => strip_tags($block->title),
            'gram_panchayat' => strip_tags($this->gram_panchayat),
            'village' => $village->id,
            'village_name' => strip_tags($village->title),
            'pin_code' => $this->pin_code,
            'rpm_ownership' => $this->rpm_ownership,
            'operating_rpm' => $this->operating_rpm,
            'premises_rpm' => $this->premises_rpm,
            'is_on_rent' => $this->is_on_rent,
            'rate_per_annum' => $this->rate_per_annum,
            'market_regulation' => $this->market_regulation,
            'regulation_type' => $this->regulation_type,
            'periodicity' => $this->periodicity,
            'working_days' => $this->working_days,
            'sale_start_time' => $this->sale_start_time,
            'sale_end_time' => $this->sale_end_time,
            'staff_size' => $this->staff_size,
            'nearest_railway_station' => $linkage->nearest_railway_station,
            'railway_distance' => (float)$linkage->railway_distance,
            'nearest_highway' => $linkage->nearest_highway,
            'highway_distance' => (float)$linkage->highway_distance,
            'nearest_apmc_market' => $linkage->nearest_apmc_market,
            'apmc_distance' => (float)$linkage->apmc_distance,
            'nearest_bus_stand' => $linkage->nearest_bus_stand,
            'agmarknet_node' => (int)$linkage->agmarknet_node,
            // 'linkage' => $linkage,
            'other_haat_bazaar' => $other_haat_bazaar,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,

            /* to view details */
            'rpm_ownerships' => isset($this->getRpmOwnership)? strip_tags($this->getRpmOwnership->title) : null,
            'regulation' => isset($this->getMarketRegulation)? strip_tags($this->getMarketRegulation->title) : null,
            'regutaionType' => isset($this->getReguationType)? strip_tags($this->getReguationType->title) : null,
            'periodicities' => isset($this->getPeriodicities)? strip_tags($this->getPeriodicities->title) : null,


        ];
    }
}