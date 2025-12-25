<?php 

namespace App\Exports\Contabilidad;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use App\Help\Help;
// clase para exportar a excel
class ExportEstadoResultado implements FromView, ShouldAutoSize
{
    use Exportable;
    // variables arecibir 
    protected $fechaReporte;
    protected $fechaInicio;
    protected $fechaFin;
    protected $utilidades;

    public function __construct($fechaReporte, $fechaInicio, $fechaFin, $utilidades) {
        $this->fechaReporte = $fechaReporte;
        $this->fechaInicio = $fechaInicio;
        $this->fechaFin = $fechaFin;
        $this->utilidades = $utilidades;
    }
    // funcion para llamar la vista de html a descargar en excel
    public function view(): View {
        return view('contabilidad.reportes.EstadoResultadoNuevoPDF', [
            "fechaReporte" => $this->fechaReporte,
            "fechaInicio" => $this->fechaInicio,
            "fechaFin" => $this->fechaFin,
            "utilidades" => $this->utilidades,
            "empresaId"=> Help::empresa()
        ]);
    }

}
