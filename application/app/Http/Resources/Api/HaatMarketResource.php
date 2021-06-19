<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Resources\Json\JsonResource;


class HaatMarketResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $part_one = $this->getPartOne;   
        $state = $this->getState($part_one['state']); 
        $district = $this->getDistrict($part_one['district_id']);
        $block = $this->getBlock($part_one['block_id']);        
        $village = $this->getVillage($part_one['village_id']);    
         $surveyor_data=$this->getSurveyor;      

        return [
            'id' => $this->id,
            'part_one_id' => $this->part_one,
            'part_two_id' => $this->part_two,
            'part_three_id' => $this->part_three,
            'part_four_id' => $this->part_four,
            'rpm_name' => strip_tags($part_one['rpm_name']),
            'rpm_location' => strip_tags($part_one['rpm_location']),
            'address' => strip_tags($part_one['address']),
            'state' => $part_one['state'],
            'state_name' => strip_tags($state[0]['title']),
            'district' => $part_one['district_id'],
            'district_name' => strip_tags($district[0]['title']),
            'block' => $part_one['block_id'],
            'block_name' => strip_tags($block[0]['title']),
            'village' => $part_one['village_id'],
            'village_name' => strip_tags($village[0]['title']),
            'status' => $this->status,
            'is_completed'=>$this->part_four?'1':'0',
            'surveyor'=> $surveyor_data['name']?? null,
            'linkageHaatBazaar'=>$this->getHaatBazaarLinkage->count,
            //'linkageWarehouse'=>$this->getWarehouseLinkage->count
        ];
    }
}
