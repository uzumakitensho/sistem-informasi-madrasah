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

    Route::resources([
        'school-years' => SchoolYearController::class,
    ]);
});
