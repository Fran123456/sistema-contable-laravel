<?php

use App\Http\Controllers\SociosdeNegocio\CargoController;
use App\Http\Controllers\SociosDeNegocio\ContactoController;

//Rutas de contactos
Route::name('socios.')->prefix('socios')->group(function () {
    Route::resource('contacto', ContactoController::class);
});

//Rutas de cargos
Route::name('socios.')->prefix('socios')->group(function (){
    Route::resource('cargo', CargoController::class);
});

