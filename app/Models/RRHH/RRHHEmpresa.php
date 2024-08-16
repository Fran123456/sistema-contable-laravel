<?php

namespace App\Models\RRHH;

use App\Models\User;
use App\Models\Facturacion\FactFacturacion;
use Illuminate\Database\Eloquent\Model;
use App\Models\Contabilidad\ContaNivelCuenta;
use App\Models\Contabilidad\ContaTipoPartida;
use App\Models\Contabilidad\ContaClasificacionCuenta;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class RRHHEmpresa extends Model
{
    use HasFactory;
    protected $table = 'rrhh_empresa';
    protected $fillable = [
        'empresa',
        'actualizada',
        'abreviatura',
        'nrc',
        'nit',
        'razon_social',
        'created_at',
        'updated_at',
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

    public function rrhhPeriodosPlanilla(){
        return $this->hasMany(RRHHPeriodosPlanilla::class, 'empresa_id', 'id');
    }

    public function rrhhIncapacidad() {
        return $this->hasMany(RRHHIncapacidad::class, 'empresa_id', 'id');
    }

    public function permiso(){
        return $this->hasMany(RRHHPermiso::class,'empresa_id', 'id');
    }

    public function empleado(){
        return $this->hasMany(RRHHEmpleado::class,'empresa_id', 'id');
    }

    //metodos generales
    public function usuarios()
    {
        return $this->belongsToMany(User::class, 'rrhh_empresa_usuario','empresa_id','usuario_id')
        ->withPivot('activo');
    }

    public function facturaciones()
        {
            return $this->hasMany(FactFacturacion::class, 'empresa_id');
        }
    


}