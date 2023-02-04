<?php
namespace App\Help;
use Illuminate\Support\Facades\Http;
class HttpClient  
{
    
    public static function  post($url){

        $response = Http::post( env('PATH_API').'/'.$url);
        return $response->json($key = null);
    }
}
