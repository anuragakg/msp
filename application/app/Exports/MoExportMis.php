<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromArray;

class MoExportMis implements FromArray
{
    public function array(): array
    {
        
        $cols = [];
 
        $ids=array();
        foreach ($_POST['myCheckboxes'] as $key => $value) {
            $ids[]= $value;
        }

       $shgData=User::whereHas('getUserDetails')->with('getMentoringOrganisationDetails')->whereIn('id',$ids)->get();
        $heading = [
			'Mentoring Organisation Name', 
            'Organisation Type',
            'Mobile No.',
			'State Name',
			'District Name',
            'Block/Tehsil Name',
            'No. Of VDVKs',
			'Status'
		];

        array_push($cols, $heading);

        foreach ($shgData as $val) { $userDetails = $val->getUserDetails;
        $additionalDetails = $val->getMentoringOrganisationDetails;
        $no_of_vdvks = $val->getNoOfVdvks;
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

        if ($val->status==1) {
            $status='Active';
        }else
        {
            $status='Inactive';
        }

        if ($additionalDetails) {
            $getOrgType = $additionalDetails->getOrgType;
            $orgType =  isset($getOrgType) ? strip_tags($getOrgType->title) : null;
        }

        	$col = [
				$val->name. ''.$val->middle_name. ''.$val->last_name ,
                $orgType,
                $val->mobile_no,
                $state,
                $district,
                $block,
                $vdvk_count,
                $status
			];

        	array_push($cols, $col);
        }

        return $cols;

    }
}