<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;

use App\Http\Controllers\user\RoleController;
use App\Http\Controllers\user\SettingController;
use App\Http\Controllers\RRHH\PuestoController;
use App\Http\Controllers\RRHH\EmpleadoController;
use App\Http\Controllers\SupportController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\NewPasswordController;
use Illuminate\Http\Request;
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

Route::get('forgot-password', function () {
    return view('auth.forgot-password');
})->middleware(['guest'])->name('password.request');

Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])
    ->middleware(['guest'])->name('password.email');

Route::get('reset-password/{token}', function ($token, Request $request) {
    return view('auth.reset-password', [
        'token' => $token,
        'email' => $request->email,
    ]);
})->middleware(['guest'])->name('password.reset');

Route::post('reset-password', [NewPasswordController::class, 'store'])
    ->middleware(['guest'])->name('password.update');

Route::middleware(['auth'])->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');
    Route::name('settings')->prefix('settings')->group(function () {
        Route::get('/', [SettingController::class, 'settings'])->name('.settings');
        Route::put('/update/{id}', [SettingController::class, 'updateSetting'])->name('.updateSetting');
        Route::get('/general', [SettingController::class, 'generalSettings'])->name('.generalSettings');
        Route::get('/{key}', [SettingController::class, 'settingsByKey'])->name('.settingsByKey');
        Route::post('/{id}/change-logo', [SettingController::class, 'changeLogo'])->name('.changeLogo');
    });

    Route::resource('roles', RoleController::class);
    Route::name('roles')->prefix('roles')->group(function () {
        Route::delete('/permissions/destroy/{id}', [RoleController::class, 'destroyPermissions'])->name('.destroyPermissions');
        Route::get('/permissions/destroy/sub/one/{id}', [RoleController::class, 'destroyPermissionOne'])->name('.destroyPermissionOne');
    });

    Route::get('/support', [SupportController::class, 'askView'])->name('support.askView');
    Route::get('/support/chat', [SupportController::class, 'askChat'])->name('support.askChat');
    
    Route::post('/support', [SupportController::class, 'ask'])->name('ask');
});



include('routes/partials/users.php');
include('routes/partials/contabilidad.php');
include('routes/partials/rrhh.php');
include('routes/partials/config.php');
include('routes/partials/sociosdenegocio.php');
include('routes/partials/producto.php');

// include_once __DIR__ . '/partials/users.php';
// include_once __DIR__ . '/partials/contabilidad.php';
// include_once __DIR__ . '/partials/rrhh.php';
// include_once __DIR__ . '/partials/config.php';
// include_once __DIR__ . '/partials/sociosdenegocio.php';
// include_once __DIR__ . '/partials/producto.php';
