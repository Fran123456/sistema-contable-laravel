<?php

namespace App\Models\Contabilidad;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContaClasificacionCuenta extends Model
{
    use HasFactory;
    protected $table = 'conta_clasificacion_cuenta_contable';
    protected $fillable = [
        'clasificacion','created_at','updated_at','empresa_id'
    ];

}
