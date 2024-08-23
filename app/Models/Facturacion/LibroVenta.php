<?php

namespace App\Models\Facturacion;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LibroVenta extends Model
{
    use HasFactory;

    protected $table = 'libro_ventas';

    protected $fillable = [
        'fecha_emision',
        'documento',
        'nit',
        'dui',
        'nrc',
        'cliente',
        'excenta',
        'no_sujeta',
        'debito_fiscal',
        'iva',
        'ventas_terceros',
        'debito_terceros',
        'iva_percibido',
        'iva_retenido',
        'mostrar'
    ];

}
