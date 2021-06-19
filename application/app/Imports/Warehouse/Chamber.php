<?php

namespace App\Imports\Warehouse;

use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

$bank_data = [];

class Chamber implements ToCollection, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return User|null
     */
    public function collection(Collection $data)
    {
        $GLOBALS['chamber_data'] = [];
        $jsonDecode = json_decode($data);
        $x=0;$row_number=1;
        
        foreach($jsonDecode as $jd){
            ++$row_number;
			$reference_id=$jd->reference_id;
			$GLOBALS['chamber_data'][$reference_id][]=array(
				'reference_id'=>$jd->reference_id,
				'form_id'=>$jd->reference_id,
				'chamber_name'=>$jd->chamber_name,
                'chamber_capacity'=>$jd->chamber_capacity,
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