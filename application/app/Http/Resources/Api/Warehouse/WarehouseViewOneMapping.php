<?php

namespace App\Http\Resources\Api\Warehouse;

use Illuminate\Http\Resources\Json\JsonResource;

class WarehouseViewOneMapping extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {   
        $chamber_data = $this->getChamberDetails;
        $part_two_data=array();
        $getPartOne=$this->getPartOne;
        $getPartOne['closed_days']=explode(',',$getPartOne['closed_days']);
        $getPartOne['chamber_data']=$chamber_data;
        $getPartOne['registration_date']=date('d/m/Y',strtotime($getPartOne['registration_date']));
        $getPartTwo=$this->getPartTwo;
        $getPartThree=$this->getPartThree;
        
        $staff_data = $this->getStaff;
        $depositor_data = $this->getDepositor;
        $linkage_data = $this->getLinkageDetails;
        
        $other_haat_bazaar_data = $this->other_haat_bazaar_data;
        if(!empty($getPartTwo))
        {
			$getPartTwo['nearest_railwaystation']=$linkage_data['nearest_railwaystation'];
			$getPartTwo['railwaystation_distance']=$linkage_data['railwaystation_distance'];
			$getPartTwo['nearest_highway']=$linkage_data['nearest_highway'];
			$getPartTwo['highway_distance']=$linkage_data['highway_distance'];
			$getPartTwo['nearest_apmc_market']=$linkage_data['nearest_apmc_market'];
			$getPartTwo['nearest_apmc_market_distance']=$linkage_data['nearest_apmc_market_distance'];
            $getPartTwo['nearest_haat_bazaar']=$linkage_data['nearest_haat_bazaar'];
            $getPartTwo['nearest_haat_bazaar_distance']=$linkage_data['nearest_haat_bazaar_distance'];
			$getPartTwo['premises']=$linkage_data['premises'];
			$getPartTwo['farmers']=$depositor_data['farmers'];
			$getPartTwo['government']=$depositor_data['government'];
			$getPartTwo['societies']=$depositor_data['societies'];
			$getPartTwo['private']=$depositor_data['private'];
			$getPartTwo['traders']=$depositor_data['traders'];
			
			
            $getPartTwo['staff_data']=$staff_data;
            $getPartTwo['depositor_data']=$depositor_data;
            $getPartTwo['linkage_data']=$linkage_data;
            $getPartTwo['haatmarket_data']=$other_haat_bazaar_data;
        }
        $bank_data = $this->getBankDetails;
		$commodities_data = $this->getWarehouse_mfp_commodities_Details;
        if(!empty($getPartThree)){
            $getPartThree['bank_data']=$bank_data;
            $getPartThree['commodity_data']=$commodities_data;
        }
        
		
        
        return [
            'id' => $this->id,
            'part_one' => $getPartOne,
            'part_two' => $getPartTwo,
            
            'part_three' => $getPartThree,
            'is_completed' => $this->part_three? '1' : '0',
            'updated_by' => $this->updated_by,
            'updated_by' => $this->updated_by,
        ];
    }
}
