<?php

namespace App\Imports\Warehouse;

use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

$haatmarket_data = [];

class HaatMarket implements ToCollection, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return User|null
     */
    public function collection(Collection $data)
    {
        $GLOBALS['haatmarket_data'] = [];
        $jsonDecode = json_decode($data);
        $x=0;$row_number=1;

        foreach($jsonDecode as $jd){
            ++$row_number;
			$reference_id=$jd->reference_id;
			$GLOBALS['haatmarket_data'][$reference_id][]=array(
				'reference_id'=>$jd->reference_id,
				'other_bazaar'=>$jd->other_haat_bazzar,
				'other_bazaar_distance'=>$jd->distance,
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