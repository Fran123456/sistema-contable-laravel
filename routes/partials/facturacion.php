<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Facturacion\FacturacionController;
use App\Http\Controllers\Facturacion\SerialDocumentoController;

Route::middleware(['auth'])->group(function () {
    Route::get('/facturacion', [FacturacionController::class, 'index'])->name('facturacion.index');
    Route::post('/facturacion', [FacturacionController::class, 'store'])->name('facturacion.store');
    Route::get('/facturacion/items/facturar/{id}', [FacturacionController::class, 'agregarItemsFactura'])->name('facturacion.agregarItemsFactura');
    Route::post('/facturacion/items/post', [FacturacionController::class, 'facturarItems'])->name('facturacion.postItemsFactura');
    Route::post('/facturacion/facturar/post', [FacturacionController::class, 'facturar'])->name('facturacion.facturar');

    // rutas de serial doumento
    Route::prefix('serial-facturacion')->name('serial-facturacion.')->group(function () {
        Route::get('/', [SerialDocumentoController::class, 'index'])->name('index');
        Route::post('/store', [SerialDocumentoController::class, 'store'])->name('store');
        Route::put('/{id}', [SerialDocumentoController::class, 'update'])->name('update');
        Route::delete('/{id}', [SerialDocumentoController::class, 'destroy'])->name('destroy');
    });
});