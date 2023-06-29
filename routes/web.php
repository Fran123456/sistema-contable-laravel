<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;

use App\Http\Controllers\user\RoleController;
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
});


include('routes/partials/users.php');
include('routes/partials/contabilidad.php');
include('routes/partials/rrhh.php');
include('routes/partials/config.php');

