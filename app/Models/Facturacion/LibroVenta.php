<?php

namespace App\Models\Facturacion;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\RRHH\RRHHEmpresa;

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
        'gravadas_locales',
        'debito_fiscal',
        'iva',
        'ventas_terceros',
        'debito_terceros',
        'iva_percibido',
        'iva_retenido',
        'empresa_id',
        'mostrar'
    ];

    public function empresa()
    {
        return $this->belongsTo(RRHHEmpresa::class, 'empresa_id');
    }
}
