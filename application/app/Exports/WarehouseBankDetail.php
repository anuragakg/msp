<?php

namespace App\Exports;

use App\Models\Warehouse\WarehouseBankDetails;
use App\Models\Masters\Bank;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\FromArray;

class WarehouseBankDetail implements FromArray, WithTitle
{   
    public function __construct($warehouses) 
    {
     
        $this->warehouses = $warehouses;
    }


    public function array(): array
    {
        
        $cols = [];

        $warehouseIds=array();
        $warehouseformIds=array();
        foreach ($this->warehouses as $warehouse) {
            
                $parttwo_id=$warehouse['part_three'];
                $warehouseIds[$parttwo_id] =$warehouse['id'];
                $warehouseformIds[]= $warehouse->getPartThree['id'];
        }
       //// print_r($warehouseIds); die();
        $rpms = WarehouseBankDetails::whereIn('form_id', $warehouseformIds)->orderBy('form_id', 'DESC')->get();
      //  print_r($rpms); die;
        $heading = [
			'Refrence id',
			'Bank Name',
            'Bank Other'
		];

        array_push($cols, $heading);

        foreach ($rpms as $rpm) {
            $bank=Bank::where('id', $rpm->bank_id)->select('title')->get();
        	$col = [
				$warehouseIds[$rpm->form_id],
				$bank[0]['title']?? null,
                $rpm->bank_other,
			];

        	array_push($cols, $col);
        }

        return $cols;

    }

    public function title(): string
    {
        return 'WarehouseBankDetails';
    }
}