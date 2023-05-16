<?php

use App\Http\Controllers\RRHH\EmpresaController;





Route::name('rrhh.')->prefix('rrhh')->group(function () {
    Route::resource('empresa', EmpresaController::class); 
    Route::get('/empresa/cambio/{id}', [EmpresaController::class, 'cambioEmpresa'])->name('.cambioEmpresa');

    
});
