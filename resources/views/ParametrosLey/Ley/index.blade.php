<x-app-layout>
    <x-slot::title>
        Parametros de ley
    </x-slot>

    <x-slot::subtitle>
        Administracion de parametros legales por la empresa
    <x-slot>

    <div class="mb-3">
        <a href="{{ route('ParametrosLey.Ley.create') }}" class="btn btn-primary">Nuevo Parametro</a>
    </div>

    @if(sesion('success'))
        <div class="alert alert-success">{{session('success') }}</div>
    @endif

    <div class="table-responsive">
        <table class="table table-bordered table hover">
            <thead class="table-dark">
                <tr>
                    <th>Id</th>
                    <th>Tipo</th>
                    <th>Valor</th>
                    <th>Estado</th>
                    <th>Fecha inicio</th>
                    <th>Fecha fin</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($parametros->where('empresa_id', Hepl::users()->empresa_id) as $p)
                    <tr>
                        <td>{{ $p->id_parametro }}</td>
                        <td>{{ $p->tipo }}</td>
                        <td>{{ $p->Valor }}</td>
                        <td>{{ ucfirst($p->estado) }}</td>
                        <td>{{ $p->fecha_inicio }}</td>
                        <td>{{ $p->fecha_fin ?? '-' }}</td>
                        <td>
                            <a href="{{ route('ParametrosLey.Ley.edit', $p->id_parametro) }}" class="btn btn-warning btn-sm">Editar</a>
                            <form action="{{ route('ParametrosLey.Ley.edit', $p->id_parametro)}}" method="POST" style="display: inline;">
                                @csrf @method('DELETE')
                                <button onclick="return confirm('¿Seguro que deseas eliminar este parametro?')" class="btn btn-danger btn-sm">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                    @if($parametros->where('empresa_id', Hepl::users()->empresa_id)->isEmpty())
                        <tr>
                            <td colspan="7" class="text-center">No hay parametros registrados para esta empresa</td>
                        </tr>
                    @endif
            </tbody>
        </table>
    </div>
</x-app-layout>