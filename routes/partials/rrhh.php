<?php

use App\Http\Controllers\RRHH\AfpController;
use App\Http\Controllers\RRHH\ReportesRRHHController;
use App\Http\Controllers\RRHH\PermisoController;
use App\Http\Controllers\RRHH\AreaController;
use App\Http\Controllers\RRHH\EmpresaController;
use App\Http\Controllers\RRHH\EmpleadoController;
use App\Http\Controllers\RRHH\DepartamentoController;
use App\Http\Controllers\RRHH\IncapacidadController;
use App\Http\Controllers\RRHH\IngresoController;
use App\Http\Controllers\RRHH\PeriodoPlanillaController;
use App\Http\Controllers\RRHH\PuestoController;



Route::middleware(['auth'])->group(function () {

    //Rutas de RRHH Departamentos
    Route::resource('departamento', DepartamentoController::class);

    Route::name('rrhh.')->prefix('rrhh')->group(function () {
        Route::resource('empresa', EmpresaController::class);
        Route::resource('empleado', EmpleadoController::class);
        Route::get('/empresa/cambio/{id}', [EmpresaController::class, 'cambioEmpresa'])->name('cambioEmpresa');
        Route::get('/empleado/cambio/{id}', [EmpresaController::class, 'cambioEmpleado'])->name('cambioEmpleado');

        //Rutas de RRHH Areas
        Route::resource('area', AreaController::class);
        //Rutas de RRHH Puetos
        Route::resource('puesto', PuestoController::class);
        //Rutas de RRHH Departamentos
        Route::resource('departamento', DepartamentoController::class);
    });
        // REPORTES
        Route::name('rrhh.')->prefix('rrhh')->group(function () {
            Route::get('/reportes/incapacidades', [ReportesRRHHController::class, 'reporteIncapacidades'])->name('reporteIncapacidades');
            Route::get('/reportes/permisos', [ReportesRRHHController::class, 'reportePermisos'])->name('reportePermisos');
        });

        Route::name('rrhh.')->prefix('rrhh')->group(function(){
            Route::resource('afp', AfpController::class);
            Route::get('/afp/edit/{id}', [AfpController::class, 'edit'])->name('editarAFP');
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

    // INCAPACIDADES
    Route::name('rrhh.')->prefix('rrhh')->group(function () {
        Route::resource('incapacidad', IncapacidadController::class);
        Route::get('/incapacidad', [IncapacidadController::class,'index'])->name('obtenerIncapacidades');
        Route::get('/incapacidad/edit/{id}', [IncapacidadController::class,'edit'])->name('editIncapacidad');
        // Route::get('/incapacidad/edit/{id}', [IncapacidadController::class,'edit'])->name('editarIncapacidad');
    });

    Route::name('rrhh.')->prefix('rrhh')->group(function () {
        Route::resource('permisos', PermisoController::class);
        // Route::get('/permiso', [PermisoController::class, 'index'])->name('obtenerPermiso');
        Route::get('/permisos/edit/{id}', [PermisoController::class, 'edit'])->name('editPermiso');
    });

    // REPORTES
    Route::name('rrhh.')->prefix('rrhh')->group(function () {
        Route::get('/reportes/incapacidades', [ReportesRRHHController::class, 'reporteIncapacidades'])->name('reporteIncapacidades');
    });


    //Ruta que ejecuta el codigo javascript para obtener el departamento correcto
    Route::name('rrhh.')->prefix('rrhh')->group(function () {
        Route::get('/obtener-departamentos/{areaId}',[PuestoController::class, 'obtenerDepartamentos'])->name('.obtenerDepartamentos');
        Route::get('/obtener-departamentos/{areaId}',[EmpleadoController::class, 'obtenerDepartamentos'])->name('.obtenerDepartamentos');
        Route::get('/obtener-cargos/{departamentoId}',[EmpleadoController::class, 'obtenerCargos'])->name('.obtenerCargos');
    });

});


Route::name('rrhh.')->prefix('rrhh')->group(function(){
    Route::resource('ingreso', IngresoController::class);
    Route::get('/ingreso/edit/{id}', [IngresoController::class, 'edit'])->name('editarIngreso');

});

