<x-app-layout>
    <script>
        $(document).ready(function(){
            $.fn.modal.Constructor.prototype._enforceFocus = function() {};
        });
        </script>
    <x-slot:title>
        Lista de incapacidades
    </x-slot>

    <x-slot:subtitle>
    </x-slot>

    <div class="col-md-12">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
            <li class="breadcrumb-item" aria-current="page">Incapacidades</li>
            <li class="breadcrumb-item active" aria-current="page">Lista de incapacidades</li>
        </ol>
    </div>
    <div class="col-md-12">
        <x-alert></x-alert>
    </div>

    <div class="col-md-12 text-end mb-4">

        @include('rrhh.incapacidad.modal.modal_incapacidades')
        <a style="color:white" class="btn btn-success" href="#incapacidades_modal" data-bs-toggle="modal" data-bs-target="#incapacidades_modal"> Reporte </a>
        <a class="btn btn-success" href="{{ route('rrhh.incapacidad.create') }}"> <i class="fas fa-user-plus"></i> </a>
    </div>

    <div class="col-md-12">

        <div class="card">
            <div class="card-body">
                <h5>Incapacidades</h5>
                <table class="table table-sm" id="datatable-responsive">
                    <thead>
                        <tr>

                            <th width="40" scope="col">#</th>
                            <th scope="col">Empleado</th>
                            <th scope="col">Periodo Planilla</th>
                            <th scope="col">Fecha</th>
                            <th scope="col">Cantidad</th>
                            <th scope="col">Tipo</th>

                            <th width="50" class="text-center" scope="col"><i class="fas fa-edit"></i></th>
                            <th width="50" class="text-center" scope="col"><i class="fas fa-trash"></i></th>

                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($incapacidades as $key => $item)
                            <tr>

                                <th scope="row">{{ $key + 1 }}</th>

                                <td>{{ $item->empleado->nombre_completo }} </td>
                                <td>{{ $item->periodoPlanilla->mes_string }} - {{ $item->periodoPlanilla->year }} {{ $item->periodoPlanilla->tipo_periodo }} {{ $item->periodoPlanilla->periodo_dias }}</td>
                                <td>{{ date_format(new DateTime($item->fecha_inicio), 'd-m-Y') }} </td>
                                <td>{{ $item->cantidad }} </td>
                                <td>{{ $item->tipoIncapacidad->tipo }} </td>


                                <td><a href="{{ route('rrhh.incapacidad.edit', $item->id) }}" class="btn btn-warning"><i class="fas fa-edit"></i></a></td>
                                <td>
                                    <form id="form{{ $item->id }}"
                                        action="{{ route('rrhh.incapacidad.destroy', $item->id) }}" method="post">
                                        @method('DELETE')
                                        @csrf
                                        <button
                                            onclick="confirm('form{{ $item->id }}','¿Desea eliminar el empleado?')"
                                            class="btn btn-danger" type="button"><i class="fas fa-trash"></i></button>
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
