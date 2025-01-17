<?php

namespace App\Exports\IVA;

use DateTime;
use App\Models\RRHH\RRHHEmpresa;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithEvents;
use Carbon\Carbon;

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

        Carbon::setLocale('es');

        $fecha = Carbon::create()->month($this->mes);

        $nombreMes = $fecha->translatedFormat('F');

        return view('iva.reporteIvaContribuyente.excel', [
            'data' => $this->data,
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