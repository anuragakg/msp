<?php

namespace App\Exports;

use App\Models\FundManagement\SanctionLetterVdvkMapping;
use App\Models\Proposed\Vdvk;
use carbon\carbon;
use Maatwebsite\Excel\Concerns\FromArray;

class VdvkSanctionedExportMis implements FromArray
{
    public function array(): array
    {
        
        $cols = [];
 
        $ids=array();
        foreach ($_POST['myCheckboxes'] as $key => $value) {
            $ids[]= $value;
        }

       $vdvkData=
       SanctionLetterVdvkMapping::join('sanction_letter_schema', function($join) {
                  $join->on('sanction_letter_vdvk_mapping.letter_id', '=', 'sanction_letter_schema.id');
                })
                ->join('vdvk', function($join) {
                  $join->on('sanction_letter_vdvk_mapping.vdvk_id', '=', 'vdvk.id');
                })
                ->join('proposed_location', function($join) {
                  $join->on('proposed_location.vdvk_id', '=', 'vdvk.id');
                })
                ->leftJoin('states_master', function($join) {
                  $join->on('proposed_location.state', '=', 'states_master.id');
                })
                ->leftJoin('districts_master', function($join) {
                  $join->on('proposed_location.district', '=', 'districts_master.id');
                })
                ->leftJoin('blocks_master', function($join) {
                  $join->on('proposed_location.block', '=', 'blocks_master.id');
                })
                //->groupBy('sanction_letter_schema.snd_id')
                ->where('vdvk.sanctioned',1)
               //// ->where('sanction_letter_schema.release_status',0)
                ->select('vdvk.id','states_master.title as state_name','districts_master.title as district_name','blocks_master.title as block_name','sanction_letter_vdvk_mapping.sanctioned_amount','sanction_letter_vdvk_mapping.released_amount', 'sanction_letter_schema.sanctioned_date','proposed_location.kendra_name')
                ->whereIn('vdvk.id',$ids)
                ->get();
                //Vdvk::whereHas('getProposedLocation')->whereIn('vdvk.id',$ids)->get();
        $heading = [
			'Kendra Name', 
			'State Name',
			'District Name',
            'Sanctioned Amount',
            'Sanctioned Date'
		];

        array_push($cols, $heading);

        foreach ($vdvkData as $val) {  
        	$col = [
				$val['kendra_name'],
                $val['state_name'],
                $val['district_name'],
                $val['sanctioned_amount'],
                $val['sanctioned_date'],
				
			];

        	array_push($cols, $col);
        }

        return $cols;

    }
}