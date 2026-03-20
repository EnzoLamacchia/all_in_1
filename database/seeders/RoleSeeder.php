<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Role::create(['name' => 'amministratore']);
        Role::create(['name' => 'gestione utenti']);
        Role::create(['name' => 'redattore']);
        Role::create(['name' => 'lettore']);
    }
}
