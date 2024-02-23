<?php
use App\Http\Controllers\Producto\CategoriaController;
Route::name('producto.')->prefix("producto")->group(function () {
    Route::resource('categoria', CategoriaController::class);

});
