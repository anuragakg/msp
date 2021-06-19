<?php

namespace App\Exports;

use App\Models\User;
use App\Models\UserDetail;
use App\Models\SurveyorSupervisor;
use App\Models\UserBankDetail;
use Maatwebsite\Excel\Concerns\FromArray;

class SupervisorsExport implements FromArray
{
    public function __construct($supervisor)
    {
        $this->supervisor =$supervisor;
    }

    public function array(): array
    {
        
        $cols = [];

       // $users = User::whereRole(12)->get();


        $heading = [
			'User Name',
			'Name',
			'Email',
			'Role',
//			'Date of Birth',
			'Mobile No',
			'Aadhaar No.',
			'State',
			'District',
			'Block',
			'Supervising for',
			'Phone Type',
			'Is phone selfed/owned',
			'Branch Name',
			'Bank Name',
			'Bank Mobile Number',
			'Bank A/c No.',
			'IFSC Code'
		];

        array_push($cols, $heading);

        foreach ($this->supervisor as $user) {

            $mappings = [
                1 => 'Gatherer',
                2 => 'Haat Baazar',
                3 => 'Warehouse',
                4 => 'other'
            ];

            $data = $user->getSurveyorSupervisorDetails->supervising_for;
            $value = array();
            foreach ($data as $item){
                if (isset($mappings[$item])) {
                    $value[] =  $mappings[$item];
                }
            }
            $supervisiongFor = implode(',', $value);

        	$col = [
				$user->user_name,
				$user->name.' '.$user->middle_name.' '.$user->last_name,
				$user->email,
				$user->getRole->title,
//				$user->getuserDetails->dob,
				$user->mobile_no,
				$user->getuserDetails->id_proof_value,
				$user->getuserDetails->getState->title,
				$user->getuserDetails->getDistrict->title,
				$user->getuserDetails->getBlock->title,
                $supervisiongFor,
				isset($user->getSurveyorSupervisorDetails->getPhoneType->title)?$user->getSurveyorSupervisorDetails->getPhoneType->title:'',
				(isset($user->getSurveyorSupervisorDetails->is_phone_self_owned) && ($user->getSurveyorSupervisorDetails->is_phone_self_owned == 1)) ? 'Self' : 'Other',
				$user->getUserBankDetails->branch_name,
				$user->getUserBankDetails->bank_name,
				$user->getUserBankDetails->mobile_no,
				$user->getUserBankDetails->bank_ac_no,
				$user->getUserBankDetails->ifsc_code
			];

        	array_push($cols, $col);
        }

        return $cols;

    }
}