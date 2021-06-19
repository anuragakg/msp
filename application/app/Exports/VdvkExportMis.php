<?php

namespace App\Exports;

use App\Models\Proposed\ProposedLocation;
use App\Models\Proposed\Vdvk;
use carbon\carbon;
use Maatwebsite\Excel\Concerns\FromArray;

class VdvkExportMis implements FromArray
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
			'Kendra Name', 
			'State Name',
			'District Name',
            'Proposal Submission Date',
            'Proposal Approval Date',
			'VDVK Status'
		];

        array_push($cols, $heading);

        foreach ($vdvkData as $val) {  
         $location = $val->getProposedLocation;
        $vdvk = $val->getVdvk;
        $vdvk_funds = $val->getFundManagement;
        $sanctioned_amount = $val->get_sanctioned_amount;
        $state = $location->getState;
        $district = $location->getDistrict;
        $created_at = Carbon::parse($vdvk['created_at'])->format('d/m/Y h:i:s A');
        $vdvk_funds_approval_date = Carbon::parse($vdvk_funds['created_at'])->format('d/m/Y h:i:s A');
        $status='';
        if($val->status==1)
        {
            $status='Approved';
        }else
        {
            $status='Pending';
        }

        	$col = [
				strip_tags($location->kendra_name),
				strip_tags($state->title), 
				strip_tags($district->title), 
                $created_at,
                $vdvk['actual_date'],
				$status
			];

        	array_push($cols, $col);
        }

        return $cols;

    }
}