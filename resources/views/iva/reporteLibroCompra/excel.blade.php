<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Reporte Libro Compra</title>
</head>
<body>

    <table style="text-align: center">
      <tbody>
          <tr style="text-align: center">
              <th style="text-align: center" colspan="5">REPORTE DE LIBRO DE COMPRAS - {{ $mes }} / {{ $anio }}</th>
          </tr>
      </tbody>
  </table>

    <table class="table">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Fecha Emisión</th>
            <th scope="col">Documento</th>
            <th scope="col">NIT</th>
            <th scope="col">DUI</th>
            <th scope="col">NRC</th>
            <th scope="col">Proveedor</th>
            <th scope="col">Exentas Internas</th>
            <th scope="col">Exentas Importaciones</th>
            <th scope="col">Gravadas Internas</th>
            <th scope="col">Gravadas Importaciones</th>
            <th scope="col">Gravada IVA</th>
            <th scope="col">Contribución Especial</th>
            <th scope="col">Anticipo IVA Retenido</th>
            <th scope="col">Anticipo IVA Recibido</th>
            <th scope="col">Total Compra</th>
            <th scope="col">Compras Excluidas</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($data as $key => $compra)
          <tr>
            <th scope="row">{{ $key + 1 }}</th>
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
