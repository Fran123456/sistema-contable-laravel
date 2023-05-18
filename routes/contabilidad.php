<?php

use App\Http\Controllers\Contabilidad\TipoPartidaController;
use App\Http\Controllers\Contabilidad\PeriodoContableController;
use App\Http\Controllers\Contabilidad\CuentaContableController;
use App\Http\Controllers\Contabilidad\ConfiguracionController;

Route::name('contabilidad.')->prefix('contabilidad')->group(function () {
    Route::resource('periodos', PeriodoContableController::class); 
});

Route::name('contabilidad.')->prefix('contabilidad')->group(function () {
    Route::resource('tipos-de-partida', TipoPartidaController::class); 
});


Route::name('contabilidad.')->prefix('contabilidad')->group(function () {
    Route::resource('cuentas-contables', CuentaContableController::class); 
});


Route::name('contabilidad.')->prefix('contabilidad')->group(function () {
    Route::get('/copiar/data', [ConfiguracionController::class, 'indexCopiarInformacionContable'])->name('copiar-data');
    Route::post('/copiar/data', [ConfiguracionController::class, 'copiarInformacionContable'])->name('copiar-data-store');
});
