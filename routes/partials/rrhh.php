<?php

use App\Http\Controllers\RRHH\AreaController;
use App\Http\Controllers\RRHH\EmpresaController;
use App\Http\Controllers\RRHH\EmpleadoController;
use App\Http\Controllers\RRHH\DepartamentoController;
use App\Http\Controllers\RRHH\IncapacidadController;
use App\Http\Controllers\RRHH\PeriodoPlanillaController;



Route::middleware(['auth'])->group(function () {


    Route::name('rrhh.')->prefix('rrhh')->group(function () {
        Route::resource('empresa', EmpresaController::class);
        Route::resource('empleado', EmpleadoController::class);
        Route::get('/empresa/cambio/{id}', [EmpresaController::class, 'cambioEmpresa'])->name('cambioEmpresa');
        Route::get('/empleado/cambio/{id}', [EmpresaController::class, 'cambioEmpleado'])->name('cambioEmpleado');

        //Rutas de RRHH Areas
        Route::resource('area', AreaController::class);

        //Rutas de RRHH Departamentos
        Route::resource('departamento', DepartamentoController::class);
    });

    // PERIODO PLANILLA
    Route::name('rrhh.')->prefix('rrhh')->group(function () {
        Route::resource('periodoPlanilla', PeriodoPlanillaController::class);
        Route::get('/periodo-planilla', [PeriodoPlanillaController::class,'index'])->name('obtenerPeriodos');
        Route::get('/periodo-planilla/edit/{id}', [PeriodoPlanillaController::class,'edit'])->name('editarPeriodo');
    });

    // INCAPACIDADES
    Route::name('rrhh.')->prefix('rrhh')->group(function () {
        Route::resource('incapacidad', IncapacidadController::class);
        Route::get('/incapacidad', [IncapacidadController::class,'index'])->name('obtenerIncapacidades');
        Route::get('/incapacidad/create/{id}', [IncapacidadController::class,'create'])->name('crearIncapacidad');
        // Route::get('/incapacidad/edit/{id}', [IncapacidadController::class,'edit'])->name('editarIncapacidad');
    });


});


