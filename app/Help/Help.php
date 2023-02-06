<?php

namespace App\Help;
use Illuminate\Support\Facades\Storage;
use App\Help\HttpClient;
use Carbon\Carbon;

class Help
{

   public static function pathAssets($path){
      //$url = env('PATH_ASSETS').'/'.$path.'/'.$name;
      $url = HttpClient::get( 'api/validar/asset', env('PATH_ASSETS'),['path'=> $path] ,'body'  );
   
      return $url;
   }

   public static function date($fecha){
      $c =  substr($fecha, 0, 10);
      $date = new \DateTime($c);
      return $date->format('d/m/Y') ;
   }




}
?>