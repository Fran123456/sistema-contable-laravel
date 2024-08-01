<x-app-layout>
    <x-slot:title>
        Editar Combo
    </x-slot>

    <!-- Navegables -->
    <div class="col-md-12">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Productos</li>
            <li class="breadcrumb-item"><a href="{{ route('producto.combo.index') }}">Combos</a></li>
            <li class="breadcrumb-item active" aria-current="page">Editar Combo</li>
        </ol>
    </div>
    <!-- Fin navegables -->

    <!-- Div para alertas -->
    <div class="col-md-12">
        <x-alert></x-alert>
    </div>
    <!-- Fin Div para alertas -->

    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <h5 class="my-3">Editar Combo</h5>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form action="{{ route('producto.combo.update', $combo->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-md-6 my-2">
                            <label for="combo">Combo</label>
                            <input type="text" class="form-control" id="combo" name="combo" value="{{ old('combo', $combo->combo) }}" required>
                        </div>
                        <div class="col-md-6 my-2">
                            <label for="precio">Precio</label>
                            <input type="number" step="0.01" class="form-control" id="precio" name="precio" value="{{ old('precio', $combo->precio) }}" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 my-2">
                            <label for="codigo">Código</label>
                            <input type="text" class="form-control" id="codigo" name="codigo" value="{{ old('codigo', $combo->codigo) }}" required>
                        </div>
                        <div class="col-md-6 my-2">
                            <label for="estado">Estado</label>
                            <select class="form-control" id="estado" name="estado" required>
                                <option value="1" {{ old('estado', $combo->estado) == 1 ? 'selected' : '' }}>Activo</option>
                                <option value="0" {{ old('estado', $combo->estado) == 0 ? 'selected' : '' }}>Inactivo</option>
                            </select>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-auto">
                            <button type="submit" class="btn btn-primary my-3 text-white">Actualizar combo</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Card de precios -->
    <div class="col-md-12 mt-4">
        <div class="card">
            <div class="card-body">
                <h5 class="my-3">Agregar Tipo de Precio</h5>
                <form action="{{ route('producto.combo.storeComboTipoPrecio', $combo->id) }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-6 my-2">
                            <label for="tipo_precio_id">Tipo de Precio</label>
                            <select class="form-control" id="tipo_precio_id" name="tipo_precio_id" required>
                                @foreach($tiposPrecios as $tipoPrecio)
                                    @if(!$combo->comboTiposPrecios->contains('tipo_precio_id', $tipoPrecio->id))
                                        <option value="{{ $tipoPrecio->id }}">{{ $tipoPrecio->tipo }}</option>
                                    @endif
                                @endforeach
                                <option value="" selected disabled>Elegir tipo de precio</option>
                            </select>
                        </div>
                        <div class="col-md-6 my-2">
                            <label for="precio">Precio</label>
                            <input type="number" step="0.01" class="form-control" id="precio" name="precio" required>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-auto">
                            <button type="submit" class="btn btn-primary my-3 text-white">Añadir Tipo de Precio</button>
                        </div>
                    </div>
                </form>
                <hr>
                <h5 class="my-3">Tipos de Precio del Combo</h5>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Tipo de Precio</th>
                            <th>Precio</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($combo->comboTiposPrecios as $comboTipoPrecio)
                            <tr>
                                <td>{{ $comboTipoPrecio->tipoPrecio->tipo }}</td>
                                <td>{{ $comboTipoPrecio->precio }}</td>
                                <td>
                                    <form action="{{ route('producto.combo.updateEstadoComboTipoPrecio', $comboTipoPrecio->id) }}" method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <select name="estado" onchange="this.form.submit()">
                                            <option value="1" {{ $comboTipoPrecio->estado ? 'selected' : '' }}>Activo</option>
                                            <option value="0" {{ !$comboTipoPrecio->estado ? 'selected' : '' }}>Inactivo</option>
                                        </select>
                                    </form>
                                </td>
                                <td>
                                    <form action="{{ route('producto.combo.destroyComboTipoPrecio', $comboTipoPrecio->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger" title="Eliminar"><i class="fas fa-trash text-white"></i></button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Card de productos -->
    <div class="col-md-12 mt-4">
        <div class="card mb-5">
            <div class="card-body">
                <h5 class="my-3">Agregar Producto al Combo</h5>
                <form action="{{ route('producto.combo.storeComboProducto', $combo->id) }}" method="POST" id="producto-form">
                    @csrf
                    <div class="row">
                        <div class="col-md-6 my-2">
                            <label for="producto_id">Producto</label>
                            <select class="form-control" id="producto_id" name="producto_id" required>
                                @foreach($productos as $producto)
                                    @if(!$combo->productos->contains('producto_id', $producto->id))
                                        <option value="{{ $producto->id }}" data-producto="{{ json_encode($producto) }}">{{ $producto->producto }}</option>
                                    @endif
                                @endforeach
                                <option value="" selected disabled>Elegir producto</option>
                            </select>
                        </div>
                        <div class="col-md-6 my-2">
                            <label for="precio_venta">Precio de Venta</label>
                            <input type="number" step="0.01" class="form-control" id="precio_venta" name="precio_venta" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 my-2">
                            <label for="cantidad">Cantidad</label>
                            <input type="number" class="form-control" id="cantidad" name="cantidad" required>
                        </div>
                        <div class="col-md-6 my-2">
                            <label for="codigo_producto">Código del Producto</label>
                            <input type="text" class="form-control" id="codigo_producto" readonly>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-auto">
                            <button type="submit" class="btn btn-primary my-3 text-white">Añadir Producto</button>
                        </div>
                    </div>
                </form>
                <hr>
                <h5 class="my-3">Productos del Combo</h5>
                <table class="table mb-5">
                    <thead>
                        <tr>
                            <th>Producto</th>
                            <th>Precio de Venta</th>
                            <th>Cantidad</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($combo->productos as $comboProducto)
                            <tr>
                                <td>{{ $comboProducto->producto->producto }}</td>
                                <td>{{ $comboProducto->precio_venta }}</td>
                                <td>{{ $comboProducto->cantidad }}</td>
                                <td>
                                    <form action="{{ route('producto.combo.destroyComboProducto', $comboProducto->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger" title="Eliminar"><i class="fas fa-trash text-white"></i></button>
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

<script>
    document.getElementById('producto_id').addEventListener('change', function () {
        var selectedOption = this.options[this.selectedIndex];
        var producto = JSON.parse(selectedOption.getAttribute('data-producto'));
        document.getElementById('codigo_producto').value = producto.codigo;
    });
</script>
