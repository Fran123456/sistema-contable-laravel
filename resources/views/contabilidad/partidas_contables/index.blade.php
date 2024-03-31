<x-app-layout>


    @if (Help::periodoContable())
    <x-slot:title>
        Listado de partidas contables periodo {{ Help::getNameMothByNumber(  ltrim(Help::periodoContable()?->mes, "0")) }} {{ Help::periodoContable()->year }}
    </x-slot>
    @endif

    <x-slot:subtitle>
        {{--Periodo {!! Help::periodoContable()?->codigo!!}  --}}
    </x-slot>

    <div class="col-md-12">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dasboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Partidas contables</li>
        </ol>
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
                <h5>Partidas contables del periodo: {!! Help::periodoContable()?->codigo ??
                "<span class='badge bg-danger'>No hay periodo activo</span>"!!} </h5>
                @if (count($partidas) > 0)
                    <table class="table table-sm" id="datatable-responsive">
                        <thead>
                            <tr>
                                <th width="40" scope="col">#</th>
                                <th scope="col" width="110">N° Partida</th>
                                <th scope="col" width="90">Tipo</th>
                                <th scope="col" width="90">DEBE</th>
                                <th scope="col" width="90">HABER</th>

                                <th width="100" scope="col">Fecha</th>

                                <th width="120" class="text-center" scope="col">Acciones</th>
                                <th width="60" class="text-center" scope="col">Anular</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($partidas as $key => $item)
                                <tr
                                    class="  @if ($item->anulada == true) table-danger @endif @if ($item->cerrada == true) table-warning @endif">

                                    <th scope="row">{{ $key + 1 }}</th>

                                    <td>{{  Help::codigoPartida($item) }} </td>
                                    <td>{{ $item->tipoPartida->tipo }} </td>
                                    <td>{{ $item->debe }} </td>
                                    <td>{{ $item->haber }} </td>

                                    <td> {{ Help::date($item->fecha_contable) }}</td>
                                    <td class="text-center">
                                        <a target="_blank"
                                            href="{{ route('contabilidad.reportePartidaContable', ['id' => $item->id, 'reporte' => 'pdf']) }}">
                                            <i class="fa-solid fa-file-pdf fa-2x"></i></a>

                                        @if ($item->anulada == false && $item->cerrada == false)
                                            <a
                                                href="{{ route('contabilidad.partidas.edit', $item->id) }}"
                                               ><i class="fa-solid fa-file-pen fa-2x"></i></a>
                                        @endif
                                    </td>
                                    <td class="text-center">

                                        @if (!$item->anulada)
                                            @if ($item->cerrada)
                                            <i class="fa-solid fa-lock"></i>
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
