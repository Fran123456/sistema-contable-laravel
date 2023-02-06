<?php
namespace App\Help;
use Illuminate\Support\Facades\Http;
class HttpClient  
{
    
    public static function  post($url){

        $response = Http::post( env('PATH_API').'/'.$url);
        return $response->json($key = null);
    }

    public static function  get($relativePath, $path =null, $queryParams = [], $responseType='json'){
        $init = null;
        if($path == null)$init=env('PATH_API');
        else $init= $path;
      
        
        $response = Http::get( $init.'/'.$relativePath, $queryParams);
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
