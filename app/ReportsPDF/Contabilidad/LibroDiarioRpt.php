<?php

namespace App\ReportsPDF\Contabilidad;

use App\Help\PDF\EasyTable\easyTable;
use App\Help\PDF\EasyTable\exfpdf;
use App\Help\Help;
use App\Help\PDF\EasyTable\Styles;
use App\Help\Contabilidad\ReportesContables;

class LibroDiarioRpt
{

    public static function report($fechai, $fechaf, $data){
        $data = Help::groupArray($data, 'fecha_contable');
        $n=0;
        $pdf = new exFPDF('REPORTE DE LIBRO DIARIO', "DEL " . Help::date($fechai) . " AL " .  Help::date($fechaf)   , 'P', 'mm', 'legal');
        $pdf->AliasNbPages();
        $pdf->AddPage();
        $pdf->SetFont('Arial','',7);


        //ESTILOS POR DEFECTO PARA CELDAS DEL HEADER Y TABLA EN GENERAL
        $style= Styles::alignPaddingY('1.07', 'C');
        $generalStyle= Styles::alignPaddingY('1.13','C');
        $alternativeStyle=Styles::paddingY('1.13');
        $numberStyle= Styles::alignPaddingY('1.13','R');

        $alternativeStyleBorder= Styles::alignPaddingYBorder('1.07', 'C');


        //el % de la tabla debe ser 100 en su total si no no funciona.
        $table = new easyTable($pdf, '%{10,9,21,40,10,10}','width:550; border-color:#3C4048;border-width:0.2; font-size:7.5; border:0; paddingY:1.3;');
        $table->rowStyle('font-style:B;font-color:#3F3F3F;valign:M;');
        $table->easyCell("Fecha", $style);//rowspan es para combinar columnas
        $table->easyCell('Codigo',$style);
        $table->easyCell("Cuenta",$style);
        $table->easyCell("Concepto",$style);
        $table->easyCell("Debe",$style);
        $table->easyCell("Haber",$style);
        $table->printRow(true);//parametro true para indicar que es un header y replicar en las paginas
        $count =0;
        $debe = 0;
        $haber = 0;


        foreach ($data as $key => $dt) {

            $debeFecha = 0;
            $haberFecha = 0;
            foreach ($dt['groupeddata'] as $key2 => $t) {
                //$count = $key;
                $table->easyCell(  Help::date($dt['fecha_contable'] )  ,$alternativeStyle);
                $table->easyCell( $t['cuenta_contable']['codigo']  ,$numberStyle);
                $table->easyCell(  utf8_decode($t['cuenta_contable']['nombre_cuenta'])  ,$alternativeStyle);

                $concepto = "";
                if ($t['concepto']  == null) {
                    $concepto  = Help::codigoPartida($t['partida']);
                }else{
                    $concepto  = Help::codigoPartida($t['partida']) ." - ".utf8_decode($t['concepto']);
                }

                $table->easyCell($concepto ,$alternativeStyle);
                $table->easyCell( number_format($t['debe'],2 ),$numberStyle);
                $table->easyCell(number_format($t['haber'],2 ),$numberStyle);
                $table->printRow();
                $debe +=$t['debe'];
                $haber +=$t['haber'];
                $debeFecha +=$t['debe'];
                $haberFecha +=$t['haber'];

            }

            $table->easyCell(  ""  ,$alternativeStyle."border:T;");
            $table->easyCell( ""  ,$alternativeStyle."border:T;");
            $table->easyCell(  ""  ,$alternativeStyle."border:T;");
            $table->easyCell(  "" ,$alternativeStyle."border:T;");
            $table->easyCell( number_format($debeFecha,2 ),$numberStyle."border:T;");
            $table->easyCell(number_format($haberFecha,2 ),$numberStyle."border:T;");
            $table->printRow();

            $table->easyCell(  ""  ,$alternativeStyle);
            $table->easyCell( ""  ,$alternativeStyle);
            $table->easyCell(  ""  ,$alternativeStyle);
            $table->easyCell(  "" ,$alternativeStyle);
            $table->easyCell("",$alternativeStyle);
            $table->easyCell("",$alternativeStyle);
            $table->printRow();
        }

        $table->easyCell(  ""  ,$alternativeStyle."border:T;");
        $table->easyCell( ""  ,$alternativeStyle."border:T;");
        $table->easyCell(  ""  ,$alternativeStyle."border:T;");
        $table->easyCell(  "Total" ,$numberStyle."border:T;");
        $table->easyCell( number_format($debe,2 ),$numberStyle."border:T;");
        $table->easyCell(number_format($haber,2 ),$numberStyle."border:T;");
        $table->printRow();

        $table->endTable(15);
        //salto de tabla dinamico
        /*$decimal = $count / 27;
        if($decimal ==null){
        }else{
            $decimal = explode(".", $decimal);
            $decimal = $decimal[1];
            if($decimal >814814815){
                $space=new easyTable($pdf, 1,'width:260; font-size:10;');
                $space->endTable(20);
            }//salto de tabla dinamico
        }*/
        $pdf->Output('I',  'reporte-libro-diario-del'.Help::date($fechai) . "-al-" .  Help::date($fechaf). '.pdf');
        exit;


    }
}
