<?php

//use Elamacchia\Dedir\Http\Controllers\CompetenzeController;
use Elamacchia\Dedir\Http\Controllers\DetermineController;
use Elamacchia\Dedir\Http\Controllers\CompetenzeController;
use Illuminate\Support\Facades\Route;

// Route::group([                                                                  // <-- middleware originale (senza permesso package)
//     'middleware' => ['web','auth:sanctum', 'verified', 'role:amministratore|gestione_determine'],
//     'namespace' => 'Elamacchia\Dedir\Http\Controllers',
//     'prefix' => 'detdir'
// ] ,function () {
Route::group([
    'middleware' => ['web', 'auth:sanctum', 'verified', 'permission:usa dedir'],
    'namespace' => 'Elamacchia\Dedir\Http\Controllers',
    'prefix' => 'detdir'
] ,function () {
//    Route::group(['namespace' => 'Elamacchia\Dedir\Http\Controllers'], function () {
//        Route::get('detdir', [CompetenzeController::class, 'index']);
//Route::group([
//    'middleware' => ['web','auth','verified','role:amministratore|redattore'], // No 'api' or 'auth:api'
////    'namespace' => 'Elamacchia\Dedir\Http\Controllers',
//    'prefix' => 'detdir'
//],
//    function () {

    //Report & Export
        Route::get('/determinazioni/report', [DetermineController::class,'createReportPage'])->name('report');
        Route::get('/determinazioni/report/export2excel', [DetermineController::class,'exportReportToExcel']);
        Route::get('/determinazioni/report/export2csv', [DetermineController::class,'exportReportToCSV']);
        Route::get('/determinazioni/report/export2pdf', [DetermineController::class,'createReportPDF']);
        Route::get('/determinazioni/report/createFilePDF', [DetermineController::class,'downloadPDF']);
    //Determine....
        Route::post('/determinazioni/salva', [DetermineController::class,'save'])->name('saveDetermina');
        Route::get('/determinazioni/crea', [DetermineController::class,'create'])->name('creaDetermina');
        Route::get('/determinazioni/{tipoVista?}', [DetermineController::class,'index'])->name('determine');
        Route::get('/determinazioni/filtered/{tipoVista?}', [DetermineController::class,'show'])->name('determineFiltrate');
        Route::get('/determinazioni/{id}/edit', [DetermineController::class,'edit'])->name('editDetermina');
        Route::patch('/determinazioni/{id}/update', [DetermineController::class,'update']);
        Route::delete('/determinazioni/{id}/delete', [DetermineController::class,'delete']);
    //Competenze...
        Route::get('/competenze', [CompetenzeController::class,'index'])->name('competenze');
        Route::get('/competenze/crea', [CompetenzeController::class,'create'])->name('creaCompetenza');
        Route::get('/competenze/{id}/edit', [CompetenzeController::class,'edit'])->name('editCompetenza');
        Route::post('/competenze/salva', [CompetenzeController::class,'store'])->name('saveCompetenza');
        Route::patch('/competenze/{id}/update', [CompetenzeController::class,'update']);
        Route::delete('/competenze/{id}/delete', [CompetenzeController::class,'destroy']);
    });

//Route::get('detdir',function (){
//    return view('dedir::index');
//});
