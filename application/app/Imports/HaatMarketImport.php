<?php

namespace App\Imports;

// use HaatMarketOneImport;
// use HaatMarketTwoImport;

use App\Models\HaatMarketOne;
use App\Models\HaatMarketLinkages;
use App\Models\OtherHaatBazaar;
use App\Models\HaatBazaarFormMapping;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use Maatwebsite\Excel\Concerns\WithConditionalSheets;
use Maatwebsite\Excel\Concerns\Importable;

class HaatMarketImport  implements ToModel, WithHeadingRow, WithMultipleSheets 
{
    use Importable;

    /**
     * @param array $row
     *
     * @return User|null
     */
    public function model(array $row)
    {
     
    }
    public function sheets(): array
    {
        return [
            0 => new HaatMarketOneImport(),
            1 => new HaatMarketTwoImport(),
            2 => new HaatMarketThreeImport(),
            3 => new HaatMarketFourImport(),
            4 => new HaatMarketOtherHaatBazaarImport(),
            //5 => new HaatMarketAnnualExpenditureImport(),
            5 => new HaatMarketMfpImport(),
            6 => new HaatMarketAgentImport(),
            7 => new HaatMarketAgentCommodityImport()
        ];
    }
}