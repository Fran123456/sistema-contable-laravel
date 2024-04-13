<?php

namespace App\Http\Controllers\Contabilidad;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Help\Help;
use App\Help\StdClass;
use App\Help\Contabilidad\ReportesContables;
use App\Help\Log;
use App\Models\Contabilidad\ContaCuentaContable;
use App\Models\Contabilidad\ContaDetallePartida;
use App\Models\Contabilidad\ContaBalanceConf;
use App\ReportsPDF\Contabilidad\SaldoCuentaRpt;
use App\Exports\Contabilidad\SaldoCuentaRpt as SaldoCuentaRptExcel;
use App\ReportsPDF\Contabilidad\LibroDiarioRpt;
use App\Exports\Contabilidad\LibroDiarioRpt as LibroDiarioRptExcel;
use PDF;
use App\Exports\Contabilidad\LibroDiarioMayorRpt as LibroDiarioMayorRptExcel;
use App\ReportsPDF\Contabilidad\LibroDiarioMayorRpt;
use App\ReportsPDF\Contabilidad\BalanceComprobacionRpt;
use App\Exports\Contabilidad\BalanceComprobacionRpt as BalanceComprobacionRptExcel;
use App\Models\Contabilidad\ContaPartidaContable;
use App\ReportsPDF\Contabilidad\BalanceComprobacionRptNew;
use App\Help\Fecha;
use App\Models\Contabilidad\ContaClasificacionCuenta;

use Maatwebsite\Excel\Facades\Excel;

class ReportesContablesController extends Controller
{

    public function reportes(){

       
        $c  = ContaClasificacionCuenta::where('clasificacion', 'detalle')
        ->where('empresa_id', Help::empresa())->first();
        $cuentas = ContaCuentaContable::where('clasificacion_id', $c->id)->get();
        return view('contabilidad.reportes.home', compact('cuentas'));
    }

    public function reporteBalanceComprobacion(Request $request){

        /*$cuentas =ContaDetallePartida::
        whereBetween('fecha_contable', [$request->fechai, $request->fechaf])
        ->orderBy('codigo_cuenta', 'asc')->with(['cuentaContable'=>function($query){
            $query->select('nombre_cuenta','nombre_cuenta','id','tipo_cuenta');
        }])
        ->get()->toArray();*/

        /*$f = date("d-m-Y h:i:s");
        if($request->excel){
            return Excel::download(new BalanceComprobacionRptExcel($request->fechai, $request->fechaf, $cuentas), "balance-comprobacion-${f}.xlsx");
        }*/
        $data = ReportesContables::debeHaberPorCuentaByFechaGroupByCuenta($request->fechai, $request->fechaf);
       
        return BalanceComprobacionRptNew::report($request->fechai, $request->fechaf, $data);
        //return BalanceComprobacionRpt::report($request->fechai, $request->fechaf, $cuentas);
    }



