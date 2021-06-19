<?php

namespace App\Exports;

use App\Models\User;
use App\Models\UserDetail;
use App\Models\UserBankDetail;
use Maatwebsite\Excel\Concerns\FromArray;

class UsersExport implements FromArray
{
    public function array(): array
    {
        
        $cols = [];

        $users = User::whereNotIn('role', [8, 11, 12])->get();

        $heading = [
			'User Name',
			'Name',
			'Email',
			'Role',
			'State',
			'District',
			'Block',
			'Date of Birth',
			'Mobile Number',
			'Landline No.',
			'Id Proof Type',
			'Id Proof Number',
			'Official Address',
			'Department',
			'Designation',
			'A/c Holder Name',
			'Bank Name',
			'Bank A/c No.',
			'IFSC Code'
		];

        array_push($cols, $heading);

        foreach ($users as $user) {
        	$col = [
				$user->user_name,
				$user->name.' '.$user->middle_name.' '.$user->last_name,
				$user->email,
				$user->getRole->title,
				$user->getuserDetails->getState->title ?? null,
				$user->getuserDetails->getDistrict->title ?? null,
				$user->getuserDetails->getBlock->title ?? null,
				$user->getuserDetails->dob,
				$user->mobile_no,
				$user->getuserDetails->landline_no,
				$user->getuserDetails->getIdProof->title,
				$user->getuserDetails->id_proof_value,
				$user->getuserDetails->official_address,
				$user->getuserDetails->getDepartment->title ?? null,
				$user->getuserDetails->getDesignation->title ?? null,
				$user->getUserBankDetails->ac_holder_name ?? null,
				$user->getUserBankDetails->bank_name ?? null,
				$user->getUserBankDetails->bank_ac_no ?? null,
				$user->getUserBankDetails->ifsc_code ?? null
			];

        	array_push($cols, $col);
        }

        return $cols;

    }
}