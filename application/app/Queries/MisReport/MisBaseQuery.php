<?php

namespace App\Queries\MisReport;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

class MisBaseQuery
{

    /**
     * Get authenticated user
     *
     * @return User
     */
    protected function getUser(): User
    {
        return Auth::user();
    }

    protected function viewAllQuery($param)
    {
        $user = $this->getUser();

        $mappings = [
            1 => 'getMisReport'.$param.'Admin',
            2 => 'getMisReport'.$param.'TrifedAdmin',
            3 => 'getMisReport'.$param.'TrifedUser',
            8 => 'getMisReport'.$param.'Mo',
            4 => 'getMisReport'.$param.'Snd',
            19 => 'getMisReport'.$param.'Snd',
            7 => 'getMisReport'.$param.'Sio',
            13 => 'getMisReport'.$param.'Dio',
            6 => 'getMisReport'.$param.'Sio',
            // 11 => 'getMisReport'.$param.'Surveyor',
            // 12 => 'getMisReport'.$param.'Supervisor',

            5 => 'getMisReport'.$param.'Admin',
            14 => 'getMisReport'.$param.'Admin',
            15 => 'getMisReport'.$param.'Admin',
            16 => 'getMisReport'.$param.'Admin',
            17 => 'getMisReport'.$param.'Admin',
            18 => 'getMisReport'.$param.'Admin',
        ];

        return $mappings;
    }
}
