<?php
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\Configuracion\ProvisionEmpresaController;

route::name('configuracion.')->prefix('configuracion')->group(function () {
    Route::resource('provisiones', ProvisionEmpresaController::class);
});
?>