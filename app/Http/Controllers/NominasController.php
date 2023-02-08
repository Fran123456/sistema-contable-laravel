<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Help\HttpClient;

class NominasController extends Controller
{
    public function dashboard(Request $request){

        $tipos =HttpClient::post('api/tipos/tipo-posts');
        $blogs = HttpClient::get('api/post/ultimos/9');
        return view('nominas.dashboard');

    }

    public function boletasPago(){

        return view('nominas.boletas.boletas');
    }

    public function boletaPago($id){

        return view('nominas.boletas.boleta', compact('id'));
    }

    public function firmarBoleta($id){

    }
}
