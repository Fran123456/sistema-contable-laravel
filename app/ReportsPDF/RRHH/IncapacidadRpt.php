<?php

namespace App\ReportsPDF\RRHH;

use App\Help\PDF\EasyTable\easyTable;
use App\Help\PDF\EasyTable\exfpdf;
use App\Help\PDF\EasyTable\Styles;
use DateTime;

class IncapacidadRpt
{

    public static function report($planilla, $incapacidades)
    {
        $header = 'MES DE ' . strtoupper($planilla->mes_string) . ' ' . $planilla->year . ' DE TIPO ' . strtoupper($planilla->tipo_periodo) . ' ' . $planilla->periodo_dias;
        $pdf = new exFPDF('REPORTE DE INCAPACIDADES ', $header, 'P', 'mm', 'legal');
        $pdf->AliasNbPages();
        $pdf->AddPage();
        $pdf->SetFont('Arial', '', 7);


        //ESTILOS POR DEFECTO PARA CELDAS DEL HEADER Y TABLA EN GENERAL
        $style = Styles::alignPaddingY('1.07', 'C');
        $generalStyle = Styles::alignPaddingY('1.13', 'C');
        $alternativeStyle = Styles::paddingY('1.13');
        $numberStyle = Styles::alignPaddingY('1.13', 'R');
        $alternativeStyleBorder = Styles::alignPaddingYBorder('1.07', 'C');

        $table = new easyTable($pdf, '%{23,23,15,10,8,21}', 'width:550; border-color:#3C4048;border-width:0.2; font-size:7.5; border:0; paddingY:1.3;');
        $table->rowStyle('font-style:B;font-color:#3F3F3F;valign:M;');

        $table->easyCell('Empresa', $style . "border:BTRL");
        $table->easyCell("Empleado", $style . "border:BTRL");
        $table->easyCell(utf8_decode("Período Planilla"), $style . "border:BTRL");
        $table->easyCell("Fecha", $style . "border:BTRL");
        $table->easyCell("Cantidad", $style . "border:BTRL");
        $table->easyCell("Tipo", $style . "border:BTRL");
        $table->printRow(true); //parametro true para indicar que es un header y replicar en las paginas

        foreach ($incapacidades as $key => $item) {

            $periodo = $item->periodoPlanilla->mes_string . ' ' . $item->periodoPlanilla->year . ' ' . $item->periodoPlanilla->tipo_periodo . ' ' . $item->periodoPlanilla->periodo_dias;
            $diasInca = $item->cantidad;

            $table->easyCell(utf8_decode($item->empresa->empresa),$alternativeStyle . "border:BTRL" );
            $table->easyCell(utf8_decode($item->empleado->nombre_completo),$alternativeStyle . "border:BTRL" );
            $table->easyCell($periodo, $alternativeStyle . "border:BTRL" );
            $table->easyCell(date_format(new DateTime($item->fecha_inicio), 'd-m-Y'),$alternativeStyle . "border:BTRL" );
            $table->easyCell( $diasInca . ($diasInca == 1 ? utf8_decode(' día') : utf8_decode(' días')) , $alternativeStyle . "border:BTRL" );
            $table->easyCell( utf8_decode($item->tipoIncapacidad->tipo), $alternativeStyle . "border:BTRL" );
            $table->printRow();

        }


        $table->endTable(15);

        $fecha = date("d-m-Y h:i:s");

        $pdf->Output('I',  'REPORTE-INCAPACIDADES-DEL ' . $header . ' ' . $fecha .'pdf');
        exit;
    }
}
