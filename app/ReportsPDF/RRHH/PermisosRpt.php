<?php

namespace App\ReportsPDF\RRHH;

use App\Help\PDF\EasyTable\easyTable;
use App\Help\PDF\EasyTable\exfpdf;
use App\Help\PDF\EasyTable\Styles;
use DateTime;

class PermisosRpt
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
        $alternativeStyle = Styles::paddingY('1.13');
        $bordesCompletos = "border:BTRL";

        $table = new easyTable($pdf, '%{15,20,15,8,8,20,14}', 'width:550; border-color:#3C4048;border-width:0.2; font-size:7.5; border:0; paddingY:1.3;');
        $table->rowStyle('font-style:B;font-color:#3F3F3F;valign:M;');

        $table->easyCell('Empresa', $style . $bordesCompletos);
        $table->easyCell("Empleado", $style . $bordesCompletos);
        $table->easyCell(utf8_decode("Período Planilla"), $style . $bordesCompletos);
        $table->easyCell("Fecha", $style . $bordesCompletos);
        $table->easyCell("Cantidad", $style . $bordesCompletos);
        $table->easyCell("Tipo", $style . $bordesCompletos);
        $table->easyCell(utf8_decode("Descripción"), $style . $bordesCompletos);
        $table->printRow(true); //parametro true para indicar que es un header y replicar en las paginas

        foreach ($incapacidades as $key => $item) {

            $periodo = $item->periodo_planilla->mes_string . ' ' . $item->periodo_planilla->year . ' ' . $item->periodo_planilla->tipo_periodo . ' ' . $item->periodo_planilla->periodo_dias;
            $diasInca = $item->cantidad;

            $table->easyCell(utf8_decode($item->empresa->empresa),$alternativeStyle . $bordesCompletos );
            $table->easyCell(utf8_decode($item->empleado->nombre_completo),$alternativeStyle . $bordesCompletos );
            $table->easyCell($periodo, $alternativeStyle . $bordesCompletos );
            $table->easyCell(date_format(new DateTime($item->fecha_inicio), 'd-m-Y'),$alternativeStyle . $bordesCompletos );
            $table->easyCell( $diasInca . ($diasInca == 1 ? utf8_decode(' día') : utf8_decode(' días')) , $alternativeStyle . $bordesCompletos );
            $table->easyCell( utf8_decode($item->tipo_permiso), $alternativeStyle . $bordesCompletos );
            $table->easyCell( utf8_decode($item->descripcion), $alternativeStyle . $bordesCompletos );
            $table->printRow();

        }


        $table->endTable(15);

        $fecha = date("d-m-Y h:i:s");

        $pdf->Output('I',  'REPORTE-INCAPACIDADES-DEL ' . $header . ' ' . $fecha .'pdf');
        exit;
    }
}