    public function reporteEstadoResultado(Request $request)
    {


       // return $this->explout("44");
        $fechai = $request->fechai;
        $fechaf = $request->fechaf;
       //return AuxiliarDeCuentasRepository::getSaldo(601,$fechai, $fechaf );
      // return AuxiliarDeCuentasRepository::getSaldo(601,$fechai, $fechaf );
        $fechaReporte = "DEL ".Fecha::obtenerDia($fechai)." DE ".strtoupper(Fecha::obtenerMesyDiaPorFecha($fechai) )." AL ".Fecha::obtenerDia($fechaf)." DE ".strtoupper(Fecha::obtenerMesyDiaPorFecha($fechaf))." DE " . Fecha::obtenerYear( $fechaf);
        $mayor = ContaBalanceConf::whereIn('mayor', ['1','2','3'])->where('balance', 'balance')
        ->where('empresa_id', Help::empresa())
        ->orderBy('orden')->get();
        //mayor = 1 = trae cuenta de mayor
        //mayor = 2 = es un separador nada mas , este no se opera

        $data = array();
        foreach ($mayor as $key => $value) {
            $explode = array();
            $obj = new StdClass();
            $obj->id = $value->id;
            $obj->cuenta=$value->cuenta?->codigo;
            $obj->nombre_cuenta = $value->cuenta?->nombre_cuenta;
            $obj->grupo =  $value->grupo;
            $obj->mayor = $value->mayor;
            $obj->underline = $value->underline;
            $obj->espacio = $value->espacio;
            $obj->saldo =0;
            $obj->bold =$value->bold;

            if($value->mayor === 2){
                //$explode = str_split($value->anexo);
                $explode = $this->explout($value->anexo);
                //$operacion = $explode;
                //$operacion = array();
                $operacion= null;
                $signo = null;
                for ($i=0; $i <count($explode) ; $i++) {

                  if(StdClass::is_number($explode[$i])){
                    if($i == 0){
                        $operacion = $data[$explode[$i]-1]->saldo ;
                        //$operacion = $explode[$i]-1 ;
                       // array_push($operacion,$data[$explode[$i]-1]->saldo);
                    }else{

                      if($signo == "+")$operacion= $operacion + $data[$explode[$i]-1]->saldo ;
                    if($signo == "-")$operacion= $operacion - $data[$explode[$i]-1]->saldo ;
                     // if($signo=="+")$operacion = $operacion."+".$explode[$i]-1;
                     // if($signo == "-")$operacion = $operacion."-".$explode[$i]-1;

                     // if($signo == "+")$operacion= $operacion .'+'. $data[$explode[$i]-1]->saldo ;
                    //  if($signo == "-")$operacion= $operacion .'-'. $data[$explode[$i]-1]->saldo ;
                      // array_push($operacion,$data[$explode[$i]-1]->saldo);
                    }
                  }else{
                    $signo = $explode[$i];
                  }
                }
                $cuentas = array();

                $objCuenta = new StdClass();
                $objCuenta->id = null;
                $objCuenta->cuenta_id = null;
                $objCuenta->balance = 'resultado';
                $objCuenta->cuenta = null;
                $objCuenta->mayor = $value->mayor;
                $objCuenta->nombre_cuenta = null;
                $objCuenta->saldo = $operacion;
                $objCuenta->underline = $value->underline;
                $objCuenta->bold =$value->bold;

                array_push($cuentas, $objCuenta);
                $obj->data = $cuentas;
                $obj->saldo = $operacion;
            }
            elseif($value->mayor === 3){
               // $obj->saldo = ReportesContables::getSaldoEstadoResultado($value->cuenta_id,$fechai, $fechaf );
                $cuentaAux = ContaCuentaContable::find($value->cuenta_id);
                if($cuentaAux ==null ) return 1;

                $obj->saldo = ReportesContables::obtenerSaldoMayorNuevo( $cuentaAux,$fechai, $fechaf, false );
                $obj->data=[];
            }
            else{

                $obj->data = ContaBalanceConf::where('grupo', $value->grupo)->where('mayor', 0)
                ->where('empresa_id', Help::empresa())
                ->with('cuenta:id,codigo,nombre_cuenta')->get();
                $cuentas = array();
                $saldo = 0;
                foreach ($obj->data as $key => $d) {
                    $objCuenta = new StdClass();
                    $objCuenta->id = $d->id;
                    $objCuenta->cuenta_id = $d->cuenta_id;
                    $objCuenta->balance = $d->balance;
                    $objCuenta->cuenta = $d->cuenta->codigo;
                    $objCuenta->mayor = $d->mayor;
                    $objCuenta->bold =$d->bold;
                    $objCuenta->underline = $d->underline;
                    $objCuenta->nombre_cuenta = $d->cuenta->nombre_cuenta;
                    $cuentaAux = ContaCuentaContable::find($d->cuenta_id);

                    if($cuentaAux ==null ) return 1;
                    $objCuenta->saldo = ReportesContables::obtenerSaldoMayorNuevo($cuentaAux,$fechai, $fechaf , false);
                    array_push($cuentas, $objCuenta);
                    $obj->data = $cuentas;
                    $saldo =$saldo +  $objCuenta->saldo;
                }
                $obj->saldo = $saldo;
            }

            array_push($data, $obj);
            unset($obj);
            unset($cuentas);
            unset($objCuenta);



        }

       /* foreach ($data as $key => $value) {
           $b = BalanceConf::find(24);
           $b->cantidad = $value->saldo;
           $b->save();
        }*/

        //$firmas =FirmaBalance::all();
        $firmas =[];
        $context = compact('fechaReporte','data','firmas');
        ///return $data;
        $view = 'contabilidad.reportes.EstadoResultadosPDFRpt';
        if (isset($request->btnExcel)) {
            return Excel::download(
             /*   new EstadosFinancierosExport('exports.EstadosFinancieros.EstadoResultadoNew', $context),
                "Estado Resultado.xlsx"*/
            );
        }
        $pdf = PDF::loadView($view, $context)->setPaper('letter', 'portrait');
        $pdf->output();
        $dom_pdf = $pdf->getDomPDF();
        $canvas = $dom_pdf->get_canvas();
        $w = $canvas->get_width();
        $h = $canvas->get_height();
        $canvas->page_text($w - 55, $h - 28, "{PAGE_NUM} / {PAGE_COUNT}", null, 9, array(0, 0, 0));
        return $pdf->stream("Estado de Resultados.pdf");
    }




