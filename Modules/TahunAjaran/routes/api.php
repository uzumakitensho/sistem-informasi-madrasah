<?php

use Illuminate\Support\Facades\Route;
use Modules\TahunAjaran\Http\Controllers\TahunAjaranController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('tahunajarans', TahunAjaranController::class)->names('tahunajaran');
});
