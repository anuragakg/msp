<?php
namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class ShgMasterExport implements FromArray, WithMultipleSheets
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
            new YearExport('Year'),
            new FinancialYearExport('FinancialYear'),
            new IDTypeExport('ID Proof Type'),
            new CommodityExport('Commodity'),
            new OccupationExport('Occupation'),
            new EducationExport('Education'),
            new OfficeBearerRoleExport('OfficeBearerRole'),
            new CategoryExport('Category'),
            new ScheduledTribesExport('ScheduledTribes'),
            new VehicleExport('Vehicle'),
            new PhoneTypeExport('PhoneType'),
            new MemberRelationExport('MemberRelation')
        ];

        return $sheets;
    }
}