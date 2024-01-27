<x-app-layout>
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
            <li class="breadcrumb-item"><a href="/contabilidad/balance">Contabilidad</a></li>
            <li class="breadcrumb-item"><a href="/contabilidad/balance">Balance</a></li>
            <li class="breadcrumb-item active" aria-current="page">Catalogo de balance de empresas</li>
            </li>
        </ol>
    </div>
    <div class="col-md-12">
        <x-alert></x-alert>
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
                            <th width="50" class="text-center" scope="col"><i class="fas fa-edit"></i></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($balance as $key => $item)
                            <tr>

                                <th scope="row">{{ $key + 1 }}</th>

                                <td>{{ $item->titulo }} </td>
                                <td>{{ $item->descripcion }}</td>
                                <td>{{ $item->valor }}</td>

                                {{-- opciones --}}
                                <td><a href="{{ route('contabilidad.editarBalance', $item->id) }}" class="btn btn-warning"><i
                                            class="fas fa-edit"></i></a></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</x-app-layout>
