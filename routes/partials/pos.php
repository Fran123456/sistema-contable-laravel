<?php

use App\Http\Controllers\POS\FacturacionExpressController;

Route::middleware(['auth'])->group(function () {

    Route::name('pos.')->prefix('pos')->group(function () {
        Route::resource('facturacionexpress', FacturacionExpressController::class);
    });
});