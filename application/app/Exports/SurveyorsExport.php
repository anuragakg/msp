<?php

namespace App\Exports;

use App\Models\User;
use App\Models\UserDetail;
use App\Models\SurveyorSupervisor;
use App\Models\UserBankDetail;
use Maatwebsite\Excel\Concerns\FromArray;

class SurveyorsExport implements FromArray
{
    public function __construct($surveyors)
    {
        $this->surveyors = $surveyors;
    }

    public function array(): array
    {
        
        $cols = [];

//        $users = User::whereRole(11)->get();


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
			'Surveyor for',
			'Phone Type',
			'Is phone self/Other',
			'Branch Name',
			'Bank Name',
			'Bank Mobile Number',
			'Bank A/c No.',
			'IFSC Code'

		];

        array_push($cols, $heading);

        foreach ($this->surveyors as $user) {

            $mappings = [
                1 => 'Gatherer',
                2 => 'Haat Baazar',
                3 => 'Warehouse',
                4 => 'other'
            ];

            $data =  $user->getSurveyorSupervisorDetails->survey_for;
            $value = array();
            foreach ($data as $item){
                if (isset($mappings[$item])) {
                  $value[] =  $mappings[$item];
                }
            }
            $surveyFor = implode(',', $value);


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
                $surveyFor,
				$user->getSurveyorSupervisorDetails->getPhoneType->title ?? null,
				$user->getSurveyorSupervisorDetails->is_phone_self_owned == 1 ? 'Self' : 'Other',
				$user->getUserBankDetails->branch_name ?? null,
				$user->getUserBankDetails->bank_name ?? null,
				$user->getUserBankDetails->mobile_no ?? null,
				$user->getUserBankDetails->bank_ac_no ?? null,
				$user->getUserBankDetails->ifsc_code ?? null
			];

        	array_push($cols, $col);
        }

        return $cols;

    }
}