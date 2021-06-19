<?php

namespace App\Exports;

use App\Models\User;
use App\Models\UserDetail;
use App\Models\MentoringOrganisation;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\FromArray;

class MentoringOrganisationExport implements FromArray
{
    public function __construct($mo_users)
    {
        $this->mo_users = $mo_users;
    }

    public function array(): array
    {

        $cols = [];

//        $mo_users = User::whereRole(8)->get();


        $heading = [
			'Organization Name',
			'Type of Organization',
			'Mobile',
			'Email Id',
			'Registration No.',
			'User Name',
			'State',
			'District',
			'Pincode',
			'Chairman name',
			'Chairman Mobile',
			'Chairman Email',
			'Secretary name',
			'Secretary Mobile',
			'Secretary Email',
			'Date of Registration',
			'Registration Valid Till',
			'GST TAN No.',
		];

        array_push($cols, $heading);

        foreach ($this->mo_users as $mo_user) {
        	$col = [

       	    // print_r($mo_user->getUserDetails->getState['title']),
            //    die(),

				$mo_user['name'],
				$mo_user->getMentoringOrganisationDetails->getOrgType['title'],
				$mo_user['mobile_no'],
				// $mo_user['status'],
				$mo_user['email'],
				$mo_user->getMentoringOrganisationDetails['registration_no'],
				$mo_user['user_name'],
				$mo_user->getUserDetails->getState['title'],
				$mo_user->getUserDetails->getDistrict['title'],
				$mo_user->getUserDetails['pin_code'],
				$mo_user->getMentoringOrganisationDetails['chairman_name'],
				$mo_user->getMentoringOrganisationDetails['chairman_mobile'],
				$mo_user->getMentoringOrganisationDetails['chairman_email'],
				$mo_user->getMentoringOrganisationDetails['secretary_name'],
				$mo_user->getMentoringOrganisationDetails['secretary_mobile'],
				$mo_user->getMentoringOrganisationDetails['secretary_email'],
				Carbon::parse($mo_user->getMentoringOrganisationDetails['registration_date'])->format('d/m/Y'),
				Carbon::parse($mo_user->getMentoringOrganisationDetails['registration_expiry'])->format('d/m/Y'),
				
				$mo_user->getMentoringOrganisationDetails['gst_or_tan'],
			];

        	array_push($cols, $col);
        }

        return $cols;

    }
}