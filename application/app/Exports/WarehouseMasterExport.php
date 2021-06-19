<?php
namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class WarehouseMasterExport implements FromArray, WithMultipleSheets
{
    protected $sheets;

    public function __construct($sheets = null)
    {
        $this->sheets = $sheets;
    }

    public function array(): array
    {
        return $this->sheets;
    }

    public function sheets(): array
    {
        $sheets = [
            new WarehousePremisesExport('WarehousePremises'),
            new DesignationExport('Designation'),
            new BankExport('Bank'),
            new WarehouseAgeExport('WarehouseAge'),
            new WarehouseConditionExport('WarehouseCondition'),
            new CommodityExport('Commodity'),
            
        ];

        return $sheets;
    }
}