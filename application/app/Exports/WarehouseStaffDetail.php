<?php

namespace App\Exports;

use App\Models\Warehouse\WarehouseStaffDetails;
use App\Models\Masters\Designation;
use App\Models\Masters\Education;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\FromArray;

class WarehouseStaffDetail implements FromArray, WithTitle
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

        $rpms = WarehouseStaffDetails::whereIn('form_id', $warehouseformIds)->orderBy('form_id', 'DESC')->get();
      //  print_r($rpms); die;
        $heading = [
			'Refrence id',
			'Name',
            'Designation',
            'Qualification',
            'Mobile',
            'Phone_type_id',
            'Email',
            'Duties'
		];

        array_push($cols, $heading);

        foreach ($rpms as $rpm) {
            $designation=Designation::where('id', $rpm->designation)->select('title')->get();
           $qualification=Education::where('id', $rpm->qualification)->select('title')->get();
        	$col = [
				$warehouseIds[$rpm->form_id],
				$rpm->name,
                $designation[0]['title']?? null,
                $qualification[0]['title']?? null,
                $rpm->mobile,
                $rpm->phone_type_id,
                $rpm->email,
                $rpm->duties,
			];

        	array_push($cols, $col);
        }

        return $cols;

    }

    public function title(): string
    {
        return 'WarehouseStaffDetails';
    }
}