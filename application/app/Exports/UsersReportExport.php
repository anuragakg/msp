<?php
namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class UsersReportExport implements FromArray, WithMultipleSheets
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
            new UsersTypeExport('Users'),
            new SioSndExport('Users'),
            new UsersCreatedExport('UsersCreated'),
            new UsersActivityExport('Users Activity'),
        ];

        return $sheets;
    }
}