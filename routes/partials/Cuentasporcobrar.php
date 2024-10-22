<?php

use App\Http\Controllers\Cuentasporcobrar\CuentasPorCobrarController;

    
Route::middleware(['auth'])->group(function () {

    Route::name('CuentasPorcobrar.')->prefix('CuentasPorcobrar')->group(function () {
        Route::get('/listar', [CuentasPorCobrarController::class, 'index'])->name('listar-cuentas');
        
    });

});