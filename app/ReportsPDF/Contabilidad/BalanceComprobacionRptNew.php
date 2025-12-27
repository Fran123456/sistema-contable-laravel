<?php

namespace App\ReportsPDF\Contabilidad;

use App\Help\Contabilidad\ReportesContables;
use App\Help\Help;
use App\Help\PDF\EasyTable\easyTable;
use App\Help\PDF\EasyTable\exfpdf;
use App\Help\PDF\EasyTable\Styles;
use App\Models\Contabilidad\ContaClasificacionCuenta;
use App\Models\Contabilidad\ContaCuentaContable;

class BalanceComprobacionRptNew
{

    public static function report($fechai, $fechaf  )
    {

        //$data = Help::groupArray($data,'codigo_cuenta');
        $n = 0;
        $pdf = new exFPDF('BALANCE DE ' . utf8_decode("COMPROBACIÓN"), " DEL " . Help::date($fechai) . " AL " . Help::date($fechaf), 'P', 'mm', 'legal');
        $pdf->AliasNbPages();
        $pdf->AddPage();
        $pdf->SetFont('Arial', '', 7);

        //ESTILOS POR DEFECTO PARA CELDAS DEL HEADER Y TABLA EN GENERAL
        $style = Styles::alignPaddingY('1.07', 'C');
        $generalStyle = Styles::alignPaddingY('1.13', 'C');
        $alternativeStyle = Styles::paddingY('1.13');
        $numberStyle = Styles::alignPaddingY('1.13', 'R');
        $alternativeStyleBorder = Styles::alignPaddingYBorder('1.07', 'C');

        //el % de la tabla debe ser 100 en su total si no no funciona.
        $table = new easyTable($pdf, '%{16,42,14,14,14}', 'width:550; border-color:#3C4048;border-width:0.2; font-size:7.5; border:0; paddingY:1.3;');
        $table->rowStyle('font-style:B;font-color:#3F3F3F;valign:M;');
        // Encabezado
        $table->easyCell(utf8_decode('Código'), 'font-size:11; font-style:B;');
        $table->easyCell('Cuenta', 'font-size:11; font-style:B;');
        //$table->easyCell('Saldo inicial', 'font-size:11; font-style:B;');
        $table->easyCell('Debe', 'font-size:11; font-style:B;align:R;');
        $table->easyCell('Haber', 'font-size:11; font-style:B;align:R;');
        $table->easyCell('Saldo', 'font-size:11; font-style:B;align:R;');
        $table->printRow();

        $debe = 0;
        $haber = 0;
        $cuentas1 = null;
        $numeros = [ 1,2,3,4,5, 6];
        $superTotalHaber = 0;
        $superTotalDebe = 0;
        $supersaldo = 0;
        $debetotal = 0;
        $habertotal = 0;
        $empresaId = Help::empresa();
        $clasificacion = ContaClasificacionCuenta::where('clasificacion', 'detalle')->where('empresa_id', $empresaId)->first();
        $totalNumeroSaldo = 0;
        foreach ($numeros as $key => $n) {

            $cuentas1 = ContaCuentaContable::where('codigo', 'like', $n . '%')
                //->where('clasificacion_id', $clasificacion->id)
                ->where('empresa_id', $empresaId)
                ->orderBy('codigo')->get();
            $data1 = array();

            foreach ($cuentas1 as $key => $value) {

                $aux = ReportesContables::obtenerSaldoMayorNuevoDebe($value, $fechai, $fechaf);
                $aux2 = ReportesContables::obtenerSaldoMayorNuevoHeber($value, $fechai, $fechaf);

                array_push($data1, array(
                    "debe" => $aux ?? "0",
                    "haber" => $aux2 ?? "0",
                    "codigo" => $value->codigo,
                    "nombre_cuenta" =>
                    $value->nombre_cuenta,
                    "naturaleza" => $value->tipo_cuenta,
                    //"obj" => $value,
                ));
            }
           // $total = 0;
            foreach ($data1 as $key2 => $dt) {
                //$saldoInicial = ReportesContables::obtenerSaldoMayorInicial($dt['obj'], $fechai, null);

                // if ($dt['haber'] < 0) {
                //     $dt['haber'] = $dt['haber'] * -1;
                // }
                // if ($dt['debe'] < 0) {
                //     $dt['debe'] = $dt['debe'] * -1;
                // }

                // $aux = $dt['haber'] - $dt['debe'];
                if (round($dt['debe'], 2) != 0 || round($dt['haber'], 2) != 0) {

                    $table->easyCell($dt['codigo']);
                    $table->easyCell(utf8_decode($dt['nombre_cuenta']));
                    //$table->easyCell(number_format(0, 2));
                    // $table->easyCell(number_format($saldoInicial, 2));
                    $table->easyCell(number_format($dt['debe'], 2), 'align:R;');
                    $table->easyCell(number_format($dt['haber'], 2), 'align:R;');


                    //$table->easyCell(number_format($dt['debe'] < 0 ? $dt['debe'] * -1 : $dt['debe'], 2), ' align:R;');
                    //$table->easyCell(number_format($dt['haber'] < 0 ? $dt['haber'] * -1 : $dt['haber'], 2), ' align:R;');

                    $total = 0;
                    // if ($dt['naturaleza'] == "deudora" || $dt['naturaleza'] == "DEUDORA" || $dt['naturaleza'] == "deudadora") {
                    

                    //     //$total = $saldoInicial + $dt['debe'] - $dt['haber'];
                    //     $total = $dt['debe'] - $dt['haber'];
                    //     $supersaldo = $supersaldo + $total;
                    //     $totalNumeroSaldo = $totalNumeroSaldo+$total;
                    //     $table->easyCell(number_format($total, 2), ' align:R;');
                    //     $table->printRow();
                    // } else {
                    //     if ($dt['haber'] == 0) {
                    //         //$total = ($saldoInicial + $dt['debe']);
                    //         $total = $dt['debe'];

                    //         $supersaldo = $supersaldo + $total;
                    //     } else {
                    //         //$total = ($saldoInicial + $dt['haber'] - $dt['debe']);
                    //         $total = $dt['haber'] - $dt['debe'];
                    //         $supersaldo = $supersaldo + $total;
                    //     }
                    //     $totalNumeroSaldo = $totalNumeroSaldo+$total;
                    //     $table->easyCell(number_format($total, 2), ' align:R;');
                    //     $table->printRow();
                    // }

                    if($dt['naturaleza'] == "DEUDORA"){
                        $total = $dt['debe'] - $dt['haber'];                        
                    } else {
                        $total = $dt['haber'] - $dt['debe'];
                    }

                    $table->easyCell(number_format($total, 2), 'align:R;');
                    $table->printRow();
                    

                    // $superTotalDebe = ($dt['debe'] < 0 ? $dt['debe'] * -1 : $dt['debe']) + $superTotalDebe;
                    // $superTotalHaber = ($dt['haber'] < 0 ? $dt['haber'] * -1 : $dt['haber']) + $superTotalHaber;

                }
            }

            if(count($data1) > 0){
                if($data1[0]['debe'] > 0 || $data1[0]['haber'] > 0){
                    $total = 0;

                    if($dt["naturaleza"] == "DEUDORA"){
                        $total = $data1[0]['debe'] - $data1[0]['haber'];
                    } else {
                        $total = $data1[0]['haber'] - $data1[0]['debe'];
                    }

                     $table->easyCell("",'border:T');
                    $table->easyCell("",'border:T');
                    $table->easyCell(number_format($data1[0]['debe'], 2), ' align:R;border:T');
                    $table->easyCell(number_format($data1[0]['haber'], 2), ' align:R;border:T');
                    $table->easyCell(number_format($total, 2), ' align:R;font-style:B;border:T');
                    $table->printRow();

                    $debe = $debe + $data1[0]['debe'];
                    $haber = $haber + $data1[0]['haber'];
                }
            }

            // $table->easyCell("",'border:T');
            // $table->easyCell("",'border:T');
            // $table->easyCell("",'border:T');
            // $table->easyCell(number_format($data1[0]['debe'], 2), ' align:R;border:T');
            // $table->easyCell(number_format($data1[0]['haber'], 2), ' align:R;border:T');
            // $table->easyCell(number_format($total, 2), ' align:R;font-style:B;border:T');
            // $table->printRow();

            $totalNumeroSaldo = 0;
        }

        $table->easyCell("", 'border:T');
        $table->easyCell("Total", 'border:T');
        $table->easyCell(number_format($debe, 2), ' align:R;border:T');
        $table->easyCell(number_format($haber, 2), ' align:R;border:T');
        $table->easyCell(number_format(0, 2), ' align:R;border:T');
        $table->printRow();

        $table->endTable(15);
        $pdf->Output('I', 'balance-comprobacion-del' . Help::date($fechai) . "-al-" . Help::date($fechaf) . '.pdf');
        exit;
    }
}
