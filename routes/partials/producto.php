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
        Route::post('/producto/{producto}/precio', [ProductoController::class, 'agregarPrecio'])->name('agregarPrecio');
        Route::delete('/producto/{producto}/precio/{precio}', [ProductoController::class, 'eliminarPrecio'])->name('eliminarPrecio');
        Route::resource('servicio', ServicioController::class);
        Route::resource('precio', PrecioController::class);
        Route::resource('combo', ComboController::class);
        Route::post('combo/{combo}/tipo-precio', [ComboController::class, 'storeComboTipoPrecio'])->name('combo.storeComboTipoPrecio');
        Route::patch('combo/tipo-precio/{comboTipoPrecio}', [ComboController::class, 'updateEstadoComboTipoPrecio'])->name('combo.updateEstadoComboTipoPrecio');
        Route::delete('combo/tipo-precio/{comboTipoPrecio}', [ComboController::class, 'destroyComboTipoPrecio'])->name('combo.destroyComboTipoPrecio');
        Route::post('combo/{combo}/producto', [ComboController::class, 'storeComboProducto'])->name('combo.storeComboProducto');
        Route::delete('combo/producto/{comboProducto}', [ComboController::class, 'destroyComboProducto'])->name('combo.destroyComboProducto');
        Route::get('/api/productos/{productoId}/tipos-precios', [ComboController::class, 'getTiposPrecios']);

        
        // Elimina la categoria que esta asociada al producto
        Route::delete('eliminarCategoria/{producto}/{categoria}', [ProductoController::class, 'eliminarCategoria'])->name('eliminarCategoria');
    });

    // Rutas para asociar productos a proveedores
    Route::name('producto.')->prefix("producto")->group(function () {
        Route::resource('producto_proveedor', ProductoProveedorController::class);
    });
});


