<?php

namespace App\Imports;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use Maatwebsite\Excel\Concerns\WithConditionalSheets;
use Maatwebsite\Excel\Concerns\Importable;

class ShgGathererImport  implements ToModel, WithHeadingRow, WithMultipleSheets 
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
            0 => new ShgPartOneImport(),
            1 => new ShgMembersImport(),
            2 => new YearlyUsageImport(),
        ];
    }
}