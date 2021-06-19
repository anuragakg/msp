<?php

namespace App\Exports;

use App\Models\HaatWarehouseMfpCommodities;
use App\Models\Masters\Commodity;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\FromArray;

class MfpCommoditiesExport implements FromArray, WithTitle
{   
    public function __construct($haat_markets) 
    {
        $this->haat_markets = $haat_markets;
    }

    public function array(): array
    {
        
        $cols = [];

        $haatbazarIds=array();
        $haatbazarformIds=array();
        foreach ($this->haat_markets as $haat_markets) {            
                $parttwo_id=$haat_markets['part_four'];
                $haatbazarIds[$parttwo_id] =$haat_markets['id'];
                $haatbazarformIds[]= $haat_markets['part_four'];
        }

        $rpms = HaatWarehouseMfpCommodities::whereIn('form_id', $haatbazarformIds)->orderBy('form_id', 'DESC')->get();
        $heading = [
			'Refrence Id',
            'Commodity',
            'Annual Quantity'
		];

        array_push($cols, $heading);

        foreach ($rpms as $rpm) {
           $commodity=Commodity::where('id', $rpm->commodity)->select('title')->get();
        	$col = [
				$haatbazarIds[$rpm->form_id],            
                $commodity[0]['title']?? null,
                $rpm->annual_quantity,
			];

        	array_push($cols, $col);
        }

        return $cols;

    }

    public function title(): string
    {
        return 'Mfp Commodities';
    }
}