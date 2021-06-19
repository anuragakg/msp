<?php

namespace App\Http\Resources\Api\MisReport;

use Illuminate\Http\Resources\Json\JsonResource;

class ShgCommodityResource extends JsonResource
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
        $bankDetails = $this->getBankDetails;
        $shgGathers = $this->getMfpYearlyGatherings()->with('getCommodity')->first();
        $commodity_data = $this->getMfpYearlyGatherings()->with('getCommodity')->get();
       // print_r($shgGathers); die();
        return [
            'id' => $this->id,
            'name_of_tribal' => strip_tags($this->name_of_tribal),
            'gender'         => $this->gender,
            'dob'            => date('d/m/Y',strtotime($this->dob)),
            'state'          => ($state->exists) ? strip_tags($state->title) : null,
            'district'       => ($district->exists) ? strip_tags($district->title) : null,
            'block'          => ($block->exists) ? strip_tags($block->title) : null,
            'village'        => ($village->exists) ? strip_tags($village->title) : null,
            'mobile'         => $bankDetails->mobile_no ?? null,
            'status'         => $this->status,

            // 'mfpYearGathers' => isset($shgGathers) ? [
            //         "shg_id"        => $shgGathers['shg_id'],
            //         "commodity"     => $shgGathers['commodity'],
            //         "quantity"      => $shgGathers['quantity'],
            //         "mfp_use"       => $shgGathers['mfp_use'],
            //         "created_by"    => $shgGathers['created_by'],
            //         "updated_by"    => $shgGathers['updated_by'],
                                            
            // ] : null,
            'commodity_data' => $commodity_data,
            'commodity'       => isset($shgGathers['getCommodity']) ? [
                    "title"         => strip_tags($shgGathers['getCommodity']['title']),
                    "unit"          => $shgGathers['getCommodity']['unit']?? null,
                    "state"         => $shgGathers['getCommodity']['state'],
                    "session"       => $shgGathers['getCommodity']['session'],
                    "common_name"   => strip_tags($shgGathers['getCommodity']['common_name']?? null),
                    "lab_name"      => strip_tags($shgGathers['getCommodity']['lab_name']?? null),
                    "quality"       => strip_tags($shgGathers['getCommodity']['quality']?? null),
                    "photo"         => $shgGathers['getCommodity']['photo'],
                    "msp"           => $shgGathers['getCommodity']['msp'],
                    "status"        => $shgGathers['getCommodity']['status'],
                    "created_by"    => $shgGathers['getCommodity']['created_by'],
                    "updated_by"    => $shgGathers['getCommodity']['updated_by'],
            ] : null ,
        ];


    }
}


