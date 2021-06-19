<?php

namespace App\Exports;

use App\Models\Masters\MemberRelation;

use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\FromArray;

class MemberRelationExport implements FromArray, WithTitle
{
    public function array(): array
    {
        
        $cols = [];

        $memberRelations = MemberRelation::where('status', 1)->get();

        $heading = [
			'ID',
			'Title'
		];

        array_push($cols, $heading);

        foreach ($memberRelations as $memberRelation) {
        	$col = [
				$memberRelation->id,
				$memberRelation->title
			];

        	array_push($cols, $col);
        }

        return $cols;

    }

    public function title(): string
    {
        return 'Member Relation';
    }
}