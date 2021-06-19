<?php

namespace App\Exports;

use App\Models\Masters\FinancialYear;

use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\FromArray;

class FinancialYearExport implements FromArray, WithTitle
{
    public function array(): array
    {
        
        $cols = [];

        $years = FinancialYear::where('status', 1)->get();

        $heading = [
			'ID',
			'Title'
		];

        array_push($cols, $heading);

        foreach ($years as $year) {
        	$col = [
				$year->id,
				$year->title
			];

        	array_push($cols, $col);
        }

        return $cols;

    }

    public function title(): string
    {
        return 'FinancialYear';
    }
}