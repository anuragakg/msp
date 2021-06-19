<?php

namespace App\Exports;

use App\Models\Masters\AccessRoad;

use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\FromArray;

class AccessRoadExport implements FromArray, WithTitle
{
    public function array(): array
    {
        
        $cols = [];

        $accessRoads = AccessRoad::where('status', 1)->get();

        $heading = [
			'ID',
			'Title'
		];

        array_push($cols, $heading);

        foreach ($accessRoads as $accessRoad) {
        	$col = [
				$accessRoad->id,
				$accessRoad->title
			];

        	array_push($cols, $col);
        }

        return $cols;

    }

    public function title(): string
    {
        return 'Access Road';
    }
}