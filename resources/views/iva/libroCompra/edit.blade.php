<x-app-layout>
    <x-slot:title>
        Editar Libro Compra
    </x-slot>
    <x-slot:subtitle>
    </x-slot>

    <div class="col-md-12">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('iva.libro_compras.index') }}">Libro Compra</a></li>
            <li class="breadcrumb-item active" aria-current="page">Editar</li>
        </ol>
    </div>
    <div class="col-md-12">
        <x-alert></x-alert>
    </div>

    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('iva.libro_compras.update', $libroCompra->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="fecha_emision" class="form-label">Fecha Emisión</label>
                        <input type="datetime-local" class="form-control" id="fecha_emision" name="fecha_emision" value="{{ $libroCompra->fecha_emision }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="fecha_emision_en_pdf" class="form-label">Fecha Emisión PDF</label>
                        <input type="datetime-local" class="form-control" id="fecha_emision_en_pdf" name="fecha_emision_en_pdf" value="{{ $libroCompra->fecha_emision_en_pdf }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="documento" class="form-label">Documento</label>
                        <input type="text" class="form-control" id="documento" name="documento" value="{{ $libroCompra->documento }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="proveedor_id" class="form-label">Proveedor</label>
                        <select class="form-control" id="proveedor_id" name="proveedor_id">
                            <option value="">Seleccione un proveedor</option>
                            @foreach ($proveedores as $proveedor)
                                <option value="{{ $proveedor->id }}" {{ $libroCompra->proveedor_id == $proveedor->id ? 'selected' : '' }}>{{ $proveedor->nombre }}</option>
                            @endforeach
                        </select>
                    </div>
                    <!-- Add the other fields similarly -->
                    <div class="mb-3">
                        <label for="total_compra" class="form-label">Total Compra</label>
                        <input type="number" class="form-control" id="total_compra" name="total_compra" value="{{ $libroCompra->total_compra }}">
                    </div>
                    <div class="mb-3 form-check">
                        <input type="checkbox" class="form-check-input" id="mostrar" name="mostrar" {{ $libroCompra->mostrar ? 'checked' : '' }}>
                        <label class="form-check-label" for="mostrar">Mostrar</label>
                    </div>
                    <button type="submit" class="btn btn-primary">Actualizar</button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
