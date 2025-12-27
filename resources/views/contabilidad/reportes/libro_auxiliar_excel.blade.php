<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Libro Auxiliar</title>
</head>
<body>
    <table style="text-align: center">
            <tbody>
                <tr style="text-align: center">
                    <th colspan="8">LIBRO AUXILIAR  DEL {{ date('d/m/Y', strtotime($fechaInicial))}} AL {{ date('d/m/Y', strtotime($fechaFinal))}}</th>
                </tr>
            </tbody>
    </table>

    @foreach ($total as $key => $num)
        @php
            $cuentaC = $cuentaModel->find($num->id);
            $item = $aux::getTransactiosDetails($num->id,$fechaInicial,$fechaFinal);
            $saldo = $aux::getSaldo($num->id,null,$fechaInicial);
        @endphp
         <table>
              <tbody>
                @if (!empty($item) && isset($item[0]))
                    <tr>
                        <th colspan="3"> <strong>{{ $item[0]->codCuenta }} {{  $item[0]->nombre_cuenta }}</strong> </th>
                        <th> <strong>Saldo:</strong> </th>
                        <th > <strong> {{ number_format($saldo,2)}}</strong> </th>
                    </tr>
                @endif
                
              </tbody>
        </table>

        <table>
            <thead>
                <tr>
                  <th scope="col" width="15" style="font-weight: bold;">Fecha</th>
                  <th scope="col" width="100" style="font-weight: bold;">Concepto</th>
                  <th scope="col" width="14" style="font-weight: bold;">Debe</th>
                  <th scope="col" width="14" style="font-weight: bold;">Haber</th>
                  <th scope="col"  width="14" style="font-weight: bold;">Saldo</th>
                </tr>
              </thead>
              <tbody>
              @php
                  $totalDebe = 0;
                  $totalHaber = 0;
                  $cuenta = "";
                  $cuentaId = $cuentaModel->find($num->id);
              @endphp
              @foreach ($item as $key=> $transaccion)
                @php
                
                /*auxiliar por cuentas ( saldo + debe - haber ) cuentas activo 1 y 4
                     ( saldo - debe + haber )  2, 3, 5 
                por rango de cuentas y fecha inicial y final*/
                $totalDebe += $transaccion->debe;
                $totalHaber += $transaccion->haber;
    
    
                    $codigo = substr($cuentaId->codigo, 0, 1);
                    if( $codigo== "1" || $codigo== "4"){
                        if($transaccion->debe != 0)
                            $saldo = $saldo + $transaccion->debe ;
                        if($transaccion->haber != 0)
                            $saldo = $saldo - $transaccion->haber;
                    }else{
                        if($transaccion->debe != 0)
                            $saldo = $saldo - $transaccion->debe ;
                        if($transaccion->haber != 0)
                            $saldo = $saldo + $transaccion->haber;
                    }
                    $partida = $partidaModel->find($transaccion->partidaId);
                    $concepto  = $help::codigoPartida($partida) ." - ".utf8_decode($transaccion->concepto);
                @endphp
                
                        <tr>
                            <th>{{ date('d/m/Y', strtotime($transaccion->fecha_contable)) }}</th>
                            <td>{{$concepto}}</td>
                            <td style="text-align: right">{{number_format($transaccion->debe ,2)}}</td>
                            <td style="text-align: right">{{ number_format($transaccion->haber,2) }}</td>
                            <td style="text-align: right">{{ number_format($saldo,2) }}</td>
                            
                        </tr>
              @endforeach
                        <tr>
                          <td></td>
                          <td></td>
                          <td style="text-align: right; font-weight: bold;">{{ number_format($totalDebe,2)  }}</td>
                          <td style="text-align: right; font-weight: bold;">{{ number_format($totalHaber,2)  }}</td>
                          <td style="text-align: right; font-weight: bold;">{{ number_format($saldo,2) }}</td>
                        </tr>
            </tbody>
        </table>
    @endforeach
    
</body>
</html>