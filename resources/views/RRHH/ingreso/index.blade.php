<x-app-layout>
    <x-slot:title>
        Lista de Ingresos
    </x-slot>

    <x-slot:subtitle>
    </x-slot>

    <div class="col-md-12">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="/">RRHH</a></li>
            <li class="breadcrumb-item active" aria-current="page">Ingresos</li>
        </ol>
    </div>
    <div class="col-md-12">
        <x-alert></x-alert>
    </div>

    <div class="col-md-12 text-end mb-4">
        <a class="btn btn-success" href="{{ route('rrhh.ingreso.create') }}"> <i class="fas fa-user-plus"></i> </a>
    </div>

            <div class="col-md-12">

                <div class="card">
                    <div class="card-body">
                        <h5>Ingresos</h5>
                        <table class="table table-sm" id="datatable-responsive">
                            <thead>
                                <tr>
                                    <th width="40" scope="col">#</th>
                                    <th scope="col">Empleado</th>
                                    <th scope="col">Tipo</th>
                                    <th scope="col">Periodo Planilla</th>
                                    <th scope="col">Cantidad</th>
                                    <th scope="col">Fecha</th>
                                    <th width="50" class="text-center" scope="col"><i
                                            class="fas fa-edit"></i></th>
                                    <th width="50" class="text-center" scope="col"><i
                                            class="fas fa-trash"></i></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($ingresos as $key => $item)
                                <tr>

                                    <th scope="row">{{ $key + 1 }}</th>

                                    <td>{{ $item->empleado->nombre_completo }} </td>
                                    <td>{{ $item->tipoIngreso->tipo }} </td>
                                    <td>{{ $item->planilla->mes_string }} - {{ $item->planilla->year }} {{ $item->planilla->tipo_periodo }} {{ $item->planilla->periodo_dias }}</td>
                                    <td>{{ $item->cantidad }} </td>
                                    <td>{{ date_format(new DateTime($item->fecha), 'd-m-Y') }} </td>

                                    <td><a href="{{ route('rrhh.ingreso.edit', $item->id) }}" class="btn btn-warning"><i class="fas fa-edit"></i></a></td>
                                    <td>
                                        <form id="form{{ $item->id }}"
                                            action="{{ route('rrhh.ingreso.destroy', $item->id) }}"
                                            method="delete">
                                            @method('DELETE')
                                            @csrf
                                            <button
                                                onclick="confirm('form{{ $item->id }}','¿Desea eliminar el registro del ingreso?')"
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
