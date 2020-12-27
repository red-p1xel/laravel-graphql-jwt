<?php

namespace App\Repositories;

use App\Models\User;
use Prettus\Repository\Criteria\RequestCriteria;

class UserAccountRepository
{
    public function getUserByEmail(string $email): User
    {
        return User::where('email', $email)->first();
    }

    public function getUpdatedAt(string $email): \DateTime
    {
        $updatedAt = $this->getUserByEmail($email)->getUpdatedAtColumn();

        return $updatedAt->format('d.m.Y');
    }
}
