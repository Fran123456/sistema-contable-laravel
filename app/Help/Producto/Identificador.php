<?php

namespace App\Help\Producto;
use App\Models\Config;

class Identificador
{
    /* El identificador del producto es el digito que se guarda en la base de datos config, 
    sirve para llevar el conteo de los digitos */
    public static function identificador()
    {
    
        // define('PREFIJO', 'PR');
        $digito = Config::where('field', 'identificadorProducto')->value('value');
        $identificadorProducto = intval($digito) + 1;
        //Se usa esta funcion para rellenar de ceros a la izquierda si es necesario. 
        $identificador = str_pad($identificadorProducto, 6, 0, STR_PAD_LEFT);
        
        return $identificador;
    
    }
    public static function actualizarIdentificador()
    {
        $digito = Config::where('field', 'identificadorProducto')->first();
        $digito->value = ltrim(self::identificador(),0);
        $digito->save();
    }
}

?>