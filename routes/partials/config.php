
<?php

use App\Http\Controllers\user\ReporteController;

Route::name('reportes.')->prefix('rrhh')->group(function () {
    Route::resource('permisos', ReporteController::class); 

});
