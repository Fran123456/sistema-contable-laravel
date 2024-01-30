<?php

use App\Http\Controllers\RRHH\AreaController;
use App\Http\Controllers\RRHH\EmpresaController;
use App\Http\Controllers\RRHH\EmpleadoController;
use App\Http\Controllers\RRHH\PeriodoPlanillaController;





Route::name('rrhh.')->prefix('rrhh')->group(function () {
    Route::resource('empresa', EmpresaController::class);
    Route::resource('empleado', EmpleadoController::class);
    Route::get('/empresa/cambio/{id}', [EmpresaController::class, 'cambioEmpresa'])->name('cambioEmpresa');

    //Rutas de RRHH Areas
    Route::resource('area', AreaController::class);
    Route::get('/empleado/cambio/{id}', [EmpresaController::class, 'cambioEmpleado'])->name('cambioEmpleado');
});

// BALANCE DE EMPRESAS
Route::name('rrhh.')->prefix('rrhh')->group(function () {
    Route::resource('periodoPlanilla', PeriodoPlanillaController::class);
    Route::get('/periodo-planilla', [PeriodoPlanillaController::class,'index'])->name('obtenerPeriodos');
    Route::get('/periodo-planilla/edit/{id}', [PeriodoPlanillaController::class,'edit'])->name('editarPeriodo');
});

