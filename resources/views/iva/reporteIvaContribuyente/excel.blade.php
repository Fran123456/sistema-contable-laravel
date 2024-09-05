<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Reporte Libro Iva contribuyente</title>
</head>
<body>
    <div style="margin: 0; padding: 20px; box-sizing: border-box;">
        <table style="width: 100%; border-collapse: collapse; margin-bottom: 20px;">
            <tr>
                <td colspan="14" style="border: 1px solid #ddd; padding: 8px; text-align: start; white-space: nowrap;">
                    LIBRO O REGISTRO DE CONTRIBUYENTES  {{ $mes }} {{$anio}}
                </td>
            </tr>
        </table>

        <table style="width: 100%; border-collapse: collapse;">
            <thead>
                <tr>
                    <!-- Asegúrate de que el número de <th> coincida con el número de <td> en cada fila -->
                    <th style="border: 1px solid #ddd; padding: 8px; text-align: center; white-space: nowrap;">#</th>
                    <th style="border: 1px solid #ddd; padding: 8px; text-align: left; white-space: nowrap;">Fecha Emisión</th>
                    <th style="border: 1px solid #ddd; padding: 8px; text-align: left; white-space: nowrap;">Numero del documento</th>
                    <th style="border: 1px solid #ddd; padding: 8px; text-align: left; white-space: nowrap;">NRC</th>
                    <th style="border: 1px solid #ddd; padding: 8px; text-align: left; white-space: nowrap;">Nombre del Contribuyente</th>
                    <th style="border: 1px solid #ddd; padding: 8px; text-align: left; white-space: nowrap;">Ventas Exentas</th>
                    <th style="border: 1px solid #ddd; padding: 8px; text-align: left; white-space: nowrap;">Ventas No Sujetas</th>
                    <th style="border: 1px solid #ddd; padding: 8px; text-align: left; white-space: nowrap;">Ventas Gravas Local</th>
                    <th style="border: 1px solid #ddd; padding: 8px; text-align: left; white-space: nowrap;">Ventas Debito Fiscal</th>
                    <th style="border: 1px solid #ddd; padding: 8px; text-align: left; white-space: nowrap;">Ventas Ctas. tercero</th>
                    <th style="border: 1px solid #ddd; padding: 8px; text-align: left; white-space: nowrap;">Debito F. tercero</th>
                    <th style="border: 1px solid #ddd; padding: 8px; text-align: left; white-space: nowrap;">IVA percibido</th>
                    <th style="border: 1px solid #ddd; padding: 8px; text-align: left; white-space: nowrap;">IVA Retenido</th>
                    <th style="border: 1px solid #ddd; padding: 8px; text-align: left; white-space: nowrap;">Total Ventas</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $key => $contribuyente)
                @php
                    $total = $contribuyente->excenta + $contribuyente->no_sujeta + $contribuyente->gravadas_locales + $contribuyente->debito_fiscal +
                            $contribuyente->ventas_terceros + $contribuyente->debito_terceros + $contribuyente->iva_percibido - 
                            ($contribuyente->iva_retenido >= 1 ? $contribuyente->iva_retenido : number_format(0.00, 2));
                @endphp
                <tr>
                    <td style="padding: 8px; text-align: center; white-space: nowrap;">{{ $key + 1 }}</td>
                    <td style="padding: 8px; text-align: left; white-space: nowrap;">{{ \Carbon\Carbon::parse($contribuyente->fecha_emision)->format('d/m/Y') }}</td>
                    <td style="padding: 8px; text-align: right; white-space: nowrap;">{{ $contribuyente->documento }}</td>
                    <td style="padding: 8px; text-align: right; white-space: nowrap;">{{ $contribuyente->nrc }}</td>
                    <td style="padding: 8px; text-align: right; white-space: nowrap;">{{ $contribuyente->cliente }}</td>
                    <td style="padding: 8px; text-align: right; white-space: nowrap;">{{ $contribuyente->excenta }}</td>
                    <td style="padding: 8px; text-align: right; white-space: nowrap;">{{ $contribuyente->no_sujeta }}</td>
                    <td style="padding: 8px; text-align: right; white-space: nowrap;">{{ $contribuyente->gravadas_locales }}</td>
                    <td style="padding: 8px; text-align: right; white-space: nowrap;">{{ $contribuyente->debito_fiscal }}</td>
                    <td style="padding: 8px; text-align: right; white-space: nowrap;">{{ $contribuyente->ventas_terceros }}</td>
                    <td style="padding: 8px; text-align: right; white-space: nowrap;">{{ $contribuyente->debito_terceros }}</td>
                    <td style="padding: 8px; text-align: right; white-space: nowrap;">{{ $contribuyente->iva_percibido }}</td>
                    <td style="padding: 8px; text-align: right; white-space: nowrap;">{{ $contribuyente->iva_retenido }}</td>
                    <td style="padding: 8px; text-align: right; white-space: nowrap;">{{ $total }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>
