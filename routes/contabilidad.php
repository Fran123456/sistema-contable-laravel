<?php

use App\Http\Controllers\Contabilidad\TipoPartidaController;
use App\Http\Controllers\Contabilidad\PeriodoContableController;



Route::name('contabilidad.')->prefix('contabilidad')->group(function () {
    Route::resource('periodos', PeriodoContableController::class); 
});

Route::name('contabilidad.')->prefix('contabilidad')->group(function () {
    Route::resource('tipos-de-partida', TipoPartidaController::class); 
});
