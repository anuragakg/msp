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

$haatMfpData = [];
class HaatMarketMfpImport implements ToCollection, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return User|null
     */
    public function collection(Collection $data)
    {
        $GLOBALS['haatMfpData'] = [];
        $jsonDecode = json_decode($data);
        $x=0;
        foreach($jsonDecode as $jd){
            if (!array_key_exists("reference_id",$jsonDecode[$x]))
            {
                return false;
            }
            $GLOBALS['haatMfpData'][$x]['reference_id'] = $jsonDecode[$x]->reference_id;
            $GLOBALS['haatMfpData'][$x]['commodity'] = $jsonDecode[$x]->commodity;
            $GLOBALS['haatMfpData'][$x]['annual_quantity'] = $jsonDecode[$x]->annual_quantity;
            $x++;
        }    
    }

    public function headingRow(): int
    {
        return 2;
    }
}