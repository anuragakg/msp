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
class HaatMarketAgentCommodityImport implements ToCollection, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return User|null
     */
    public function collection(Collection $data)
    {
        $GLOBALS['haatAgentCommodityData'] = [];
        $jsonDecode = json_decode($data);
        //dd($jsonDecode);
        $x=0;
        foreach($jsonDecode as $jd){
            if (!array_key_exists("reference_id",$jsonDecode[$x]))
            {
                return false;
            }
            $reference_id=$jsonDecode[$x]->reference_id;
            $record_number=$jsonDecode[$x]->record_number;
            //$GLOBALS['haatAgentCommodityData'][$x]['reference_id'] = $jsonDecode[$x]->reference_id;
           // $GLOBALS['haatAgentCommodityData'][$reference_id]['record_number'] = $jsonDecode[$x]->record_number;
            $GLOBALS['haatAgentCommodityData'][$reference_id][$record_number]['agent_commodity'][] = $jsonDecode[$x]->agent_commodity;
            $GLOBALS['haatAgentCommodityData'][$reference_id][$record_number]['agent_quantity'][] = $jsonDecode[$x]->agent_quantity;
            $x++;
        }    
    }

    public function headingRow(): int
    {
        return 2;
    }
}