<?php

namespace App\Exports;

use App\Models\User;
use App\Models\Warehouse\WarehouseFormMapping;
use Maatwebsite\Excel\Concerns\FromArray;

class WarehouseCommodityExportMis implements FromArray
{
    public function array(): array
    {
        
        $cols = [];
 
        $ids=array();
        foreach ($_POST['myCheckboxes'] as $key => $value) {
            $ids[]= $value;
        }

     $haatData=  WarehouseFormMapping::whereHas('getPartOne')->whereHas('getWarehouse_mfp_commodities_Details')->with(['getPartOne','getWarehouse_mfp_commodities_Details'])->whereIn('warehouse_form_mapping.part_one',$ids)->get();

        $heading = [
			'Warehouse Name',
			'Type',
      'Address', 
      'Mobile No.',
			'State Name',
			'District Name',
			'Common Name',
      'Scientific/Botanical Name',
      'Title',
      'Unit'
		];

        array_push($cols, $heading);

        foreach ($haatData as $val) {  

            $commodity = $val->getWarehouse_mfp_commodities_Details()->with('getCommodity')->first();
            $commodity_data = $val->getWarehouse_mfp_commodities_Details()->with('getCommodity')->get();
            $part_one  = $val->getPartOne;
            $state     = $part_one->getState;
            $district  = $part_one->getDistrict;
            $block     = $part_one->getBlock;
            $village   = $part_one->getVillage;
             //print_r($commodity['getCommodity']['common_name']); die();
        	$col = [
				strip_tags($part_one->name),
				$part_one['type'], 
				strip_tags($part_one->address),
        strip_tags($part_one['mobile_no']),
        strip_tags($state->title), 
				strip_tags($district->title),  
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