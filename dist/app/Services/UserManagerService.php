<?php

namespace App\Services;

use App\Models\User;
use App\Repositories\UserAccountRepository;
use Illuminate\Validation\ValidationException;
use Validator;

class UserManagerService
{
    private $userAccountRepository;

    public function __construct()
    {
        $this->userAccountRepository = new UserAccountRepository();
    }

    public function signUp(array $data): User
    {
        $data['password'] = bcrypt($data['password']);
        try {
            $data = Validator::validate($data, [
                'email' => ['email', 'unique:users'],
                'name' => ['required'],
                'password' => ['min:6'],
            ]);
        } catch (ValidationException $e) {
        }
        $user = User::create($data);

        return User::where('email', $data['email'])->first();
    }

}
