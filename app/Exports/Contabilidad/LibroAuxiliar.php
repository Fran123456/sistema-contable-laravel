<?php

namespace App\Exports\Contabilidad;

use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\Exportable;
use Illuminate\Contracts\View\View;
use App\Help\Contabilidad\ReportesContables;
use App\Help\Help;
use App\Models\Contabilidad\ContaClasificacionCuenta;
use App\Models\Contabilidad\ContaCuentaContable;
use App\Models\Contabilidad\ContaPartidaContable;

class LibroAuxiliar implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */

    use Exportable;

    public $fechaInicial;
    public $fechaFinal;
    public $cuentaInicial;
    public $cuentaFinal;

    function __construct($fechaInicial, $fechaFinal, $cuentaInicial, $cuentaFinal)
    {
        $this->fechaInicial = $fechaInicial;
        $this->fechaFinal = $fechaFinal;
        $this->cuentaInicial = $cuentaInicial;
        $this->cuentaFinal = $cuentaFinal;
    }
    
    public function view(): View
    {
        $c  = ContaClasificacionCuenta::where('clasificacion', 'detalle')
        ->where('empresa_id', Help::empresa())->first();
        $total = ReportesContables::getTotalDeCuentasRango($this->cuentaInicial, $this->cuentaFinal, $this->fechaInicial, $this->fechaFinal, $c->id);
        $help = new Help();
        $aux = new ReportesContables();
        $partidaModel = new ContaPartidaContable();
        return view('contabilidad.reportes.libro_auxiliar_excel', [
            'total' => $total,
            'aux' => $aux,
            'help' => $help,
            'partidaModel' => $partidaModel,
            'fechaInicial' => $this->fechaInicial,
            'fechaFinal' => $this->fechaFinal,
            'cuentaInicial' => $this->cuentaInicial,
            'cuentaModel' => new ContaCuentaContable(),
            'cuentaFinal' => $this->cuentaFinal,
        ]);
    }
}
