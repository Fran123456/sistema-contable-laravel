<?php

namespace App\Exports\IVA;

use App\Models\RRHH\RRHHEmpresa;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\Exportable;

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
        $empresa = auth()->user()->empresa;

        $empresa = $empresa->empresa ?? ' SIN EMPRESA';
        $nrc = $empresa->nrc ?? ' NO DISPONIBLE';
        $nit = $empresa->nit ?? ' NO DISPONIBLE';
        return view('iva.reporteLibroCompra.excel',[       
                        'data'=> $this->data ,
                        'mes'=> $this->mes,
                        'anio'=> $this->anio,
                        'empresa'=> $empresa,
                        'nrc'=> $nrc,
                        'nit'=> $nit
        ]);
    }
}