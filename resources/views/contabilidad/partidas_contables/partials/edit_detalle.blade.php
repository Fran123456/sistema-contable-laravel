

<table class="table table-sm" >
    <thead>
        <tr>
            <th width="40" scope="col">#</th>
            <th scope="col" width="150">Codigo</th>
            <th scope="col" >Cuenta</th>
            <th scope="col">Concepto</th>
            <th scope="col">Debe</th>
            <th scope="col">Haber</th>
            <th scope="col" width="120">Fecha</th>
           
            <th width="50" class="text-center" scope="col"><i class="fas fa-trash"></i></th>
        </tr>
    </thead>
    <tbody>
        @foreach ($partida->detalles as $key => $item)
            <tr class="  @if ($item->debe >0) table-danger @else table-success @endif">

                <th scope="row">{{ $key + 1 }}</th>
                <td>{{ $item->cuentaContable->codigo }} </td>
                <td>{{ $item->cuentaContable->nombre_cuenta }} </td>
                <td>{{ $item->concepto }} </td>
                <td>{{ $item->debe }} </td>
                <td>{{ $item->haber }} </td>
                <td>{{  Help::date($item->fecha_contable) }}</td>
                <td class="text-center">
                    <form id="form{{ $item->id }}"
                        action="{{ route('contabilidad.tipos-de-partida.destroy', $item->id) }}"
                        method="post">
                        @method('DELETE')
                        @csrf
                        <button
                            onclick="confirm('form{{ $item->id }}','¿Desea eliminar el tipo de partida?')"
                            class="btn @if ($item->cerrada) btn-success @else btn-danger @endif "
                            type="button"><i class="fas fa-trash"></i></button>
                    </form>
                </td>
            </tr>
        @endforeach


    </tbody>
</table>