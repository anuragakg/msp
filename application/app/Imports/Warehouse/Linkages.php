<?php

namespace App\Imports\Warehouse;

use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

$linkages = [];

class Linkages implements ToCollection, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return User|null
     */
    public function collection(Collection $data)
    {
        $GLOBALS['linkages'] = [];
        $jsonDecode = json_decode($data);
        $x=0;

        foreach($jsonDecode as $jd){
			$reference_id=$jd->reference_id;
			$GLOBALS['linkages'][$reference_id]=array(
				'nearest_railwaystation'=>$jd->nearest_railway_station,
				'railwaystation_distance'=>$jd->railway_station_distance,
				'nearest_highway'=>$jd->nearest_highway,
				'highway_distance'=>$jd->highway_distance,
				'nearest_apmc_market'=>$jd->nearest_apmc_market	,
				'nearest_apmc_market_distance'=>$jd->nearest_apmc_market_distance,
                'nearest_haat_bazaar'=>$jd->nearest_haat_bazaar,
                'nearest_haat_bazaar_distance'=>$jd->nearest_haat_bazaar_distance,
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