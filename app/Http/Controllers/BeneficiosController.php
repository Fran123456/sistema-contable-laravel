<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Help\HttpClient;

class BeneficiosController extends Controller
{
    public function dashboard(){

        return view('beneficios.dashboard');
    }

    public function catalogoTienda(){

        return view('beneficios.tienda.tienda');
    }

    public function detalleProducto($id){
        return view('beneficios.tienda.producto');
    }

}
