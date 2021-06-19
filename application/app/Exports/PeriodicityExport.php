<?php

namespace App\Exports;

use App\Models\Masters\Periodicity;

use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\FromArray;

class PeriodicityExport implements FromArray, WithTitle
{
    public function array(): array
    {
        
        $cols = [];

        $periodicities = Periodicity::where('status', 1)->get();

        $heading = [
			'ID',
			'Title'
		];

        array_push($cols, $heading);

        foreach ($periodicities as $periodicitie) {
        	$col = [
				$periodicitie->id,
				$periodicitie->title
			];

        	array_push($cols, $col);
        }

        return $cols;

    }

    public function title(): string
    {
        return 'Periodicity';
    }
}