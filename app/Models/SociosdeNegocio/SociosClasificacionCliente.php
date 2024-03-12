<?php

namespace App\Models\SociosdeNegocio;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SociosClasificacionCliente extends Model
{
    use HasFactory;
    protected $table = 'socios_clasificacion_cliente';
    protected $fillable = [
        'tipo',
        'descripcion',
        'created_at',
        'updated_at',
    ];
}
