<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Facturacion\FacturacionController;

Route::middleware(['auth'])->group(function () {
    Route::get('/facturacion', [FacturacionController::class, 'index'])->name('facturacion.index');
});