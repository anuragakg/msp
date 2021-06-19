<?php

namespace App\Exports;

use App\Models\UserDetail;
use App\Models\Shg\ShgGatherers;
use App\Models\Shg\ShgMfpYearlyGatherings;
use App\Models\Shg\ShgHouseholdMember;
use Maatwebsite\Excel\Concerns\FromArray;

class ShgGroupExport implements FromArray
{

    public function __construct($groups)
    {
        $this->groups = $groups;
    }

    public function array(): array
    {
        $cols = [];


        $heading = [
            'Group Name',
            'Bank Account No',
            'Ifsc Code',
            'Total carpus',
            'Carpus to invest',
            'Coordinating Agency',
            'ST Members',
            'Contact person',
            'Contact person mobile',
            'Is Ajeevika',
            'Ajeevika value',
            'Shg Group Number',

        ];

        array_push($cols, $heading);

        foreach ($this->groups as $group) {

            $col = [

                $group['title'],
                $group['bank_ac_no'],
                $group['ifsc_code'],
                $group['total_corpus'],
                $group['corpus_to_invest'],
                $group['get_coordinating_agency']['title'],
                count($group['get_st_member']),
                $group['contact_person'],
                $group['contact_person_mobile'],
                $group['is_ajeevika'] == 1 ? 'Yes' : 'No',
                $group['ajeevika_value'],
                $group['shg_group_no'],

            ];

            array_push($cols, $col);
        }

        return $cols;
    }
}