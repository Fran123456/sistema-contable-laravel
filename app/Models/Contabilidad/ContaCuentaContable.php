<?php

namespace App\Models\Contabilidad;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Contabilidad\ContaClasificacionCuenta;
use App\Models\Contabilidad\ContaNivelCuenta;

class ContaCuentaContable extends Model
{
    use HasFactory;
    protected $table = 'conta_cuenta_contable';
    protected $fillable = [
        'codigo','created_at','updated_at','nombre_cuenta','padre_id','hijos','nivel_id',
        'clasificacion_id','saldo','activo'
    ];

    public function clasificacion(){
        return $this->belongsTo(ContaClasificacionCuenta::class, 'clasificacion_id');
    }

    public function nivel(){
        return $this->belongsTo(ContaNivelCuenta::class, 'nivel_id');
    }
    
    public function padre(){
        return $this->belongsTo(ContaCuentaContable::class, 'padre_id');
    }

    public function hijos($id){
        return ContaCuentaContable::where('padre_id', $id)->get();
    }

}
