<?php 

namespace App\Exports\Contabilidad;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
// clase para exportar a excel
class ExportEstadoResultado implements FromView, ShouldAutoSize
{
    use Exportable;
    // variables arecibir 
    protected $fechaReporte;
    protected $utilidades;

    public function __construct($fechaReporte, $utilidades) {
        $this->fechaReporte = $fechaReporte;
        $this->utilidades = $utilidades;
    }
    // funcion para llamar la vista de html a descargar en excel
    public function view(): View {
        return view('contabilidad.reportes.EstadoResultadoNuevoPDF', [
            "fechaReporte" => $this->fechaReporte,
            "utilidades" => $this->utilidades
        ]);
    }

}
