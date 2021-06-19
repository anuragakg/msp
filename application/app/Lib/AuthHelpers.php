<?php

namespace App\Lib;

use App\Models\User;

class AuthHelpers
{

    /**
     * Failed Login Attempt
     * 
     * @param string $username 
     * @return null|User 
     */
    public function failedLoginAttempt($username)
    {

        $user = User::where('user_name', $username)->first();

        if ($user) {

            $user->increment('failed_attempts');

            if ($user->failed_attempts > ($user->attemptsAllowed - 1)) {
                $user->blockUser();
            }
        }

        return $user;
    }


    public function isUserBlocked($username)
    {
        $user = User::where('user_name', $username)->first();

        if ($user && $user->isBlocked()) {
            return $user->thresholdTime;
        }

        return false;
    }
}
