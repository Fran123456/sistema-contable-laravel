<?php
use App\Http\Controllers\user\UserController;
use App\Http\Controllers\user\LogController;

Route::resource('users', UserController::class);
Route::name('users')->prefix('users')->group(function () {
    Route::post('/change-password/{id}', [UserController::class, 'updatePassword'])->name('.updatePassword');
    Route::get('/disable-user/{id}', [UserController::class, 'disableUser'])->name('.disableUser');

    Route::post('/empresa', [UserController::class, 'agregarEmpresa'])->name('.agregarEmpresa');
    Route::get('/empresa/{id}/{empresa_id}', [UserController::class, 'eliminarEmpresa'])->name('.eliminarEmpresa');

});
Route::resource('logs', LogController::class);