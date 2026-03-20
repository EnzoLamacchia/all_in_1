<?php

use Elamacchia\Excelimport\Http\Controllers\ExcelimportController;
use Elamacchia\Excelimport\Http\Controllers\ImportedDataController;
use Illuminate\Support\Facades\Route;

// Route::group(['middleware' => ['web'], 'prefix' => 'excel-import', 'as' => 'excelimport.'], function () {  // <-- middleware originale (senza auth e permesso)
Route::group(['middleware' => ['web', 'auth:sanctum', 'verified', 'permission:usa excelimport'], 'prefix' => 'excel-import', 'as' => 'excelimport.'], function () {
    Route::get('/', [ExcelimportController::class, 'showImportForm'])->name('form');
    Route::post('/import', [ExcelimportController::class, 'import'])->name('import');
    Route::post('/confirm-overwrite', [ExcelimportController::class, 'confirmOverwrite'])->name('confirm-overwrite');
    Route::get('/result', [ExcelimportController::class, 'showResult'])->name('result');

    Route::get('/tables', [ImportedDataController::class, 'index'])->name('tables.index');
    Route::delete('/tables/{tableName}', [ImportedDataController::class, 'destroy'])->name('tables.destroy');
    Route::get('/tables/{tableName}/edit/{id}', [ImportedDataController::class, 'edit'])->name('tables.edit');
    Route::put('/tables/{tableName}/update/{id}', [ImportedDataController::class, 'update'])->name('tables.update');
});