    public function explout($string){
        //$string = "1+2-4-6-8-10-12";
        $string = str_split($string);
        $final = null;

        $real = 0;
        for ($i=0; $i <count($string) ; $i++) {

            //evaluar el que corresponde
            $aux = $string[$i];
            if (is_numeric($string[$i])) {
                if(isset($string[$i+1])){
                    if(is_numeric($string[$i+1])){
                        $aux = $aux.$string[$i+1];
                        $i++;
                    }
                }
            }else{
                $aux = $string[$i];
            }

            $final[$real] = $aux;
            $real++;

        }
        return $final;
    }






    public function reporteSaldoCuenta(Request $request){

        $fechaFinSaldo = $request->fechai;
       // $fechaFinSaldo= date("Y-m-d",strtotime($fechaFinSaldo."- 1 day"));
        $saldo = ReportesContables::getSaldo($request->cuenta, null , $fechaFinSaldo);
        $data = ContaDetallePartida::where('cuenta_contable_id', $request->cuenta)
        ->whereBetween('fecha_contable', [$request->fechai, $request->fechaf])->get();
        $cuenta = ContaCuentaContable::find($request->cuenta);
        $f = date("d-m-Y h:i:s");
        if($request->excel){
            return Excel::download(new SaldoCuentaRptExcel($request->fechai, $request->fechaf, $data, $saldo, $cuenta), "saldoCuenta-${f}.xlsx");
        }
        return SaldoCuentaRpt::report($request->fechai, $request->fechaf, $data, $saldo, $cuenta);
    }

    public function reporteLibroDiario(Request $request){

        $data = ContaDetallePartida::whereBetween('fecha_contable',[$request->fechai, $request->fechaf])
        ->orderBy('fecha_contable','DESC')->with('cuentaContable','partida')->get();
        $f = date("d-m-Y h:i:s");
        if($request->excel){
            return Excel::download(new LibroDiarioRptExcel($request->fechai, $request->fechaf, $data), "libro-diario-${f}.xlsx");
        }
        return LibroDiarioRpt::report($request->fechai, $request->fechaf, $data->toArray());
    }

    public function listadoDePartidas(Request $request){

        $data = [
            'partida' => ContaPartidaContable::whereBetween('fecha_contable',[$request->fechai, $request->fechaf])
            ->orderBy('fecha_contable','DESC')->get(),
            'fechai'=> $request->fechai,
            'fechaf'=> $request->fechaf
        ];

        return PDF::loadView('contabilidad.reportes.ListadoPartidasPDF', $data)
        ->stream('listado_partidas_contables.pdf');

    }

    public function libroDiarioMayor(Request $request){
        $cuentas =ContaDetallePartida::select('codigo_cuenta','cuenta_contable_id')
        ->whereBetween('fecha_contable', [$request->fechai, $request->fechaf])
        ->groupBy('cuenta_contable_id')->get();
        $cuentasMayores = array();
        $cuentasMayoresObj = array();
        foreach ($cuentas as $key => $value) {
            $cuenta =$value->cuentaContable->buscarPadre($value->cuenta_contable_id,4);
          //  $detalle = ReportesContables::getSaldoDetalle($value->cuenta_contable_id, $request->fechai,$request->fechaf, true);
          //  $detalleArreglado = array();
            array_push($cuentasMayores,$cuenta->id);
            array_push($cuentasMayoresObj,array("id"=>$cuenta->id, "codigo"=> $cuenta->codigo, "nombre"=>
            $cuenta->nombre_cuenta, "saldo"=>$cuenta->saldo));
        }
        $cuentasMayoresFiltrado = array_unique($cuentasMayores);

        $data = array();
        $c = 0;
        foreach ( $cuentasMayoresFiltrado as $key => $value) {
            $detalle = ReportesContables::getSaldoDetalle($value, $request->fechai,$request->fechaf, true);
            if ( isset($detalle[0]['debe']) ) {
                //return $data[0]['detalle'];
             }else{
                $detalle = $detalle[0];
                 //return $data[1]['detalle'];
             }
             $c++;
            array_push($data, array("cuenta"=> $cuentasMayoresObj[$key], "detalle"=> $detalle)   );
        }
        $f = date("d-m-Y h:i:s");
        if($request->excel){
            return Excel::download(new LibroDiarioMayorRptExcel($request->fechai, $request->fechaf, $data), "libro-diario-mayor-${f}.xlsx");
        }
        return LibroDiarioMayorRpt::report($request->fechai, $request->fechaf, $data);


    }

}
