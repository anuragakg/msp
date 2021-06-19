<?php
namespace App\Exports;


use App\Models\Shg\ShgMfpYearlyGathering;
use App\Models\Masters\Commodity;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\FromArray;

class ShgMFPGatheringExport implements FromArray, WithTitle
{   
    public function __construct($shg_gatherers) 
    {
        $this->shg_gatherers = $shg_gatherers;
    }

    public function array(): array
    {
        
        $cols = [];
        $shg_gatherersIds=array();
        $shg_gatherersformIds=array();
        foreach ($this->shg_gatherers as $shg_gatherers) {            
                $parttwo_id=$shg_gatherers['id'];
                $shg_gatherersIds[$parttwo_id] =$shg_gatherers['id'];
                $shg_gatherersformIds[]= $shg_gatherers['id'];
        }

        $rpms = ShgMfpYearlyGathering::whereIn('shg_id', $shg_gatherersformIds)->orderBy('shg_id', 'DESC')->get();
        $heading = [
            'Refrence ID',
            'Commodity',
            'Quantity',
            'MFP Use',
        ];

        array_push($cols, $heading);
        foreach ($rpms as $rpm) {
            
            if($rpm->mfp_use==1)
            {
                $Type='Self Consumption';
            }elseif($rpm->mfp_use==2)
            {
                $Type='Value Addition';
            }else
            {
                $Type='Sale in Market';
            }

           $commodity=Commodity::where('id', $rpm->commodity)->select('title')->get();
            $col = [
                $rpm->shg_id,          
                $commodity[0]['title']?? null,
                $rpm->quantity,
                $Type,
            ];

            array_push($cols, $col);
        }

        return $cols;

    }

    public function title(): string
    {
        return 'ShgMFPGathering';
    }
}