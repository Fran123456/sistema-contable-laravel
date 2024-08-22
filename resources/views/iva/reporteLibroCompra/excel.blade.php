<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Reporte Libro Compra</title>
</head>
<body>
    <br><br><br>
    <div style="margin: 0; padding: 20px; box-sizing: border-box;">
        <table style="width: 100%; border-collapse: collapse; margin-bottom: 20px;">
            <tr>
                <td colspan="5" style="border: 1px solid #ddd; padding: 8px; text-align: center; white-space: nowrap;">
                    <strong>NOMBRE DEL CONTRIBUYENTE: </strong>&nbsp; {{ $empresa }}
                </td>
                <td colspan="1" style="border: 1px solid #ddd; padding: 8px; text-align: center; white-space: nowrap;">
                    <strong>NRC: </strong>&nbsp; {{ $empresa->nrc ?? ' NO DISPONIBLE' }}
                </td>
                <td colspan="1" style="border: 1px solid #ddd; padding: 8px; text-align: center; white-space: nowrap;">
                    <strong>NIT: </strong>&nbsp; {{ $empresa->nit ?? ' NO DISPONIBLE' }}
                </td>
                <td colspan="1" style="border: 1px solid #ddd; padding: 8px; text-align: center; white-space: nowrap;">
                    <strong>MES: </strong>&nbsp; {{ $mes }}
                </td>
                <td colspan="1" style="border: 1px solid #ddd; padding: 8px; text-align: center; white-space: nowrap;">
                    <strong>AÑO: </strong>&nbsp; {{ $anio }}
                </td>
            </tr>
        </table>

        <table style="width: 100%; border-collapse: collapse;">
            <thead>
                <tr>
                    <th style="border: 1px solid #ddd; padding: 8px; text-align: center; white-space: nowrap;">#</th>
                    <th style="border: 1px solid #ddd; padding: 8px; text-align: left; white-space: nowrap;">Fecha Emisión</th>
                    <th style="border: 1px solid #ddd; padding: 8px; text-align: left; white-space: nowrap;">Documento</th>
                    <th style="border: 1px solid #ddd; padding: 8px; text-align: left; white-space: nowrap;">DUI</th>
                    <th style="border: 1px solid #ddd; padding: 8px; text-align: left; white-space: nowrap;">NIT</th>
                    <th style="border: 1px solid #ddd; padding: 8px; text-align: left; white-space: nowrap;">NRC</th>
                    <th style="border: 1px solid #ddd; padding: 8px; text-align: left; white-space: nowrap;">Proveedor</th>
                    <th style="border: 1px solid #ddd; padding: 8px; text-align: left; white-space: nowrap;">Compras Exentas Internas</th>
                    <th style="border: 1px solid #ddd; padding: 8px; text-align: left; white-space: nowrap;">Compras Exentas Impor/Inter</th>
                    <th style="border: 1px solid #ddd; padding: 8px; text-align: left; white-space: nowrap;">Compras Gravadas Internas</th>
                    <th style="border: 1px solid #ddd; padding: 8px; text-align: left; white-space: nowrap;">Compras Gravadas Impor/Inter</th>
                    <th style="border: 1px solid #ddd; padding: 8px; text-align: left; white-space: nowrap;">Crédito Fiscal</th>
                    <th style="border: 1px solid #ddd; padding: 8px; text-align: left; white-space: nowrap;">Contribución Especial</th>
                    <th style="border: 1px solid #ddd; padding: 8px; text-align: left; white-space: nowrap;">Anticipo IVA Retenido</th>
                    <th style="border: 1px solid #ddd; padding: 8px; text-align: left; white-space: nowrap;">Anticipo IVA Recibido</th>
                    <th style="border: 1px solid #ddd; padding: 8px; text-align: left; white-space: nowrap;">Total Compra</th>
                    <th style="border: 1px solid #ddd; padding: 8px; text-align: left; white-space: nowrap;">Compras Excluidas</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $key => $compra)
                <tr>
                    <td style="border: 1px solid #ddd; padding: 8px; text-align: center; white-space: nowrap;">{{ $key + 1 }}</td>
                    <td style="border: 1px solid #ddd; padding: 8px; text-align: left; white-space: nowrap;">{{ \Carbon\Carbon::parse($compra->fecha_emision)->format('d/m/Y') }}</td>
                    <td style="border: 1px solid #ddd; padding: 8px; text-align: right; white-space: nowrap;">{{ $compra->documento }}</td>
                    <td style="border: 1px solid #ddd; padding: 8px; text-align: right; white-space: nowrap;">{{ $compra->dui }}</td>
                    <td style="border: 1px solid #ddd; padding: 8px; text-align: right; white-space: nowrap;">{{ $compra->nit }}</td>
                    <td style="border: 1px solid #ddd; padding: 8px; text-align: right; white-space: nowrap;">{{ $compra->nrc }}</td>
                    <td style="border: 1px solid #ddd; padding: 8px; text-align: right; white-space: nowrap;">{{ $compra->proveedor->nombre ?? 'N/A' }}</td>
                    <td style="border: 1px solid #ddd; padding: 8px; text-align: right; white-space: nowrap;">{{ $compra->excentas_internas }}</td>
                    <td style="border: 1px solid #ddd; padding: 8px; text-align: right; white-space: nowrap;">{{ $compra->excentas_importaciones }}</td>
                    <td style="border: 1px solid #ddd; padding: 8px; text-align: right; white-space: nowrap;">{{ $compra->gravadas_internas }}</td>
                    <td style="border: 1px solid #ddd; padding: 8px; text-align: right; white-space: nowrap;">{{ $compra->gravadas_importaciones }}</td>
                    <td style="border: 1px solid #ddd; padding: 8px; text-align: right; white-space: nowrap;">{{ $compra->gravada_iva }}</td>
                    <td style="border: 1px solid #ddd; padding: 8px; text-align: right; white-space: nowrap;">{{ $compra->contribucion_especial }}</td>
                    <td style="border: 1px solid #ddd; padding: 8px; text-align: right; white-space: nowrap;">{{ $compra->anticipo_iva_retenido }}</td>
                    <td style="border: 1px solid #ddd; padding: 8px; text-align: right; white-space: nowrap;">{{ $compra->anticipo_iva_recibido }}</td>
                    <td style="border: 1px solid #ddd; padding: 8px; text-align: right; white-space: nowrap;">{{ $compra->total_compra }}</td>
                    <td style="border: 1px solid #ddd; padding: 8px; text-align: right; white-space: nowrap;">{{ $compra->compras_excluidas }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>
