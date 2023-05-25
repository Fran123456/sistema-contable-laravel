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
                                <th scope="col" width="110">N° Partida</th>
                                <th scope="col" width="90">Tipo</th>
                                <th scope="col" width="90">DEBE</th>
                                <th scope="col" width="90">HABER</th>
                                <th scope="col">Concepto</th>
                                <th width="150" scope="col">Fecha Contable</th>
                                <th width="50" class="text-center" scope="col">Editar</th>
                                <th width="60" class="text-center" scope="col">Anular</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($partidas as $key => $item)
                                <tr class="  @if ($item->anulada == true) table-danger @endif @if ($item->cerrada == true) table-warning @endif">

                                    <th scope="row">{{ $key + 1 }}</th>

                                    <td>{{ $item->correlativo }} </td>
                                    <td>{{ $item->tipoPartida->tipo }} </td>
                                    <td>{{ $item->debe}} </td>
                                    <td>{{ $item->haber }} </td>
                                    <td>{{ $item->concepto }} </td>
                                    <td> {{  Help::date($item->fecha_contable) }}</td>
                                    <td>
                                        @if ($item->anulada == false && $item->cerrada == false)
                                           <a class="btn btn-warning" href="{{ route('contabilidad.partidas.edit', $item->id) }}" class="btn btn-waring"><i class="fas fa-edit"></i></a>
                                        @elseif($item->anulada == true && $item->cerrada == false)
                                           <button disabled class="btn btn-warning" ><i class="fas fa-edit"></i></button>
                                        @elseif($item->anulada == false && $item->cerrada == true)
                                            <button disabled class="btn btn-warning" ><i class="fas fa-edit"></i></button>
                                        @endif

                                    </td>
                                    <td class="text-center">
                                        @if (!$item->anulada)
                                          @if ($item->cerrada)
                                           CERRADA
                                          @else
                                          <form id="form{{ $item->id }}"
                                            action="{{ route('contabilidad.partidas.destroy', $item->id) }}"
                                            method="post">
                                            @method('DELETE')
                                            @csrf
                                            <button
                                                onclick="confirm('form{{ $item->id }}','¿Desea anular la partida?')"
                                                class="btn @if ($item->cerrada) btn-success @else btn-danger @endif "
                                                type="button"><i class="fas fa-ban"></i></button>
                                        </form>
                                          @endif
                                        @else
                                           <div class="text-center">ANULADA</div>
                                        @endif
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
