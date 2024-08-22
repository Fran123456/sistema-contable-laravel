<?php

namespace App\Exports\IVA;

use DateTime;
use App\Models\RRHH\RRHHEmpresa;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithEvents;

class LibroCompraRpt implements FromView, WithEvents
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
        $empresa = $empresa->empresa;
        $nrc = $empresa->nrc ?? ' NO DISPONIBLE';
        $nit = $empresa->nit ?? ' NO DISPONIBLE';

        setlocale(LC_TIME, 'es_ES.UTF-8');

        $fecha = DateTime::createFromFormat('!m', $this->mes);
        $nombreMes = strftime('%B', $fecha->getTimestamp());

        return view('iva.reporteLibroCompra.excel',[       
                        'data'=> $this->data ,
                        'mes'=> ucfirst($nombreMes),
                        'anio'=> $this->anio,
                        'empresa'=> $empresa,
                        'nrc'=> $nrc,
                        'nit'=> $nit
        ]);
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function(AfterSheet $event) {
                $sheet = $event->sheet->getDelegate();
    
                // Establecer un ancho fijo para las columnas A a J en las primeras filas (1 a 6)
                foreach (range('A', 'J') as $col) {
                    $sheet->getColumnDimension($col)->setWidth(20);
                }
    
                // Autoajustar el ancho de las columnas desde la fila 7 en adelante
                foreach (range('A', 'Q') as $col) {
                    $sheet->getColumnDimension($col)->setAutoSize(true);
                }
            },
        ];
    }
}