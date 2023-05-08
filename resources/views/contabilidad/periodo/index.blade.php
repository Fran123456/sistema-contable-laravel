<x-app-layout>

    <div class="col-md-12">
        <x-commonnav></x-commonnav>
    </div>
    <div class="col-md-12">
        <x-alert></x-alert>
    </div>

    <div class="col-md-6   mb-4">
        <form method="post" action="{{ route('contabilidad.periodos.store') }}">
            <label for="">Año a generar</label>
            @csrf
            <input name="year" required type="number" step="1" class="form-control">
            <button class="btn btn-primary mt-2" style="color:white;" type="submit"> <i class="fas fa-save"></i>
            </button>
        </form>

    </div>
    <div class="col-md-12">

        <div class="card">
            <div class="card-body">
                <h5>Periodos contables</h5>
                <table class="table table-sm" id="datatable-responsive">
                    <thead>
                        <tr>
                            <th width="40" scope="col">#</th>
                            <th scope="col">Codigo</th>
                            <th scope="col">Año</th><th scope="col">Mes</th>
                            <th width="40" class="text-center" scope="col">Estado</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($periodos as $key => $item)
                            <tr class="  @if ($item->activo) table-success @endif">

                                <th scope="row">{{ $key + 1 }}</th>
                                <td> 
                                    {{ $item->codigo }}
                                </td>
                                <td>{{ $item->year }} </td>
                                <td>
                                    {{  Help::monthToString($item->mes) }}
                                </td>
                                <td >
                                    <form id="form{{ $item->id }}"
                                        action="{{ route('contabilidad.periodos.destroy', $item->id) }}" method="post">
                                        @method('DELETE')
                                        @csrf
                                        <button onclick="confirm('form{{ $item->id }}','¿Desea modificar el estado del periodo?')"
                                            class="btn @if ($item->activo) btn-success @else btn-danger @endif "
                                            type="button">
                                            @if ($item->activo)
                                                <i class="fas fa-check-circle"></i>
                                            @else
                                                <i class="fas fa-times"></i>
                                            @endif
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach


                    </tbody>
                </table>
            </div>
        </div>

    </div>

</x-app-layout>
