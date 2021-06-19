<?php

namespace App\Imports\Warehouse;

use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

$staffDetails = [];

class StaffDetails implements ToCollection, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return User|null
     */
    public function collection(Collection $data)
    {
        $GLOBALS['staffDetails'] = [];
        $jsonDecode = json_decode($data);
        $x=0;$row_number=1;
        
        foreach($jsonDecode as $jd){
            ++$row_number;
			$reference_id=$jd->reference_id;
			$GLOBALS['staffDetails'][$reference_id][]=array(
				'reference_id'=>$jd->reference_id,
				'name'=>$jd->name,
				'designation'=>$jd->designation,
				'qualification'=>$jd->qualification,
				'mobile'=>$jd->mobile,
				'phone_type_id'=>$jd->type_of_phone,
				'email'=>$jd->email,
                'duties'=>$jd->duties,
				'row_number'=>$row_number,
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