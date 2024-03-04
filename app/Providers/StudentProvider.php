<?php
// app/Providers/StudentProvider.php

namespace App\Providers;

use App\Models\Student;
use Illuminate\Contracts\Auth\Authenticatable as UserContract;
use Illuminate\Contracts\Auth\UserProvider;
use Illuminate\Support\Facades\Hash;

class StudentProvider implements UserProvider
{
    // Implement methods from the UserProvider interface

    public function retrieveById($identifier)
    {
        // Retrieve a user by their unique identifier (e.g., registration number)
        return Student::where('reg_no', $identifier)->first();
    }

    public function retrieveByToken($identifier, $token)
    {
        // Implement if needed
    }

    public function updateRememberToken(UserContract $user, $token)
    {
        // Implement if needed
    }

    public function retrieveByCredentials(array $credentials)
    {
        // Retrieve a user by the given credentials (e.g., registration number)
        return Student::where('reg_no', $credentials['reg_no'])->first();
    }

    public function validateCredentials(UserContract $user, array $credentials)
    {
        // Validate the user's credentials (e.g., compare password)
        return Hash::check($credentials['password'], $user->getAuthPassword());
    }
}
