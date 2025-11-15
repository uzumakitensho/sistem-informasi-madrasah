<?php

use Illuminate\Support\Facades\Route;
use Modules\Guru\Http\Controllers\GuruController;

Route::prefix('admin')->group(function () {
    Route::prefix('guru')->controller(GuruController::class)->group(function () {
        Route::get('/', 'index')->name('guru.index');
        Route::get('/create', 'create')->name('guru.create');
        Route::post('/', 'store')->name('guru.store');
        Route::get('/{guru}/edit', 'edit')->name('guru.edit');
        Route::post('/{guru}', 'update')->name('guru.update');
        Route::post('/{guru}/delete', 'destroy')->name('guru.destroy');
    });
});
