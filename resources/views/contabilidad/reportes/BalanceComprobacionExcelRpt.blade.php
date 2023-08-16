<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Balance de comprobación</title>
</head>
<body>

    <table style="text-align: center">
      <tbody>
          <tr style="text-align: center">
              <th style="text-align: center" colspan="5">BALANCE DE COMPROBACIÓN {{ Help::date($fechai) }} AL {{ Help::date($fechaf)}}</th>
          </tr>
      </tbody>
  </table>

    <table class="table">
        <thead>
          <tr>
            <th scope="col" width="14"> <strong>Codigo</strong></th>
            <th scope="col" width="35"> <strong>Cuenta</strong></th>
            <th scope="col" width="14"><strong>Debe</strong></th>
            <th scope="col" width="14"><strong>Haber</strong></th>
            <th scope="col" width="14"><strong>Saldo</strong></th>
          </tr>
        </thead>
        <tbody>
            @php
                $debeTotal = 0;
                $haberTotal = 0;
            @endphp
          @foreach ($data as $key => $dt)
          <tr>
             <td>{{ $dt['codigo_cuenta'] }}</td>

             @php
             $debe = 0;
             $haber = 0;
             @endphp
             @foreach ($dt['groupeddata'] as $key2 => $t)
                 @php
                     $debe +=$t['debe'];
                     $haber +=$t['haber'];
                 @endphp
             @endforeach
            <td>{{ $t['cuenta_contable']['nombre_cuenta'] }}</td>

            <td style="text-align: right">
                {{ number_format($debe,2) }}
            </td>

            <td style="text-align: right">
              {{ number_format($haber,2) }}
            </td>

            <td style="text-align: right">
                {{ number_format($contabilidadHelp::saldoAcreedorDeudor($debe, $haber, 0, $t['cuenta_contable']['tipo_cuenta']),2) }}
              </td>
          </tr>
          @php
              $debeTotal += $debe;
             $haberTotal += $haber;
          @endphp
          @endforeach

          <tr>
            <td></td>
            <td></td>

            <td style="text-align: right">
                <strong>{{ number_format($debeTotal ,2) }}</strong>
            </td>
            <td style="text-align: right">
              <strong> {{ number_format($haberTotal,2) }}</strong>
            </td>
            <td></td>
          </tr>
        </tbody>
      </table>

</body>
</html>
