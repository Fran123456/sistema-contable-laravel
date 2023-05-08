<?php

namespace App\Models\Contabilidad;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContaPeriodoContable extends Model
{
    use HasFactory;
    protected $table = 'conta_periodo_contables';
    protected $fillable = [
        'codigo','year', 'mes', 'activo','usuario_creador_id','usuario_actualizador_id','created_at','updated_at'
    ];

}
