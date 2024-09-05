<?php
namespace App\Help;
use Illuminate\Support\Facades\Http;

class HttpClient  
{
    
    public static function post($url, $path, $body = [])
    {
        $init = null;
        if($path == null)$init=env('PATH_API_HACIENDA');
        else $init= $path;
        // Enviar la solicitud POST con el cuerpo de datos
        $response = Http::post($init.$url, $body);

        // Retornar la respuesta en formato JSON
        return $response->json($key = null);
    }

    public static function  get($relativePath, $path =null, $queryParams = [], $responseType='json'){
        $init = null;
        if($path == null)$init=env('PATH_API_HACIENDA');
        else $init= $path;
      
        
        $response = Http::get( $init.$relativePath, $queryParams);
        return HttpClient::typeResponse($responseType, $response);
    }

    public static function typeResponse($type, $response){

        if($type=='json'){
            return $response->json($key=null);
        }
        if($type=='body'){
            return $response->body();
        }
        
    }


}
