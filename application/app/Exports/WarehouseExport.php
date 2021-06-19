<?php
namespace App\Exports;

use App\Models\Warehouse\WarehouseFormMapping;
use App\Models\WareHouseOne;
use App\Models\WareHouseTwo;
use App\Models\WareHouseThree;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class WarehouseExport implements FromArray, WithMultipleSheets
{
    protected $sheets;

     public function __construct($warehouses) 
    {
        //print_r($warehouses); die;
        $this->warehouses = $warehouses;
    }

       


    public function array(): array
    {
        return $this->sheets;
    }

    public function sheets(): array
    {
        $sheets = [
            new WarehouseFormExport($this->warehouses),
             new WarehouseOtherHaat($this->warehouses), 
             new WarehouseBankDetail($this->warehouses),
             new WarehouseStaffDetail($this->warehouses),
             new WarehouseMfpCommodities($this->warehouses),  
            
        ];

        return $sheets;
    }
}