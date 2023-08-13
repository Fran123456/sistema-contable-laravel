<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Libro diario mayor</title>
</head>
<body>

    <table style="text-align: center">
      <tbody>
          <tr style="text-align: center">
              <th style="text-align: center" colspan="7">REPORTE DE LIBRO DIARIO MAYOR {{ Help::date($fechai) }} AL {{ Help::date($fechaf) }}</th>
          </tr>
      </tbody>
  </table>

    <table class="table">
        <thead>
          <tr>
            <th scope="col" width="25"> <strong>Codigo</strong></th>
            <th scope="col" width="45"> <strong>Cuenta</strong></th>
            <th scope="col" width="14"><strong>Debe</strong></th>
            <th scope="col" width="14"><strong>Haber</strong></th>
            <th scope="col" width="14"><strong>Saldo</strong></th>
          </tr>
        </thead>
        <tbody>
            @php
                $debe = 0;
                $haber = 0;
            @endphp
          @foreach ($data as $key=> $dt)
          <tr>
            <td>{{  $dt['cuenta']['codigo'] }}</td>
            <td>{{ $dt['cuenta']['nombre'] }}</td>
            <td></td>
            <td></td>
            <td>{{   number_format($dt['cuenta']['saldo'],2)}}</td>
          </tr>
            @php
                $debe = 0;
                $haber = 0;
            @endphp
            @foreach ($dt['detalle'] as $key => $d)
                <tr>
                    <td>{{ $d['cuenta'] }}</td>
                    <td>{{ $d['nombre'] }}</td>
                    <td>{{  number_format($d['debe'],2 ) }}</td>
                    <td>{{  number_format($d['haber'],2 ) }}</td>
                    <td></td>
                </tr>
                @php
                    $debe += $d['debe'];
                    $haber +=$d['haber'];
                @endphp
            @endforeach

            <tr>
                <td></td>
                <td></td>
                <td>{{ number_format($debe,2 ) }}</td>
                <td>{{  number_format($haber,2 ) }}</td>
                <td></td>
            </tr>

            @for ($i=0; $i <1 ; $i++)
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
            @endfor


          @endforeach


        </tbody>
      </table>

</body>
</html>
