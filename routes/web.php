<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\user\MeController;
use App\Http\Controllers\user\TeamController;
use App\Http\Controllers\user\UserController;
use App\Http\Controllers\user\SettingController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect()->route('login');
});

/*Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});*/

Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');


Route::group(['prefix' => 'usuarios'], function() {
    Route::get('/me', [MeController::class, 'me'])->name('me');
    Route::put('/me/update', [MeController::class, 'updateMe'])->name('updateMe');
    Route::put('/me/team/{id}', [TeamController::class, 'updateTeam'])->name('updateTeamMe');
    Route::get('/me/team/{id}', [TeamController::class, 'team'])->name('teamMe');
    Route::get('/me/team/{id}/invited/{user_id}', [TeamController::class, 'sendInvitation'])->name('sendInvitation');
    Route::get('/me/team/{id}/invited/cancel/{id_user_invitation}', [TeamController::class, 'cancelInvitation'])->name('cancelInvitation');
    Route::get('/me/team/invitations/home', [TeamController::class, 'invitations'])->name('invitations');
    Route::get('/me/team/invitations/acepting/{id}', [TeamController::class, 'aceptingInvitation'])->name('aceptingInvitation');
    Route::get('/me/team/{id}/delete-user/{user_id}', [TeamController::class, 'removeUser'])->name('removeUser');
})->middleware('auth:sanctum');


Route::resource('users', UserController::class); 
Route::name('users')->prefix('users')->group(function () {
    Route::post('/change-password/{id}', [UserController::class, 'updatePassword'])->name('.updatePassword');
    Route::get('/disable-user/{id}', [UserController::class, 'disableUser'])->name('.disableUser');
});


Route::name('settings')->prefix('settings')->group(function () {
    Route::get('/', [SettingController::class, 'settings'])->name('.settings');
    Route::put('/update/{id}', [SettingController::class, 'updateSetting'])->name('.updateSetting');
});
