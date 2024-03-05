<?php

use App\Http\Controllers\SociosdeNegocio\CargoController;
use App\Http\Controllers\SociosdeNegocio\ContactoController;
use App\Http\Controllers\SociosdeNegocio\RegistroController;
use App\Http\Controllers\SociosdeNegocio\ProveedoresController;


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
});


