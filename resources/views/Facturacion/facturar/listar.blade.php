<div class="row">
    <div class="col-md-12 table-responsive">
        <table class="table  table-striped table-hover table-sm">
            <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Item</th>
                  <th scope="col">Cantidad</th>
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
                    <td class="text-end">{{ number_format( $item->cantidad*$item->precio_unitario,2)  }}</td>
                    <td class="text-end">{{ number_format($item->descuento,2) }}</td>
                    <td class="text-end">{{ number_format($item->gravada ,2) }}</td>
                    <td class="text-end">{{ number_format($item->excenta,2) }}</td>
                    <td class="text-end">{{ number_format($item->iva,2) }}</td>
                    <td class="text-end">{{ number_format($item->total,2) }}</td>
                  
                  </tr>
                @endforeach
                
                
              </tbody>
        </table>
    
    </div>
</div>