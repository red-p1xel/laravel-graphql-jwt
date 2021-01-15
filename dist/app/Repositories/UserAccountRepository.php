<?php

namespace App\Repositories;

use App\Models\User;

class UserAccountRepository
{
    public function getUserByEmail(string $email): User
    {
        return User::where('email', $email)->first();
    }
}
