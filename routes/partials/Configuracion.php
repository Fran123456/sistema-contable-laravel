<?php

use App\Http\Controllers\Configuracion\GestionEmpresasController;



Route::middleware(['auth'])->group(function () {

    Route::prefix('Configuracion')->group(function () {
    // mostrar index
    Route::get('/gestionempresas', [GestionEmpresasController::class, 'index'])
        ->name('configuracion.gestionempresas.index');
    
    // formulario para añadir
    Route::get('/gestionempresas/crear', [GestionEmpresasController::class, 'create'])
        ->name('configuracion.gestionempresas.create');
    
    // añadir
    Route::post('/gestionempresas', [GestionEmpresasController::class, 'store'])
        ->name('configuracion.gestionempresas.store');
    
    //mostrar formulario para editar
    Route::get('/configuracion/gestionempresas/{empresa}/edit', [GestionEmpresasController::class, 'edit'])
    ->name('configuracion.gestionempresas.edit');
    
    //funcion editar
    Route::put('/configuracion/gestionempresas/{empresa}', [GestionEmpresasController::class, 'update'])
    ->name('configuracion.gestionempresas.update');

    //funcion borrar
    Route::delete('/configuracion/gestionempresas/{empresa}', [GestionEmpresasController::class, 'destroy'])
    ->name('configuracion.gestionempresas.destroy');


    });
});