<?php

namespace App\Models\Contabilidad;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Contabilidad\ContaPeriodoContable;
use App\Models\Contabilidad\ContaTipoPartida;
use App\Models\Contabilidad\ContaCuentaContable;
use App\Models\Contabilidad\ContaPartidaContable;
use App\Models\RRHH\RRHHEmpresa;
use App\Models\User;
class ContaDetallePartida extends Model
{
    use HasFactory;
    protected $table = 'conta_detalle_partida_contable';
    protected $fillable = [
        'partida_id','id','periodo_id','tipo_partida_id','empresa_id','creador_id',
        'actualizador_id','cuenta_contable_id','debe','haber','fecha_contable',
        'concepto','created_at','updated_at'
    ];

    public function cuentaContable(){
        return $this->belongsTo(ContaCuentaContable::class, 'periodo_id');
    }

    public function partida(){
        return $this->belongsTo(ContaPartidaContable::class, 'partida_id');
    }

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

}


													