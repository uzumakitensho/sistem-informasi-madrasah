<?php

use Illuminate\Support\Facades\Route;
use Modules\TahunAjaran\Http\Controllers\TahunAjaranController;

Route::prefix('admin')->group(function () {
    Route::resource('tahun-ajaran', TahunAjaranController::class)->names('tahun-ajaran');
});
