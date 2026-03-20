<?php

namespace Database\Seeders;

use App\Models\UserStatus;
use Illuminate\Database\Seeder;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        UserStatus::create([
            'user_status' => 'attivo',
            'description' => 'utente operativo',
        ]);
        UserStatus::create([
            'user_status' => 'disattivo',
            'description' => 'utente sospeso',
        ]);
    }
}
