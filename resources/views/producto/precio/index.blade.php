

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



    <!-- Modales para las acciones: Editar, Eliminar -->

        <!-- Modal Editar -->
        <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Título del Modal</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        Contenido del modal.
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        <button type="button" class="btn btn-primary">Guardar cambios</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Eliminar -->
        <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Título del Modal</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        Contenido del modal.
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        <button type="button" class="btn btn-primary">Guardar cambios</button>
                    </div>
                </div>
            </div>
        </div>
    <!-- Fin modales para las acciones: Editar, Eliminar -->








</x-app-layout>