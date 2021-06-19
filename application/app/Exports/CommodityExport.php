<?php

namespace App\Exports;

use App\Models\Masters\Commodity;

use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\FromArray;

class CommodityExport implements FromArray, WithTitle
{
    public function array(): array
    {
        
        $cols = [];

        $commodities = Commodity::where('status', 1)->get();

        $heading = [
			'ID',
			'Title',
			'Common Name',
			'MSP',
			'Lab Name'
		];

        array_push($cols, $heading);

        foreach ($commodities as $commodity) {
        	$col = [
				$commodity->id,
				$commodity->title,
				$commodity->common_name,
				$commodity->msp,
				$commodity->lab_name
			];

        	array_push($cols, $col);
        }

        return $cols;

    }

    public function title(): string
    {
        return 'Commodity';
    }
}