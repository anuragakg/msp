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

$haatOtherHaatBazaarData = [];

class HaatMarketOtherHaatBazaarImport implements ToCollection, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return User|null
     */
    public function collection(Collection $data)
    {
        $GLOBALS['haatOtherHaatBazaarData'] = [];
        $jsonDecode = json_decode($data);
        $x=0;
        foreach($jsonDecode as $jd){
            if (!array_key_exists("reference_id",$jsonDecode[$x]))
            {
                return false;
            }
            $GLOBALS['haatOtherHaatBazaarData'][$x]['reference_id'] = $jsonDecode[$x]->reference_id;
            $GLOBALS['haatOtherHaatBazaarData'][$x]['name'] = $jsonDecode[$x]->name;
            $GLOBALS['haatOtherHaatBazaarData'][$x]['distance'] = $jsonDecode[$x]->distance;
            $x++;        
        }    
    }

    public function headingRow(): int
    {
        return 2;
    }
}