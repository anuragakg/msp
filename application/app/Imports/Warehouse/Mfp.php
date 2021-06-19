<?php

namespace App\Imports\Warehouse;

use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

$mfp = [];

class Mfp implements ToCollection, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return User|null
     */
    public function collection(Collection $data)
    {
        $GLOBALS['mfp'] = [];
        $jsonDecode = json_decode($data);
        $x=0;$row_number=1;
		//echo '<pre>';print_r($jsonDecode);die;
        foreach($jsonDecode as $jd){
            ++$row_number;
			$reference_id=$jd->reference_id;
			$GLOBALS['mfp'][$reference_id][]=array(
				'reference_id'=>$jd->reference_id,
				'commodity'=>$jd->commodity,
				'annual_quantity'=>$jd->quantity,
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