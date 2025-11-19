<?php

use Illuminate\Support\Facades\Route;
use Modules\Kelas\Http\Controllers\KelasController;

Route::prefix('admin')->group(function () {
    Route::prefix('kelas')->controller(KelasController::class)->group(function () {
        Route::get('/', 'index')->name('kelas.index');
        Route::get('/create', 'create')->name('kelas.create');
        Route::post('/', 'store')->name('kelas.store');
        Route::get('/{kelas}/edit', 'edit')->name('kelas.edit');
        Route::post('/{kelas}', 'update')->name('kelas.update');
        Route::post('/{kelas}/delete', 'destroy')->name('kelas.destroy');
    });
});
