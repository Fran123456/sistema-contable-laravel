<?php

namespace App\Models\Configuracion;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConProvisionEmpresa extends Model
{
    use HasFactory;
    protected $table = 'tbl_provisiones_empresa';
    protected $fillable = [
        'empresa_id',
        'tipo_provision',
        'porcentaje',
        'feca_inicio',
        'fecha_fin',
        'descripcion',
        'creado_por',
        'fecha_creacion',
        'estado',
        'tipo_empleado'
    ];
}
