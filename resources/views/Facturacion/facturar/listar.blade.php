<div class="row">
    <div class="col-md-12 table-responsive">
       @if (count($doc->detalles)>0)
       <table class="table  table-striped table-hover table-sm">
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
                <td class="text-end">{{ number_format( $item->cantidad*$item->precio_unitario,2)  }}</td>
                <td class="text-end">{{ number_format($item->descuento,2) }}</td>
                <td class="text-end">{{ number_format($item->gravada ,2) }}</td>
                <td class="text-end">{{ number_format($item->exenta,2) }}</td>
                <td class="text-end">{{ number_format($item->iva,2) }}</td>
                <td class="text-end">{{ number_format($item->total,2) }}</td>
              
              </tr>
            @endforeach
            
            
          </tbody>
    </table>
    @else 
    <div class="alert alert-danger" role="alert">
       No hay items para mostrar
      </div>
       @endif
    
    </div>
</div>