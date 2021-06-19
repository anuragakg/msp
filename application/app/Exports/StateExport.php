<?php

namespace App\Exports;

use App\Models\Masters\State;
use App\Services\Service;
use App\Queries\StateQuery;

use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\FromArray;

class StateExport implements FromArray, WithTitle
{
    public function array(): array
    {
        
        $cols = [];

        $states = State::where('status', 1)->get();

        $heading = [
			'ID',
			'State',
			//'Code'
		];

        array_push($cols, $heading);

        foreach ($states as $state) {
        	$col = [
				$state->id,
				$state->title,
				//$state->code
			];

        	array_push($cols, $col);
        }

        return $cols;

    }

    public function title(): string
    {
        return 'State';
    }
}