<?php

namespace App\Http\Resources\Api\Warehouse;

use Illuminate\Http\Resources\Json\JsonResource;
use PhpParser\Builder\Class_;

class WarehouseViewPartTwoResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {

        $staff_data = $this->getStaff;
        $depositor_data = $this->getDepositor;
        $linkage_data = $this->getLinkageDetails;
        $other_haat_bazaar_data = $this->other_haat_bazaar_data;
        return [
            'id' => $this->id,
            'form_id' => $this->form_id,
            'weighbridge' => $this->weighbridge,
            'weighbridge_number' => strip_tags($this->weighbridge_number),
            'electronic_weighing_scale' => $this->electronic_weighing_scale,
            'electronic_weighing_number' => strip_tags($this->electronic_weighing_number),
            'manual_weighing_scale' => $this->manual_weighing_scale,
            'manual_weighing_number' => strip_tags($this->manual_weighing_number),
            'storage_rack' => $this->storage_rack,
            'storage_rack_number' => strip_tags($this->storage_rack_number),
            'staff_data' => $staff_data,
           // 'depositor_data' => $depositor_data,
           // 'linkage_data' => $linkage_data,
			'farmers'=>$depositor_data['farmers'],
			'government'=>$depositor_data['government'],
			'societies'=>$depositor_data['societies'],
			'private'=>$depositor_data['private'],
			'traders'=>$depositor_data['traders'],
			'nearest_railwaystation'=> strip_tags($linkage_data['nearest_railwaystation']),
			'railwaystation_distance'=>$linkage_data['railwaystation_distance'],
			'nearest_highway'=> strip_tags($linkage_data['nearest_highway']),
			'highway_distance'=>$linkage_data['highway_distance'],
			'nearest_apmc_market'=> strip_tags($linkage_data['nearest_apmc_market']),
			'nearest_apmc_market_distance'=>$linkage_data['nearest_apmc_market_distance'],
            'nearest_haat_bazaar'=>$linkage_data['nearest_haat_bazaar'],
            'nearest_haat_bazaar_distance'=>$linkage_data['nearest_haat_bazaar_distance'],
			'premises'=>$linkage_data['premises'],
            'haatmarket_data' => $other_haat_bazaar_data,

          /* to View details  */
            'staff_count' => $staff_data->count(),
            'houseHold' => StaffDataResourse::collection($staff_data),
        ];
    }
}

class StaffDataResourse extends JsonResource
{
    public function toArray($request)
    {
        return [
            'name' => strip_tags($this->name),
            'mobile' => strip_tags($this->mobile),
            'email' => strip_tags($this->email),
            'duties' => strip_tags($this->duties),
            'qualification' => isset($this->getQualification->title)? strip_tags($this->getQualification->title) :'',
            'designation' =>  isset($this->getDesignation->title)? strip_tags($this->getDesignation->title) :'',
        ];
    }
}