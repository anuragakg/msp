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

$haatTwoData = [];
class HaatMarketTwoImport implements ToCollection, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return User|null
     */
    public function collection(Collection $data)
    {
        $GLOBALS['haatTwoData'] = [];
        $jsonDecode = json_decode($data);
        $x=0;
        foreach($jsonDecode as $jd){

            if (!array_key_exists("reference_id",$jsonDecode[$x]))
            {
                return false;
            }
            $GLOBALS['haatTwoData'][$x]['reference_id'] = $jsonDecode[$x]->reference_id;
            $GLOBALS['haatTwoData'][$x]['market_type'] = $jsonDecode[$x]->market_type;
            $GLOBALS['haatTwoData'][$x]['market_charges'] = $jsonDecode[$x]->market_charges;
            $GLOBALS['haatTwoData'][$x]['market_fees'] = $jsonDecode[$x]->market_fees;
            $GLOBALS['haatTwoData'][$x]['broker_fees'] = $jsonDecode[$x]->broker_fees;
            $GLOBALS['haatTwoData'][$x]['sitting_charges'] = $jsonDecode[$x]->sitting_charges;
            $GLOBALS['haatTwoData'][$x]['commission_agency_charges'] = $jsonDecode[$x]->commission_agency_charges;
            $GLOBALS['haatTwoData'][$x]['weighing_charges'] = $jsonDecode[$x]->weighing_charges;
            $GLOBALS['haatTwoData'][$x]['user_charges'] = $jsonDecode[$x]->user_charges;
            $GLOBALS['haatTwoData'][$x]['other_charges'] = $jsonDecode[$x]->other_charges;
            $GLOBALS['haatTwoData'][$x]['boundary_wall'] = $jsonDecode[$x]->boundary_wall;
            $GLOBALS['haatTwoData'][$x]['built_up_area'] = $jsonDecode[$x]->built_up_area;
            $GLOBALS['haatTwoData'][$x]['access_road'] = $jsonDecode[$x]->access_road;
            $GLOBALS['haatTwoData'][$x]['internal_road'] = $jsonDecode[$x]->internal_road;
            $GLOBALS['haatTwoData'][$x]['is_godown_secured'] = $jsonDecode[$x]->is_godown_secured;
            $GLOBALS['haatTwoData'][$x]['tonnage'] = $jsonDecode[$x]->tonnage;
            $GLOBALS['haatTwoData'][$x]['godown_area'] = $jsonDecode[$x]->godown_area;
            $GLOBALS['haatTwoData'][$x]['weigbridge'] = $jsonDecode[$x]->weigbridge;
            $GLOBALS['haatTwoData'][$x]['electronic_weighing_scale'] = $jsonDecode[$x]->electronic_weighing_scale;
            $GLOBALS['haatTwoData'][$x]['manual_weighing_scale'] = $jsonDecode[$x]->manual_weighing_scale;
            $GLOBALS['haatTwoData'][$x]['number'] = $jsonDecode[$x]->number;
            $GLOBALS['haatTwoData'][$x]['is_demarcated_area'] = $jsonDecode[$x]->is_demarcated_area;
            $GLOBALS['haatTwoData'][$x]['cleaning_area'] = $jsonDecode[$x]->cleaning_area;
            //$GLOBALS['haatTwoData'][$x]['other_infrastructure'] = $jsonDecode[$x]->other_infrastructure;
            $GLOBALS['haatTwoData'][$x]['transportation'] = $jsonDecode[$x]->transportation;
            $x++;       
        }    
        // echo "<pre>";
        // print_r($data);
        // echo "</pre>";
        // $shgGroupData = new ShgGroup();
        // DB::beginTransaction();
        // try {

            

        //     DB::commit();
        //     return $shgGroupData;

        // } catch (\Throwable $th) {
        //     DB::rollBack();
        //     throw $th;
        // }
    }

    public function headingRow(): int
    {
        return 2;
    }
}