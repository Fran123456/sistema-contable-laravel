

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


    <!-- Botón para agregar tipo de precio -->
    <div class="col-md-12 text-end mb-4">
        <a class="btn btn-primary text-white" href="{{--route('producto.producto.create')--}}" title="Crear"><i class=""></i>AGREGAR TIPO DE PRECIO</a>
    </div>
    <!-- Fin botón para agregar tipo de precio -->


    <!-- Cuerpo de la vista -->
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3 class="m-2">Tipos de precio</h3>
            </div>
            <div class="card-body">
                <!-- Declaración de datatable con clases -->
                <table class="table table-sm" id="datatable-responsive">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Tipo de precio</th>
                            <th>Acciones</th>
                    </thead>
                    <tbody>
                        <tr>
                            <th></th>
                            <th></th>
                            <th></th>
                        </tr>
                    </tbody>
                </table>

            </div>
        </div>
    </div>
    <!-- Fin cuerpo de la vista -->








</x-app-layout>