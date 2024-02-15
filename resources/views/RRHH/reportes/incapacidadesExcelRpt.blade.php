<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Incapacidades reporte</title>
</head>

<body>

    @php
        $header = 'MES DE ' . $planilla->mes_string . ' ' . $planilla->year . ' DE TIPO ' . $planilla->tipo_periodo . ' ' . $planilla->periodo_dias;
    @endphp

    <table style="text-align: center;">
        <tbody>
            <tr style="text-align: center">
                <th style="text-align: center;" colspan="7">REPORTE DE INCAPACIDADES
                    {{ $header }}</th>
            </tr>
        </tbody>
    </table>

    <table class="table table-bordered" style="text-align: left; border-collapse: collapse">
        <thead>
            <tr>
                <th scope="col" width="5" style="border: 1px solid #ddd;">#</th>
                <th scope="col" width="25" style="border: 1px solid #ddd;"><strong>Empresa</strong></th>
                <th scope="col" width="40" style="border: 1px solid #ddd;"><strong>Empleado</strong></th>
                <th scope="col" width="30" style="border: 1px solid #ddd;"><strong>Periodo Planilla</strong></th>
                <th scope="col" width="15" style="border: 1px solid #ddd;"><strong>Fecha</strong></th>
                <th scope="col" width="10" style="border: 1px solid #ddd;"><strong>Cantidad</strong></th>
                <th scope="col" width="27" style="border: 1px solid #ddd;"><strong>Tipo</strong></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $key => $item)
                <tr>
                    <th scope="row" style="text-align: left; border: 1px solid #ddd;">{{ $key + 1 }}</th>

                    <td style="border: 1px solid #ddd;">{{ $item->empresa->empresa }}</td>
                    <td style="border: 1px solid #ddd;">{{ $item->empleado->nombre_completo }}</td>
                    <td style="border: 1px solid #ddd;">{{ $item->periodoPlanilla->mes_string }} -
                        {{ $item->periodoPlanilla->year }} {{ $item->periodoPlanilla->tipo_periodo }}
                        {{ $item->periodoPlanilla->periodo_dias }}</td>
                    <td style="border: 1px solid #ddd;">{{ date_format(new DateTime($item->fecha_inicio), 'd-m-Y') }}
                    </td>
                    <td style="text-align: left; border: 1px solid #ddd;">{{ $item->cantidad }}</td>
                    <td style="border: 1px solid #ddd;">{{ $item->tipoIncapacidad->tipo }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

</body>

</html>
