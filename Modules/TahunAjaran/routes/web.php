<?php

use Illuminate\Support\Facades\Route;
use Modules\TahunAjaran\Http\Controllers\TahunAjaranController;

Route::prefix('admin')->group(function () {
    Route::prefix('tahun-ajaran')->controller(TahunAjaranController::class)->group(function () {
        Route::get('/', 'index')->name('tahun-ajaran.index');
        Route::get('/create', 'create')->name('tahun-ajaran.create');
        Route::post('/', 'store')->name('tahun-ajaran.store');
        Route::get('/{school_year}/edit', 'edit')->name('tahun-ajaran.edit');
        Route::post('/{school_year}', 'update')->name('tahun-ajaran.update');
        Route::post('/{school_year}/delete', 'destroy')->name('tahun-ajaran.destroy');
    });
});
