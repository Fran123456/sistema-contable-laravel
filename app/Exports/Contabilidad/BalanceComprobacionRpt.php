<?php

namespace App\Exports\Contabilidad;
use Maatwebsite\Excel\Concerns\Exportable;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use App\Help\Contabilidad\ReportesContables;
use App\Help\Help;

class BalanceComprobacionRpt implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */

    use Exportable;

    public function __construct( $fechai, $fechaf, $data)
    {
        $this->fechai = $fechai;
        $this->fechaf = $fechaf;
        $this->data = $data = Help::groupArray($data,'codigo_cuenta');

    }

    public function view(): View
    {
        $contabilidadHelp = new ReportesContables();

        return view('contabilidad.reportes.BalanceComprobacionExcelRpt',[
                        'data'=> $this->data ,
                        'fechai'=> $this->fechai,
                        'fechaf'=> $this->fechaf,
                        'contabilidadHelp'=> $contabilidadHelp
        ]);

    }


}
