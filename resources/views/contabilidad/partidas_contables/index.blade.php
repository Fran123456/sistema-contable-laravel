<x-app-layout>

    <div class="col-md-12">
        <x-commonnav></x-commonnav>
    </div>
    <div class="col-md-12">
        <x-alert></x-alert>
    </div>

    <div class="col-md-12 text-end mt-2 mb-2">
        <!-- Button trigger modal -->
        <a style="color: white" type="button" class="btn btn-primary" href="{{ route('contabilidad.partidas.create') }}">
            <i class="fas fa-save"></i>
        </a>


    </div>


    <div class="col-md-12">

        <div class="card">
            <div class="card-body">
                <h5>Partidas contables del periodo: </h5>
                @if (count($partidas) > 0)
                    <table class="table table-sm" id="datatable-responsive">
                        <thead>
                            <tr>
                                <th width="40" scope="col">#</th>
                                <th scope="col">N° Partida</th>
                                <th scope="col">Tipo</th>
                                <th scope="col">Concepto</th>
                                <th scope="col">Fecha Contable</th>
                                <th width="50" class="text-center" scope="col">Estado</th>
                                <th width="50" class="text-center" scope="col">Anular</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($partidas as $key => $item)
                                <tr class="  @if ($item->anulada == false) table-danger @endif">

                                    <th scope="row">{{ $key + 1 }}</th>

                                    <td>{{ $item->correlativo }} </td>
                                    <td>{{ $item->tipo_partida_id }} </td>
                                    <td>{{ $item->concepto }} </td>
                                    <td>{{ $item->fecha_contable }}</td>
                                    <td>{{ $item->fecha_contable }}</td>
                                    <td>
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
                @else
                    <x-message color="danger" message="No hay partidas contables para el periodo solicitado">
                    </x-message>
                @endif
            </div>
        </div>

    </div>

</x-app-layout>
