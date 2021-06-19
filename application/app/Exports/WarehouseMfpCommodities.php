<?php
namespace App\Exports;

use App\Models\HaatWarehouseMfpCommodities;
use App\Models\Masters\Commodity;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\FromArray;

class WarehouseMfpCommodities implements FromArray, WithTitle
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
        $rpms = HaatWarehouseMfpCommodities::whereIn('form_id', $warehouseformIds)->orderBy('form_id', 'DESC')->get();
        $heading = [
            'Refrence ID',
            'Commodity',
            'Annual Quantity'
        ];

        array_push($cols, $heading);

        foreach ($rpms as $rpm) {
           $commodity=Commodity::where('id', $rpm->commodity)->select('title')->get();
            $col = [
                $warehouseIds[$rpm->form_id],          
                $commodity[0]['title']?? null,
                $rpm->annual_quantity,
            ];

            array_push($cols, $col);
        }

        return $cols;

    }

    public function title(): string
    {
        return 'WarehouseMfpCommodities';
    }
}