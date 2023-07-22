<?php

namespace App\Help;
use Illuminate\Support\Facades\Storage;
use App\Help\HttpClient;
use Carbon\Carbon;
use Illuminate\Support\Facades\Route;
use App\Models\TeamInvitation;
use App\Models\Config;
use App\Models\Contabilidad\ContaPeriodoContable;
use \Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class Help
{

   public static function groupPermissions($group){
      return Permission::where('opcion', $group)->get();
   }

   public static function groupPermissionsOwner($group, Role $role){

      return DB::table('role_has_permissions')
      ->select('roles.name as role_name','roles.id as id_role','permissions.name as permission',
      'permissions.opcion','permissions.id as id_permissions' )
      ->join('roles', 'roles.id', '=', 'role_has_permissions.role_id')
      ->join('permissions', 'permissions.id', '=', 'role_has_permissions.permission_id')
      ->where('role_has_permissions.role_id', $role->id)->where('permissions.opcion',$group)->get();
       
      
   }

   public static function usuario(){
      return  Auth::user();
   }

   public static function empresa(){
      return  Auth::user()->empresa_id;
   }

   public static function periodoContable(){
      return ContaPeriodoContable::where('empresa_id', Help::empresa())->where('activo',true)->first();
   }


	public static function complementCode($string, $MaxNumber, $complement){
		$response = str_pad($string, ($MaxNumber - Str::length($MaxNumber))+1, $complement, STR_PAD_LEFT);
       return $response;
	}

   public static function monthToString($month){
      $array = ["Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre"];
      for ($i=0; $i <count($array) ; $i++) { 
        if($month==($i+1)) return $array[$i];
      }
   }


   public static function countTeamInvitations(){
      $user = auth()->user();
      return count(TeamInvitation::where('email', $user->email)->get());
   }

   public static function getConfigByKey($category, $key){
      return Config::where('field', $key)->where('category', $category)->first();
   }

   public static function pathAssets($path){
      //$url = env('PATH_ASSETS').'/'.$path.'/'.$name;
      $url = HttpClient::get( 'api/validar/asset', env('PATH_ASSETS'),['path'=> $path] ,'body'  );
      return $url;
   }

   public static function uploadFile($request, $folder,$anexo ,$input, $ramdonName = true){
		//url es el path corto luego de el path publico a donde se encontrara el archivo.
		//anexo debe ser algo extra en el proyecto se usa por ejemplo MAT115/archivo.png donde anexo = "MAT115/"
		$file  = $request->file($input);
		$original = Help::changeCharacters($file->getClientOriginalName());
      $name = $ramdonName?Help::code(8).'-'.time().'-'.$original:$original;
      $file->move(public_path().'/'.$folder.'/',$name);
      return $name;
	}

   public static function deleteFile($path, $file = null){
      $fullPath = $path;
      if($file != null){
         $fullPath=$path.'/'.$file;
      }
      Storage::disk('public')->delete($fullPath);
   }

   public static function code($lenght){
      return substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, $lenght);
   }

   public static function date($fecha){
      $c =  substr($fecha, 0, 10);
      $date = new \DateTime($c);
      return $date->format('d/m/Y ') ;
   }

   public static function dateByYear($fecha, $separator='/'){
      $c =  substr($fecha, 0, 10);
      $date = new \DateTime($c);
      return $date->format("Y${separator}m${separator}d") ;
   }


   public static function hour($fecha){
      $date=date_create($fecha);
      return  date_format($date,"d/m/Y h:i:s A");
   }

   public static function year(){
      $hoy = getdate();
      return $hoy['year'];
   }

   public static function changeCharacters($string){
      $data = array('á','é','í','ó','ú','ñ',' ');
      $sup = array('a','e','i','o','u','n','-');
      $a = $string;
      for ($i=0; $i <count($data) ; $i++) {
         $a = str_replace($data[$i],$sup[$i], $a);
      }
      return strtolower($a);
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
