<x-app-layout>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="https://cdn.rawgit.com/harvesthq/chosen/gh-pages/chosen.jquery.min.js"></script>
    <link href="https://cdn.rawgit.com/harvesthq/chosen/gh-pages/chosen.min.css" rel="stylesheet" />
    <x-slot:title>
        Catalogo Balance Empresas
    </x-slot>

    <x-slot:subtitle>
        Balance Contabilidad
    </x-slot>

    {{-- Ruta actual en la vista --}}
    <div class="col-md-12">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="/contabilidad/balance">Balance</a></li>
            <li class="breadcrumb-item active" aria-current="page">Catalogo de balance de empresas</li>
            </li>
        </ol>
    </div>
    <div class="col-md-12">
        <x-alert></x-alert>
    </div>

    {{-- Boton para agregar un nuevo balance --}}
    <div class="col-md-12 text-end mb-4">
        <a class="btn btn-success" href="{{ route('contabilidad.crearBalance') }}"> <i class="fas fa-user-plus"></i>
        </a>
    </div>

    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <h5>Balances</h5>
                <table class="table table-sm" id="datatable-responsive">
                    <thead>
                        <tr>
                            <th width="40" scope="col">#</th>
                            <th scope="col">Título</th>
                            <th scope="col">Descripción</th>
                            <th scope="col">Valor</th>
                            <th width="50" class="text-center" scope="col"><i class="fas fa-eye"></i></th>
                            <th width="50" class="text-center" scope="col"><i class="fas fa-edit"></i></th>
                            <th width="50" class="text-center" scope="col"><i class="fas fa-trash"></i></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($balance as $key => $item)
                            <tr>

                                <th scope="row">{{ $key + 1 }}</th>

                                <td>{{ $item->titulo }} </td>
                                <td>{{ $item->descripcion }}</td>
                                <td>{{ $item->valor }}</td>

                                <td><a href="{{ route('contabilidad.mostrarBalance', $item->id) }}" class="btn btn-success"><i
                                            class="fas fa-eye"></i></a></td>
                                <td><a href="{{ route('contabilidad.editarBalance', $item->id) }}" class="btn btn-warning"><i
                                            class="fas fa-edit"></i></a></td>
                                <td>
                                    <form id="form{{ $item->id }}"
                                        action="{{ route('contabilidad.balance.destroy', $item->id) }}" method="post">
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
