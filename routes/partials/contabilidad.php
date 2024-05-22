<?php

use App\Http\Controllers\Contabilidad\BalanceContableController;
use App\Http\Controllers\Contabilidad\TipoPartidaController;
use App\Http\Controllers\Contabilidad\PeriodoContableController;
use App\Http\Controllers\Contabilidad\CuentaContableController;
use App\Http\Controllers\Contabilidad\ConfiguracionController;
use App\Http\Controllers\Contabilidad\PartidasContablesController;
use App\Http\Controllers\Contabilidad\ReportesContablesController;
use App\Http\Controllers\Contabilidad\BalanceConfiguracionController;



Route::middleware(['auth'])->group(function () {

    //PERIODOS
    Route::name('contabilidad.')->prefix('contabilidad')->group(function () {
        Route::resource('periodos', PeriodoContableController::class);
    });

    //TIPO DE PARTIDAS
    Route::name('contabilidad.')->prefix('contabilidad')->group(function () {
        Route::resource('tipos-de-partida', TipoPartidaController::class);
    });

    //CUENTAS CONTABLES
    Route::name('contabilidad.')->prefix('contabilidad')->group(function () {
        Route::resource('cuentas-contables', CuentaContableController::class);
    });

    //IMPORTAR CATALOGOS
    Route::name('contabilidad.')->prefix('contabilidad')->group(function () {
        Route::get('/copiar/data', [ConfiguracionController::class, 'indexCopiarInformacionContable'])->name('copiar-data');
        Route::post('/copiar/data', [ConfiguracionController::class, 'copiarInformacionContable'])->name('copiar-data-store');

        Route::get('/importar/excel', [CuentaContableController::class, 'importarCuentasExcelView'])->name('importarCuentasExcelView');
        Route::post('/importar/excel', [CuentaContableController::class, 'importarCuentasExcel'])->name('importarCuentasExcel');
   
        Route::post('/importar/partida/excel', [PartidasContablesController::class, 'importarPartidasExcel'])->name('importarPartidasExcel');
    });

    //PARTIDAS CONTABLES
    Route::name('contabilidad.')->prefix('contabilidad')->group(function () {
        Route::resource('partidas', PartidasContablesController::class);
        Route::get('/partida/partidas', [PartidasContablesController::class, 'obtenerCorrelativoAjax'])->name('obtenerCorrelativoAjax');
        //Route::get('/correlativo/partidas', [PartidasContablesController::class, 'obtenerCorrelativoAjax'])->name('obtenerCorrelativoAjax');
        Route::get('/partida/cerrar/{id}', [PartidasContablesController::class, 'cerrarPartida'])->name('cerrarPartida');
        Route::get('/partida/reporte/{id}', [PartidasContablesController::class, 'reportePartidaContable'])->name('reportePartidaContable');
        Route::delete('/partida/detalle/eliminar/{id}', [PartidasContablesController::class, 'eliminarDetallePartida'])->name('eliminarDetallePartida');

    });

    //REPORTES CONTABLES
    Route::name('contabilidad.')->prefix('contabilidad')->group(function () {
        Route::get('/reportes', [ReportesContablesController::class, 'reportes'])->name('reportes');
        Route::get('/reportes/saldo-cuenta', [ReportesContablesController::class, 'reporteSaldoCuenta'])->name('reporteSaldoCuenta');
        Route::get('/reportes/libro-diario', [ReportesContablesController::class, 'reporteLibroDiario'])->name('reporteLibroDiario');
        Route::get('/reportes/balance-comprobacion', [ReportesContablesController::class, 'reporteBalanceComprobacion'])->name('reporteBalanceComprobacion');
        Route::get('/reportes/listado-partidas-contables', [ReportesContablesController::class, 'listadoDePartidas'])->name('listadoDePartidas');
        Route::get('/reportes/libro-diario-mayor', [ReportesContablesController::class, 'libroDiarioMayor'])->name('libroDiarioMayor');

        Route::get('/reportes/estado-resultado', [ReportesContablesController::class, 'reporteEstadoResultado'])->name('reporteEstadoResultado');


    });

    // BALANCE DE EMPRESAS
    Route::name('contabilidad.')->prefix('contabilidad')->group(function () {
        Route::resource('balance', BalanceContableController::class);
        Route::get('/balance', [BalanceContableController::class, 'index'])->name('obtenerBalance');
        Route::get('/balance/edit/{id}', [BalanceContableController::class, 'edit'])->name('editarBalance');
    });

    // CONFIGURACION DE CONTABILIDAD
    Route::name('contabilidad.')->prefix('contabilidad')->group(function () {
        Route::get('/configuracion', [BalanceConfiguracionController::class, 'index'])->name('configuracion');
        Route::get('/configuracion/edit/{id}', [BalanceConfiguracionController::class, 'edit'])->name('editarConfiguracion');
        Route::put('/configuracion/update/{id}', [BalanceConfiguracionController::class, 'update'])->name('updateConfiguracion');

    });


});
