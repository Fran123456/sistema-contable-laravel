<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function obtenerInformacion(Request $request){

        $response = Http::post('http://ccpcatalana.com/api/public/api/tipos/tipo-posts');
        return $response;

    }
}
