<?php

namespace App\Models\RRHH;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\RRHH\RRHHEmpleado;
use App\Models\RRHH\RRHHEmpresa;
use App\Models\RRHH\RRHHPeriodosPlanilla;
use App\Models\RRHH\RRHHTipoIncapacidad;

class RRHHIncapacidad extends Model
{
    use HasFactory;

    protected $table = 'rrhh_incapacidad';

    protected $fillable = [
        'id',
        'empleado_id',
        'empresa_id',
        'periodo_planilla_id',
        'tipo_incapacidad_id',
        'fecha_inicio',
        'periodo',
        'mes',
        'year',
        'cantidad',
        'created_at',
        'updated_at',
    ];

    public function empresa(){
        return $this->belongsTo(RRHHEmpresa::class, 'empresa_id')->withDefault(); //with default muestra los null
    }

    public function empleado(){
        return $this->belongsTo(RRHHEmpleado::class, 'empleado_id')->withDefault(); //with default muestra los null
    }

    public function tipoIncapacidad(){
        return $this->belongsTo(RRHHTipoIncapacidad::class, 'tipo_incapacidad_id')->withDefault(); //with default muestra los null
    }

    public function periodoPlanilla(){
        return $this->belongsTo(RRHHPeriodosPlanilla::class, 'periodo_planilla_id')->withDefault(); //with default muestra los null
    }
}
