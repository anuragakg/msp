<?php

namespace App\Imports\Warehouse;

use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

$capture = [];

class Capture implements ToCollection, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return User|null
     */
    public function collection(Collection $data)
    {
        $GLOBALS['capture'] = [];
        $jsonDecode = json_decode($data);
        $x=0;

        foreach($jsonDecode as $jd){
			$reference_id=$jd->reference_id;
			$GLOBALS['capture'][$reference_id]=array(
				'latitude'=>$jd->latitude,
				'longitude'=>$jd->longitude,
				'warehouse_age'=>$jd->warehouse_age,
				'warehouse_condition'=>$jd->warehouse_condition,
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