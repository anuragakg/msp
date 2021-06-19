<?php

namespace App\Exports;

use App\Models\Masters\BuiltUpArea;

use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\FromArray;

class BuiltUpAreaExport implements FromArray, WithTitle
{
    public function array(): array
    {
        
        $cols = [];

        $builtUpAreas = BuiltUpArea::where('status', 1)->get();

        $heading = [
			'ID',
			'Title'
		];

        array_push($cols, $heading);

        foreach ($builtUpAreas as $builtUpArea) {
        	$col = [
				$builtUpArea->id,
				$builtUpArea->title
			];

        	array_push($cols, $col);
        }

        return $cols;

    }

    public function title(): string
    {
        return 'Built Up Area';
    }
}