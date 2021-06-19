<?php

namespace App\Services;

use App\Models\User;
use App\Models\UserBankDetail as ServiceModel;

class UserBankDetailsService
{

    public function getDetails($user_id)
    {
        $user = User::findOrFail($user_id);

        return $user->getUserBankDetails;
    }

    public function getDetailsByAccountNo($acc_no) {
        return ServiceModel::whereIn("bank_ac_no", $acc_no)->get();
    }
}
