<?php

namespace App\Models\RRHH;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\RRHH\RRHHEmpresa;
use App\Models\RRHH\RRHHEmpleado;
use App\Models\RRHH\RRHHPeriodosPlanilla;
use App\Models\RRHH\RRHHTipoPermiso;

class RRHHPermiso extends Model
{
    use HasFactory;

    protected $table = "rrhh_permiso";

    protected $fillable = [
        'id',
        'empleado_id',
        'empresa_id',
        'periodo_planilla_id',
        'tipo_permiso_id',
        'tipo_permiso',
        'fecha_inicio',
        'periodo',
        'mes',
        'year',
        'cantidad',
        'descripcion',
        'created_at',
        'updated_at',
    ];

    public function empresa(){
        return $this->belongsTo(RRHHEmpresa::class,'empresa_id')->withDefault();
    }

    public function empleado(){
        return $this->belongsTo(RRHHEmpleado::class,'empleado_id')->withDefault();
    }

    public function periodo_planilla(){
        return $this->belongsTo(RRHHPeriodosPlanilla::class,'periodo_planilla_id')->withDefault();
    }

    public function tipoPermiso(){
        return $this->belongsTo(RRHHTipoPermiso::class,'tipo_permiso_id')->withDefault();
    }
}
