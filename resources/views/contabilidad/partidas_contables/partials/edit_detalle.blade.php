


<table class="table table-sm" id="detalles" >
    <thead>
        <tr>
            <th width="40" scope="col">#</th>
            <th scope="col" width="150">Codigo</th>
            <th scope="col" >Cuenta</th>
            <th scope="col">Concepto</th>
            <th class="text-center" scope="col">Debe</th>
            <th class="text-center" scope="col">Haber</th>
            <th class="text-center" scope="col" width="120">Fecha</th>
           
            <th width="50" class="text-center" scope="col"><i class="fas fa-trash"></i></th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <th colspan="4" scope="row"></th>  
            <td class="text-end"> <strong>{{ number_format($partida->debe,2) }}</strong> </td>
            <td class="text-end"> <strong>{{ number_format($partida->haber,2) }}</strong> </td>
            <th colspan="2" scope="row"></th> 
        </tr>
        @foreach ($partida->detalles as $key => $item)

            <tr class="  @if ($item->debe >0) table-danger @else table-success @endif">
                <th scope="row">{{ $key + 1 }}</th>
                <td>{{ $item->cuentaContable->codigo }} </td>
                <td>{{ $item->cuentaContable->nombre_cuenta }} </td>
                <td>{{ $item->concepto }} </td>
                <td class="text-end">{{ number_format($item->debe,2) }} </td>
                <td class="text-end">{{ number_format($item->haber,2) }} </td>
                <td class="text-center">{{  Help::date($item->fecha_contable) }}</td>
                <td class="text-center">
                    <form id="form{{ $item->id }}"
                        action="{{ route('contabilidad.eliminarDetallePartida', $item->id) }}"
                        method="post">
                        @method('DELETE')
                        @csrf
                        <button
                            onclick="confirm('form{{ $item->id }}','¿Desea eliminar el detalle de la partida?')"
                            class="btn @if ($item->cerrada) btn-success @else btn-danger @endif "
                            type="button"><i class="fas fa-trash"></i></button>
                    </form>
                </td>
            </tr>
        @endforeach


    </tbody>
</table>

