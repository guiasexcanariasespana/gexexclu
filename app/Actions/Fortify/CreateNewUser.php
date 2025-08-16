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
     * @param  array  $input
     * @return \App\Models\User
     */
    public function create(array $input)
    {
        Validator::make($input, [
            'name' => ['required', 'string', 'max:75'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,NULL,id,deleted_at,NULL'],
            'telefono' => ['required', 'max:9'],
            'password' => $this->passwordRules(),
            'edad' => 'required|numeric|min:18',
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['accepted', 'required'] : '',
            'g-recaptcha-response' => 'required|captcha',
        ])->validate();

        return  User::create([
            'name' => $input['name'],
            'email' => $input['email'],
            'password' => Hash::make($input['password']),
            'telefono' => $input['telefono'],
            'nacionalidad' => $input['nacionalidad'],
            'edad' => $input['edad'],
        ])->assignRole('Usuario');;
    }
}
