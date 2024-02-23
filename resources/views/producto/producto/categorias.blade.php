<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('producto.guardarCategoria', ['id' => $data?->id ?? 0]) }}" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-md-12">
                            <label><strong>Categorias</strong></label>
                            <select required class="form-control" name="categoria" id="">
                                @foreach ($categorias as $cate)
                                    <option value="{{ $cate->id }}">{{ $cate->categoria }}</option>
                                @endforeach
                            </select>
                            <button @if ($data?->id == null) disabled @endif type="submit"
                                class="btn btn-primary mt-4"><i class='fas fa-check-circle'></i> Guardar</button>
                        </div>
                        <div class="col-md-12 mt-4">
                            @php
                                $cac = $data
                                    ?->categorias()
                                    ->where('pro_categoria.sub', 0)
                                    ->get();
                                if ($cac == null) {
                                    $cac = [];
                                }
                            @endphp
                            @if ($cac)
                                @if (count($cac) == 0)
                                    <div class="alert alert-danger">
                                        <strong>¡Opps! Parece que no tienes ninguna categoria asociada</strong>
                                    </div>
                                @else
                                    <ul class="list-group list-group-horizontal">
                                        @foreach ($cac as $item1)
                                            <li style="font-size: 15px;" class="list-group-item">{{ $item1->categoria }}
                                                <a
                                                    href="{{ route('producto.eliminarCategoria', $data->id) }}?categoria_id={{ $item1->id }}"><span
                                                        style="font-size: 15px; color:aliceblue"
                                                        class="badge bg-danger">X</span></a>
                                            </li>
                                        @endforeach
                                    </ul>
                                @endif
                            @endif

                        </div>
                    </div>

                </form>
                <div class="row justify-content-center mt-3">
                    @if (count($categoriasDelProducto) > 0)
                        @if ($verificarCategorias[0]->datos <= 0)
                            <button type="button" data-bs-toggle="modal" data-bs-target="#atributosModalCat"
                                class="btn btn-primary" data-bs-id="{{ $data->id }}"
                                data-bs-name="{{ $data->id }}" value="{{ $data->id }}">Agregar
                                atributos</button>
                        @elseif ($verificarCategorias[0]->datos > 0)
                            <button type="button" data-bs-toggle="modal" data-bs-target="#atributosModalCat"
                                class="btn btn-primary" data-bs-id="{{ $data->id }}"
                                data-bs-name="{{ $data->id }}" value="{{ $data->id }}" disabled>Agregar
                                atributos</button>
                        @endif
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Modal para agregar atributos de categoria-->
    <div class="modal fade" id="atributosModalCat" tabindex="-1" aria-labelledby="atributosModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="atributosModalLabel">Agregar atributos que contiene la categoría</h5>
                    <!--begin::Close-->
                    <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal"
                        aria-label="Close">
                        <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span class="path2"></span></i>
                    </div>
                    <!--end::Close-->
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('storeAtributosCategoriaProductos') }}"
                        enctype="multipart/form-data">
                        @csrf
                        <h4 class="text-center text-lg">Categorías asociadas al producto: </h2>
                            <div class="alert alert-info text-center" role="alert">
                                @foreach ($categoriasDelProducto as $categoria)
                                    <p class="mt-0 mb-0">{{ $categoria->nombre_categoria }}</p>
                                @endforeach
                            </div>
                            {{-- <p><b>Importante:</b> A continuación se presenta una serie de atributos contenidos en las
                                categorías asociadas al producto, ingrese los valores que desea llenar en base al
                                producto y de clic en el botón <b>Agregar</b>.</p> --}}
                            <div
                                class="alert alert-dismissible bg-light-primary d-flex flex-column flex-sm-row p-5 mb-1">
                                <!--begin::Icon-->
                                <i class="ki-duotone ki-notification-bing fs-2hx text-primary me-4 mb-5 mb-sm-0"><span
                                        class="path1"></span><span class="path2"></span><span
                                        class="path3"></span></i>
                                <!--end::Icon-->

                                <!--begin::Wrapper-->
                                <div class="d-flex flex-column pe-0 pe-sm-10">
                                    <!--begin::Title-->
                                    <h4 class="fw-semibold">Importante</h4>
                                    <!--end::Title-->

                                    <!--begin::Content-->
                                    <span>A continuación se presenta una serie de atributos contenidos en las
                                        categorías asociadas al producto, ingrese los valores que desea llenar en base
                                        al
                                        producto y de clic en el botón <b>Agregar</b></span>
                                    <!--end::Content-->
                                </div>
                            </div>
                            <div class="form-group row mt-3 mb-4">
                                @foreach ($atributosCategoriasProducto as $atributo)
                                    <div class="form-group col-md-6">
                                        <label>{{ $atributo->nombre_atributo }}</label>
                                        <input type="text" class="form-control" name="valor[]"
                                            placeholder="Categoría: {{ $atributo->nombre_categoria }}">
                                        <input type="hidden" name="pro_atributos_categoria_id[]"
                                            value="{{ $atributo->atributo_categoria_id }}">
                                        <input type="hidden" name="pro_producto_categoria_id[]"
                                            value="{{ $atributo->producto_categoria_id }}">
                                    </div>
                                @endforeach
                            </div>
                            <div class="modal-footer justify-content-center">
                                <button type="submit" class="btn btn-success">Agregar</button>
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
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
                var recipient = button.data('id') // Extract info from data-bs-* attributes
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


    <div class="col-md-6">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('producto.guardarCategoria', ['id' => $data?->id ?? 0]) }}" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-md-12">
                            <label><strong>Sub Categorias</strong></label>
                            <select class="form-control" required name="categoria" id="">
                                @foreach ($sub as $cate)
                                    <option value="{{ $cate->id }}">{{ $cate->categoria }}</option>
                                @endforeach
                            </select>
                            <button @if ($data?->id == null) disabled @endif type="submit"
                                class="btn btn-primary mt-4"><i class='fas fa-check-circle'></i> Guardar</button>
                        </div>
                        <input type="hidden" name="sub" value="1">
                        <div class="col-md-12 mt-4">
                            @php
                                $subc = $data
                                    ?->categorias()
                                    ->where('pro_categoria.sub', 1)
                                    ->get();
                                if ($subc == null) {
                                    $subc = [];
                                }
                            @endphp
                            @if ($subc)
                                @if (count($subc) == 0)
                                    <div class="alert alert-danger">
                                        <strong>¡Opps! Parece que no tienes ninguna sub categoria asociada</strong>
                                    </div>
                                @else
                                    <ul class="list-group list-group-horizontal">
                                        @foreach ($subc as $item)
                                            <li style="font-size: 15px;" class="list-group-item">
                                                {{ $item->categoria }}
                                                <a
                                                    href="{{ route('producto.eliminarCategoria', $data->id) }}?categoria_id={{ $item->id }}"><span
                                                        style="font-size: 15px; color:aliceblue"
                                                        class="badge bg-danger">X</span></a>
                                            </li>
                                        @endforeach
                                    </ul>
                                @endif
                            @endif

                        </div>
                    </div>

                </form>
                <div class="row justify-content-center mt-3">
                    @if (count($subCategoriasDelProducto) > 0)
                        @if ($verificarSubCategorias[0]->datos <= 0)
                            <button type="button" data-bs-toggle="modal" data-bs-target="#atributosModalSub"
                                class="btn btn-secondary" data-bs-id="{{ $data->id }}"
                                data-bs-name="{{ $data->id }}" value="{{ $data->id }}">Agregar
                                atributos</button>
                        @elseif ($verificarSubCategorias[0]->datos > 0)
                            <button type="button" data-bs-toggle="modal" data-bs-target="#atributosModalSub"
                                class="btn btn-secondary" data-bs-id="{{ $data->id }}"
                                data-bs-name="{{ $data->id }}" value="{{ $data->id }}" disabled>Agregar
                                atributos</button>
                        @endif
                    @endif
                </div>
            </div>
        </div>

    </div>

