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
        <a class="btn btn-primary text-white my-3 g-0" href="{{route('producto.combo.create')}}">Nuevo combo</a>
        <div class="card">
            <div class="card-body">
                <h5> Combos </h5>
                <table class="table" id="datatable-responsive">
                    <thead>
                        <tr>
                            <th>Código</th>
                            <th>Combo</th>
                            <th>Precio</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($combos as $combo)
                        <tr>
                            <td>{{ $combo->codigo }}</td>
                            <td>{{ $combo->combo }}</td>
                            <td>{{ $combo->precio }}</td>
                            <td>{{ $combo->estado ? 'Activo' : 'Inactivo' }}</td>
                            <td>
                                <a href="{{ route('producto.combo.edit', $combo->id) }}" class="btn btn-sm btn-warning">Editar</a>
                                <form action="{{ route('producto.combo.destroy', $combo->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">Eliminar</button>
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
        document.getElementById('show-add-combo-card').addEventListener('click', function() {
            var addComboCard = document.getElementById('add-combo-card');
            if (addComboCard.style.display === 'none') {
                addComboCard.style.display = 'block';
            } else {
                addComboCard.style.display = 'none';
            }
        });
    </script>

</x-app-layout>
