<?php
namespace App\Help;
use Illuminate\Support\Facades\Http;

class HttpClient  
{
    
    public static function post($url, $path, $body = [],  $token = null)
    {
        $init = $path ?? env('PATH_API_HACIENDA'); // Utilizar $path o la variable de entorno

        try {
            // Crear la solicitud con o sin token.
            $request = Http::withHeaders([
                'Authorization' => $token ? 'Bearer ' . $token : ''
            ]);
    
            // Enviar la solicitud POST y lanzar excepción si hay error
            $response = $request->post($init . $url, $body)->throw();
    
            // Retornar la respuesta en formato JSON
            return $response->json();
        } catch (\Exception $e) {
            // Manejar el error y retornar el mensaje de error o la respuesta
            return [
                'error' => true,
                'message' => $e->getMessage(),
                'response' => $e instanceof \Illuminate\Http\Client\RequestException ? $e->response->json() : null
            ];
        }
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
