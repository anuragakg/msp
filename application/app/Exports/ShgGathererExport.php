<?php

namespace App\Exports;

use App\Models\UserDetail;
use App\Models\Shg\ShgGatherers;
use App\Models\Shg\ShgMfpYearlyGathering;
use App\Models\Shg\ShgHouseholdMember;
use App\Models\Masters\Commodity;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class ShgGathererExport implements FromArray, WithMultipleSheets
{
    protected $sheets;
	public function __construct($shg_gatherers)
    { 
        $this->shg_gatherers = $shg_gatherers;
    }

    public function array(): array
    {
        return $this->sheets;
    }

    public function sheets(): array
    {
        $sheets = [
            new ShgGathererFormExport($this->shg_gatherers),
            new ShgMFPGatheringExport($this->shg_gatherers), 
            
        ];

        return $sheets;
    }
}