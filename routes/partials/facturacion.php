<?php

use App\Http\Controllers\Facturacion\DocumentoElectronicoController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Facturacion\FacturacionController;
use App\Http\Controllers\Facturacion\SerialDocumentoController;
use PHPUnit\TextUI\XmlConfiguration\Group;
use App\Http\Controllers\Facturacion\PartidasAutomaticasController;


Route::middleware(['auth'])->group(function () {
    Route::get('/facturacion', [FacturacionController::class, 'index'])->name('facturacion.index');
    Route::post('/facturacion', [FacturacionController::class, 'store'])->name('facturacion.store');
    Route::get('/facturacion/items/facturar/{id}', [FacturacionController::class, 'agregarItemsFactura'])->name('facturacion.agregarItemsFactura');
    Route::post('/facturacion/items/post', [FacturacionController::class, 'facturarItems'])->name('facturacion.postItemsFactura');
    Route::post('/facturacion/facturar/post', [FacturacionController::class, 'facturar'])->name('facturacion.facturar');
    Route::post('/facturacion/anular', [FacturacionController::class, 'anularFacturacion'])->name('facturacion.anular');
    

    //rutas de facturacion electronica
    Route::resource('facturacionElectronica',DocumentoElectronicoController::class);

    // rutas de serial doumento
    Route::prefix('serial-facturacion')->name('serial-facturacion.')->group(function () {
        Route::get('/', [SerialDocumentoController::class, 'index'])->name('index');
        Route::post('/store', [SerialDocumentoController::class, 'store'])->name('store');
        Route::put('/{id}', [SerialDocumentoController::class, 'update'])->name('update');
        Route::delete('/{id}', [SerialDocumentoController::class, 'destroy'])->name('destroy');
    });

    Route::prefix('partidasAutomaticas')->name('partidasAutomaticas.')->group( function(){
        Route::get('/partidas-automaticas', [PartidasAutomaticasController::class, 'index'])->name('index');
        Route::put('/partidas-automaticas/update/{id}', [PartidasAutomaticasController::class, 'update'])->name('update');
    });
});