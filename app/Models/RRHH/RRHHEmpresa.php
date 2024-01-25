<?php

namespace App\Models\RRHH;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Contabilidad\ContaTipoPartida;
use App\Models\Contabilidad\ContaClasificacionCuenta;
use App\Models\Contabilidad\ContaNivelCuenta;
use App\Models\Contabilidad\ContaBalanceConf;
use App\Models\User;
class RRHHEmpresa extends Model
{
    use HasFactory;
    protected $table = 'rrhh_empresa';
    protected $fillable = [
        'actualizada','created_at','updated_at','empresa'
    ];

    //metodos de contabilidad
    public function contaTiposPartidas(){
        return $this->hasMany(ContaTipoPartida::class, 'empresa_id', 'id');
    }

    public function contaClasificacion(){
        return $this->hasMany(ContaClasificacionCuenta::class, 'empresa_id', 'id');
    }

    public function contaNivel(){
        return $this->hasMany(ContaNivelCuenta::class, 'empresa_id', 'id');
    }
    public function contaBalance(){
        return $this->hasMany(ContaBalanceConf::class, 'empresa_id', 'id');
    }

    //metodos generales
    public function usuarios()
    {
        return $this->belongsToMany(User::class, 'rrhh_empresa_usuario','empresa_id','usuario_id')
        ->withPivot('activo');
    }


}
