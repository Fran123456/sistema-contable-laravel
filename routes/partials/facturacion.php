<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Facturacion\FacturacionController;

Route::middleware(['auth'])->group(function () {
    Route::get('/facturacion', [FacturacionController::class, 'index'])->name('facturacion.index');
    Route::post('/facturacion', [FacturacionController::class, 'store'])->name('facturacion.store');
    Route::get('/facturacion/items/facturar/{id}', [FacturacionController::class, 'agregarItemsFactura'])->name('facturacion.agregarItemsFactura');
    Route::post('/facturacion/items/post', [FacturacionController::class, 'facturarItems'])->name('facturacion.postItemsFactura');

    
});