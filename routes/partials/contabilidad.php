<?php

use App\Http\Controllers\Contabilidad\TipoPartidaController;
use App\Http\Controllers\Contabilidad\PeriodoContableController;
use App\Http\Controllers\Contabilidad\CuentaContableController;
use App\Http\Controllers\Contabilidad\ConfiguracionController;
use App\Http\Controllers\Contabilidad\PartidasContablesController;
use App\Http\Controllers\Contabilidad\ReportesContablesController;


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
});

//PARTIDAS CONTABLES
Route::name('contabilidad.')->prefix('contabilidad')->group(function () {
    Route::resource('partidas', PartidasContablesController::class);
    Route::get('/correlativo/partidas', [PartidasContablesController::class, 'obtenerCorrelativoAjax'])->name('obtenerCorrelativoAjax');
    Route::get('/partida/cerrar/{id}', [PartidasContablesController::class, 'cerrarPartida'])->name('cerrarPartida');
    Route::get('/partida/reporte/{id}', [PartidasContablesController::class, 'reportePartidaContable'])->name('reportePartidaContable');
    Route::delete('/partida/detalle/eliminar/{id}', [PartidasContablesController::class, 'eliminarDetallePartida'])->name('eliminarDetallePartida');

});

//REPORTES CONTABLES
Route::name('contabilidad.')->prefix('contabilidad')->group(function () {
    Route::get('/reportes', [ReportesContablesController::class, 'reportes'])->name('reportes');
    Route::get('/reportes/saldo-cuenta', [ReportesContablesController::class, 'reporteSaldoCuenta'])->name('reporteSaldoCuenta');
    Route::get('/reportes/libro-diario', [ReportesContablesController::class, 'reporteLibroDiario'])->name('reporteLibroDiario');


});
