<?php

namespace App\Models\RRHH;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RRHHEmpleado extends Model
{
    use HasFactory;

    protected $table = 'rrhh_empleado';
    protected $fillable = [
        'id',
        'nombres',
        'apellidos',
        'nombre_completo',
        'edad',
        'activo',
        'correo',
        'telefono',
        'correo_empresarial',
        'direccion',
        'sexo',
        'fecha_nacimiento',
        'fecha_ingreso',
        'created_at',
        'updated_at',
    ];
}