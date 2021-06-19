<?php
namespace App\Exports;

use App\Models\HaatBazaarFormMapping;
use App\Models\HaatMarketOne;
use App\Models\HaatMarketTwo;
use App\Models\HaatMarketThree;
use App\Models\HaatMarketFour;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class HaatMarketExport implements FromArray, WithMultipleSheets
{
    protected $sheets;

    public function __construct($haat_markets)
    {
        //$this->sheets = $sheets;
        // print_r($haat_markets); die('testdata');
        $this->haat_markets = $haat_markets;
    }
       


    public function array(): array
    {
        return $this->sheets;
    }

    public function sheets(): array
    {
        $sheets = [
            new HaatFormDataExport($this->haat_markets),
             new ProcurementExport($this->haat_markets),  
             new MfpCommoditiesExport($this->haat_markets),
            
        ];

        return $sheets;
    }
}