<?php

namespace App\Imports\Warehouse;

use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

$depositors = [];

class Depositors implements ToCollection, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return User|null
     */
    public function collection(Collection $data)
    {
        $GLOBALS['depositors'] = [];
        $jsonDecode = json_decode($data);
        $x=0;
        
        foreach($jsonDecode as $jd){
			$reference_id=$jd->reference_id;
			$GLOBALS['depositors'][$reference_id]=array(
				'farmers'=>$jd->farmers,
				'government'=>$jd->government,
				'societies'=>$jd->societies,
				'private'=>$jd->private,
				'traders'=>$jd->traders,
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