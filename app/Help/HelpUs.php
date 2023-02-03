<?php

namespace App\Help;
use Illuminate\Support\Facades\Storage;
use App\ClimaPreguntaEmpleados;

class Help
{

	public static function subir_Archivo($request, $carpetas,$anexo ,$input){
		//url es el path corto luego de el path publico a donde se encontrara el archivo.
		//anexo debe ser algo extra en el proyecto se usa por ejemplo MAT115/archivo.png donde anexo = "MAT115/"
	$file  = $request->file($input);
	$original = Help::reemplazar_caracter($file->getClientOriginalName());
    $name = Help::short_code().'-'.time().'-'.$original;
    $file->move(public_path().'/'.$carpetas,$name);
    return $name;
	}

	public static function reemplazar_caracter($cadena){
    $data = array('á','é','í','ó','ú','ñ',' ');
    $sup = array('a','e','i','o','u','n','-');
    $a = $cadena;

    for ($i=0; $i <count($data) ; $i++) {
      $a = str_replace($data[$i],$sup[$i], $a);
    }

    $a = strtolower($a);
    return $a;
	}


	public static function medium_code(){
     $code = array();
     $code[0] = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 4);
     $code[1] = rand(10, 99);
		 $code[2] = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 3);

    return $code[0].$code[1].$code[2];
   }

	 public static function fechaHoy(){
		 $hoy = getdate();
     return $hoy['mday'].'-'.$hoy['mon'].'-'.$hoy['year'];
	 }

	 public static function fechaHoyPorYear(){
		 $hoy = getdate();
     return $hoy['year'].'-'.$hoy['mon'].'-'.$hoy['mday'];
	 }

	 public static function yearActual(){
	 	$hoy = getdate();
	 	return $hoy['year'];
	 }

	 public static function sumarDiasFecha($fecha, $numeroDias){
		 $res = date("Y-m-d",strtotime($fecha."+ ". $numeroDias ." days"));
		 return $res;
	 }

	 public static function formato_fecha($fecha){
		 $c =  substr($fecha, 0, 10);
		 $date = new \DateTime($c);
		 return $date->format('d/m/Y') ;
	 }



	 public static function short_code(){
		 $code = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 5);
		 return $code;
	 }

	 public static function mesString($mes, $year){
	 	setlocale(LC_TIME, "spanish");
	 	 $hoy = getdate();
	    $mes = ucwords(strftime("%B", strtotime($year.'-'.$mes.'-'.$hoy['mday'])));
	    return $mes;
	 }



	public static function FormatoTime($time, $pre=null){
	 	$i = new \Datetime($time);
	 	 return $i->format("H:i".$pre);
	}


	 public static function token(){
          $url = "http://ccpcatalana.com/api/public/api/catalana/token";
					//$url = "http://apicatalana.test:8888/api/catalana/token";
          $cliente = curl_init();
           curl_setopt($cliente, CURLOPT_URL, $url);
           curl_setopt($cliente, CURLOPT_HTTPGET, TRUE);
           curl_setopt($cliente, CURLOPT_RETURNTRANSFER, true);
           $remote_server_output = curl_exec($cliente);
           curl_close($cliente);
           return json_decode($remote_server_output, true);
	 }





   






}
?>