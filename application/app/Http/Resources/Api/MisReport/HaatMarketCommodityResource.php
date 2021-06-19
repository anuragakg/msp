<?php

namespace App\Http\Resources\Api\MisReport;

use Illuminate\Http\Resources\Json\JsonResource;


class HaatMarketCommodityResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {   
        
        $commodity = $this->getMfpCommodity()->with('getCommodity')->first();
        $commodity_data = $this->getMfpCommodity()->with('getCommodity')->get();
        $part_one = $this->getPartOne;   
        $state = $this->getState($part_one['state']); 
        $district = $this->getDistrict($part_one['district_id']);
        $block = $this->getBlock($part_one['block_id']);        
        $village = $this->getVillage($part_one['village_id']);
        return [
            'id'    =>$part_one['id'],
            'rpm_name'          => strip_tags($part_one['rpm_name']),
            'rpm_location'      => strip_tags($part_one['rpm_location']),
            "gram_panchayat"    => strip_tags($part_one['gram_panchayat']),
            'address'           => strip_tags($part_one['address']),
            "village_id"        => $part_one['village_id'],
            "pin_code"          => $part_one['pin_code'],
            "rpm_ownership"     => $part_one['rpm_ownership'],
            "operating_rpm"     => $part_one['operating_rpm'],
            "premises_rpm"      => $part_one['premises_rpm'],
            "is_on_rent"        => $part_one['is_on_rent'],
            "rate_per_annum"    => (!empty($part_one['rate_per_annum']) ? $part_one['rate_per_annum'] : ''),
            "market_regulation" => $part_one['market_regulation'],
            "regulation_type"   => $part_one['regulation_type'],
            "periodicity"       => $part_one['periodicity'],
            "working_days"      => $part_one['working_days'],
            "sale_start_time"   => $part_one['sale_start_time'],
            "sale_end_time"     => $part_one['sale_end_time'],
            "staff_size"        => $part_one['staff_size'],
            "status"            => $this->status,
            "created_by"        => $part_one['created_by'],
            "updated_by"        => $part_one['updated_by'],

            'state_name'        => strip_tags($state[0]['title']),
            'district_name'     => strip_tags($district[0]['title']),
            'block_name'        => strip_tags($block[0]['title']),
            'village_name'      => strip_tags($village[0]['title']),
            'commodity_data' => $commodity_data,
            'commodity'       => isset($commodity['getCommodity']) ? [
                    "title"         => strip_tags($commodity['getCommodity']['title']),
                    "unit"          => strip_tags($commodity['getCommodity']['unit']),
                    "state"         => $commodity['getCommodity']['state'],
                    "session"       => $commodity['getCommodity']['session'],
                    "common_name"   => strip_tags($commodity['getCommodity']['common_name']),
                    "lab_name"      => strip_tags($commodity['getCommodity']['lab_name']),
                    "quality"       => strip_tags($commodity['getCommodity']['quality']),
                    "photo"         => $commodity['getCommodity']['photo'],
                    "msp"           => $commodity['getCommodity']['msp'],
                    "status"        => $commodity['getCommodity']['status'],
                    "created_by"    => $commodity['getCommodity']['created_by'],
                    "updated_by"    => $commodity['getCommodity']['updated_by'],
            ] : null ,
            
        ];
    }
}

