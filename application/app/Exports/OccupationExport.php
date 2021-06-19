<?php

namespace App\Exports;

use App\Models\Masters\Occupation;

use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\FromArray;

class OccupationExport implements FromArray, WithTitle
{
    public function array(): array
    {
        
        $cols = [];

        $occupations = Occupation::where('status', 1)->get();

        $heading = [
			'ID',
			'Title'
		];

        array_push($cols, $heading);

        foreach ($occupations as $occupation) {
        	$col = [
				$occupation->id,
				$occupation->title
			];

        	array_push($cols, $col);
        }

        return $cols;

    }

    public function title(): string
    {
        return 'Occupations';
    }
}