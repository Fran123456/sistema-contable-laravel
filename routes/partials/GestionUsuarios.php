<?php

use App\Http\Controllers\GestionUsuarios\UsuariosController;

Route::middleware(['auth'])->prefix('GestionUsuarios')->name('GestionUsuarios.')->group(function () {

    // Listado de usuarios
    Route::get('/index', [UsuariosController::class, 'index'])->name('index');

    // Crear usuario
    Route::get('/create', [UsuariosController::class, 'create'])->name('create');
    Route::post('/store', [UsuariosController::class, 'store'])->name('store');

    // Editar usuario
    Route::get('/edit/{id_usuario}', [UsuariosController::class, 'edit'])->name('edit');
    Route::put('/update/{id_usuario}', [UsuariosController::class, 'update'])->name('update');

    // Mostrar detalle de usuario
    Route::get('/show/{id_usuario}', [UsuariosController::class, 'show'])->name('show');

    // Activar / desactivar usuario
    Route::get('/toggle/{id_usuario}', [UsuariosController::class, 'toggleEstado'])->name('toggleEstado');

    // Asignar usuario a empresa y rol
    Route::post('/asignar/{id_usuario}', [UsuariosController::class, 'asignarEmpresaRol'])->name('asignar');

    // Bloquear funciones específicas
    Route::post('/bloqueos/{id_usuario}', [UsuariosController::class, 'bloquearFunciones'])->name('bloquearFunciones');

    // Bitácora de accesos
    Route::get('/bitacora', [UsuariosController::class, 'bitacora'])->name('bitacora');

    // Login (si lo manejas desde este controlador)
    Route::post('/login', [UsuariosController::class, 'login'])->name('login');
});
