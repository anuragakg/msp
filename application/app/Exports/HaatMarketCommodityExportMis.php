<?php

namespace App\Exports;

use App\Models\HaatBazaarFormMapping;
use App\Models\HaatMarketProcurementAgents;
use App\Models\HaatAgentsCommodity;
use App\Models\HaatMarketOne;
use App\Models\HaatMarketTwo;
use App\Models\HaatMarketThree;
use App\Models\HaatMarketFour;
use App\Models\Masters\Commodity;
use App\Models\Masters\State;
use App\Models\Masters\District;
use Maatwebsite\Excel\Concerns\FromArray;

class HaatMarketCommodityExportMis implements FromArray
{
    public function array(): array
    {
        
        $cols = [];
 
        $ids=array();
        foreach ($_POST['myCheckboxes'] as $key => $value) {
            $ids[]= $value;
        }

     $haatData=  HaatBazaarFormMapping::whereHas('getPartOne')->whereHas('getMfpCommodity')->with(['getPartOne','getProcurementAgents','getMfpCommodity'])->whereIn('haat_bazaar_form_mapping.part_one',$ids)->get();

        $heading = [
			'Haat Market Name',
			'Haat Market Location',
      'Rate Per Annum.', 
			'State Name',
			'District Name',
			'Common Name',
      'Scientific/Botanical Name',
      'Title',
      'Unit'
		];

        array_push($cols, $heading);

        foreach ($haatData as $val) {  
          $part_one = $val->getPartOne;  
           $state = $val->getState($part_one['state']); 
          $district = $val->getDistrict($part_one['district_id']);
           $commodity = $val->getMfpCommodity()->with('getCommodity')->first();
        	$col = [
				strip_tags($part_one['rpm_name']),
				strip_tags($part_one['rpm_location']), 
				(!empty($part_one['rate_per_annum']) ? $part_one['rate_per_annum'] : ''),
        strip_tags($state[0]['title']), 
				strip_tags($district[0]['title']), 
        strip_tags($commodity['getCommodity']['common_name']),
				strip_tags($commodity['getCommodity']['lab_name']),
        strip_tags($commodity['getCommodity']['title']), 
				strip_tags($commodity['getCommodity']['unit']),
			];

        	array_push($cols, $col);
        }

        return $cols;

    }
}