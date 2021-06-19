<?php

namespace App\Imports\Warehouse;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use Maatwebsite\Excel\Concerns\WithConditionalSheets;
use Maatwebsite\Excel\Concerns\Importable;

class WarehouseImport  implements ToModel, WithHeadingRow, WithMultipleSheets 
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
            0 => new PartOneImport(),
            1 => new PartTwoImport(),
            2 => new StaffDetails(),
            3 => new Linkages(),
            4 => new HaatMarket(),
            5 => new Depositors(),
            6 => new Sops(),
            7 => new Bank(),
            8 => new Capture(),
            9 => new Mfp(),
            10 => new Chamber(),
            
        ];
    }
}