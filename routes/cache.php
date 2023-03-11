<?php
use Illuminate\Support\Facades\Route;


Route::group(['prefix' => 'clear'], function() {
    // borrar caché de la aplicación
    Route::get('/clear-cache', function() {
         $exitCode = Artisan::call('cache:clear');
         return 'Application cache cleared';
    });
 
      // borrar caché de ruta
    Route::get('/route-cache', function() {
         $exitCode = Artisan::call('route:cache');
         return 'Routes cache cleared';
    });
 
     // borrar caché de configuración
    Route::get('/config-cache', function() {
         $exitCode = Artisan::call('config:cache');
         return 'Config cache cleared';
    }); 
 
     // borrar caché de vista
    Route::get('/view-clear', function() {
         $exitCode = Artisan::call('view:clear');
         return 'View cache cleared';
    });
 
    Route::get('/', function() {
         $exitCode = Artisan::call('cache:clear');
         $exitCode = Artisan::call('route:cache');
         $exitCode = Artisan::call('view:clear');
         $exitCode = Artisan::call('config:cache');
         return 'Cache cleared';
    });
     
 });