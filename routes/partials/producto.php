<?php
use App\Http\Controllers\Producto\CategoriaController;
use App\Http\Controllers\Producto\ProductoController;

Route::middleware(['auth'])->group(function () {
    Route::name('producto.')->prefix("producto")->group(function () {
        Route::resource('categoria', CategoriaController::class);
        Route::resource('producto', ProductoController::class);
        //Elimina la categoria que esta asociada al producto
        Route::delete('eliminarCategoria/{producto}/{categoria}', [ProductoController::class, 'eliminarCategoria'])->name('eliminarCategoria');
    });
});
