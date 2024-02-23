<?php

namespace App\Models\RRHH;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RRHHAfp extends Model
{
    use HasFactory;

    protected $table = 'rrhh_afp';

    protected $fillable = [
        'id',
        'afp',
        'id_empresa',
        'porciento_empleador',
        'porciento_empleado',
        'created_at',
        'updated_at'
    ];

    public function empleado(){
        return $this->hasMany(RRHHEmpleado::class, 'id_afp', 'id');
    }
}
