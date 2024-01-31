<x-app-layout>
    <x-slot:title>
        Lista de periodos planillas
    </x-slot>

    <x-slot:subtitle>
    </x-slot>

    <div class="col-md-12">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Periodos Planillas</li>
        </ol>
    </div>
    <div class="col-md-12">
        <x-alert></x-alert>
    </div>

    <div class="col-md-12 text-end mb-4">
        <a class="btn btn-success" href="{{ route('rrhh.periodoPlanilla.create') }}"> <i class="fas fa-user-plus"></i> </a>
    </div>

            <div class="col-md-12">

                <div class="card">
                    <div class="card-body">
                        <h5>Periodos</h5>
                        <table class="table table-sm" id="datatable-responsive">
                            <thead>
                                <tr>
                                    <th width="40" scope="col">#</th>
                                    <th scope="col">Año</th>
                                    <th scope="col">Mes</th>
                                    <th scope="col">Tipo</th>
                                    <th scope="col">Periodo</th>
                                    <th scope="col">Activo</th>

                                    <th width="50" class="text-center" scope="col"><i class="fas fa-trash"></i></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($periodos as $key => $item)
                                <tr>

                                    <th scope="row">{{ $key + 1 }}</th>

                                    <td>{{ $item->year }} </td>
                                    <td>{{ $item->mes_string }} </td>
                                    <td>{{ $item->tipo_periodo }} </td>
                                    <td>{{ $item->periodo_dias }} </td>
                                    <td>{{ $item->activo == 1 ? 'Activo' : 'Inactivo' }}</td>

                                    <td>
                                        <form id="form{{ $item->id }}"
                                            action="{{ route('rrhh.periodoPlanilla.destroy', $item->id) }}"
                                            method="post">
                                            @method('DELETE')
                                            @csrf
                                            <button
                                                onclick="confirm('form{{ $item->id }}','¿Desea eliminar el periodo planilla?')"
                                                class="btn btn-danger"
                                                type="button" ><i class="fas fa-trash"></i></button>
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
