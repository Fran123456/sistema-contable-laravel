<?php
use App\Http\Controllers\Producto\CategoriaController;

Route::middleware(['auth'])->group(function () {
    Route::name('producto.')->prefix("producto")->group(function () {
        Route::resource('categoria', CategoriaController::class);

    });
});
