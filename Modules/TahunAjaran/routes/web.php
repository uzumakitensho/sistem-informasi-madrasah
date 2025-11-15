<?php

use Illuminate\Support\Facades\Route;
use Modules\TahunAjaran\Http\Controllers\TahunAjaranController;

Route::prefix('admin')->group(function () {
    Route::prefix('tahun-ajaran')->controller(TahunAjaranController::class)->group(function () {
        Route::get('/', 'index')->name('tahun-ajaran.index');
        Route::get('/create', 'create')->name('tahun-ajaran.create');
        Route::post('/', 'store')->name('tahun-ajaran.store');
        Route::get('/{th_ajaran}/edit', 'edit')->name('tahun-ajaran.edit');
        Route::post('/{th_ajaran}', 'update')->name('tahun-ajaran.update');
        Route::post('/{th_ajaran}/delete', 'destroy')->name('tahun-ajaran.destroy');
    });
});
