<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Jetstream\Jetstream;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array<string, string>  $input
     */
    public function create(array $input): User
    {
        $rules = [
            'nik' => ['required', 'integer'],
            'name' => ['required', 'string', 'max:255'],
            // 'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => $this->passwordRules(),
        ];

        // Menambahkan validasi untuk terms jika fitur aktif
        if (Jetstream::hasTermsAndPrivacyPolicyFeature()) {
            $rules['terms'] = ['accepted', 'required'];
        }

        Validator::make($input, $rules)->validate();

        return User::create([
            'nik' => $input['nik'],
            'name' => $input['name'],
            // 'email' => $input['email'],
            'password' => Hash::make($input['password']),
        ]);
    }
}
