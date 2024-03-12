<?php 

namespace App\Help\Cliente;

class Cliente
{
    public static function tipo()
    {
        $tipo = ['Local', 'Exterior'];
        return $tipo;
    }

    public static function magnitud()
    {
        $magnitud = ['Contribuyente grande', 'Contribuyente mediano', 'Contribuyente pequeño'];
        return $magnitud;
    }
}