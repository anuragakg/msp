<?php

namespace App\Exports;

use App\Models\Masters\ScheduledTribes;

use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\FromArray;

class ScheduledTribesExport implements FromArray, WithTitle
{
    public function array(): array
    {
        
        $cols = [];

        $scheduledTribes = ScheduledTribes::with('state')->where('status', 1)->get();

        $heading = [
			'ID',
            'Title',
            'State ID',
            'State Name'
		];

        array_push($cols, $heading);

        foreach ($scheduledTribes as $scheduledTribe) {
        	$col = [
				$scheduledTribe->id,
				$scheduledTribe->title,
				$scheduledTribe->state_id,
				$scheduledTribe->state->title
			];

        	array_push($cols, $col);
        }

        return $cols;

    }

    public function title(): string
    {
        return 'Scheduled Tribes';
    }
}