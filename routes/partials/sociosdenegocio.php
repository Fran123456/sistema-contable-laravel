<?php

use App\Http\Controllers\SociosdeNegocio\CargoController;
use App\Http\Controllers\SociosdeNegocio\ClasificacionClienteController;
use App\Http\Controllers\SociosdeNegocio\ContactoController;
use App\Http\Controllers\SociosdeNegocio\RegistroController;
use App\Http\Controllers\SociosdeNegocio\ProveedoresController;
use App\Http\Controllers\SociosdeNegocio\ClienteController;

//Rutas de contactos
Route::middleware(['auth'])->group(function () {
    Route::name('socios.')->prefix('socios')->group(function () {
        Route::resource('contacto', ContactoController::class);

        
    });

    //Rutas de cargos
    Route::name('socios.')->prefix('socios')->group(function (){
        Route::resource('cargo', CargoController::class);
    });

    //Ruta de registros
    Route::name('socios.')->prefix('socios')->group(function (){
        Route::resource('registro', RegistroController::class);
    });

    //Ruta de Proveedores
    Route::name('socios.')->prefix('socios')->group(function (){
        Route::resource('proveedores', ProveedoresController::class);
    });

    //Ruta de clasificacion de clientes
    Route::name('socios.')->prefix('socios')->group(function (){
        Route::resource('clasificacion', ClasificacionClienteController::class);
    });

    //Ruta de clientes
    Route::name('socios.')->prefix('socios')->group(function (){
        Route::resource('cliente', ClienteController::class);
    });

    //Ruta que ejecuta el codigo javascript para obtener el departamento y distrito correcto
    Route::name('socios.')->prefix('socios')->group(function () {
        Route::get('/obtener-departamentos/{paisId}',[ClienteController::class, 'obtenerDepartamentos'])->name('.obtenerDepartamentos');
        Route::get('/obtener-distritos/{departamentoId}',[ClienteController::class, 'obtenerDistritos'])->name('.obtenerDistritos');
    });
    //Ruta de clientes
    Route::name('socios')->prefix('socios')->group(function (){
        Route::get('/deshabilitar-cliente/{id}', [ClienteController::class, 'deshabilitarCliente'])->name('.deshabilitarCliente');
    });
    
});


