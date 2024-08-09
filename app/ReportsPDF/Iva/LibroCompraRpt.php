<?php

namespace App\ReportsPDF\Iva;

use App\Help\PDF\EasyTable\easyTable;
use App\Help\PDF\EasyTable\exfpdf;
use App\Help\Help;
use App\Help\PDF\EasyTable\Styles;
use App\Help\Contabilidad\ReportesContables;

class LibroCompraRpt
{
    public static function report($data, $mes, $anio)
    {   $titulo = "MES: " . $mes . " AÑO: " . $anio;

        $pdf = new exFPDF('REPORTE DE LIBRO DE COMPRA',$titulo, 'P', 'mm', 'A4');
        $pdf->AliasNbPages();
        $pdf->AddPage();
        $pdf->SetFont('Arial', '', 7);

        // Define estilos
        $style = Styles::alignPaddingY('1.07', 'C');
        $numberStyle = Styles::alignPaddingY('1.13', 'R');

        // Crea la tabla
        $table = new easyTable($pdf, '%{5,10,12,23,10,10,10,10,10}', 'width:190; border-color:#3C4048;border-width:0.2; font-size:8; border:0; paddingY:1.3;');
        $table->rowStyle('font-style:B;font-color:#3F3F3F;valign:M;');
        $table->easyCell("No", $style . 'border:B;');
        $table->easyCell('Fecha', $style . 'border:B;');
        $table->easyCell('Documento', $style . 'border:B;');
        $table->easyCell("NIT", $style . 'border:B;');
        $table->easyCell("DUI", $style . 'border:B;');
        $table->easyCell("NRC", $style . 'border:B;');
        $table->easyCell("Gravadas", $style . 'border:B;');
        $table->easyCell("Total Compra", $style . 'border:B;');
        $table->easyCell("Mostrar", $style . 'border:B;');
        $table->printRow(true);

        // Llena la tabla con datos
        foreach ($data as $key => $item) {
            $table->easyCell($key + 1, $style);
            $table->easyCell(Help::date($item->fecha_emision), $style);
            $table->easyCell($item->documento, $style);
            $table->easyCell($item->nit, $style);
            $table->easyCell($item->dui, $style);
            $table->easyCell($item->nrc, $style);
            $table->easyCell(number_format($item->gravadas_internas + $item->gravadas_importaciones, 2), $numberStyle);
            $table->easyCell(number_format($item->total_compra, 2), $numberStyle);
            $table->easyCell($item->mostrar ? 'Sí' : 'No', $style);
            $table->printRow();
        }

        $table->endTable(10);

        $pdf->Output('I', 'Reporte_Libro_Compra_' . $mes . '_' . $anio . '.pdf');
        exit;
    }
}