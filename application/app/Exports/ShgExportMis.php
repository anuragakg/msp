<?php

namespace App\Exports;

use App\Models\Shg\ShgGatherers;
use App\Models\Shg\ShgMfpYearlyGathering;
use App\Models\User;
use Maatwebsite\Excel\Concerns\FromArray;

class ShgExportMis implements FromArray
{
    public function array(): array
    {
        
        $cols = [];
 
        $ids=array();
        foreach ($_POST['myCheckboxes'] as $key => $value) {
            $ids[]= $value;
        }

       $shgData=ShgGatherers::leftJoin('shg_mfp_yearly_gatherings', function($join) {
                  $join->on('shg_gatherers.id', '=', 'shg_mfp_yearly_gatherings.shg_id');
                })->whereIn('shg_gatherers.id',$ids)->select('shg_gatherers.*')->get();
       //Vdvk::whereHas('getProposedLocation')->whereIn('vdvk.id',$ids)->get();
        $heading = [
			'Name Of Tribal', 
            'Gender',
            'DOB',
            'Mobile',
			'State Name',
			'District Name',
			'Status'
		];

        array_push($cols, $heading);

        foreach ($shgData as $val) {  
            $state = $val->getState;
            $district = $val->getDistrict;
            $bankDetails = $val->getBankDetails;
            $status = $val->status;
            if($status == 1)
            {
                $status = "Approved";
            }else {
                $status = "Pending";
            }
        	$col = [
				strip_tags($val->name_of_tribal),
                $val->gender,
                date('d/m/Y',strtotime($val->dob)),
                $bankDetails->mobile_no ?? null,
				strip_tags($state->title), 
				strip_tags($district->title),
                $status
			];

        	array_push($cols, $col);
        }

        return $cols;

    }
}