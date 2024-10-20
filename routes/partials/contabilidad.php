<?php

use App\Http\Controllers\Contabilidad\TipoPartidaController;
use App\Http\Controllers\Contabilidad\ConfiguracionController;
use App\Http\Controllers\Contabilidad\CuentaContableController;
use App\Http\Controllers\Contabilidad\BalanceContableController;
use App\Http\Controllers\Contabilidad\ContaRubroGrupoController;
use App\Http\Controllers\Contabilidad\PeriodoContableController;
use App\Http\Controllers\Contabilidad\ContaRubroGeneralController;
use App\Http\Controllers\Contabilidad\PartidasContablesController;
use App\Http\Controllers\Contabilidad\ReportesContablesController;
use App\Http\Controllers\Contabilidad\BalanceConfiguracionController;
use App\Http\Controllers\Contabilidad\EstadoResultado\CuentaResultado;
use App\Http\Controllers\Contabilidad\EstadoResultado\UtilidadController;
use App\Http\Controllers\Contabilidad\EstadoResultado\GrupoResultadoController;
use App\Http\Controllers\Contabilidad\EstadoResultado\CuentaResultadoController;
use App\Http\Controllers\Contabilidad\EstadoResultado\SubGrupoResultadoController;
use App\Http\Controllers\Contabilidad\EstadoResultado\UtilidadOperacionController;
use App\Http\Controllers\Contabilidad\ContaRubroCuentaController;

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
        Route::post('/partida/detalle/actualizar/{id}', [PartidasContablesController::class, 'actualizarDetallePartida'])->name('actualizarDetallePartida');
        Route::delete('/partida/detalle/eliminar/{id}', [PartidasContablesController::class, 'eliminarDetallePartida'])->name('eliminarDetallePartida');
        Route::post('/partida/duplicar', [PartidasContablesController::class, 'duplicar'])->name('duplicarPartida');

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
        Route::get('/reportes/estado-resultado-nuevo', [ReportesContablesController::class, 'reporteEstadoResultadoNuevo'])->name('reporteEstadoResultadoNuevo');


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

    //CONFIGURACION DE ESTADO DE RESULTADO DE UTILIDAD
    Route::name('contabilidad.')->prefix('contabilidad')->group(function () {
        Route::resource('utilidades', UtilidadController::class);
        Route::get('/utilidadOperaciones/{utilidad_id}', [UtilidadOperacionController::class, 'index'])->name('utilidadOperaciones.index');
        Route::post('/utilidadOperaciones/{utilidad_id}', [UtilidadOperacionController::class, 'store'])->name('utilidadOperaciones.store');
        Route::delete('/utilidadOperaciones/{utilidad_id}/{id}', [UtilidadOperacionController::class, 'destroy'])->name('utilidadOperaciones.destroy');
        Route::get('/grupoResultado/{utilidad_id}', [GrupoResultadoController::class, 'index'])->name('grupoResultado.index');
        Route::post('/grupoResultado/{utilidad_id}', [GrupoResultadoController::class, 'store'])->name('grupoResultado.store');
        Route::put('/grupoResultado/{utilidad_id}/{id}', [GrupoResultadoController::class, 'update'])->name('grupoResultado.update');
        Route::delete('/grupoResultado/{utilidad_id}/{id}', [GrupoResultadoController::class, 'destroy'])->name('grupoResultado.destroy');
        Route::get('/subGrupoResultado/{utilidad_id}/{grupo_id}', [SubGrupoResultadoController::class, 'index'])->name('subGrupoResultado.index');
        Route::post('/subGrupoResultado/{utilidad_id}/{grupo_id}', [SubGrupoResultadoController::class, 'store'])->name('subGrupoResultado.store');
        Route::put('/subGrupoResultado/{utilidad_id}/{grupo_id}/{id}', [SubGrupoResultadoController::class, 'update'])->name('subGrupoResultado.update');
        Route::delete('/subGrupoResultado/{utilidad_id}/{grupo_id}/{id}', [SubGrupoResultadoController::class, 'destroy'])->name('subGrupoResultado.destroy');
        Route::get('/cuentaResultado/{utilidad_id}/{grupo_id}/{sub_grupo_id}', [CuentaResultadoController::class, 'index'])->name('cuentaResultado.index');
        Route::post('/cuentaResultado/{utilidad_id}/{grupo_id}/{sub_grupo_id}', [CuentaResultadoController::class, 'store'])->name('cuentaResultado.store');
        Route::put('/cuentaResultado/{utilidad_id}/{grupo_id}/{sub_grupo_id}/{id}', [CuentaResultadoController::class, 'update'])->name('cuentaResultado.update');
        Route::delete('/cuentaResultado/{utilidad_id}/{grupo_id}/{sub_grupo_id}/{id}', [CuentaResultadoController::class, 'destroy'])->name('cuentaResultado.destroy');
    });

    //CONFIGURACION RUBRO GENERAL
    Route::name('contabilidad.')->prefix('contabilidad')->group(function () {
        Route::resource('rubros', ContaRubroGeneralController::class);

        Route::get('rubros/{rubro}/grupos', [ContaRubroGrupoController::class, 'index'])->name('grupos.index');
        Route::post('rubros/{rubro}/grupos', [ContaRubroGrupoController::class, 'store'])->name('grupos.store');
        Route::put('grupos/{grupo}', [ContaRubroGrupoController::class, 'update'])->name('grupos.update');
        Route::delete('grupos/{grupo}', [ContaRubroGrupoController::class, 'destroy'])->name('grupos.destroy');

        Route::get('rubros/{rubro}/grupos/{grupo}/cuentas-contables',[ContaRubroCuentaController::class, 'index'])->name('grupo.cuentaContable.index');
        Route::post('rubros/{rubro}/grupos/{grupo}/cuentas-contables',[ContaRubroCuentaController::class, 'store'])->name('grupo.cuentaContable.store');
        Route::put('grupo/cuenta-contable-asociada/{id}',[ContaRubroCuentaController::class, 'update'])->name('grupo.cuentaContable.update');
        Route::delete('grupo/cuenta-contable-asociada/delete/{id}',[ContaRubroCuentaController::class, 'destroy'])->name('grupo.cuentaContable.destroy');


    });
});
