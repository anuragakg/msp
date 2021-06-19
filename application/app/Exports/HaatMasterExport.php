<?php
namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class HaatMasterExport implements FromArray, WithMultipleSheets
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
            new RPMOwnershipExport('RPMOwnership'),
            new MarketRegulationExport('MarketRegulation'),
            new MarketTypeExport('MarketType'),
            new BoundaryWallExport('BoundaryWall'),
            new BuiltUpAreaExport('BuiltUpArea'),
            new AccessRoadExport('AccessRoad'),
            new TransportationExport('Transportation'),
            new CommodityExport('Commodity'),
            new PeriodicityExport('Periodicity')
        ];

        return $sheets;
    }
}