<x-app-layout>
    <x-slot:title>
        Lista de empleados
    </x-slot>

    <x-slot:subtitle>
    </x-slot>

    <div class="col-md-12">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Empleados</li>
        </ol>
    </div>
    <div class="col-md-12">
        <x-alert></x-alert>
    </div>

    <div class="col-md-12 text-end mb-4">
        <a class="btn btn-success" href="{{ route('rrhh.empleado.create') }}"> <i class="fas fa-user-plus"></i> </a>
    </div>

            <div class="col-md-12">

                <div class="card">
                    <div class="card-body">
                        <h5>Empleados</h5>
                        <table class="table table-sm" id="datatable-responsive">
                            <thead>
                                <tr>
                                    <th width="40" scope="col">#</th>
                                    <th scope="col">Nombre completo</th>
                                    <th scope="col">Fecha de nacimiento</th>
                                    <th scope="col">Estado</th>
                                    <th width="50" class="text-center" scope="col"><i
                                            class="fas fa-eye"></i></th>
                                    <th width="50" class="text-center" scope="col"><i
                                            class="fas fa-edit"></i></th>
                                    <th width="50" class="text-center" scope="col"><i
                                            class="fas fa-trash"></i></th>
                                </tr>
                            </thead>
                            <tbody>
                                {{-- @foreach ($empleados as $key => $item)
                                <tr class="  @if ($item->actualizada == false) table-danger @endif">

                                    <th scope="row">{{ $key + 1 }}</th>

                                    <td>{{ $item->nombre_completo }} </td>
                                    <td>{{ $item->fecha_ingreso }} </td>

                                    <td>
                                        @if ($item->activo)
                                            Activo
                                        @else
                                            No Activo
                                        @endif
                                    </td>

                                    <td><a href="{{ route('rrhh.empleado.show', $item->id) }}" class="btn btn-warning"><i class="fas fa-eye"></i></a></td>
                                    <td><a href="{{ route('rrhh.empleado.edit', $item->id) }}" class="btn btn-warning"><i class="fas fa-edit"></i></a></td>
                                    <td>
                                        <form id="form{{ $item->id }}"
                                            action="{{ route('rrhh.empleado .destroy', $item->id) }}"
                                            method="post">
                                            @method('DELETE')
                                            @csrf
                                            <button
                                                onclick="confirm('form{{ $item->id }}','¿Desea eliminar el empleado?')"
                                                class="btn @if ($item->activo) btn-success @else btn-danger @endif "
                                                type="button" ><i class="fas fa-trash"></i></button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach --}}


                            </tbody>
                        </table>
                    </div>
                </div>

            </div>

</x-app-layout>
