<?php

namespace App\Exports\Contabilidad;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;
use App\Help\Help;
use App\Models\Contabilidad\ContaRubroGeneral;
use App\Models\RRHH\RRHHEmpresa;

class BalanceGeneralRptExcel implements FromView
{
    use Exportable;

    public $fechaInicial;
    public $fechaFinal;
    public $fechaReporte;
    
    public function __construct(
        $fechaInicial,
        $fechaFinal,
        $fechaReporte
    ) {
        $this->fechaInicial = $fechaInicial;
        $this->fechaFinal = $fechaFinal;
        $this->fechaReporte = $fechaReporte;
    }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): View
    {

        $rubrosActivo = ContaRubroGeneral::where('signo', '+')->where('empresa_id', Help::empresa())->get();
        $rubrosPasivo = ContaRubroGeneral::where('signo', '-')->where('empresa_id', Help::empresa())->get();
        $nombreEmpresa = RRHHEmpresa::find(Help::empresa())->empresa;
        return view('contabilidad.reportes.balanceGeneral', [
            'fechaInicial' => $this->fechaInicial,
            'fechaFinal' => $this->fechaFinal,
            'fechaReporte' => $this->fechaReporte,
            'nombreEmpresa' => $nombreEmpresa,
            'rubrosActivo' => $rubrosActivo,
            'rubrosPasivo' => $rubrosPasivo,
        ]);
    }
}
