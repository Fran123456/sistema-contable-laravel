<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Reporte Libro Compra</title>
</head>
<body>

    <table style="text-align: center; width: 100%; border-collapse: collapse;">
        <tr>
            <td colspan="7" style="text-align: left;">
                <strong>NOMBRE DEL CONTRIBUYENTE:</strong> {{ $empresa->nombre ?? 'NO DISPONIBLE' }}
            </td>
            <td colspan="5" style="text-align: right;">
                <strong>NRC:</strong> {{ $empresa->nrc ?? 'NO DISPONIBLE' }}
            </td>
            <td colspan="5" style="text-align: right;">
                <strong>NIT:</strong> {{ $empresa->nit ?? 'NO DISPONIBLE' }}
            </td>
        </tr>
        <tr>
            <td colspan="7" style="text-align: left;">
                <strong>MES:</strong> {{ $mes }}
            </td>
            <td colspan="5" style="text-align: right;">
                <strong>AÑO:</strong> {{ $anio }}
            </td>
        </tr>
    </table>

    <br>

    <table class="table" border="1" style="border-collapse: collapse; width: 100%;">
        <thead>
            <tr>
                <th>#</th>
                <th>Fecha Emisión</th>
                <th>Documento</th>
                <th>NIT</th>
                <th>DUI</th>
                <th>NRC</th>
                <th>Proveedor</th>
                <th>Compras Exentas Internas</th>
                <th>Compras Exentas Impor/Inter</th>
                <th>Compras Gravadas Internas</th>
                <th>Compras Gravadas Impor/Inter</th>
                <th>Crédito Fiscal</th>
                <th>Contribución Especial</th>
                <th>Anticipo IVA Retenido</th>
                <th>Anticipo IVA Recibido</th>
                <th>Total Compra</th>
                <th>Compras Excluidas</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $key => $compra)
            <tr>
                <td>{{ $key + 1 }}</td>
                <td>{{ $compra->fecha_emision }}</td>
                <td>{{ $compra->documento }}</td>
                <td>{{ $compra->nit }}</td>
                <td>{{ $compra->dui }}</td>
                <td>{{ $compra->nrc }}</td>
                <td>{{ $compra->proveedor->nombre ?? 'N/A' }}</td>
                <td>{{ $compra->excentas_internas }}</td>
                <td>{{ $compra->excentas_importaciones }}</td>
                <td>{{ $compra->gravadas_internas }}</td>
                <td>{{ $compra->gravadas_importaciones }}</td>
                <td>{{ $compra->gravada_iva }}</td>
                <td>{{ $compra->contribucion_especial }}</td>
                <td>{{ $compra->anticipo_iva_retenido }}</td>
                <td>{{ $compra->anticipo_iva_recibido }}</td>
                <td>{{ $compra->total_compra }}</td>
                <td>{{ $compra->compras_excluidas }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

</body>
</html>
