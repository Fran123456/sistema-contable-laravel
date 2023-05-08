<?php


use App\Http\Controllers\Contabilidad\PeriodoContableController;



Route::name('contabilidad.')->prefix('contabilidad')->group(function () {
    Route::resource('periodos', PeriodoContableController::class); 
});

