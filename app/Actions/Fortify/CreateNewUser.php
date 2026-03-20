<?php

namespace App\Actions\Fortify;

use App\Models\User;
use App\Models\UserProfile;
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
        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255', 'unique:users'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => $this->passwordRules(),
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['accepted', 'required'] : '',
        ])->validate();

        $nuovoProfiloutenteID = ++ UserProfile::all()->max()->id ;
//        dd($nuovoProfiloutenteID);

        $user =  User::create([
            'name' => $input['name'],
            'surname' => '',
            'username' => $input['username'],
            'email' => $input['email'],
            'password' => Hash::make($input['password']),
            'profile_id' => $nuovoProfiloutenteID,
        ]);

        $profiloutente = new UserProfile();
        $profiloutente->user_id = $user->id;
        $profiloutente->country_id = '110';
        $profiloutente->save();

        return $user;
    }
}
