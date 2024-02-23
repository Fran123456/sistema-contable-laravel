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
        'empresa_id',
        'tipo_empleado_id',
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
        'codigo',
        'foto',
        'salario',
        'salario_diario',
        'created_at',
        'updated_at',
    ];

    public function rrhhIncapacidad() {
        return $this->hasMany(RRHHIncapacidad::class, 'empleado_id', 'id');
    }

    public function permiso() {
        return $this->hasMany(RRHHPermiso::class,'empleado_id', 'id');
    }

    public function empresa(){
        return $this->belongsTo(RRHHEmpresa::class, 'empresa_id')->withDefault(); //with default muestra los null
    }

    public function area(){

        return $this->belongsTo(RRHHArea::class, 'area_id');

    }

    public function afp(){

        return $this->belongsTo(RRHHAfp::class, 'id_afp')->withDefault();

    }
}
