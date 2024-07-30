

<!-- Vista de Precios (Tipos de precios) -->

<x-app-layout>
    <x-slot:title>
        Tipos de precios
    </x-slot>

    <!-- Navegables -->
    <div class="col-md-12">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dasboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Productos</li>
            <li class="breadcrumb-item active" aria-current="page">Precios</li>
          </ol>
    </div>
    <!-- Fin navegables -->

    <!-- Div para alertas -->
    <div class="col-md-12">
        <x-alert></x-alert>
    </div>
    <!-- Fin Div para alertas -->


    
    <!-- Formulario para agregar tipo de precio -->
    <div class="row mb-4">
        <label for="tipo" class="my-2">Agregar tipo de precio</label>
        <div class="col-md-12">
            <form action="{{ route('producto.precio.store') }}" method="POST" class="form-inline">
                @csrf
                <div class="input-group">        
                    <input type="text" name="tipo" class="form-control me-5" id="tipo" placeholder="Nombre del tipo de Precio" required>
                    <div class="input-group-append">
                        <button type="submit" class="btn btn-primary text-white g-0">Agregar Tipo de Precio</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- Fin formulario para agregar tipo de precio -->
    


    <!-- Cuerpo de la vista -->
    <div class="col-md-12">
        <div class="card">
           
            
            <div class="card-body">
                <h5> Tipo precio </h5>
                <!-- Declaración de datatable con clases -->
                <table class="table" id="datatable-responsive">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Tipo de precio</th>
                            <th>Acciones</th>
                    </thead>
                    <tbody>
                    @foreach ($tiposPrecios as $key => $tipoPrecio)
                        <tr>
                            <td>{{ $key+1 }}</td>
                            <td>{{ $tipoPrecio->tipo }}</td>
                            <td>
                                <!-- Boton para eliminar -->
                                <form id="form{{ $tipoPrecio->id }}"
                                        action="{{ route('producto.precio.destroy', $tipoPrecio->id) }}"
                                        method="post">
                                        @method('DELETE')
                                        @csrf
                                        <button
                                            onclick="confirm('form{{ $tipoPrecio->id }}','¿Desea eliminar el tipo de precio?')"
                                            class="btn btn-danger"
                                            type="button" title="Eliminar"><i class="fas fa-trash"></i></button>
                                    </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>
        </div>
    </div>
    <!-- Fin cuerpo de la vista -->








</x-app-layout>