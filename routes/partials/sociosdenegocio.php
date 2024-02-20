<?php

use App\Http\Controllers\SociosDeNegocio\ContactoController;

Route::name('socios.')->prefix('socios')->group(function () {
    Route::resource('contacto', ContactoController::class);
});

