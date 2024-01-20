<?php

namespace App\Models\Contabilidad;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Contabilidad\ContaPeriodoContable;
use App\Models\Contabilidad\ContaTipoPartida;
use App\Models\Contabilidad\ContaDetallePartida;
use App\Models\RRHH\RRHHEmpresa;
use App\Models\User;
class ContaPartidaContable extends Model
{
    use HasFactory;
    protected $table = 'conta_partida_contable';
    protected $fillable = [
        'concepto','created_at','updated_at','periodo_id','tipo_partida_id','correlativo',
        'debe','haber','fecha_contable','cerrada','anulada','fecha_cierre','empresa_id',
        'creador_id','actualizador_id'
    ];



    public function periodo(){
        return $this->belongsTo(ContaPeriodoContable::class, 'periodo_id');
    }

    public function tipoPartida(){
        return $this->belongsTo(ContaTipoPartida::class, 'tipo_partida_id');
    }

    public function empresa(){
        return $this->belongsTo(RRHHEmpresa::class, 'empresa_id');
    }

    public function creador(){
        return $this->belongsTo(User::class, 'creador_id');
    }

    public function actualizador(){
        return $this->belongsTo(User::class, 'actualizador_id');
    }



    public function detalles(){
        return $this->hasMany(ContaDetallePartida::class,'partida_id');
    }
}


