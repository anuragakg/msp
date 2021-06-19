<?php

namespace App\Exports;

use App\Models\Shg\ShgGatherers;
use App\Models\Shg\ShgMfpYearlyGathering;
use App\Models\User;
use Maatwebsite\Excel\Concerns\FromArray;

class ShgCommodityExportMis implements FromArray
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
        $block = $val->getBlock;
        $village = $val->getVillage;
        $bankDetails = $val->getBankDetails;
        $shgGathers = $val->getMfpYearlyGatherings()->with('getCommodity')->first();
        $commodity_data = $val->getMfpYearlyGatherings()->with('getCommodity')->get();
        	$col = [
				strip_tags($val->name_of_tribal),
                $val->gender,
                date('d/m/Y',strtotime($val->dob)),
                $bankDetails->mobile_no ?? null,
				strip_tags($state->title), 
				strip_tags($district->title),
                $shgGathers['getCommodity']['common_name'],
                $shgGathers['getCommodity']['lab_name'],
                $shgGathers['getCommodity']['title'],
                $shgGathers['getCommodity']['unit']
			];
        	array_push($cols, $col);
        }
        return $cols;
    }
}