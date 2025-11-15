<?php

use Illuminate\Support\Facades\Route;
use Modules\TahunAjaran\Http\Controllers\TahunAjaranController;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('tahunajarans', TahunAjaranController::class)->names('tahunajaran');
});
