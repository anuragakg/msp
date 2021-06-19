<?php

namespace App\Imports;

use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

$shgMembersData = [];

class ShgMembersImport implements ToCollection, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return User|null
     */
    public function collection(Collection $data)
    {
        $GLOBALS['shgMembersData'] = [];
        $jsonDecode = json_decode($data);
        $x=0;
        foreach($jsonDecode as $jd){
            if (!array_key_exists("reference_id",$jsonDecode[$x]))
            {
                return false;
            }
            $GLOBALS['shgMembersData'][$x]['reference_id'] = $jsonDecode[$x]->reference_id;
            $GLOBALS['shgMembersData'][$x]['name'] = $jsonDecode[$x]->name;
            $GLOBALS['shgMembersData'][$x]['gender'] = $jsonDecode[$x]->gender;
            try {
                $dobObj = Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($jsonDecode[$x]->dob));
                $GLOBALS['shgMembersData'][$x]['dob'] = $dobObj->format('d/m/Y');
            } catch (\Throwable $th) {
                $GLOBALS['shgMembersData'][$x]['dob'] = null;
            }
            $GLOBALS['shgMembersData'][$x]['age'] = $jsonDecode[$x]->age;
            $GLOBALS['shgMembersData'][$x]['occupation'] = $jsonDecode[$x]->occupation;
            $GLOBALS['shgMembersData'][$x]['education'] = $jsonDecode[$x]->education;
            $GLOBALS['shgMembersData'][$x]['relationship_with_member'] = $jsonDecode[$x]->relationship_with_member;
            $GLOBALS['shgMembersData'][$x]['is_gathering_mfp'] = $jsonDecode[$x]->is_gathering_mfp;
            $x++;
        }    
    }

    public function headingRow(): int
    {
        return 2;
    }
}