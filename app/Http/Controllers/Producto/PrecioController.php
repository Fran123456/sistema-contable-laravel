<?php

namespace App\Http\Controllers\Producto;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PrecioController extends Controller{

    public function index()
    {
        return view('producto.precio.index');
    }
}