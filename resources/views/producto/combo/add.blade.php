<x-app-layout>
    <x-slot:title>
        Agregar Combo
    </x-slot>

    <!-- Navegables -->
    <div class="col-md-12">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Productos</li>
            <li class="breadcrumb-item"><a href="{{ route('producto.combo.index') }}">Combos</a></li>
            <li class="breadcrumb-item active" aria-current="page">Agregar Combo</li>
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
                <h5 class="my-3">Agregar Nuevo Combo</h5>
                <form action="{{ route('producto.combo.store') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-6 my-2">
                            <label for="combo">Combo</label>
                            <input type="text" class="form-control" id="combo" name="combo" required>
                        </div>
                        <div class="col-md-6 my-2">
                            <label for="precio">Precio</label>
                            <input type="number" step="0.01" class="form-control" id="precio" name="precio" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 my-2">
                            <label for="codigo">Código</label>
                            <input type="text" class="form-control" id="codigo" name="codigo" required>
                        </div>
                        <div class="col-md-6 my-2">
                            <label for="estado">Estado</label>
                            <select class="form-control" id="estado" name="estado" required>
                                <option value="1">Activo</option>
                                <option value="0">Inactivo</option>
                            </select>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-auto">
                            <button type="submit" class="btn btn-primary my-3 text-white">Agregar combo</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
