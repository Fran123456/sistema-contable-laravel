<?php

namespace App\Models\RRHH;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RRHHIngreso extends Model
{
    use HasFactory;

    protected $table = 'rrhh_ingreso';

    protected $fillable = [
        'id',
        'id_empresa',
        'id_empleado',
        'id_tipo_ingreso',
        'id_periodo_planilla',
        'cantidad',
        'fecha',
        'descripcion',
        'created_at',
        'updated_at'
    ];

    /**
     * Get the empresa that owns the RRHHIngreso
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function empresa()
    {
        return $this->belongsTo(RRHHEmpresa::class, 'id_empresa', 'id')->withDefault();
    }

    /**
     * Get the empresa that owns the RRHHIngreso
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function empleado()
    {
        return $this->belongsTo(RRHHEmpleado::class, 'id_empleado', 'id')->withDefault();
    }

    /**
     * Get the empresa that owns the RRHHIngreso
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function planilla()
    {
        return $this->belongsTo(RRHHPeriodosPlanilla::class, 'id_periodo_planilla', 'id')->withDefault();
    }

    /**
     * Get the empresa that owns the RRHHIngreso
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function tipoIngreso()
    {
        return $this->belongsTo(RRHHTipoIngreso::class, 'id_tipo_ingreso', 'id')->withDefault();
    }
}
