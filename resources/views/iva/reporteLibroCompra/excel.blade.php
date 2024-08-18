<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Reporte Libro Compra</title>
</head>
<body>

<br>
<br>
<br>
    <div style="margin: 0; padding: 20px; box-sizing: border-box;">
        <table style="width: 100%; border-collapse: collapse; margin-bottom: 20px;">
            <tr>
                <td colspan="5" style="border: 1px solid #ddd; padding: 10px; text-align: center;">
                    <strong>NOMBRE DEL CONTRIBUYENTE: </strong> {{ $empresa->nombre ?? ' NO DISPONIBLE' }}
                </td>
                <td colspan="5" style="border: 1px solid #ddd; padding: 10px; text-align: center;">
                    <strong>NRC: </strong> {{ $empresa->nrc ?? ' NO DISPONIBLE' }}
                </td>
                <td colspan="5" style="border: 1px solid #ddd; padding: 10px; text-align: center;">
                    <strong>NIT: </strong> {{ $empresa->nit ?? ' NO DISPONIBLE' }}
                </td>
                <td colspan="5" style="border: 1px solid #ddd; padding: 10px; text-align: center;">
                    <strong>MES: </strong> {{ $mes }}
                </td>
                <td colspan="5" style="border: 1px solid #ddd; padding: 10px; text-align: center;">
                    <strong>AÑO: </strong> {{ $anio }}
                </td>
            </tr>
        </table>

        <table style="width: 100%; border-collapse: collapse;">
            <thead>
                <tr>
                    <th style="border: 1px solid #ddd; padding: 8px; text-align: center;">#</th>
                    <th colspan="2" style="border: 1px solid #ddd; padding: 8px; text-align: center;">Fecha Emisión</th>
                    <th colspan="2" style="border: 1px solid #ddd; padding: 8px; text-align: center;">Documento</th>
                    <th colspan="2" style="border: 1px solid #ddd; padding: 8px; text-align: center;">NIT</th>
                    <th colspan="2" style="border: 1px solid #ddd; padding: 8px; text-align: center;">DUI</th>
                    <th colspan="3" style="border: 1px solid #ddd; padding: 8px; text-align: center;">NRC</th>
                    <th colspan="3" style="border: 1px solid #ddd; padding: 8px; text-align: center;">Proveedor</th>
                    <th colspan="3" style="border: 1px solid #ddd; padding: 8px; text-align: center;">Compras Exentas Internas</th>
                    <th colspan="3" style="border: 1px solid #ddd; padding: 8px; text-align: center;">Compras Exentas Impor/Inter</th>
                    <th colspan="3" style="border: 1px solid #ddd; padding: 8px; text-align: center;">Compras Gravadas Internas</th>
                    <th colspan="3" style="border: 1px solid #ddd; padding: 8px; text-align: center;">Compras Gravadas Impor/Inter</th>
                    <th colspan="2" style="border: 1px solid #ddd; padding: 8px; text-align: center;">Crédito Fiscal</th>
                    <th colspan="2" style="border: 1px solid #ddd; padding: 8px; text-align: center;">Contribución Especial</th>
                    <th colspan="2" style="border: 1px solid #ddd; padding: 8px; text-align: center;">Anticipo IVA Retenido</th>
                    <th colspan="2" style="border: 1px solid #ddd; padding: 8px; text-align: center;">Anticipo IVA Recibido</th>
                    <th colspan="2" style="border: 1px solid #ddd; padding: 8px; text-align: center;">Total Compra</th>
                    <th colspan="2" style="border: 1px solid #ddd; padding: 8px; text-align: center;">Compras Excluidas</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $key => $compra)
                <tr>
                    <td style="border: 1px solid #ddd; padding: 8px; text-align: center;">{{ $key + 1 }}</td>
                    <td colspan="2" style="border: 1px solid #ddd; padding: 8px; text-align: center;">{{ $compra->fecha_emision }}</td>
                    <td colspan="2" style="border: 1px solid #ddd; padding: 8px; text-align: center;">{{ $compra->documento }}</td>
                    <td colspan="2" style="border: 1px solid #ddd; padding: 8px; text-align: center;">{{ $compra->nit }}</td>
                    <td colspan="2" style="border: 1px solid #ddd; padding: 8px; text-align: center;">{{ $compra->dui }}</td>
                    <td colspan="3" style="border: 1px solid #ddd; padding: 8px; text-align: center;">{{ $compra->nrc }}</td>
                    <td colspan="3" style="border: 1px solid #ddd; padding: 8px; text-align: center;">{{ $compra->proveedor->nombre ?? 'N/A' }}</td>
                    <td colspan="3" style="border: 1px solid #ddd; padding: 8px; text-align: center;">{{ $compra->excentas_internas }}</td>
                    <td colspan="3" style="border: 1px solid #ddd; padding: 8px; text-align: center;">{{ $compra->excentas_importaciones }}</td>
                    <td colspan="3" style="border: 1px solid #ddd; padding: 8px; text-align: center;">{{ $compra->gravadas_internas }}</td>
                    <td colspan="3" style="border: 1px solid #ddd; padding: 8px; text-align: center;">{{ $compra->gravadas_importaciones }}</td>
                    <td colspan="2" style="border: 1px solid #ddd; padding: 8px; text-align: center;">{{ $compra->gravada_iva }}</td>
                    <td colspan="2" style="border: 1px solid #ddd; padding: 8px; text-align: center;">{{ $compra->contribucion_especial }}</td>
                    <td colspan="2" style="border: 1px solid #ddd; padding: 8px; text-align: center;">{{ $compra->anticipo_iva_retenido }}</td>
                    <td colspan="2" style="border: 1px solid #ddd; padding: 8px; text-align: center;">{{ $compra->anticipo_iva_recibido }}</td>
                    <td colspan="2" style="border: 1px solid #ddd; padding: 8px; text-align: center;">{{ $compra->total_compra }}</td>
                    <td colspan="2" style="border: 1px solid #ddd; padding: 8px; text-align: center;">{{ $compra->compras_excluidas }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>
