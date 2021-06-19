<?php

namespace App\Exports;

use App\Models\Masters\BoundaryWall;

use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\FromArray;

class BoundaryWallExport implements FromArray, WithTitle
{
    public function array(): array
    {
        
        $cols = [];

        $boundaryWalls = BoundaryWall::where('status', 1)->get();

        $heading = [
			'ID',
			'Title'
		];

        array_push($cols, $heading);

        foreach ($boundaryWalls as $boundaryWall) {
        	$col = [
				$boundaryWall->id,
				$boundaryWall->title
			];

        	array_push($cols, $col);
        }

        return $cols;

    }

    public function title(): string
    {
        return 'Boundary Wall';
    }
}