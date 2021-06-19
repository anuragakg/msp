<?php

namespace App\Exports;

use App\Models\Masters\Vehicle;

use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\FromArray;

class VehicleExport implements FromArray, WithTitle
{
    public function array(): array
    {
        
        $cols = [];

        $vehicles = Vehicle::where('status', 1)->get();

        $heading = [
			'ID',
			'Title'
		];

        array_push($cols, $heading);

        foreach ($vehicles as $vehicle) {
        	$col = [
				$vehicle->id,
				$vehicle->title
			];

        	array_push($cols, $col);
        }

        return $cols;

    }

    public function title(): string
    {
        return 'Vehicle';
    }
}