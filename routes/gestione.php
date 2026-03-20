<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DocummaginiController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\StatoUtentiController;
use App\Http\Controllers\UserController;

//use App\Http\Livewire\UserList;
use App\Http\Controllers\VocabularyController;
use App\Http\Controllers\VoiceController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Gestione Routes
|--------------------------------------------------------------------------
|
*/
//Route::group(['prefix' =>'gestione','middleware' => ['auth:sanctum', 'verified','role:amministratore|gestione utenti']] ,function () {
////Route::middleware(['auth:sanctum', 'verified', 'role:amministratore|gestione utenti'])->group(function () {
//    Route::get('/test', function () {return view('gestione.welcomegest');})->name('gestioneutenti');
//});

Route::group(['middleware' => ['auth:sanctum', 'verified','role_or_permission:amministratore|gestione utenti|Super Amministratore']] ,function () {
//Route::middleware(['auth:sanctum', 'verified', 'role:amministratore|gestione utenti'])->group(function () {
//    Route::get('/', function () {return view('gestione.index');})->name('gestione');
    Route::get('/', [DashboardController::class, 'index'])->name('gestione');
    Route::get('/setperpage/{perPage}', [DashboardController::class,'setPerPage']);
//  --- Ruoli ---
    Route::get('/ruoli', [RoleController::class,'index'])->name('gestioneruoli');
    Route::get('/ruoli/filtered', [RoleController::class, 'show'])->name('filtraruoli');
    Route::get('/ruoli/{id}/edit', [RoleController::class,'edit'])->name('editruolo');
    Route::patch('/ruoli/{id}/update', [RoleController::class,'update'])->name('aggiornaruolo');
    Route::get('/ruoli/{id}/users2role', [RoleController::class,'users2Role'])->name('utenti2ruolo');
    Route::post('/ruoli/{rid}/{uid}/setuser2role', [RoleController::class,'setUser2Role'])->name('assegnautenti2ruolo');
    Route::post('/ruoli/{rid}/{uid}/deluserfromrole', [RoleController::class,'delUserFromRole'])->name('rimuoviutentidaruolo');
    Route::get('/ruoli/{id}/permissions2role', [RoleController::class,'permissions2Role'])->name('permessi2ruolo');
    Route::post('/ruoli/{rid}/{uid}/setpermission2role', [RoleController::class,'setPermission2Role'])->name('assegnapermessi2ruolo');
    Route::post('/ruoli/{rid}/{uid}/delpermissionfromrole', [RoleController::class,'delPermissionFromRole'])->name('rimuovipermessidaruolo');
    Route::get('/ruoli/crea', [RoleController::class,'create'])->name('crearuolo');
    Route::post('/ruoli/salva', [RoleController::class, 'store'])->name('salvaruolo');
    Route::delete('/ruoli/{id}/delete', [RoleController::class,'destroy'])->name('cancellaruolo');
//  --- Permessi ---
    Route::get('/permessi', [PermissionController::class,'index'])->name('gestionepermessi');
    Route::get('/permessi/filtered', [PermissionController::class, 'show'])->name('filtrapermessi');
    Route::get('/permessi/crea', [PermissionController::class,'create'])->name('creapermesso');
    Route::post('/permessi/salva', [PermissionController::class, 'store'])->name('salvapermesso');
    Route::get('/permessi/{id}/edit', [PermissionController::class,'edit'])->name('editpermesso');
    Route::patch('/permessi/{id}/update', [PermissionController::class,'update'])->name('aggiornapermesso');
    Route::get('/permessi/{id}/users2permission', [PermissionController::class,'users2Permission'])->name('utenti2permesso');
    Route::post('/permessi/{rid}/{uid}/setuser2permission', [PermissionController::class,'setUser2Permission'])->name('assegnautenti2permesso');
    Route::post('/permessi/{rid}/{uid}/deluserfrompermission', [PermissionController::class,'delUserFromPermission'])->name('rimuoviutentidapermesso');
    Route::delete('/permessi/{id}/delete', [PermissionController::class,'destroy'])->name('cancellapermesso');
//  --- Utenti ---
    Route::get('/utenti', [UserController::class, 'index'])->name('gestioneutenti');
    Route::get('/utenti/crea', [UserController::class, 'create'])->name('creautente');
    Route::post('/utenti/salva', [UserController::class, 'store'])->name('salvautente');
    Route::get('/utenti/filtered', [UserController::class, 'show'])->name('filtrautenti');
    Route::get('/utenti/{id}/onoff', [UserController::class,'onoffutente'])->name('onoffutente');
//    Route::get('/utenti/setperpage/{perPage}', [UserController::class,'setPerPage']);
//    Route::post('/utenti/{id}/attiva', [UserController::class,'attiva'])->name('attivautente');
    Route::get('/utenti/{id}/edit', [UserController::class,'edit'])->name('editutente');
    Route::patch('/utenti/{id}/update', [UserController::class,'update'])->name('aggiornautente');
    Route::get('/utenti/{id}/editpw', [UserController::class,'editpw'])->name('editapassword');
    Route::patch('/utenti/{id}/updatepw', [UserController::class,'updatepw'])->name('modificapassword');
    Route::get('/utenti/{id}/editaruoli', [UserController::class,'editruoli'])->name('editaruoli');
    Route::post('/utenti/{id}/{rid}/setruolo', [UserController::class,'setruolo'])->name('setruolo');
    Route::post('/utenti/{id}/{rid}/delruolo', [UserController::class,'delruolo'])->name('delruolo');
    Route::get('/utenti/{id}/editapermessi', [UserController::class,'editpermessi'])->name('editapermessi');
    Route::post('/utenti/{id}/{rid}/setpermesso', [UserController::class,'setpermesso'])->name('setpermesso');
    Route::post('/utenti/{id}/{rid}/delpermesso', [UserController::class,'delpermesso'])->name('delpermesso');
    Route::delete('/utenti/{id}/delete', [UserController::class,'destroy'])->name('cancellautente');
//  --- Stati Utente ---
    Route::get('/statiutente', [StatoUtentiController::class, 'index'])->name('statiutente');
    Route::get('/statiutente/crea', [StatoUtentiController::class, 'create'])->name('creastato');
    Route::post('/statiutente/salva', [StatoUtentiController::class, 'store'])->name('salvastato');
    Route::get('/statiutente/{id}/edit', [StatoUtentiController::class, 'edit'])->name('editstato');
    Route::patch('/statiutente/{id}/update', [StatoUtentiController::class,'update'])->name('aggiornastato');
    Route::delete('/statiutente/{id}/delete', [StatoUtentiController::class, 'destroy'])->name('delstato');
//  --- Contenuti ---
    Route::get('/docummagini', [DocummaginiController::class, 'index'])->name('docummagini');
    Route::get('/tags', [TagController::class, 'index'])->name('tags');
//  --- Vocabolari ---
    Route::get('/vocabolari', [VocabularyController::class, 'index'])->name('vocabolari');
    Route::get('/vocabolari/crea', [VocabularyController::class, 'create'])->name('creavocabolario');
    Route::post('/vocabolari/salva', [VocabularyController::class, 'store'])->name('salvavocabolario');
    Route::get('/vocabolari/{id}/show', [VocabularyController::class, 'show'])->name('showvocabolario');
    Route::get('/vocabolari/{id}/edit', [VocabularyController::class, 'edit'])->name('editvocabolario');
    Route::patch('/vocabolari/{id}/update', [VocabularyController::class,'update'])->name('aggiornavocabolario');
    Route::delete('/vocabolari/{id}/delete', [VocabularyController::class, 'destroy'])->name('delvocabolario');
//  --- Voci vocabolari ---
    Route::get('/vocabolari/{id}/newvoice', [VoiceController::class, 'create'])->name('creavoce');
    Route::post('/vocabolari/savevoice', [VoiceController::class, 'store'])->name('salvavoce');
    Route::get('/vocabolari/{idvoice}/editvoice', [VoiceController::class, 'edit'])->name('editvoce');
    Route::patch('/vocabolari/{idvoice}/updatevoice', [VoiceController::class,'update'])->name('aggiornavoce');
    Route::delete('/vocabolari/{idvoice}/deletevoice', [VoiceController::class, 'destroy'])->name('delvoce');
});
