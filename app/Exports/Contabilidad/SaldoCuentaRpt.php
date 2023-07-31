<?php

namespace App\Exports\Contabilidad;
use Maatwebsite\Excel\Concerns\Exportable;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use App\Help\Contabilidad\ReportesContables;


class SaldoCuentaRpt implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */

    use Exportable;

    public function __construct( $fechai, $fechaf, $data, $saldo, $cuenta)
    {
        $this->fechai = $fechai;
        $this->fechaf = $fechaf;
        $this->data = $data;
        $this->saldo = $saldo;
        $this->cuenta = $cuenta;
    }                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                           

    public function view(): View
    {
        $helpConta = new ReportesContables();
        return view('contabilidad.reportes.saldoCuentaExcelRpt',[       
                        'data'=> $this->data ,
                        'fechai'=> $this->fechai,
                        'fechaf'=> $this->fechaf,
                        'saldo'=> $this->saldo,
                        'cuenta'=> $this->cuenta,
                        'helpConta'=> $helpConta
        ]);

    }


}
