<?php

namespace App\Imports;

use App\Models\HaatMarketOne;
use App\Models\HaatMarketLinkages;
use App\Models\OtherHaatBazaar;
use App\Models\HaatBazaarFormMapping;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

$haatFourData = [];
class HaatMarketFourImport implements ToCollection, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return User|null
     */
    public function collection(Collection $data)
    {
        $GLOBALS['haatFourData'] = [];
        $jsonDecode = json_decode($data);
        $x=0;
        foreach($jsonDecode as $jd){

            if (!array_key_exists("reference_id",$jsonDecode[$x]))
            {
                return false;
            }
            
            $GLOBALS['haatFourData'][$x]['reference_id'] = $jsonDecode[$x]->reference_id;
            $GLOBALS['haatFourData'][$x]['cleaning_and_sanitation'] = $jsonDecode[$x]->cleaning_and_sanitation;
            $GLOBALS['haatFourData'][$x]['garbage_collection'] = $jsonDecode[$x]->garbage_collection;
            $GLOBALS['haatFourData'][$x]['waste_utilization'] = $jsonDecode[$x]->waste_utilization;
            // $GLOBALS['haatFourData'][$x]['other_facility'] = $jsonDecode[$x]->other_facility;
            // $GLOBALS['haatFourData'][$x]['remarks'] = $jsonDecode[$x]->remarks;
            // $GLOBALS['haatFourData'][$x]['annual_income'] = $jsonDecode[$x]->annual_income;
            $GLOBALS['haatFourData'][$x]['latitude'] = $jsonDecode[$x]->latitude;
            $GLOBALS['haatFourData'][$x]['longitude'] = $jsonDecode[$x]->longitude;
            //$GLOBALS['haatFourData'][$x]['nearest_apmc_distance'] = $jsonDecode[$x]->nearest_apmc_distance;
            $x++;
        }    
    }

    public function headingRow(): int
    {
        return 2;
    }
}