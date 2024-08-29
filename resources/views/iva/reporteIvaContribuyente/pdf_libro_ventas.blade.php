<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Libro de Ventas a Contribuyentes</title>
    <style>
        /* Estilos CSS para el diseño del PDF */
        body {
            font-family: Arial, sans-serif;
            font-size: 10px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th, td {
            border: 1px solid #000;
            padding: 4px;
            text-align: center;
        }

        th {
            background-color: #f2f2f2;
        }

        .text-center {
            text-align: center;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .header h2, .header p {
            margin: 0;
            padding: 0;
        }

    </style>
</head>
<body>

    <div class="header">
        <h2>{{ $empresa->empresa }}</h2>
        <p>Dirección:</p>
        <h2>LIBRO DE VENTAS A CONTRIBUYENTES</h2>
        <p>NRC: {{ $empresa->nrc }}</p>
        <p>NIT: {{ $empresa->nit }}</p>
        <p>MES: {{ $mes }} - AÑO: {{ $anio }}</p>
    </div>

    <table>
        <thead>
            <tr>
                <th rowspan="2">No</th>
                <th rowspan="2">Fecha de emisión</th>
                <th rowspan="2">Número del documento</th>
                <th rowspan="2">NRC</th>
                <th rowspan="2">Nombre del Contribuyente</th>
                <th colspan="9">VENTAS</th> 
            </tr>
            <tr>
                <th>Exentas</th>
                <th>No Sujetas</th>
                <th>Gravas Locales</th>
                <th>Débito Fiscal</th>
                <th>Ventas Ctas. terceros</th>
                <th>Débito F. terceros</th>
                <th>IVA Percibido</th>
                <th>IVA Retenido</th>
                <th>Total Ventas</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $index => $venta)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ \Carbon\Carbon::parse($venta->fecha_emision)->format('d/m/Y') }}</td>
                    <td>{{ $venta->documento }}</td>
                    <td>{{ $venta->nrc }}</td>
                    <td>{{ $venta->cliente }}</td>
                    <td>{{ number_format($venta->excenta, 2) }}</td>
                    <td>{{ number_format($venta->no_sujeta, 2) }}</td>
                    <td>{{ number_format($venta->gravadas_locales, 2) }}</td>
                    <td>{{ number_format($venta->debito_fiscal, 2) }}</td>
                    <td>{{ number_format($venta->ventas_terceros, 2) }}</td>
                    <td>{{ number_format($venta->debito_terceros, 2) }}</td>
                    <td>{{ number_format($venta->iva_percibido, 2) }}</td>
                    <td>{{ number_format($venta->iva_retenido, 2) }}</td>
                    <td>{{ number_format(
                        $venta->excentas + $venta->no_sujetas + $venta->gravadas_locales +
                        $venta->debito_fiscal + $venta->ventas_cuentas_de_tercero + 
                        $venta->debito_cuentas_de_tercero + $venta->iva_percibido - 
                        ($venta->iva_retenido >= 1 ? $venta->iva_retenido : number_format(0, 2)), 
                        2) 
                    }}</td>
                </tr>
            @endforeach
            <tr>
                <td colspan="5" class="text-center"><strong>Totales</strong></td>
                <td>{{ number_format($data->sum('excenta'), 2) }}</td>
                <td>{{ number_format($data->sum('gravadas_locales'), 2) }}</td>
                <td>{{ number_format($data->sum('no_sujeta'), 2) }}</td>
                <td>{{ number_format($data->sum('debito_fiscal'), 2) }}</td>
                <td>{{ number_format($data->sum('ventas_terceros'), 2) }}</td>
                <td>{{ number_format($data->sum('debito_terceros'), 2) }}</td>
                <td>{{ number_format($data->sum('iva_percibido'), 2) }}</td>
                <td>{{ number_format($data->sum('iva_retenido'), 2) }}</td>
                <td>{{ number_format(
                    $data->sum('excenta') + $data->sum('no_sujeta') + $data->sum('gravadas_locales') + $data->sum('debito_fiscal') +
                    $data->sum('ventas_terceros') + $data->sum('debito_terceros') + $data->sum('iva_percibido') + $data->sum('iva_retenido'),
                    2)
                }}</td>
            </tr>
        </tbody>
    </table>
</body>
</html>
