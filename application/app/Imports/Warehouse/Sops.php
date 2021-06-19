<?php

namespace App\Imports\Warehouse;

use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

$sops = [];

class Sops implements ToCollection, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return User|null
     */
    public function collection(Collection $data)
    {
        $GLOBALS['sops'] = [];
        $jsonDecode = json_decode($data);
        $x=0;
		
        foreach($jsonDecode as $jd){
			$reference_id=$jd->reference_id;
			$GLOBALS['sops'][$reference_id]=array(
				'sop_management'=>$jd->whether_there_is_a_standard_operating_procedure_sop_for_warehouse_management_for_eg_fumigation_quality_testing_procedure,
				'disinfestation'=>$jd->disinfestation,
				'fumigation'=>$jd->fumigation_of_stores_record_rooms_ship_libraries_containers_including_exportable_commodities,
				
				'handling_clearance'=>$jd->handling_and_wagon_clearance_transport_facilities,
				'srcc'=>$jd->srcc_strike_riot_civil_commotion,
				'calamity'=>$jd->natural_calamities_earthquake_flood_etc,
				'srcc_insurance'=>$jd->srcc_insurance_cover_amount_rs,
				'calamity_insurance'=>$jd->natural_calamities_insurance_cover_amount_rs,

				'terrorist_damage'=>$jd->terrorist_and_malicious_damages,
				'terrorist_damage_insurance'=>$jd->terrorist_and_malicious_damages_insurance_cover_amount_rs,


				'sealed_sample'=>$jd->provision_of_keeping_in_sealed_samples_representatives_samples_of_stock_procured_with_proper_signatures_of_authorized_persons,

				'sealed_sample_remarks'=>$jd->sealed_sample_remarks,

				'nwr'=>$jd->do_you_issue_negotiable_warehouse_receipts_nwr,
				'stock_percent'=>$jd->if_yes_how_much_of_stock_is_pledged,

				'nwr_remarks'=>$jd->nwr_remarks,
				'nwr_count'=>$jd->how_many_nwrs_have_you_issued_in_the_last_1_year,
				'process_nwr'=>$jd->what_is_the_process_for_issuing_the_nwrs,

				'awareness'=>$jd->whether_there_is_awareness_amongst_borrowers_and_willingness_to_use_nwr_vs_wr,
			);
			$x++;
        }
        
    }

    /*public function startCell() {
        return A1;
    }*/
    public function headingRow(): int
    {
        return 2;
    }
        
}