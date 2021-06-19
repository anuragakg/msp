<?php

namespace App\Http\Resources\Api\MisReport;

use Illuminate\Http\Resources\Json\JsonResource;

class WarehouseCommodityResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {

        $commodity = $this->getWarehouse_mfp_commodities_Details()->with('getCommodity')->first();
        $commodity_data = $this->getWarehouse_mfp_commodities_Details()->with('getCommodity')->get();
        $part_one  = $this->getPartOne;
        $state     = $part_one->getState;
        $district  = $part_one->getDistrict;
        $block     = $part_one->getBlock;
        $village   = $part_one->getVillage;

            if($part_one['type']==1)
                {
                    $Type='Central Warehousing Corporation';
                }elseif($part_one['type']==2)
                {
                    $Type='State Warehousing Corporation';
                }elseif ($part_one['type']==3) {
                    $Type='Private Warehouses';
                }else
                {
                    $Type='Society Managed Warehouses';
                }
        return [
            'id'        =>$part_one->id,
            'status'                    => $this->status,
            'name'                      => strip_tags($part_one->name),
            'address'                   => strip_tags($part_one->address),
            'state_name'                => ($state->exists) ? strip_tags($state->title) : null,
            'district_name'             => ($district->exists) ? strip_tags($district->title) : null,
            'block_name'                => ($block->exists) ? strip_tags($block->title) : null,
            'village_name'              => ($village->exists) ? strip_tags($village->title) : null,

            "type"                      => $Type,
            //"name_private"              => $part_one['name_private'],
            //"address_private"           => $part_one['address_private'],
            "mobile_no"                 => strip_tags($part_one['mobile_no']),
            "landline_no"               => strip_tags($part_one['landline_no']),
            "gram_panchayat"            => strip_tags($part_one['gram_panchayat']),
            "pin_code"                  => strip_tags($part_one['pin_code']),
            "registration_no"           => strip_tags($part_one['registration_no']),
            "registration_date"         => $part_one['registration_date'],
            "length"                    => $part_one['length'],
            "width"                     => $part_one['width'],
            "warehouse_area"            => $part_one['warehouse_area'],
            "max_stack_height"          => $part_one['max_stack_height'],
            "capacity"                  => $part_one['capacity'],
            "capacity_utilization"      => $part_one['capacity_utilization'],
            "is_cold_storage_available" => $part_one['is_cold_storage_available'],
            //"is_ca_storage_available"   => $part_one['is_ca_storage_available'],
            "cold_storage_capacity"     => $part_one['cold_storage_capacity'],
            "closed_days"               => $part_one['closed_days'],
            "open_time"                 => $part_one['open_time'],
            "close_time"                => $part_one['close_time'],
            "is_generator"              => $part_one['is_generator'],
            "generator_capacity"        => $part_one['generator_capacity'],
            "chamber_wise_capacity"     => $part_one['chamber_wise_capacity'],
            "indemnification_available" => $part_one['indemnification_available'],
            "is_stuffing_facility"      => $part_one['is_stuffing_facility'],
            "is_open_yard_facility"     => $part_one['is_open_yard_facility'],
            "drying_facility"     => $part_one['drying_facility'],
            //"is_quality_agent"          => $part_one['is_quality_agent'],
            "is_commodities_stored"     => $part_one['is_commodities_stored'],
            "is_weightment"             => $part_one['is_weightment'],
            "created_by"                => $part_one['created_by'],
            "updated_by"                => $part_one['updated_by'],
            'commodity_data' => $commodity_data,
            'commodity'       => isset($commodity['getCommodity']) ? [
                    "title"         => strip_tags($commodity['getCommodity']['title']),
                    "unit"          => strip_tags($commodity['getCommodity']['unit']),
                    "state"         => strip_tags($commodity['getCommodity']['state']),
                    "session"       => $commodity['getCommodity']['session'],
                    "common_name"   => strip_tags($commodity['getCommodity']['common_name']),
                    "lab_name"      => strip_tags($commodity['getCommodity']['lab_name']),
                    "quality"       => $commodity['getCommodity']['quality'],
                    "photo"         => $commodity['getCommodity']['photo'],
                    "msp"           => $commodity['getCommodity']['msp'],
                    "status"        => $commodity['getCommodity']['status'],
                    "created_by"    => $commodity['getCommodity']['created_by'],
                    "updated_by"    => $commodity['getCommodity']['updated_by'],
            ] : null ,
        ];
    }
}
