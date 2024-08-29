<?php

namespace App\Exports\IVA;

use DateTime;
use App\Models\RRHH\RRHHEmpresa;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithEvents;

class LibroIvaContribuyenteRpt implements FromView, WithEvents
{
    /**
     * @return \Illuminate\Support\Collection
     */

    use Exportable;

    protected $data;
    protected $mes;
    protected $anio;

    public function __construct($data, $mes, $anio)
    {
        $this->data = $data;
        $this->mes = $mes;
        $this->anio = $anio;
    }

    public function view(): View
    {

        setlocale(LC_TIME, 'es_ES.UTF-8');

        // $empresa = auth()->user()->empresa;
        // $empresa = $empresa->empresa;
        $fecha = DateTime::createFromFormat('!m', $this->mes);
        $nombreMes = strftime('%B', $fecha->getTimestamp());

        return view('iva.reporteIvaContribuyente.excel', [
            'data' => $this->data,
            // 'empresa'=> $empresa,
            'mes' => ucfirst($nombreMes),
            'anio' => $this->anio,
        ]);
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $sheet = $event->sheet->getDelegate();

                foreach (range('A', 'Q') as $col) {
                    $sheet->getColumnDimension($col)->setAutoSize(true);
                }
            },
        ];
    }
}