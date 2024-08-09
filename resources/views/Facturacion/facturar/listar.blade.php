<div class="row">
    <div class="col-md-12 table-responsive">
       @if (count($doc->detalles)>0)
       <table class="table  table-striped table-hover table-sm text-center">
        <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">Item</th>
              <th scope="col">Cant</th>
              <th scope="col">Unitario</th>
              <th scope="col">Valor</th>
              <th>Desc</th>
              <th>Gravada</th>
              <th>Excenta</th>
              <th>Iva</th>
              <th>Total</th>
            </tr>
          </thead>
          <tbody class="table-group-divider">

            @foreach ($doc->detalles as $key => $item)
            <tr>
                <th scope="row">{{ $key+1 }}</th>
               
                <td>
                    @if ($item->producto_id != null)
                    {{ $item->producto->codigo }} {{ $item->producto->producto }}
                    @endif

                    @if ($item->servicio_id != null)
                    {{ $item->servicio->codigo }}   {{ $item->servicio->nombre }}
                    @endif
                </td>


                <td>{{ $item->cantidad }}</td>
                <td class="text-end">{{ number_format($item->precio_unitario,2  ) }}</td>
                <td class="text-end">{{ number_format($item->cantidad*$item->precio_unitario,2)  }}</td>
                <td class="text-end">{{ number_format($item->descuento,2) }}</td>
                <td class="text-end">{{ number_format($item->gravada ,2) }}</td>
                <td class="text-end">{{ number_format($item->excenta,2) }}</td>
                <td class="text-end">{{ number_format($item->iva,2) }}</td>
                <td class="text-end">{{ number_format($item->total,2) }}</td>
              
              </tr>
            @endforeach
            
            
          </tbody>
          <tfoot>
            <tr>
                <th colspan="2" class="text-end">TOTAL</th>
                <th id="totalCantidad" class="text-center"></th>
                <th></th>
                <th id="totalValor" class="text-end"></th>
                <th id="totalDesc" class="text-end"></th>
                <th id="totalGravada" class="text-end"></th>
                <th id="totalExcenta" class="text-end"></th>
                <th id="totalIva" class="text-end"></th>
                <th id="totalTotal" class="text-end"></th>
            </tr>
        </tfoot>
    </table>
    @else 
    <div class="alert alert-danger" role="alert">
       No hay items para mostrar
      </div>
       @endif
    
    </div>
</div>

<script>
  document.addEventListener('DOMContentLoaded', function() {
    let totalCantidad = 0;
    let totalValor = 0;
    let totalDesc = 0;
    let totalGravada = 0;
    let totalExcenta = 0;
    let totalIva = 0;
    let totalTotal = 0;

    // Recorrer las filas de la tabla para sumar los valores
    document.querySelectorAll('tbody tr').forEach(function(row) {
        totalCantidad += parseFloat(row.children[2].innerText.replace(/,/g, ''));
        totalValor += parseFloat(row.children[4].innerText.replace(/,/g, ''));
        totalDesc += parseFloat(row.children[5].innerText.replace(/,/g, ''));
        totalGravada += parseFloat(row.children[6].innerText.replace(/,/g, ''));
        totalExcenta += parseFloat(row.children[7].innerText.replace(/,/g, ''));
        totalIva += parseFloat(row.children[8].innerText.replace(/,/g, ''));
        totalTotal += parseFloat(row.children[9].innerText.replace(/,/g, ''));
    });

    // Mostrar los totales en el pie de la tabla
    document.getElementById('totalCantidad').innerText = totalCantidad.toFixed(0).replace(/\d(?=(\d{3})+\.)/g, '$&,');
    document.getElementById('totalValor').innerText = totalValor.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,');
    document.getElementById('totalDesc').innerText = totalDesc.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,');
    document.getElementById('totalGravada').innerText = totalGravada.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,');
    document.getElementById('totalExcenta').innerText = totalExcenta.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,');
    document.getElementById('totalIva').innerText = totalIva.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,');
    document.getElementById('totalTotal').innerText = totalTotal.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,');
});
  </script>