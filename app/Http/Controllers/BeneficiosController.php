<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Help\HttpClient;
use App\Help\Tienda;

class BeneficiosController extends Controller
{
    public function dashboard(){

        return view('beneficios.dashboard');
    }

   //TIENDA
    public function catalogoTienda(){
        $productos = Tienda::productos();
        return view('beneficios.tienda.tienda', compact('productos'));
    }

    public function detalleProducto($id){
        $producto = Tienda::producto($id);
        return view('beneficios.tienda.producto', compact('producto'));
    }

    public function carrito(){
       return view('beneficios.tienda.carrito');
    }

     //TIENDA
}
