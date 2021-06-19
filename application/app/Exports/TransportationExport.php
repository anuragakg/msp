<?php

namespace App\Exports;

use App\Models\Masters\Transportation;

use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\FromArray;

class TransportationExport implements FromArray, WithTitle
{
    public function array(): array
    {
        
        $cols = [];

        $transportations = Transportation::where('status', 1)->get();

        $heading = [
			'ID',
			'Title'
		];

        array_push($cols, $heading);

        foreach ($transportations as $transportation) {
        	$col = [
				$transportation->id,
				$transportation->title
			];

        	array_push($cols, $col);
        }

        return $cols;

    }

    public function title(): string
    {
        return 'Transportation';
    }
}