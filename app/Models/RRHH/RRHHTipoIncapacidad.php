<?php

namespace App\Models\RRHH;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RRHHTipoIncapacidad extends Model
{
    use HasFactory;

    protected $table = 'rrhh_tipo_incapacidad';

    protected $fillable = [
        'id',
        'tipo',
        'activo',
        'created_at',
        'updated_at',
    ];

    public function rrhhIncapacidad() {
        return $this->hasMany(RRHHIncapacidad::class, 'tipo_incapacidad_id', 'id');
    }
}
