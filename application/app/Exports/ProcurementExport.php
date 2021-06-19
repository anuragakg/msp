<?php

namespace App\Exports;

use App\Models\HaatMarketProcurementAgents;
use App\Models\Masters\State;
use App\Models\Masters\District;
use App\Models\Masters\Block;
use App\Models\Masters\Commodity;
use App\Models\Masters\Category;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\FromArray;

class ProcurementExport implements FromArray, WithTitle
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

        $rpms = HaatMarketProcurementAgents::whereIn('form_id', $haatbazarformIds)->orderBy('form_id', 'DESC')->get();
      //  print_r($rpms); die;
        $heading = [
            'Refrence Id',
			'Name',
			'Mobile_no',
            'Landline_no',
            'Address',
            'Category',
            'Commodity',
            'State',
            'District',
            'Block'
		];

        array_push($cols, $heading);

        foreach ($rpms as $rpm) {
            $state=State::where('id', $rpm->state)->select('title')->get();
           $district=District::where('id', $rpm->district)->select('title')->get();
           $block=Block::where('id', $rpm->block)->select('title')->get();
           $commodity=Commodity::whereIn('id', $rpm->commodity)->select('title')->get();
            $category_ids=Category::whereIn('id', $rpm->category_ids)->select('title')->get();
        	$col = [
                $haatbazarIds[$rpm->form_id],
				$rpm->name,
				$rpm->mobile_no,
                $rpm->landline_no,
                $rpm->address,
                $category_ids[0]['title']?? null,
                $commodity[0]['title']?? null,
                $state[0]['title']?? null,
                $district[0]['title']?? null,
                $block[0]['title']?? null
			];

        	array_push($cols, $col);
        }

        return $cols;

    }

    public function title(): string
    {
        return 'Procurement Agent';
    }
}