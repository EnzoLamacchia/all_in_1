<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

return new class extends Migration
{
    /**
     * Crea i permessi di accesso ai package e li assegna al ruolo amministratore.
     * Gli altri ruoli vanno configurati dalla console di gestione.
     */
    public function up(): void
    {
        // Aggiunge la colonna description alla tabella permissions se non esiste
        // (i DB creati con versioni precedenti di Spatie non la includevano)
        if (!Schema::hasColumn('permissions', 'description')) {
            Schema::table('permissions', function (Blueprint $table) {
                $table->string('description', 255)->nullable()->after('name');
            });
        }

        // Reset cache permessi Spatie
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        $permessi = [
            ['name' => 'usa gespidieffe', 'description' => 'Accesso al package Gespidieffe (manipolazione PDF)'],
            ['name' => 'usa dedir',       'description' => 'Accesso al package Dedir (determine dirigenziali)'],
            ['name' => 'usa excelimport', 'description' => 'Accesso al package ExcelImport (importazione Excel)'],
        ];

        foreach ($permessi as $p) {
            Permission::firstOrCreate(
                ['name' => $p['name'], 'guard_name' => 'web'],
                ['description' => $p['description']]
            );
        }

        $nomi = array_column($permessi, 'name');

        // L'amministratore ha accesso a tutto per default
        $admin = Role::where('name', 'amministratore')->first();
        if ($admin) {
            $admin->givePermissionTo($nomi);
        }

        // Super Amministratore (se esiste)
        $superAdmin = Role::where('name', 'Super Amministratore')->first();
        if ($superAdmin) {
            $superAdmin->givePermissionTo($nomi);
        }
    }

    public function down(): void
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        foreach (['usa gespidieffe', 'usa dedir', 'usa excelimport'] as $nome) {
            Permission::where('name', $nome)->delete();
        }
    }
};
