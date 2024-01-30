<?php

use App\Http\Controllers\RRHH\AreaController;
use App\Http\Controllers\RRHH\EmpresaController;
use App\Http\Controllers\RRHH\EmpleadoController;
use App\Http\Controllers\RRHH\DepartamentoController;




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

