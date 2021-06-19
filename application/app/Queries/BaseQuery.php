<?php

namespace App\Queries;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

class BaseQuery
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
}
