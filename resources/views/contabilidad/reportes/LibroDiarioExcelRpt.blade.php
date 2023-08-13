<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Libro diario</title>
</head>
<body>

    <table style="text-align: center">
      <tbody>
          <tr style="text-align: center">
              <th style="text-align: center" colspan="7">REPORTE DE LIBRO DIARIO {{ $fechai }} AL {{ $fechaf }}</th>
          </tr>
      </tbody>
  </table>

    <table class="table">
        <thead>
          <tr>
            <th scope="col" width="15"> <strong>Fecha</strong> </th>
            <th scope="col" width="14"> <strong>Codigo</strong></th>
            <th scope="col" width="35"> <strong>Cuenta</strong></th>
            <th width="50"><strong>Concepto</strong></th>
            <th scope="col" width="14"><strong>Debe</strong></th>
            <th scope="col" width="14"><strong>Haber</strong></th>
          </tr>
        </thead>
        <tbody>
            @php
                $debe = 0;
                $haber = 0;
            @endphp
          @foreach ($data as $key=> $item)
          <tr>
            <td>{{ Help::date( $item->fecha_contable )}}</td>
            <td>{{ $item->cuentaContable->codigo  }}</td>
            <td>{{ $item->cuentaContable->nombre_cuenta  }}</td>

            @php
                $concepto = "";
                if ($item->concepto  == null) {
                    $concepto  = Help::codigoPartida($item['partida']);
                }else{
                    $concepto  = Help::codigoPartida($item['partida']) ." - ".utf8_decode($item->concepto);
                }
            @endphp
            <td>{{ $concepto }}</td>
            <td style="text-align: right">
                {{ number_format($item->debe,2) }}
            </td>
            <td style="text-align: right">
              {{ number_format($item->haber,2) }}
            </td>
          </tr>
          @php
              $debe += $item->debe;
              $haber += $item->haber;
          @endphp
          @endforeach

          <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td style="text-align: right">
                <strong>{{ number_format($debe,2) }}</strong>
            </td>
            <td style="text-align: right">
              <strong> {{ number_format($haber,2) }}</strong>
            </td>
          </tr>
        </tbody>
      </table>

</body>
</html>
