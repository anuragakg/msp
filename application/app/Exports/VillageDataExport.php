<?php

namespace App\Exports;

use App\Models\User;
use App\Models\UserDetail;
use App\Models\MentoringOrganisation;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\FromArray;

class VillageDataExport implements FromArray
{
    public function __construct($villages)
    {
        $this->villages = $villages;
    }

    public function array(): array
    {

        $cols = [];

        $heading = [
			'Village Name',
			'Village Code',
			'Pincode',
		];

        array_push($cols, $heading);

        foreach ($this->villages as $mo_user) {
        	$col = [ 

				$mo_user['title'],
				$mo_user['code'],
				$mo_user['pincode'],
				
			];

        	array_push($cols, $col);
        }

        return $cols;

    }
}