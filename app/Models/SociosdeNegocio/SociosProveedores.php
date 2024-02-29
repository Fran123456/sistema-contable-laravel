<?php

namespace App\Models\SociosdeNegocio;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SociosProveedores extends Model
{
    use HasFactory;
    protected $table = "socios_proveedores";
    protected $fillable = [
        'nombre',
        'tipo_proveedor',
        'tipo_personalidad',
        'giro',
        'forma_pago',
        'numero_registro',
        'nit',
        'telefono',
        'direccion',
        'celular',
        'correo',
        'pais',
        'created_at',
        'updated_at',
    ];

}
