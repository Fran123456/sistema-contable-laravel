<?php

use App\Http\Controllers\Contabilidad\TipoPartidaController;
use App\Http\Controllers\Contabilidad\PeriodoContableController;
use App\Http\Controllers\Contabilidad\CuentaContableController;


Route::name('contabilidad.')->prefix('contabilidad')->group(function () {
    Route::resource('periodos', PeriodoContableController::class); 
});

Route::name('contabilidad.')->prefix('contabilidad')->group(function () {
    Route::resource('tipos-de-partida', TipoPartidaController::class); 
});


Route::name('contabilidad.')->prefix('contabilidad')->group(function () {
    Route::resource('cuentas-contables', CuentaContableController::class); 
});
