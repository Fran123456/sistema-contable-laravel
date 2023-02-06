<?php

namespace App\Help;
use Illuminate\Support\Facades\Storage;
use App\Help\HttpClient;

class Help
{

   public static function pathAssets($path){
      //$url = env('PATH_ASSETS').'/'.$path.'/'.$name;
      $url = HttpClient::get( 'api/validar/asset', env('PATH_ASSETS'),['path'=> $path] ,'body'  );
   
      return $url;
   }





}
?>