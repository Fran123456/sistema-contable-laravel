<x-app-layout>
    <x-slot:title>
        Lista de afps
    </x-slot>

    <x-slot:subtitle>
    </x-slot>

    <div class="col-md-12">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">AFP</li>
        </ol>
    </div>
    <div class="col-md-12">
        <x-alert></x-alert>
    </div>

    <div class="col-md-12 text-end mb-4">
        <a class="btn btn-success" href="{{ route('rrhh.afp.create') }}"> <i class="fas fa-user-plus"></i> </a>
    </div>

    <div class="col-md-12">

        <div class="card">
            <div class="card-body">
                <h5>Listas de AFP</h5>
                <table class="table table-sm" id="datatable-responsive">
                    <thead>
                        <tr>
                            <th width="40" scope="col">#</th>
                            <th scope="col">AFP</th>
                            <th scope="col">Porcentaje Empleador</th>
                            <th scope="col">Porcentaje Empleado</th>
                            <th width="50" class="text-center" scope="col"><i class="fas fa-edit"></i></th>
                            <th width="50" class="text-center" scope="col"><i class="fas fa-trash"></i></th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($afps as $key => $item)
                                <tr>

                                    <th scope="row">{{ $key + 1 }}</th>

                                    <td>{{ $item->afp }}</td>
                                    <td>{{ $item->porciento_empleador }}</td>
                                    <td>{{ $item->porciento_empleado }}</td>

                                    <td><a href="{{ route('rrhh.afp.edit', $item->id) }}" class="btn btn-warning"><i class="fas fa-edit"></i></a></td>
                                    <td>
                                        <form id="form{{ $item->id }}"
                                            action="{{ route('rrhh.afp.destroy', $item->id) }}"
                                            method="post">
                                            @method('DELETE')
                                            @csrf
                                            <button
                                                onclick="confirm('form{{ $item->id }}','¿Desea eliminar el empleado?')"
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
