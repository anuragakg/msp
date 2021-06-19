<?php

namespace App\Exports;

use App\Models\Masters\PhoneType;

use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\FromArray;

class PhoneTypeExport implements FromArray, WithTitle
{
    public function array(): array
    {
        
        $cols = [];

        $phoneTypes = PhoneType::where('status', 1)->get();

        $heading = [
			'ID',
			'Title'
		];

        array_push($cols, $heading);

        foreach ($phoneTypes as $phoneType) {
        	$col = [
				$phoneType->id,
				$phoneType->title
			];

        	array_push($cols, $col);
        }

        return $cols;

    }

    public function title(): string
    {
        return 'Phone Type';
    }
}