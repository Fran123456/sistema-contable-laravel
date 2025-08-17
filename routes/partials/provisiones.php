<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Contabilidad\ProvisionMensualController;

Route::middleware(['auth'])->group(function () {
    Route::get('provisiones/reporte', [ProvisionMensualController::class, 'reporte'])->name('provisiones.reporte');
    Route::post('provisiones/acumular', [ProvisionMensualController::class, 'acumular'])->name('provisiones.acumular');
});
