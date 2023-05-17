<?php

namespace App\Models\Contabilidad;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContaPeriodoContable extends Model
{
    use HasFactory;
    protected $table = 'conta_periodo_contables';
    protected $fillable = [
        'codigo','year', 'mes', 'activo','usuario_creador_id','usuario_actualizador_id'
        ,'created_at','updated_at','empresa_id'
    ];


    public function tiposPartida(){
        return $this->belongsToMany(ContaTipoPartida::class, 'conta_periodo_tipo_partida','periodo_id','tipo_partida_id')
        ->withPivot('correlativo','empresa_id');
    }

}
