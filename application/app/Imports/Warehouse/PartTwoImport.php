<?php

namespace App\Imports\Warehouse;

use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

$partTwoImport = [];

class PartTwoImport implements ToCollection, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return User|null
     */
    public function collection(Collection $data)
    {
        $GLOBALS['partTwoImport'] = [];
        $jsonDecode = json_decode($data);
        $x=0;
        
        foreach($jsonDecode as $jd){
			$reference_id=$jsonDecode[$x]->reference_id;
            //$GLOBALS['partTwoImport'][$reference_id]['reference_id'] = $jsonDecode[$x]->reference_id;
            $GLOBALS['partTwoImport'][$reference_id]['weighbridge'] = $jsonDecode[$x]->weighbridge;
            $GLOBALS['partTwoImport'][$reference_id]['electronic_weighing_scale'] = $jsonDecode[$x]->electronic_weighing_scale;
            $GLOBALS['partTwoImport'][$reference_id]['weighbridge_number'] = $jsonDecode[$x]->weighbridge_number;
            $GLOBALS['partTwoImport'][$reference_id]['electronic_weighing_number'] = $jsonDecode[$x]->electronic_weighing_number;
            $GLOBALS['partTwoImport'][$reference_id]['manual_weighing_scale'] = $jsonDecode[$x]->manual_weighinga_scale;
            $GLOBALS['partTwoImport'][$reference_id]['storage_rack'] = $jsonDecode[$x]->storage_rack;
            $GLOBALS['partTwoImport'][$reference_id]['manual_weighing_number'] = $jsonDecode[$x]->manual_weighing_number;
            $GLOBALS['partTwoImport'][$reference_id]['storage_rack_number'] = $jsonDecode[$x]->storage_rack_number;
            $GLOBALS['partTwoImport'][$reference_id]['premises'] = $jsonDecode[$x]->premises;
            
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