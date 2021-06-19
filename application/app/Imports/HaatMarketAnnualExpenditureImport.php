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

$haatExpdData = [];
class HaatMarketAnnualExpenditureImport implements ToCollection, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return User|null
     */
    public function collection(Collection $data)
    {
        $GLOBALS['haatExpdData'] = [];
        $jsonDecode = json_decode($data);
        $x=0;
        foreach($jsonDecode as $jd){
            $GLOBALS['haatExpdData'][$x]['reference_id'] = $jsonDecode[$x]->reference_id;
            $GLOBALS['haatExpdData'][$x]['expenditure_no'] = $jsonDecode[$x]->expenditure_no;
            $GLOBALS['haatExpdData'][$x]['head_of_expenditure'] = $jsonDecode[$x]->head_of_expenditure;
            $GLOBALS['haatExpdData'][$x]['amount'] = $jsonDecode[$x]->amount;
            $x++;
        }    
    }

    public function startCell() {
        return A1;
    }
}