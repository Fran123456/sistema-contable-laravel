<x-app-layout>
    <x-slot:title>
        Combos
    </x-slot>

    <!-- Navegables -->
    <div class="col-md-12">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Productos</li>
            <li class="breadcrumb-item active" aria-current="page">Combos</li>
        </ol>
    </div>
    <!-- Fin navegables -->

    <!-- Div para alertas -->
    <div class="col-md-12">
        <x-alert></x-alert>
    </div>
    <!-- Fin Div para alertas -->

    <div class="col-md-12">
        <a class="btn btn-primary text-white my-3 g-0" href="{{ route('producto.combo.create') }}">Nuevo combo</a>
        <div class="card">
            <div class="card-body">
                <h5>Combos</h5>
                <table class="table" id="datatable-responsive">
                    <thead>
                        <tr>
                            <th>Código</th>
                            <th>Combo</th>
                            <th>Productos</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($combos as $combo)
                            <tr>
                                <td>{{ $combo->codigo }}</td>
                                <td>{{ $combo->combo }}</td>
                                <td>{{ $combo->productos->count() }}</td>
                                <td>{{ $combo->estado ? 'Activo' : 'Inactivo' }}</td>
                                <td>
                                    <a href="{{ route('producto.combo.edit', $combo->id) }}" class="btn btn-sm btn-warning" title="Editar"><i class="fas fa-edit"></i></a>
                                    <form id="form{{ $combo->id }}" action="{{ route('producto.combo.destroy', $combo->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button onclick="confirm('form{{ $combo->id }}', '¿Desea eliminar el combo?')" class="btn btn-sm btn-danger" type="button" title="Eliminar"><i class="fas fa-trash text-white"></i></button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
        function confirmDelete(formId, message) {
            if (confirm(message)) {
                document.getElementById(formId).submit();
            }
        }
    </script>

</x-app-layout>
