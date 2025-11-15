<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SchoolYearController;
use App\Http\Controllers\SemesterController;

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('admin')->group(function () {
    Route::get('/', function () {
        return view('welcome');
    });

    Route::prefix('semesters')->controller(SemesterController::class)->group(function () {
        Route::post('/{semester}/activate', 'activate')->name('semesters.activate');
    });
});
