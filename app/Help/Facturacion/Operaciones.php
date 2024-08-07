<?php 

namespace App\Help\Facturacion;
use App\Help\Help;

class Operaciones
{
    public static function monto($cantidad, $precioUnitario)
    {
        return $cantidad*$precioUnitario;
    }

    //op = 1 , retorna el descuento 
    //op = 2, retorna el monto - descuento
    public static function descuento($cantidad, $precioUnitario, $tipoDescuento, $montoDescuento,  $op){

        $monto =self::monto($cantidad,$precioUnitario);
        $descuento = 0;
        if($tipoDescuento=="$"){
            $descuento = $montoDescuento;
        }
        if($tipoDescuento=="%"){
            $descuento =  $monto * ($montoDescuento / 100);
        }
        if($op==1){
            return  $descuento;
        }
        return $monto-$descuento;
    }

    
}