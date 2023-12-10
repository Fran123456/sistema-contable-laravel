<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>

    <table style="text-align: center">
      <tbody>
          <tr style="text-align: center">
              <th style="text-align: center" colspan="7">REPORTE DE SALDO DE CUENTAS {{ $fechai }} AL {{ $fechaf }}</th>
          </tr>
      </tbody>
  </table>

    <table class="table">
        <thead>
          <tr>
            <th scope="col"> <strong>#</strong> </th>
            <th scope="col" width="15"> <strong>Fecha</strong> </th>
            <th scope="col" width="14"> <strong>Codigo</strong></th>
            <th width="50"><strong>Concepto</strong></th>
            <th scope="col" width="14"><strong>Debe</strong></th>
            <th scope="col" width="14"><strong>Haber</strong></th>
            <th scope="col" width="14"><strong>Saldo</strong></th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td>{{ $saldo }}</td>
          </tr>

          @foreach ($data as $key=> $item)
          <tr>
            <th scope="row">{{ $key+1 }}</th>
            <td>{{ Help::date( $item->fecha_contable )}}</td>
            <td>{{ Help::codigoPartida($item->partida)  }}</td>
            <td>{{ $item->concepto }}</td>
            <td style="text-align: right">
                {{ number_format($item->debe,2) }}
            </td>
            <td style="text-align: right">
              {{ number_format($item->haber,2) }}
            </td>
            @php
                $saldoIns = $helpConta::saldoAcreedorDeudor($item->debe,$item->haber, $saldo, $cuenta->tipo_cuenta);
            @endphp
            <td style="text-align: right">
              {{ number_format($saldoIns,2) }}
            </td>

          </tr>
          @endforeach
        </tbody>
      </table>

</body>
</html>
