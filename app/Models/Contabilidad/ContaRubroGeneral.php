<?php

namespace App\Models\Contabilidad;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Contabilidad\ContaRubroGrupo;
use App\Help\Contabilidad\ReportesContables;

class ContaRubroGeneral extends Model
{
    use HasFactory;

    protected $table = 'conta_rubro_general_rpt';

    protected $fillable = [
        'rubro',
        'signo',
        'saldo',
        'empresa_id'
    ];

    public function grupos(){
        return $this->hasMany(ContaRubroGrupo::class, 'rubro_id');
    }

    public static function calcular($id, $fechaInicial, $fechaFinal)
    {
        $rubro = self::find($id);
        foreach($rubro->grupos as $grupo){
            $totalSaldoCuentas = 0;
            foreach($grupo->cuentas as $cuenta){
                $auxiliar = ReportesContables::getSaldoCuenta($cuenta->cuenta_id, $fechaInicial, $fechaFinal);
                $cuenta->saldo = $auxiliar;
                $cuenta->save();
                 if($cuenta->signo == '+'){
                    $totalSaldoCuentas += $auxiliar;
                } else {
                    $totalSaldoCuentas -= $auxiliar;
                }
                
            }
            $grupo->saldo = $totalSaldoCuentas;
            $grupo->save();
           
        }
        $saldoGrupos = 0;

        foreach($rubro->grupos as $grupo){
           if($grupo->signo == '+'){
                $saldoGrupos += $grupo->saldo;
            } else {
                $saldoGrupos -= $grupo->saldo;
            }
        }

        $rubro->saldo = $saldoGrupos;
        $rubro->save();


    }
}
