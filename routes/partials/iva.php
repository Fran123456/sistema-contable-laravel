<?php
use App\Http\Controllers\Iva\ReporteCompraController;

Route::middleware(['auth'])->group(function () {
    Route::name('iva.')->prefix('iva')->group(function () {
        Route::get('/reporte-libro-compra', [ReporteCompraController::class, 'index'])->name('reporteLibroCompra.index');

        Route::get('/reporte-libro-compra-pdf', [ReporteCompraController::class, 'getReporteLibroCompra'])->name('reportePdf');

    });

});