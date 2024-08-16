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
              <th>Excenta</th> <th>No Sujeta</th>
              <th>Iva</th>
              <th>Total</th>
            </tr>
          </thead>
          <tbody class="table-group-divider">
            @php
                $valor = 0;
                $desc = 0;
                $nosujeta = 0;
                $gravada = 0;
                $excenta = 0;
                $iva = 0;
                $total = 0;
            @endphp
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
                <td class="text-end">{{ number_format($item->exenta,2) }}</td>
                <td class="text-end">{{ number_format($item->nosujeta,2) }}</td>
                <td class="text-end">{{ number_format($item->iva,2) }}</td>
                <td class="text-end">{{ number_format($item->total,2) }}</td>
                @php
                    $valor = $valor+ ($item->cantidad*$item->precio_unitario);
                    $desc = $desc+ $item->descuento;
                    $nosujeta = $nosujeta+$item->nosujeta;
                    $gravada = $gravada+$item->gravada;
                    $excenta = $excenta+$item->exenta;
                    $iva = $iva+$item->iva;
                    $total =$total+$item->total;
                @endphp
              </tr>
            @endforeach

            <tr>
              <th colspan="2" class="text-end">TOTAL</th>
              <th id="totalCantidad" class="text-center"></th>
              <th></th>
              <th id="totalValor" class="text-end">{{ number_format($valor,2) }}</th>
              <th id="totalDesc" class="text-end">{{ number_format($desc,2) }}</th>
              <th id="totalGravada" class="text-end">{{ number_format($nosujeta,2) }}</th>
              <th id="totalExcenta" class="text-end">{{ number_format($gravada,2) }}</th>
              <th  class="text-end">{{ number_format($nosujeta,2) }}</th>
              <th id="totalIva" class="text-end">{{ number_format($iva,2) }}</th>
              <th id="totalTotal" class="text-end">{{ number_format($total,2) }}</th>
          </tr>
            
            
          </tbody>
         
    </table>
    @else 
    <div class="alert alert-danger" role="alert">
       No hay items para mostrar
      </div>
       @endif
    
    </div>
</div>

