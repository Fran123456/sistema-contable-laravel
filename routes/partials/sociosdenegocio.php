<?php

use App\Http\Controllers\SociosdeNegocio\CargoController;
use App\Http\Controllers\SociosdeNegocio\ClasificacionClienteController;
use App\Http\Controllers\SociosdeNegocio\ContactoController;
use App\Http\Controllers\SociosdeNegocio\RegistroController;
use App\Http\Controllers\SociosdeNegocio\ProveedoresController;
use App\Http\Controllers\SociosdeNegocio\ClienteController;

//Rutas públicas
Route::get('/public-contactos/{selected_ids}', [ContactoController::class, 'verContactosCompartidosPublico'])->name('public-contactos');

//Rutas de contactos
Route::middleware(['auth'])->group(function () {
    Route::name('socios.')->prefix('socios')->group(function () {
        Route::resource('contacto', ContactoController::class);
        Route::post('/contacto/seleccionados', [ContactoController::class, 'showSelectedIds'])->name('contacto.seleccionados');
    });

    //Rutas de cargos
    Route::name('socios.')->prefix('socios')->group(function () {
        Route::resource('cargo', CargoController::class);
    });

    //Ruta de registros
    Route::name('socios.')->prefix('socios')->group(function () {
        Route::resource('registro', RegistroController::class);
    });

    //Ruta de Proveedores
    Route::name('socios.')->prefix('socios')->group(function () {
        Route::resource('proveedores', ProveedoresController::class);
        Route::get('/deshabilitar-proveedor/{id}', [ProveedoresController::class, 'deshabilitarProveedor'])->name('.deshabilitarProveedor');
        Route::get('/habilitar-proveedor/{id}', [ProveedoresController::class, 'habilitarProveedor'])->name('.habilitarProveedor');

        //Ruta para listar y crear  productos asociados a proveedores
        Route::get('/listar-producto/{id}', [ProveedoresController::class, 'listarProductos'])->name('listarProductos');
    });

    //Ruta de clasificacion de clientes
    Route::name('socios.')->prefix('socios')->group(function () {
        Route::resource('clasificacion', ClasificacionClienteController::class);
    });

    //Ruta de clientes
    Route::name('socios.')->prefix('socios')->group(function () {
        Route::resource('cliente', ClienteController::class);
    });

    //Ruta que ejecuta el codigo javascript para obtener el departamento y distrito correcto
    Route::name('socios.')->prefix('socios')->group(function () {
        Route::get('/obtener-departamentos/{paisId}', [ClienteController::class, 'obtenerDepartamentos'])->name('.obtenerDepartamentos');
        Route::get('/obtener-distritos/{departamentoId}', [ClienteController::class, 'obtenerDistritos'])->name('.obtenerDistritos');
    });
    //Ruta para habilitar y deshabilitar un cliente
    Route::name('socios')->prefix('socios')->group(function () {
        Route::get('/deshabilitar-cliente/{id}', [ClienteController::class, 'deshabilitarCliente'])->name('.deshabilitarCliente');
        Route::get('/habilitar-cliente/{id}', [ClienteController::class, 'habilitarCliente'])->name('.habilitarCliente');
    });
});

// Ejemplo en un framework como Laravel
Route::get('/formulario-producto-proveedor/{id}', [ProveedoresController::class, 'viewFormProveedor'])->name('viewFormProveedor');
Route::put('/formulario-productoProveedor-update/{id}', [ProveedoresController::class, 'updateFormProveedor'])->name('updateFormProveedor');