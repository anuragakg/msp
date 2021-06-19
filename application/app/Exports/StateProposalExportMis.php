<?php

namespace App\Exports;

use App\Models\Masters\State;
use App\Models\Proposed\Vdvk;
use App\Models\FundManagement\SanctionLetterVdvkMapping;
use carbon\carbon;
use Maatwebsite\Excel\Concerns\FromArray;

class StateProposalExportMis implements FromArray
{
    public function array(): array
    {
        
        $cols = [];
 
        $ids=array();
        foreach ($_POST['myCheckboxes'] as $key => $value) {
            $ids[]= $value;
        }

       $vdvkData=SanctionLetterVdvkMapping::join('sanction_letter_schema', function($join) {
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
                 ->leftJoin('financial_year_master', function($join) {
                  $join->on('sanction_letter_schema.financial_year', '=', 'financial_year_master.id');
                })
                ->where('vdvk.sanctioned',1)

                ->select('vdvk.id','states_master.title as state_name','districts_master.title as district_name','blocks_master.title as block_name','sanction_letter_vdvk_mapping.sanctioned_amount','sanction_letter_vdvk_mapping.released_amount', 'sanction_letter_schema.sanctioned_date','proposed_location.kendra_name','financial_year_master.title as financial_year')->whereIn('vdvk.id',$ids)->get();
                //Vdvk::whereHas('getProposedLocation')->whereIn('vdvk.id',$ids)->get();
        $heading = [
			'VDVK Name', 
			'State Name',
			'District Name',
            'Block',
            'Sanctioned Amount',
            'Released Amount',
            'Financial Year',
            'Sanction Date'
		];

        array_push($cols, $heading);

        foreach ($vdvkData as $val) {  

        	$col = [
				$val['kendra_name'],
                $val['state_name'],
                $val['district_name'],
                $val['block_name'],
                $val['sanctioned_amount'],
                $val['released_amount'],
                $val['financial_year'],
                $val['sanctioned_date']

			];

        	array_push($cols, $col);
        }

        return $cols;

    }
}