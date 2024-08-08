<x-app-layout>
    <x-slot:title>
        Editar Combo
    </x-slot>
    <style>
        .highlight-shadow {
            box-shadow: 0 0 15px rgba(138, 174, 190, 0.83);
            transition: box-shadow 1s ease-in-out;
        }
        .highlight-shadow-remove {
        box-shadow: 0 0 0 rgba(0, 123, 255, 0);
        }
    </style>
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
                            <div class="input-group">
                                <span class="input-group-text">$</span>
                                <input type="number" step="0.01" class="form-control" id="precio" name="precio" value="{{ old('precio', $combo->precio) }}" required>
                            </div>
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
                            <div class="input-group">
                                <span class="input-group-text">$</span>
                                <input type="number" step="0.01" class="form-control" id="precio" name="precio" required>
                            </div>
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
                                <td>${{ number_format($comboTipoPrecio->precio,2) }}</td>
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
<div class="col-md-12 mt-4" id="card-productos">
    <div class="card mb-5">
        <div class="card-body">
            <h5 class="my-3">Agregar Producto al Combo</h5>
            <form action="{{ route('producto.combo.edit', $combo->id) }}#card-productos" method="GET" id="producto-form">
                <div class="row">
                    <div class="col-md-6 my-2">
                        <label for="producto_id">Producto</label>
                        <select class="form-control" id="producto_id" name="producto_id" required onchange="this.form.submit()">
                            <option value="" selected disabled>Elegir producto</option>
                            @foreach($productos as $producto)
                                <option value="{{ $producto->id }}" {{ request('producto_id') == $producto->id ? 'selected' : '' }}>{{ $producto->producto }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6 my-2">
                        <label for="codigo_producto">Código del Producto</label>
                        <input type="text" class="form-control" id="codigo_producto" value="{{ $codigo_producto ?? '' }}" readonly>
                    </div>
                </div>
            </form>

            @if(request('producto_id'))
            @if(count($tiposPreciosAsociados) > 0)
            <form id="tipo-precio-form">
                <input type="hidden" name="producto_id" value="{{ request('producto_id') }}">
                <div class="row">
                    <div class="col-md-6 my-2">
                        <label for="tipo_precio">Tipo de Precio</label>
                        <select class="form-control" id="tipo_precio" name="tipo_precio" required>
                            <option value="" selected disabled>Elegir tipo de precio</option>
                            @foreach($tiposPreciosAsociados as $tipoPrecio)
                                @if($tipoPrecio->tipoPrecio)
                                    <option value="{{ $tipoPrecio->tipoPrecio->id }}" {{ request('tipo_precio') == $tipoPrecio->tipoPrecio->id ? 'selected' : '' }} data-precio="{{ $tipoPrecio->precio }}">{{ $tipoPrecio->tipoPrecio->tipo }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6 my-2">
                        <label for="precio_venta">Precio de Venta</label>
                        <div class="input-group">
                            <span class="input-group-text">$</span>
                            <input type="number" step="0.01" class="form-control" id="precio_venta" name="precio_venta" value="{{ $precio_venta ?? '' }}" required>
                        </div>
                    </div>
                </div>
            </form>
            <form action="{{ route('producto.combo.storeComboProducto', $combo->id) }}#card-productos" method="POST">
                @csrf
                <input type="hidden" name="producto_id" value="{{ request('producto_id') }}">
                <input type="hidden" name="tipo_precio" value="{{ request('tipo_precio') }}">
                <input type="hidden" name="precio_venta" id="precio_venta_hidden" value="{{ $precio_venta ?? '' }}">
                <div class="row">
                    <div class="col-md-6 my-2">
                        <label for="cantidad">Cantidad</label>
                        <input type="number" class="form-control" id="cantidad" name="cantidad" required>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-auto">
                        <button type="submit" class="btn btn-primary my-3 text-white" onclick="document.getElementById('precio_venta_hidden').value = document.getElementById('precio_venta').value;">Añadir Producto</button>
                    </div>
                </div>
            </form>
            @else
            <div class="alert alert-warning">
                <strong>El producto seleccionado no tiene tipos de precios asociados.</strong>
            </div>
            @endif
            @endif
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
                            <td>${{ number_format($comboProducto->precio_venta, 2) }}</td>
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

<script>
document.getElementById('tipo_precio').addEventListener('change', function() {
    var selectedOption = this.options[this.selectedIndex];
    var precio = selectedOption.getAttribute('data-precio');
    document.getElementById('precio_venta').value = precio;
});

document.addEventListener('DOMContentLoaded', function() {
        var card = document.getElementById('card-productos');
        card.classList.add('highlight-shadow');
        setTimeout(function() {
            card.classList.add('highlight-shadow-remove');
        }, 5000); 
    });
</script>

</x-app-layout>


