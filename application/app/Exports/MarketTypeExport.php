<?php

namespace App\Exports;

use App\Models\Masters\MarketType;

use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\FromArray;

class MarketTypeExport implements FromArray, WithTitle
{
    public function array(): array
    {
        
        $cols = [];

        $marketTypes = MarketType::where('status', 1)->get();

        $heading = [
			'ID',
			'Title'
		];

        array_push($cols, $heading);

        foreach ($marketTypes as $marketType) {
        	$col = [
				$marketType->id,
				$marketType->title
			];

        	array_push($cols, $col);
        }

        return $cols;

    }

    public function title(): string
    {
        return 'Market Type';
    }
}