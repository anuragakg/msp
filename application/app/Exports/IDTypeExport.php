<?php

namespace App\Exports;

use App\Models\Masters\IdProof;

use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\FromArray;

class IDTypeExport implements FromArray, WithTitle
{
    public function array(): array
    {
        
        $cols = [];

        $idProofs = IdProof::where('status', 1)->get();

        $heading = [
			'ID',
			'Title'
		];

        array_push($cols, $heading);

        foreach ($idProofs as $idProof) {
        	$col = [
				$idProof->id,
				$idProof->title
			];

        	array_push($cols, $col);
        }

        return $cols;

    }

    public function title(): string
    {
        return 'ID Proof Type';
    }
}