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

$haatAgentData = [];
class HaatMarketAgentImport implements ToCollection, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return User|null
     */
    public function collection(Collection $data)
    {
        $GLOBALS['haatAgentData'] = [];
        $jsonDecode = json_decode($data);
        $x=0;
        foreach($jsonDecode as $jd){
            if (!array_key_exists("reference_id",$jsonDecode[$x]))
            {
                return false;
            }
            $GLOBALS['haatAgentData'][$x]['reference_id'] = $jsonDecode[$x]->reference_id;
            $GLOBALS['haatAgentData'][$x]['record_number'] = $jsonDecode[$x]->record_number;
            $GLOBALS['haatAgentData'][$x]['name'] = $jsonDecode[$x]->name;
            $GLOBALS['haatAgentData'][$x]['mobile_no'] = $jsonDecode[$x]->mobile_no;
            $GLOBALS['haatAgentData'][$x]['landline_no'] = $jsonDecode[$x]->landline_no;
            $GLOBALS['haatAgentData'][$x]['address'] = $jsonDecode[$x]->address;
            $GLOBALS['haatAgentData'][$x]['category_ids'] = $jsonDecode[$x]->category_ids;
            //$GLOBALS['haatAgentData'][$x]['state'] = $jsonDecode[$x]->state;
            $GLOBALS['haatAgentData'][$x]['district'] = $jsonDecode[$x]->district;
            $GLOBALS['haatAgentData'][$x]['block'] = $jsonDecode[$x]->block;
            $GLOBALS['haatAgentData'][$x]['commodity'] = $jsonDecode[$x]->commodity;
            $x++;
        }    
    }

    public function headingRow(): int
    {
        return 2;
    }
}