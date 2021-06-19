<?php

namespace App\Exports;

use App\Models\User;
use App\Models\Warehouse\WarehouseFormMapping;
use Maatwebsite\Excel\Concerns\FromArray;

class WarehouseExportMis implements FromArray
{
    public function array(): array
    {
        
        $cols = [];
 
        $ids=array();
        foreach ($_POST['myCheckboxes'] as $key => $value) {
            $ids[]= $value;
        }

       $haatData=WarehouseFormMapping::whereHas('getPartOne')->whereHas('getWarehouse_mfp_commodities_Details')->with(['getPartOne','getWarehouse_mfp_commodities_Details'])->whereIn('warehouse_form_mapping.part_one',$ids)->get();

        $heading = [
			'Warehouse Name',
			'Type',
      'Address',
      'Mobile Number',
			'State Name',
			'District Name',
			'Status'
		];

        array_push($cols, $heading);

        foreach ($haatData as $val) { 
        $part_one = $val->getPartOne;

        $state = $part_one->getState;
        $district = $part_one->getDistrict;
        $block = $part_one->getBlock;
        $village = $part_one->getVillage; 
        $status = $val->status;
            if($status == 1)
            {
                $status = "Approved";
            }else {
                $status = "Pending";
            } 
        	$col = [
				strip_tags($part_one->name),
				$part_one->type, 
				strip_tags($part_one->address), 
				strip_tags($part_one->mobile_no), 
				($state->exists) ? strip_tags($state->title) : null, 
				($district->exists) ? strip_tags($district->title) : null,
				$status
			];

        	array_push($cols, $col);
        }

        return $cols;

    }
}