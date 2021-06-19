<?php

namespace App\Exports;

use App\Models\Masters\MarketRegulation;

use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\FromArray;

class MarketRegulationExport implements FromArray, WithTitle
{
    public function array(): array
    {
        
        $cols = [];

        $regulations = MarketRegulation::where('status', 1)->get();

        $heading = [
			'ID',
			'Title'
		];

        array_push($cols, $heading);

        foreach ($regulations as $regulation) {
        	$col = [
				$regulation->id,
				$regulation->title
			];

        	array_push($cols, $col);
        }

        return $cols;

    }

    public function title(): string
    {
        return 'Market Regulation';
    }
}