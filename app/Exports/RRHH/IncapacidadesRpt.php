<?php

namespace App\Exports\RRHH;

use Maatwebsite\Excel\Concerns\Exportable;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use App\Help\Contabilidad\ReportesContables;


class IncapacidadesRpt implements FromView
{
    /**
     * @return \Illuminate\Support\Collection
     */

    use Exportable;

    public function __construct($planilla, $data)
    {
        $this->planilla = $planilla;
        $this->data = $data;
    }

    public function view(): View
    {
        return view('rrhh.reportes.incapacidadesExcelRpt', [
            'planilla' => $this->planilla,
            'data' => $this->data,
        ]);
    }
}
