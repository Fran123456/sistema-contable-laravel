<?php

namespace App\Models\RRHH;

use App\Models\RRHH\RRHHEmpleado;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RRHHTipoEmpleado extends Model
{
    use HasFactory;

    protected $table = 'rrhh_tipo_empleado';
    protected $fillable = [
        'id',
        'tipo',
        'created_at',
        'updated_at',
    ];

    public function rrhhEmpleados() {
        return $this->hasMany(RRHEmpleado::class, 'tipo_empleado_id', 'id');
    }
}
