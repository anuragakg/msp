<?php

namespace App\Exports;

use App\Models\HaatBazaarFormMapping;
use App\Models\User;
use Maatwebsite\Excel\Concerns\FromArray;

class HaatExportMis implements FromArray
{
    public function array(): array
    { 
        
        $cols = [];
 
        $ids=array();
        foreach ($_POST['myCheckboxes'] as $key => $value) {
            $ids[]= $value;
        }
       $haatData=HaatBazaarFormMapping::whereHas('getPartOne')->whereHas('getMfpCommodity')->with(['getPartOne','getProcurementAgents','getMfpCommodity'])->whereIn('haat_bazaar_form_mapping.part_one',$ids)->get();

        $heading = [
			'Haat Market Name',
			'Haat Market Location',
			'State Name',
			'District Name',
			'Commodity',
			'Procurment Agent',
			'Status'
		];

        array_push($cols, $heading);

        foreach ($haatData as $val) { 
        $commodity = $val->getMfpCommodity()->with('getCommodity')->first();
        $po = $val->getProcurementAgents;
        $commodity_data = $val->getMfpCommodity()->with('getCommodity')->get();
         $part_one = $val->getPartOne;   
        $state = $val->getState($part_one['state']); 
        $district = $val->getDistrict($part_one['district_id']);
        $status = $val->status;
            if($status == 1)
            {
                $status = "Approved";
            }else {
                $status = "Pending";
            }
       // print_r($val->status); die();       
        	$col = [
				strip_tags($part_one['rpm_name']),
				strip_tags($part_one['rpm_location']), 
				strip_tags($state[0]['title']), 
				strip_tags($district[0]['title']), 
				strip_tags($commodity['getCommodity']['title']), 
				$po[0]->name,
				$status
			];

        	array_push($cols, $col);
        }

        return $cols;

    }
}