<?php
namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class AreaMasterExport implements FromArray, WithMultipleSheets
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
            new StateExport('State'),
            new DistrictExport('District'),
            new BlockExport('Block'),
            new VillageExport('Village')
        ];

        return $sheets;
    }
}