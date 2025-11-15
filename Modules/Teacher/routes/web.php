<?php

use Illuminate\Support\Facades\Route;
use Modules\Teacher\Http\Controllers\TeacherController;

Route::prefix('admin')->group(function () {
    Route::prefix('guru')->controller(TeacherController::class)->group(function () {
        Route::get('/', 'index')->name('guru.index');
        Route::get('/create', 'create')->name('guru.create');
        Route::post('/', 'store')->name('guru.store');
        Route::get('/{school_year}/edit', 'edit')->name('guru.edit');
        Route::post('/{school_year}', 'update')->name('guru.update');
        Route::post('/{school_year}/delete', 'destroy')->name('guru.destroy');
    });
});
