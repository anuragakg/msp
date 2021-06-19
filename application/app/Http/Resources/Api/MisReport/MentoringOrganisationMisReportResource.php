<?php

namespace App\Http\Resources\Api\MisReport;

use Illuminate\Http\Resources\Json\JsonResource;
use Carbon\Carbon;

class MentoringOrganisationMisReportResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $userDetails = $this->getUserDetails;
        $additionalDetails = $this->getMentoringOrganisationDetails;
        $no_of_vdvks = $this->getNoOfVdvks;
        $vdvk_count=0;
        if(!empty($no_of_vdvks))
        {
            foreach ($no_of_vdvks as $key => $vdvk) {
                if($vdvk->submission_status==1){
                    ++$vdvk_count;
                }
            }
        }

        $state = null;
        $district = null;
        $block = null;
        $orgType = null;

        if ($userDetails) {

            $getState = $userDetails->getState;
            $getDistrict = $userDetails->getDistrict;
            $getBlock = $userDetails->getBlock;

            $state =  isset($getState->title) ? strip_tags($getState->title) : null;
            $district = isset($getDistrict->title) ? strip_tags($getDistrict->title) : null;
            $block = isset($getBlock->title) ? strip_tags($getBlock->title) : null;
        }

        if ($additionalDetails) {
            $getOrgType = $additionalDetails->getOrgType;
            $orgType =  isset($getOrgType) ? strip_tags($getOrgType->title) : null;
        }

        return [
            'id'    => $this->id,
            'name'        => strip_tags($this->name),
            'user_name'   => strip_tags($this->user_name),
            'middle_name' => isset($this->middle_name) ? strip_tags($this->middle_name) : "",
            'last_name'   => isset($this->last_name) ? strip_tags($this->last_name) : "",
            'mobile'      => isset($this->mobile_no) ? strip_tags($this->mobile_no) : "",
            'state'       => $state,
            'district'    => $district,
            'block'       => $block ? $block : "",
            'org_type'    => $orgType,
            'no_of_vdvks' => $vdvk_count,
            'status'      => $this->status
        ];
    }
}