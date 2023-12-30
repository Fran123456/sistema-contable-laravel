<?php

namespace App\ReportsPDF\Contabilidad;

use App\Help\PDF\EasyTable\easyTable;
use App\Help\PDF\EasyTable\exfpdf;
use App\Help\Help;
use App\Help\PDF\EasyTable\Styles;
use App\Help\Contabilidad\ReportesContables;
use App\Models\Contabilidad\ContaCuentaContable;


class BalanceComprobacionRptNew
{

    public static function report($fechai, $fechaf, $data){

        //$data = Help::groupArray($data,'codigo_cuenta');
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
        $table = new easyTable($pdf, '%{15,45,10,10,10,10}', 'width:550; border-color:#3C4048;border-width:0.2; font-size:7.5; border:0; paddingY:1.3;');
        $table->rowStyle('font-style:B;font-color:#3F3F3F;valign:M;');
        // Encabezado
        $table->easyCell('Código', 'font-size:12; font-style:B;');
        $table->easyCell('Cuenta', 'font-size:12; font-style:B;');
        $table->easyCell('Saldo inicial', 'font-size:12; font-style:B;');
        $table->easyCell('Debe', 'font-size:12; font-style:B;');
        $table->easyCell('Haber', 'font-size:12; font-style:B;');
        $table->easyCell('Saldo', 'font-size:12; font-style:B;');
        $table->printRow();

        $cuentas1 = null;
        $numeros = [1,2,3,4,5,6];
        $superTotalHaber = 0;
        $superTotalDebe = 0;
        $supersaldo = 0;
        $debetotal = 0;
        $habertotal = 0;

        foreach ($numeros as $key => $n ) {

            $cuentas1 = ContaCuentaContable::where('codigo','like',$n.'%')->where('clasificacion_id', 2)->orderBy('codigo')->get();
             $data1 = array();


            foreach ($cuentas1 as $key => $value) {

                $aux = ReportesContables::obtenerSaldoMayorNuevoDebe($value, $fechai, $fechaf);
                $aux2 = ReportesContables::obtenerSaldoMayorNuevoHeber($value, $fechai, $fechaf);

                array_push($data1, array( "debe"=> $aux??"0" , "haber"=>$aux2??"0", "codigo"=>$value->codigo,"nombre_cuenta"=>
                    $value->nombre_cuenta, "naturaleza"=> $value->tipo_cuenta, "obj"=> $value  )  );
            }
            $total = 0;
            foreach ($data1 as $key2 => $dt) {
                $saldoInicial = ReportesContables::obtenerSaldoMayorInicial($dt['obj'], $fechai, null);


                $aux =$dt['haber'] - $dt['debe'];
                if(round($aux,2) != 0 || $saldoInicial !=0){


                    $table->easyCell($dt['codigo']);
                    $table->easyCell(utf8_decode($dt['nombre_cuenta']));
                    $table->easyCell(number_format( $saldoInicial,2));
                    $table->easyCell(number_format($dt['debe']<0?$dt['debe']*-1:$dt['debe'],2));
                    $table->easyCell(number_format($dt['haber']<0?$dt['haber']*-1:$dt['haber'],2));



                    if ($dt['naturaleza'] =="acreedora") {
                        $total = $saldoInicial+ $dt['debe']-$dt['haber'];
                        $supersaldo = $supersaldo+$total;

                    }else{
                        $total =$saldoInicial+$dt['haber']-$dt['debe'];
                        $supersaldo = $supersaldo+$total;
                    }


                    $table->easyCell(number_format($total,2));
                    $table->printRow();


                    $superTotalDebe = ($dt['debe']<0?$dt['debe']*-1:$dt['debe'])+$superTotalDebe;
                    $superTotalHaber = ($dt['haber']<0?$dt['haber']*-1:$dt['haber'])+$superTotalHaber;


                }
            }
        }

        $table->easyCell("");
        $table->easyCell("");
        $table->easyCell("");
        $table->easyCell(number_format($superTotalDebe,2) );
        $table->easyCell(number_format($superTotalHaber ,2) );
        $table->easyCell(number_format($supersaldo,2) );
        $table->printRow();


        $table->endTable(15);
        $pdf->Output('I',  'balance-comprobacion-del'.Help::date($fechai) . "-al-" .  Help::date($fechaf). '.pdf');
        exit;
    }
}
