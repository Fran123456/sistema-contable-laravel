<?php

namespace App\ReportsPDF\RRHH;

use App\Help\PDF\EasyTable\easyTable;
use App\Help\PDF\EasyTable\exfpdf;
use App\Help\Help;
use App\Help\PDF\EasyTable\Styles;
use App\Help\Contabilidad\ReportesContables;

class IncapacidadRpt
{

    public static function report($fechai, $fechaf, $data)
    {
        $pdf = new exFPDF('REPORTE DE INCAPACIDADES', "DEL " . Help::date($fechai) . " AL " .  Help::date($fechaf), 'P', 'mm', 'legal');
        $pdf->AliasNbPages();
        $pdf->AddPage();
        $pdf->SetFont('Arial', '', 7);


        //ESTILOS POR DEFECTO PARA CELDAS DEL HEADER Y TABLA EN GENERAL
        $style = Styles::alignPaddingY('1.07', 'C');
        $generalStyle = Styles::alignPaddingY('1.13', 'C');
        $alternativeStyle = Styles::paddingY('1.13');
        $numberStyle = Styles::alignPaddingY('1.13', 'R');
        $alternativeStyleBorder = Styles::alignPaddingYBorder('1.07', 'C');

        $table = new easyTable($pdf, '%{10,35,18,18,19}', 'width:550; border-color:#3C4048;border-width:0.2; font-size:7.5; border:0; paddingY:1.3;');
        $table->rowStyle('font-style:B;font-color:#3F3F3F;valign:M;');


        foreach ($data as $key => $dt) {


            $table->easyCell('Codigo', $style . "border:B");
            $table->easyCell("Cuenta", $style . "border:B");
            $table->easyCell("Debe", $style . "border:B");
            $table->easyCell("Haber", $style . "border:B");
            $table->easyCell("Saldo", $style . "border:B");
            $table->printRow(true); //parametro true para indicar que es un header y replicar en las paginas

            // $table->easyCell($dt['cuenta']['codigo'],$alternativeStyle);
            // $table->easyCell($dt['cuenta']['nombre'],$alternativeStyle);
            // $table->easyCell("",$alternativeStyle);
            // $table->easyCell("",$alternativeStyle);
            // $table->easyCell( number_format($dt['cuenta']['saldo'],2 ) ,$numberStyle);
            // $table->printRow();


            foreach ($dt['detalle'] as $key => $d) {
                $table->easyCell($d['cuenta'], $alternativeStyle);
                $table->easyCell($d['nombre'], $alternativeStyle);
                $table->easyCell(number_format($d['debe'], 2), $numberStyle);
                $table->easyCell(number_format($d['haber'], 2), $numberStyle);
                $table->easyCell("", $numberStyle);
                $table->printRow();
            }

            // $table->easyCell("",$alternativeStyle);
            // $table->easyCell("",$alternativeStyle);
            // $table->easyCell( number_format($debe,2 )  ,$numberStyle);
            // $table->easyCell( number_format($haber,2 )  ,$numberStyle);
            // $table->easyCell("" ,$numberStyle);
            // $table->printRow();

            // for ($i=0; $i <4 ; $i++) {
            //     $table->easyCell("",$alternativeStyle);
            //     $table->easyCell("",$alternativeStyle);
            //     $table->easyCell("",$alternativeStyle);
            //     $table->easyCell("",$alternativeStyle);
            //     $table->easyCell("" ,$numberStyle);
            //     $table->printRow();
            // }
        }


        $table->endTable(15);

        $pdf->Output('I',  'reporte-incapacidades-del' . Help::date($fechai) . "-al-" .  Help::date($fechaf) . '.pdf');
        exit;
    }
}
