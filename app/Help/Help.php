<?php

namespace App\Help;
use Illuminate\Support\Facades\Storage;


class Help
{

   public static function assets($name, $path){
	return env('PATH_ASSETS').$path.$name;
   }



}
?>