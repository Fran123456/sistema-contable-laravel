<?php

namespace App\Models\Contabilidad;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Contabilidad\ContaClasificacionCuenta;
use App\Models\Contabilidad\ContaNivelCuenta;
use App\Models\Contabilidad\ContaDetallePartida;

class ContaCuentaContable extends Model
{
    use HasFactory;
    protected $table = 'conta_cuenta_contable';
    protected $fillable = [
        'codigo','created_at','updated_at','nombre_cuenta','padre_id','hijos','nivel_id',
        'clasificacion_id','saldo','activo','empresa_id','tipo_cuenta'
    ];

    //GPT
    public function detallesPartida()
    {
        return $this->hasMany(ContaDetallePartida::class, 'cuenta_contable_id');
    }
    //GPT


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



    public function padreRecursivo()
    {
        // recursively return all parents
        return $this->belongsTo(ContaCuentaContable::class, 'padre_id')->with('padreRecursivo');
    }

    public function buscarPadre($cuenta, $nivel){ //int
            $cuenta = ContaCuentaContable::find($cuenta)?->padre; //objeto
                if ( strlen($cuenta?->codigo) == $nivel  ) {
                        return $cuenta; //retornar objeto
                }else{
                       return $this->buscarPadre($cuenta?->id,$nivel); //retornar id
                }

    }

    public function hijosRecursivos()
    {
        // recursively return all children
        return $this->hasMany(ContaCuentaContable::class, 'padre_id')->with('hijosRecursivos');
    }

    public static function cuentasDetalle(int $empresa){
        $cuentas  = ContaCuentaContable::join("conta_clasificacion_cuenta_contable", "conta_cuenta_contable.clasificacion_id", "=", "conta_clasificacion_cuenta_contable.id")
        ->select("conta_cuenta_contable.*", "conta_clasificacion_cuenta_contable.clasificacion")
        ->where("conta_clasificacion_cuenta_contable.clasificacion", "=", 'detalle')
        ->where('conta_cuenta_contable.empresa_id', $empresa)->get();
        return $cuentas;
    }
    public static function cuentas(int $empresa){
        $cuentas  = ContaCuentaContable::join("conta_clasificacion_cuenta_contable", "conta_cuenta_contable.clasificacion_id", "=", "conta_clasificacion_cuenta_contable.id")
        ->select("conta_cuenta_contable.*", "conta_clasificacion_cuenta_contable.clasificacion")
        ->where('conta_cuenta_contable.empresa_id', $empresa)->get();
        return $cuentas;
    }
}
