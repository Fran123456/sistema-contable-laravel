<?php

use App\Http\Controllers\Iva\LibroCompraController;
use App\Http\Controllers\Iva\ReporteCompraController;

Route::middleware(['auth'])->group(function () {
    Route::name('iva.')->prefix('iva')->group(function () {
        Route::resource('libro_compras', LibroCompraController::class);
        Route::get('/reporte-libro-compra', [ReporteCompraController::class, 'index'])->name('reporteLibroCompra.index');

        Route::get('/reporte-libro-compra-pdf', [ReporteCompraController::class, 'getReporteLibroCompra'])->name('reportePdf');

        Route::get('/reporte-libro-compra-excel', [ReporteCompraController::class, 'getReporteLibroCompra'])->name('reporteExcel');

    });

});