<?php

namespace App\Exports\Contabilidad;
use Maatwebsite\Excel\Concerns\Exportable;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use App\Help\Contabilidad\ReportesContables;


class LibroDiarioMayorRpt implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */

    use Exportable;

    public function __construct( $fechai, $fechaf, $data)
    {
        $this->fechai = $fechai;
        $this->fechaf = $fechaf;
        $this->data = $data;
    }

    public function view(): View
    {
        return view('contabilidad.reportes.LibroDiarioMayorExcelRpt',[
                        'data'=> $this->data ,
                        'fechai'=> $this->fechai,
                        'fechaf'=> $this->fechaf,
        ]);

    }


}
