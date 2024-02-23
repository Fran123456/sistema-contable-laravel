@extends('metronic.base')
@section('extracss')
@endsection
@section('extrajs')
@endsection

@section('titulo')
    Gestión de atributos
@endsection
@section('content')
    {{-- <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">Dashboard</a></li>

            <li class="breadcrumb-item"><a href="/producto/categoria">Categorias y sub categoria para producto</a></li>

            <li class="breadcrumb-item active" aria-current="page">Gestión de atributos por categoría</li>
        </ol>
    </nav> --}}
    @include('sessions')
    <div class="card shadow-sm text-center">
        <div class="card-header">
            <h3 class="card-title">Gestión de atributos</h3>
        </div>
        <div class="card-body">
            <h2 class="card-title">{{ $categoria->categoria }}</h5>
                <p class="card-text">
                    @if ($categoria->sub == 0)
                        <b>Es categoría principal</b>
                    @else
                        Es una subcategoría de <b>{{ $categoria->categoriaPadre->categoria }}</b>
                    @endif
                </p>
                <button type="button" data-bs-toggle="modal" data-bs-target="#atributosModal" class="btn btn-primary"
                    data-id="{{ $categoria->id }}" data-name="{{ $categoria->categoria }}" value="{{ $categoria->id }}"><i
                        class="fa-solid fa-circle-plus"></i> Agregar
                    atributos</button> <br>
                <a href="{{ route('producto.importarAtributosExcel', $categoria->id) }}" class="btn btn-success mt-2"><i
                        class="fas fa-file-excel"></i>
                    Importar atributos vía Excel</a>
        </div>
    </div>
    <!-- Modal para agregar atributos-->
    <div class="modal fade" id="atributosModal" tabindex="-1" aria-labelledby="atributosModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title" id="atributosModalLabel">Agregar atributos que contiene la categoría</h3>
                    <!--begin::Close-->
                    <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal"
                        aria-label="Close">
                        <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span class="path2"></span></i>
                    </div>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('storeAtributosCategoria') }}" enctype="multipart/form-data">
                        @csrf
                        {{-- <div class="alert alert-info text-center" role="alert">
                            Debes escribir al menos un atributo para la categoría
                        </div> --}}
                        <!--begin::Alert-->
                        <div class="alert alert-primary d-flex align-items-center p-5">
                            <!--begin::Icon-->
                            <i class="ki-duotone ki-notification-bing fs-2hx text-primary me-4 mb-5 mb-sm-0"><span
                                    class="path1"></span><span class="path2"></span><span class="path3"></span></i>
                            <!--end::Icon-->

                            <!--begin::Wrapper-->
                            <div class="d-flex flex-column">
                                <!--begin::Title-->
                                <h4 class="mb-1 text-dark">Importante</h4>
                                <!--end::Title-->

                                <!--begin::Content-->
                                <span>Debes escribir al menos un atributo para la categoría</span>
                                <!--end::Content-->
                            </div>
                            <!--end::Wrapper-->
                        </div>
                        <!--end::Alert-->
                        <div class="form-group mb-4">
                            <input type="text" class="form-control text-center" name="categoria" id="categoria" disabled>
                            <input type="hidden" name="categoriaId" id="categoriaId">
                        </div>
                        <div class="form-group row">
                            <div class="form-group col-md-6">
                                <label for="input4">Atributo 1</label>
                                <input type="text" class="form-control" name="atributoA" id="atributo0" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="input4">Atributo 2</label>
                                <input type="text" class="form-control" name="atributoB" id="atributo1">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="form-group col-md-6">
                                <label for="input4">Atributo 3</label>
                                <input type="text" class="form-control" name="atributoC" id="atributo2">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="input4">Atributo 4</label>
                                <input type="text" class="form-control" name="atributoD" id="atributo3">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="form-group col-md-6">
                                <label for="input4">Atributo 5</label>
                                <input type="text" class="form-control" name="atributoE" id="atributo4">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="input4">Atributo 6</label>
                                <input type="text" class="form-control" name="atributoF" id="atributo5">
                            </div>
                        </div>
                        <div class="modal-footer justify-content-center">
                            <button type="submit" class="btn btn-primary">Agregar</button>
                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancelar</button>                
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>

    <script>
        $(document).ready(function() {
            //SCRIPT DE MODAL ATRIBUTOS
            $('#atributosModal').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget) // Button that triggered the modal
                var recipient = button.data('id') // Extract info from data-* attributes
                var name = button.data('name')
                var modal = $(this)
                //modal.find('.modal-title-salud').text('Validar exámenes de salud de: ' + name)
                //var id = $('#btnValidarPagoSalud').val();
                //console.log(id);
                $('#categoria').val(name)
                $('#categoriaId').val(recipient)
            });
        });
    </script>

    <div class="card mt-3">
        <div class="card-header text-center">
            <h3 class="card-title">Atributos agregados a la categoría</h3>
        </div>
        <div class="card-body">
            <table class="table table-bordered table-hover text-center">
                <thead>
                    <tr class="fw-semibold fs-6 text-gray-800 border-bottom border-gray-200">
                        <th scope="col">#</th>
                        <th scope="col">Atributo</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @if (count($atributos) > 0)
                        @foreach ($atributos as $atributo)
                            <tr>
                                <th scope="row">{{ $loop->iteration }}</th>
                                <td>{{ $atributo->atributo }}</td>
                                <td>
                                    {{-- <form method="post"
                                        action="{{ route('deleteAtributoCategoria', ['atributoId' => $atributo->id, 'categoriaId' => $atributo->pro_categoria_id]) }}">
                                        @method('delete')
                                        @csrf
                                        <input type="hidden" name="categoriaId"
                                            value="{{ $atributo->pro_categoria_id }}">
                                        <button type="submit" class="btn btn-danger"><i
                                                class="fas fa-trash"></i></button>
                                    </form> --}}
                                    <button type="button" title="Eliminar" data-bs-toggle="modal"
                                        data-bs-target="#deleteModal" class="btn btn-danger"
                                        data-bs-categoria="{{ $atributo->pro_categoria_id }}"
                                        onclick="fun_destroy('{{ $atributo->id }}')"><i
                                            class="fas fa-trash"></i></button>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="3">
                                No se han agregado atributos a esta categoría
                            </td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>

    {{-- MODAL DE ADVERTENCIA DE ELIMINACION --}}
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body align-self-center">
                    <form action="{{ route('deleteAtributoCategoriaVal') }}" method="POST">
                        @csrf
                        {{ method_field('DELETE') }}
                        <div style="text-align: center">
                            <br>
                            <i class='fas fa-exclamation-circle' style='font-size:80px;color: gray;'></i>
                            <br>
                            <br>
                            <strong>
                                <h3>¿Estás seguro que deseas eliminar el atributo?</h3>
                            </strong>
                            <input type="hidden" id="atributoId" name="atributoId">
                            <input type="hidden" id="categoriaId" name="categoriaId">
                        </div>
                        <div class="modal-footer d-flex justify-content-center">
                            <button type="submit" class="btn btn-primary">
                                <i class='fas fa-check-circle'></i>
                                Eliminar
                            </button>
                            <a href="" class="btn btn-secondary" data-bs-dismiss="modal">
                                <i class='fa fa-times'></i>
                                Cancelar
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        function fun_destroy(id) {
            $("#atributoId").val(id);
        }
    </script>
@endsection
