<?php

namespace App\ReportsPDF\Contabilidad;

use App\Help\PDF\EasyTable\easyTable;
use App\Help\PDF\EasyTable\exfpdf;
use App\Help\Help;

use App\Help\PDF\EasyTable\Styles;
use App\Help\Contabilidad\ReportesContables;

class BalanceComprobacionRpt
{

    public static function report($fechai, $fechaf, $data){
        $data = Help::groupArray($data,'codigo_cuenta');
        $n=0;
        $pdf = new exFPDF('BALANCE DE '. utf8_decode("COMPROBACIÓN"), " DEL " . Help::date($fechai) . " AL " .  Help::date($fechaf)   , 'P', 'mm', 'legal');
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
        $table = new easyTable($pdf, '%{15,34,17,17,17}','width:550; border-color:#3C4048;border-width:0.2; font-size:7.5; border:0; paddingY:1.3;');
        $table->rowStyle('font-style:B;font-color:#3F3F3F;valign:M;');
        $table->easyCell('Codigo',$style."border:B");
        $table->easyCell("Cuenta",$style."border:B");
        $table->easyCell("Debe",$style."border:B");
        $table->easyCell("Haber",$style."border:B");
        $table->easyCell("Saldo",$style."border:B");
        $table->printRow(true);//parametro true para indicar que es un header y replicar en las paginas
        $debeTotal = 0;
        $haberTotal = 0;


        foreach ($data as $key => $dt) {

            $table->easyCell( $dt['codigo_cuenta'],$alternativeStyle);
            $debe = 0;
            $haber = 0;
            foreach ($dt['groupeddata'] as $key2 => $t) {
                $debe +=$t['debe'];
                $haber +=$t['haber'];
            }
            $table->easyCell(  utf8_decode($t['cuenta_contable']['nombre_cuenta'])  ,$alternativeStyle);
            $table->easyCell(number_format($debe,2 ),$numberStyle);
            $table->easyCell(number_format($haber,2 ),$numberStyle);
            $table->easyCell(number_format( ReportesContables::saldoAcreedorDeudor($debe, $haber, 0, $t['cuenta_contable']['tipo_cuenta']) ,2 ),$numberStyle);
            $table->printRow();
            $debeTotal += $debe;
            $haberTotal += $haber;
        }

        $table->easyCell( ""  ,$alternativeStyle."border:T");
        $table->easyCell( ""  ,$alternativeStyle."border:T");
        $table->easyCell(number_format($debeTotal,2 ),$numberStyle."border:T");
        $table->easyCell(number_format($haberTotal,2 ),$numberStyle."border:T");
        $table->easyCell("",$numberStyle."border:T");
        $table->printRow();

        $table->endTable(15);
        $pdf->Output('I',  'balance-comprobacion-del'.Help::date($fechai) . "-al-" .  Help::date($fechaf). '.pdf');
        exit;
    }
}
