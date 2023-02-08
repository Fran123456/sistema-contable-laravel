<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\NominasController;
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
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});


Route::get('/blog', [BlogController::class, 'dashboard'])->name('blog-dashboard');


Route::get('/nominas', [NominasController::class, 'dashboard'])->name('nominas-dashboard');
Route::get('/nominas/boletas', [NominasController::class, 'boletasPago'])->name('nominas-boletas');
Route::get('/nominas/boleta/{id}', [NominasController::class, 'boletaPago'])->name('nominas-boleta');