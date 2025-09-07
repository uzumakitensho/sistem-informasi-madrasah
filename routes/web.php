<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SchoolYearController;

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('admin')->group(function () {
    Route::get('/', function () {
        return view('welcome');
    });

    Route::prefix('school-years')->controller(SchoolYearController::class)->group(function () {
        Route::get('/', 'index')->name('school-years.index');
        Route::get('/create', 'create')->name('school-years.create');
        Route::post('/', 'store')->name('school-years.store');
        Route::get('/{school_year}/edit', 'edit')->name('school-years.edit');
        Route::post('/{school_year}', 'update')->name('school-years.update');
        Route::post('/{school_year}/delete', 'destroy')->name('school-years.destroy');
    });
});
