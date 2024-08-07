<?php
use App\Http\Controllers\user\UserController;
use App\Http\Controllers\user\LogController;
use App\Http\Controllers\user\MeController;
use App\Http\Controllers\user\TeamController;


Route::group(['prefix' => 'usuarios'], function() {

    Route::middleware(['auth'])->group(function () {

        Route::get('/me', [MeController::class, 'me'])->name('me');
        Route::put('/me/update', [MeController::class, 'updateMe'])->name('updateMe');
        Route::put('/me/team/{id}', [TeamController::class, 'updateTeam'])->name('updateTeamMe');
        Route::get('/me/team/{id}', [TeamController::class, 'team'])->name('teamMe');
        Route::get('/me/team/{id}/invited/{user_id}', [TeamController::class, 'sendInvitation'])->name('sendInvitation');
        Route::get('/me/team/{id}/invited/cancel/{id_user_invitation}', [TeamController::class, 'cancelInvitation'])->name('cancelInvitation');
        Route::get('/me/team/invitations/home', [TeamController::class, 'invitations'])->name('invitations');
        Route::get('/me/team/invitations/acepting/{id}', [TeamController::class, 'aceptingInvitation'])->name('aceptingInvitation');
        Route::get('/me/team/{id}/delete-user/{user_id}', [TeamController::class, 'removeUser'])->name('removeUser');
    
        Route::resource('users', UserController::class);
        Route::name('users')->prefix('users')->group(function () {
            Route::post('/change-password/{id}', [UserController::class, 'updatePassword'])->name('.updatePassword');
            Route::get('/disable-user/{id}', [UserController::class, 'disableUser'])->name('.disableUser');
    
            Route::post('/empresa', [UserController::class, 'agregarEmpresa'])->name('.agregarEmpresa');
            Route::get('/empresa/{id}/{empresa_id}', [UserController::class, 'eliminarEmpresa'])->name('.eliminarEmpresa');
    
        });
        Route::resource('logs', LogController::class);
    });
  


})->middleware('auth');




