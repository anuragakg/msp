<?php

namespace App\Exports;

use App\Models\Masters\Block;

use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\FromArray;

class BlockExport implements FromArray, WithTitle
{
    public function array(): array
    {
        
        $cols = [];

        $blocks = Block::with('district')->where('status', 1)->get();

        $heading = [
			'ID',
			'Block',
            //'Code',
            //'District ID',
            'District',
            //'State ID',
            'State'
		];

        array_push($cols, $heading);

        foreach ($blocks as $block) {
        	$col = [
				$block->id,
				$block->title,
				//$block->code,
				//$block->district_id,
                $block->district->title,
                //$block->district->state->id,
                $block->district->state->title	
			];

        	array_push($cols, $col);
        }

        return $cols;

    }

    public function title(): string
    {
        return 'Block';
    }
}