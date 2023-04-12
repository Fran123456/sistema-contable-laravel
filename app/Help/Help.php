<?php

namespace App\Help;
use Illuminate\Support\Facades\Storage;
use App\Help\HttpClient;
use Carbon\Carbon;
use Illuminate\Support\Facades\Route;
use App\Models\TeamInvitation;
class Help
{
   public static function countTeamInvitations(){
      $user = auth()->user();
      return count(TeamInvitation::where('email', $user->email)->get());
   }



   public static function pathAssets($path){
      //$url = env('PATH_ASSETS').'/'.$path.'/'.$name;
      $url = HttpClient::get( 'api/validar/asset', env('PATH_ASSETS'),['path'=> $path] ,'body'  );
      return $url;
   }

   public static function date($fecha){
      $c =  substr($fecha, 0, 10);
      $date = new \DateTime($c);
      return $date->format('d/m/Y ') ;
   }


   public static function hour($fecha){
      $date=date_create($fecha);
      return  date_format($date,"d/m/Y h:i:s A");
   }

   public static function year(){
      $hoy = getdate();
      return $hoy['year'];
   }


   public static function routerNav(){
     $route = Route::currentRouteName();
     $full = url()->full();
     $previous = url()->previous();
     $current = url()->current();
     $parciales = explode("/", $full);
     $paths = array();
     $objPaths = array();
     $pathCounter = 0;
     $pathPartial = "";
     $inicial = $parciales[0].'/'.$parciales[2];
     for ($i=2; $i < count( $parciales) ; $i++) {
       $inicial = '';
        $url = null;
        if($i==2){
            $paths[  $pathCounter]  =$inicial.'/dashboard' ;
            array_push($objPaths, array('url'=> $paths[  $pathCounter], 'nombre'=> 'dashboard'  ));
        }else{
          if(  Help::isNumber($parciales[$i])    ){
            $url =$pathPartial . '/'. $parciales[$i];
            $pathPartial = $url;
            $paths[  $pathCounter-1]  =  $inicial . $url ;
            $objPaths [$pathCounter-1]['url' ] = $paths[  $pathCounter-1] ;
          }else{
            $pathPartial =  $pathPartial .'/'. $parciales[$i] ;
            $url =$inicial . $pathPartial;
            array_push($paths,   $url );
            array_push($objPaths, array('url'=> $url, 'nombre'=> $parciales[$i]    ));
           }
        }
        $pathCounter++;
     }
     return $objPaths;
   }

   public static function isNumber($str){
      	$str = str_replace(',', '.', $str);
      	if(!is_numeric($str)) return false;

      	$str = (int)$str;
      	if(!is_integer($str) AND !is_float($str)) return false;

      	return true;

  }



}
?>
