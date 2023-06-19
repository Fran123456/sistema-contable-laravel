<?php
namespace App\Help;
use App\Models\Log as ModelLog;
use App\Help\Help;
class Log
{

    public static function  log( $modulo, $opcion, $accion ){
        ModelLog::create([
            'usuario_id'=> Help::usuario()->id,
            'modulo'=> $modulo,
            'opcion'=> $opcion,
            'accion'=> $accion,
            'empresa_id'=>Help::empresa()
        ]);

    }
}
