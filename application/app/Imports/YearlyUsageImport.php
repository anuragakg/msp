<?php

namespace App\Imports;

use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

$yearlyUsageData = [];

class YearlyUsageImport implements ToCollection, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return User|null
     */
    public function collection(Collection $data)
    {
        $GLOBALS['yearlyUsageData'] = [];
        $jsonDecode = json_decode($data);
        $x=0;
        foreach($jsonDecode as $jd){
            if (!array_key_exists("reference_id",$jsonDecode[$x]))
            {
                return false;
            }
            $GLOBALS['yearlyUsageData'][$x]['reference_id'] = $jsonDecode[$x]->reference_id;
            $GLOBALS['yearlyUsageData'][$x]['commodity'] = $jsonDecode[$x]->commodity;
            $GLOBALS['yearlyUsageData'][$x]['quantity'] = $jsonDecode[$x]->quantity;
            $GLOBALS['yearlyUsageData'][$x]['mfp_use'] = explode(',', $jsonDecode[$x]->mfp_use);
            $x++;
        }    
    }

    public function headingRow():int
    {
        return 2;
    }
}