<?php

namespace App\Exports;

use App\Models\Masters\WarehousePremises;

use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\FromArray;

class WarehousePremisesExport implements FromArray, WithTitle
{
    public function array(): array
    {
        
        $cols = [];

        $rpms = WarehousePremises::where('status', 1)->get();

        $heading = [
			'ID',
			'Title'
		];

        array_push($cols, $heading);

        foreach ($rpms as $rpm) {
        	$col = [
				$rpm->id,
				$rpm->title
			];

        	array_push($cols, $col);
        }

        return $cols;

    }

    public function title(): string
    {
        return 'Warehouse Premises';
    }
}