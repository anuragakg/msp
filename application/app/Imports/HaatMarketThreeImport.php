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

$haatThreeData = [];
class HaatMarketThreeImport implements ToCollection, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return User|null
     */
    public function collection(Collection $data)
    {
        $GLOBALS['haatThreeData'] = [];
        $jsonDecode = json_decode($data);
        $x=0;
        foreach($jsonDecode as $jd){

            if (!array_key_exists("reference_id",$jsonDecode[$x]))
            {
                return false;
            }
            $GLOBALS['haatThreeData'][$x]['reference_id'] = $jsonDecode[$x]->reference_id;
            $GLOBALS['haatThreeData'][$x]['office'] = $jsonDecode[$x]->office;
            $GLOBALS['haatThreeData'][$x]['drinking_water'] = $jsonDecode[$x]->drinking_water;
            $GLOBALS['haatThreeData'][$x]['notice_board'] = $jsonDecode[$x]->notice_board;
            $GLOBALS['haatThreeData'][$x]['urinal_toilet'] = $jsonDecode[$x]->urinal_toilet;
            $GLOBALS['haatThreeData'][$x]['electricity'] = $jsonDecode[$x]->electricity;
            $GLOBALS['haatThreeData'][$x]['garbage_system'] = $jsonDecode[$x]->garbage_system;
            $GLOBALS['haatThreeData'][$x]['parking'] = $jsonDecode[$x]->parking;
            $GLOBALS['haatThreeData'][$x]['input_sundry'] = $jsonDecode[$x]->input_sundry;
            $GLOBALS['haatThreeData'][$x]['hygienic'] = $jsonDecode[$x]->hygienic;
            $GLOBALS['haatThreeData'][$x]['bank'] = $jsonDecode[$x]->bank;
            $GLOBALS['haatThreeData'][$x]['bank_name'] = $jsonDecode[$x]->bank_name;
            $GLOBALS['haatThreeData'][$x]['bank_branch_name'] = $jsonDecode[$x]->bank_branch_name;
            $GLOBALS['haatThreeData'][$x]['post_office'] = $jsonDecode[$x]->post_office;
            $GLOBALS['haatThreeData'][$x]['post_office_name'] = $jsonDecode[$x]->post_office_name;
            $GLOBALS['haatThreeData'][$x]['assaying_lab'] = $jsonDecode[$x]->assaying_lab;
            $GLOBALS['haatThreeData'][$x]['assaying_lab_remarks'] = $jsonDecode[$x]->assaying_lab_remarks;
            $GLOBALS['haatThreeData'][$x]['packaging'] = $jsonDecode[$x]->packaging;
            $GLOBALS['haatThreeData'][$x]['packaging_remarks'] = $jsonDecode[$x]->packaging_remarks;
            $GLOBALS['haatThreeData'][$x]['drying_yards'] = $jsonDecode[$x]->drying_yards;
            $GLOBALS['haatThreeData'][$x]['drying_yards_remarks'] = $jsonDecode[$x]->drying_yards_remarks;
            $GLOBALS['haatThreeData'][$x]['bagging'] = $jsonDecode[$x]->bagging;
            $GLOBALS['haatThreeData'][$x]['bagging_remarks'] = $jsonDecode[$x]->bagging_remarks;
            $GLOBALS['haatThreeData'][$x]['loading'] = $jsonDecode[$x]->loading;
            $GLOBALS['haatThreeData'][$x]['loading_remarks'] = $jsonDecode[$x]->loading_remarks;
            $GLOBALS['haatThreeData'][$x]['conditioning'] = $jsonDecode[$x]->conditioning;
            $GLOBALS['haatThreeData'][$x]['conditioning_remarks'] = $jsonDecode[$x]->conditioning_remarks;
            // $GLOBALS['haatThreeData'][$x]['pack_house'] = $jsonDecode[$x]->pack_house;
            // $GLOBALS['haatThreeData'][$x]['pack_house_remarks'] = $jsonDecode[$x]->pack_house_remarks;
            $GLOBALS['haatThreeData'][$x]['storage_capacity'] = $jsonDecode[$x]->storage_capacity;
            $GLOBALS['haatThreeData'][$x]['storage_capacity_remarks'] = $jsonDecode[$x]->storage_capacity_remarks;
            $GLOBALS['haatThreeData'][$x]['standardisation'] = $jsonDecode[$x]->standardisation;
            $GLOBALS['haatThreeData'][$x]['standardisation_remarks'] = $jsonDecode[$x]->standardisation_remarks;
            $GLOBALS['haatThreeData'][$x]['primary_processing'] = $jsonDecode[$x]->primary_processing;
            $GLOBALS['haatThreeData'][$x]['primary_processing_remarks'] = $jsonDecode[$x]->primary_processing_remarks;
            $GLOBALS['haatThreeData'][$x]['info_display'] = $jsonDecode[$x]->info_display;
            $GLOBALS['haatThreeData'][$x]['info_display_remarks'] = $jsonDecode[$x]->info_display_remarks;
            $GLOBALS['haatThreeData'][$x]['it_infra'] = $jsonDecode[$x]->it_infra;
            $GLOBALS['haatThreeData'][$x]['it_infra_remarks'] = $jsonDecode[$x]->it_infra_remarks;
            $GLOBALS['haatThreeData'][$x]['storage'] = $jsonDecode[$x]->storage;
            $GLOBALS['haatThreeData'][$x]['storage_remarks'] = $jsonDecode[$x]->storage_remarks;
            $GLOBALS['haatThreeData'][$x]['public_address'] = $jsonDecode[$x]->public_address;
            $GLOBALS['haatThreeData'][$x]['public_address_remarks'] = $jsonDecode[$x]->public_address_remarks;
            $GLOBALS['haatThreeData'][$x]['extension'] = $jsonDecode[$x]->extension;
            $GLOBALS['haatThreeData'][$x]['extension_remarks'] = $jsonDecode[$x]->extension_remarks;
            $GLOBALS['haatThreeData'][$x]['boarding_lodging'] = $jsonDecode[$x]->boarding_lodging;
            $x++;
        }    
    }

    public function headingRow(): int
    {
        return 2;
    }
}