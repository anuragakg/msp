<?php

namespace App\Exports;

use App\Models\Masters\OfficeBearerRole;

use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\FromArray;

class OfficeBearerRoleExport implements FromArray, WithTitle
{
    public function array(): array
    {
        
        $cols = [];

        $officeBearerRoles = OfficeBearerRole::where('status', 1)->get();

        $heading = [
			'ID',
			'Title'
		];

        array_push($cols, $heading);

        foreach ($officeBearerRoles as $officeBearerRole) {
        	$col = [
				$officeBearerRole->id,
				$officeBearerRole->title
			];

        	array_push($cols, $col);
        }

        return $cols;

    }

    public function title(): string
    {
        return 'OfficeBearerRole';
    }
}