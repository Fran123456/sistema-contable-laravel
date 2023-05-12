<?php

namespace App\Models\Contabilidad;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContaTipoPartida extends Model
{
    use HasFactory;
    protected $table = 'conta_tipo_partida';
    protected $fillable = [
        'activo','tipo','created_at','updated_at','descripcion'
    ];

    public function periodos(){
        return $this->belongsToMany(ContaPeriodoContable::class, 'conta_periodo_tipo_partida','tipo_partida_id','periodo_id')
        ->withPivot('correlativo');
    }

}
