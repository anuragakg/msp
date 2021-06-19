<?php

namespace App\Exports;

use App\Models\Proposed\Vdvk;
use carbon\carbon;
use Maatwebsite\Excel\Concerns\FromArray;

class VdvkFundbalaceExportMis implements FromArray
{
    public function array(): array
    {
        
        $cols = []; 
        $ids=array();
        foreach ($_POST['myCheckboxes'] as $key => $value) {
            $ids[]= $value;
        }

       $vdvkData=Vdvk::whereHas('getProposedLocation')->whereIn('vdvk.id',$ids)->get();
        $heading = [
			'VDVK Name', 
			'Proposed Amount',
			'Sanction Amount',
            'Released Amount by TRIFED',
            'Balance Amount',
            'State',
            'District',
            'Block',
            'Sanctioned',
            'Ref.Id',
            'Remarks'
		];

        array_push($cols, $heading);

        foreach ($vdvkData as $val) {  
            $location = $val->getProposedLocation;
            $fundBalance = $val->getFundBalances;
            $users = $val->userNames;
            $state = $location->getState;
            $district = $location->getDistrict;
            $block = $location->getBlock;
            $sanctioned = $val->sanctioned;
            if ($sanctioned == 1) {
                $sanctioned = "Yes";
            }else{
                $sanctioned = "No";  
            }
        	$col = [
				$users['name'],
                $val->proposed_amount,
                $fundBalance['approved_amount'],
                $fundBalance['released_amount'],
                $fundBalance['balance_amount'],
                $state->title,
                $district->title,
                $block->title,
                $sanctioned,
                $val->ref_id,
                $val->remarks				
			];

        	array_push($cols, $col);
        }

        return $cols;

    }
}