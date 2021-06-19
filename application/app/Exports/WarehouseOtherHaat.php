<?php

namespace App\Exports;

use App\Models\OtherHaatBazaar;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\FromArray;

class WarehouseOtherHaat implements FromArray, WithTitle
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
            
                $parttwo_id=$warehouse['part_two'];
                $warehouseIds[$parttwo_id] =$warehouse['id'];
                $warehouseformIds[]= $warehouse->getPartTwo['id'];
        }
       //// print_r($warehouseIds); die();
        $rpms = OtherHaatBazaar::whereIn('form_id',$warehouseformIds)->orderBy('form_id', 'DESC')->get();
      
        $heading = [
            'Refrence Id',
            'haat_bazaar_name',
            'haat_bazaar_distance',
            'premises_warehouse_id',
		];

        array_push($cols, $heading);

        foreach ($rpms as $rpm) {
        	$col = [
                $warehouseIds[$rpm->form_id],
                $rpm->haat_bazaar_name,
                $rpm->haat_bazaar_distance,
                $rpm->premises_warehouse_id,
			];

        	array_push($cols, $col);
        }

        return $cols;

    }

    public function title(): string
    {
        return 'WarehouseOtherHaat';
    }
}