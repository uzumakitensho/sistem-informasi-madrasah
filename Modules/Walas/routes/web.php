<?php

use Illuminate\Support\Facades\Route;
use Modules\Walas\Http\Controllers\WalasController;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('walas', WalasController::class)->names('walas');
});
