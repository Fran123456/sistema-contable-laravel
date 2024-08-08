<?php

namespace App\Exports\IVA;

use Maatwebsite\Excel\Concerns\Exportable;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class LibroCompraRpt implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */

    use Exportable;

    protected $data;
    protected $mes;
    protected $anio;

    public function __construct( $data, $mes, $anio)
    {
        $this->data = $data;
        $this->mes = $mes;
        $this->anio = $anio;
    }

    public function view(): View
    {
        return view('iva.reportes.libroComprasExcelRpt',[       
                        'data'=> $this->data ,
                        'mes'=> $this->mes,
                        'anio'=> $this->anio
        ]);
    }
}