<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
//      User::findOrFail('2')->assignRole('gestione utenti');
        User::create([
                'name' => 'super',
                'surname' => 'admin',
                'username' => 'superadmin',
                'email' => 'superadmin@example.com',
                'email_verified_at' => now(),
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
                'profile_id' => 1,
            ])->assignRole('amministratore');
    }
}
