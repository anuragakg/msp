<?php

namespace App\Exports;

use App\Models\Masters\Village;

use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\FromArray;

class VillageExport implements FromArray, WithTitle
{
    public function array(): array
    {
        
        $cols = [];

        $villages = Village::where('status', 1)->get();

        $heading = [
			'ID',
			'Village',
            //'Code',
            'Pincode',
		];

        array_push($cols, $heading);

        foreach ($villages as $village) {
        	$col = [
				$village->id,
				$village->title,
				//$village->code,
				$village->pincode,
			];

        	array_push($cols, $col);
        }

        return $cols;

    }

    public function title(): string
    {
        return 'Village';
    }
}