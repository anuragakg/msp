<?php

namespace App\Exports;

use App\Models\Masters\District;

use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\FromArray;

class DistrictExport implements FromArray, WithTitle
{
    public function array(): array
    {
        
        $cols = [];

        $districts = District::with('state')->where('status', 1)->get();

        $heading = [
			'ID',
			'District',
            //'Code',
            //'State ID',
            'State'
		];

        array_push($cols, $heading);

        foreach ($districts as $district) {
        	$col = [
				$district->id,
				$district->title,
				//$district->code,
				//$district->state_id,
				$district->state->title
			];

        	array_push($cols, $col);
        }

        return $cols;

    }

    public function title(): string
    {
        return 'District';
    }
}