<?php

use Illuminate\Support\Facades\Route;
use Modules\Walas\Http\Controllers\WalasController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('walas', WalasController::class)->names('walas');
});