</div>

<!-- Modal para agregar atributos-->
<div class="modal fade" id="atributosModalSub" tabindex="-1" aria-labelledby="atributosModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="atributosModalLabel">Agregar atributos que contiene la subcategoría</h5>
                <!--begin::Close-->
                <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal"
                    aria-label="Close">
                    <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span class="path2"></span></i>
                </div>
                <!--end::Close-->
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('storeAtributosCategoriaProductos') }}"
                    enctype="multipart/form-data">
                    @csrf
                    <h4 class="text-center text-lg">Subcategorías asociadas al producto: </h2>
                        <div class="alert alert-info text-center" role="alert">
                            @foreach ($subCategoriasDelProducto as $categoria)
                                <p class="mt-0 mb-0">{{ $categoria->nombre_categoria }}</p>
                            @endforeach
                        </div>
                        {{-- <p><b>Importante:</b> A continuación se presenta una serie de atributos contenidos en las
                            subcategorías asociadas al producto, ingrese los valores que desea llenar en base al
                            producto y de clic en el botón <b>Agregar</b>.</p> --}}
                        <div class="alert alert-dismissible bg-light-primary d-flex flex-column flex-sm-row p-5 mb-1">
                            <!--begin::Icon-->
                            <i class="ki-duotone ki-notification-bing fs-2hx text-primary me-4 mb-5 mb-sm-0"><span
                                    class="path1"></span><span class="path2"></span><span
                                    class="path3"></span></i>
                            <!--end::Icon-->

                            <!--begin::Wrapper-->
                            <div class="d-flex flex-column pe-0 pe-sm-10">
                                <!--begin::Title-->
                                <h4 class="fw-semibold">Importante</h4>
                                <!--end::Title-->

                                <!--begin::Content-->
                                <span>A continuación se presenta una serie de atributos contenidos en las
                                    subcategorías asociadas al producto, ingrese los valores que desea llenar en base al
                                    producto y de clic en el botón <b>Agregar</b></span>
                                <!--end::Content-->
                            </div>
                        </div>
                        <div class="form-group row mt-3 mb-4">
                            @foreach ($atributosSubCategoriasProducto as $atributo)
                                <div class="form-group col-md-6">
                                    <label>{{ $atributo->nombre_atributo }}</label>
                                    <input type="text" class="form-control" name="valor[]"
                                        placeholder="Categoría: {{ $atributo->nombre_categoria }}">
                                    <input type="hidden" name="pro_atributos_categoria_id[]"
                                        value="{{ $atributo->atributo_categoria_id }}">
                                    <input type="hidden" name="pro_producto_categoria_id[]"
                                        value="{{ $atributo->producto_categoria_id }}">
                                </div>
                            @endforeach
                        </div>
                        <div class="modal-footer justify-content-center">
                            <button type="submit" class="btn btn-success">Agregar</button>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
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
            var recipient = button.data('id') // Extract info from data-bs-* attributes
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
