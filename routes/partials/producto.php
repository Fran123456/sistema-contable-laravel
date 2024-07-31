<?php
use App\Http\Controllers\Producto\CategoriaController;
use App\Http\Controllers\Producto\ProductoController;
use App\Http\Controllers\Producto\ProductoProveedorController;
use App\Http\Controllers\Producto\ServicioController;
use App\Http\Controllers\Producto\PrecioController;
use App\Http\Controllers\Producto\ComboController;

Route::middleware(['auth'])->group(function () {
    Route::name('producto.')->prefix("producto")->group(function () {
        Route::resource('categoria', CategoriaController::class);
        Route::resource('producto', ProductoController::class);
        Route::resource('servicio', ServicioController::class);
        Route::resource('precio', PrecioController::class);
        Route::resource('combo', ComboController::class);
        
        //Elimina la categoria que esta asociada al producto
        Route::delete('eliminarCategoria/{producto}/{categoria}', [ProductoController::class, 'eliminarCategoria'])->name('eliminarCategoria');
    });

    //Rutas para asociar productos a proveedores
    Route::name('producto.')->prefix("producto")->group(function () {
        Route::resource('producto_proveedor', ProductoProveedorController::class);
    });
});

