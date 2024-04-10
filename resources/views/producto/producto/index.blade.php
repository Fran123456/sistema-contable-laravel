{{-- @extends('metronic.base')
@section('extracss')
@endsection
@section('extrajs')
<script>
    $(function() {
        $('#erp-datatable tfoot th:not(:nth-last-child(2)):not(:last-child)').each(function() {
            $(this).html('<input type="text" />');
        });
        var total_columns = $("#erp-datatable thead").find("tr")[0].cells.length

        var initialLoad = false;
        var table = $('#erp-datatable').DataTable({
            processing: true,
            serverSide: true,
            stateSave: true,
            scrollX: false,
            autoWidth: false,
            "dom": "<'row'" +
                "<'col-sm-6 d-flex align-items-center justify-content-start'l>" +
                "<'col-sm-6 d-flex align-items-center justify-content-end'f>" +
                ">" +
                "<'table-responsive'tr>" +
                "<'row'" +
                "<'col-sm-12 col-md-5 d-flex align-items-center justify-content-center justify-content-md-start'i>" +
                "<'col-sm-12 col-md-7 d-flex align-items-center justify-content-center justify-content-md-end'p>" +
                ">",
            {!! App::isLocale('es')
                ? "language: {url:'" . asset('metronic/assets/js/es-Es.json') . "'},"
                : "language: {url:'" . asset('metronic/assets/js/es-Es.json') . "'}," !!}
            initComplete: function() {

                var i = 0,
                    total_cols_busq = total_columns - 2;
                this.api().columns().every(function() {
                    if (i < total_cols_busq) {
                        var column = this;
                        $("input", $("#erp-datatable tfoot th")[i])
                            .on('change',
                                function() { //Se le agrega on change a los inputs de busqueda
                                    column.search($(this).val(), false, false, true).draw();
                                });
                        i++;
                    }
                });
                if (typeof getUrlVars()['search'] !== 'undefined') {
                    var search_val = decodeURIComponent(getUrlVars()['search']);
                    this.api().search(search_val).draw();
                }
                table = $('#erp-datatable').DataTable();
                new $.fn.dataTable.Buttons(table, {
                    name: 'btnCleanSearch',
                    buttons: [{
                        text: '{{ __('Clear') }}',
                        action: function(e, dt, node, config) {
                            dt.search('').draw();
                        },
                        className: 'btn btn-secondary btnClear'
                    }]
                });

                table
                    .buttons('btnCleanSearch', null)
                    .containers()
                    .insertAfter('.dataTables_filter');
            },
            stateSaveParams: function(settings, data) {
                if (!initialLoad) {
                    //se hacen pequeños los campos de búsqueda
                    var th, total_cols_busq = total_columns - 2;
                    for (i = 0; i < total_cols_busq; i++) {
                        var col_search_val = data.columns[i].search.search;
                        th = $('#erp-datatable tfoot').find('th:nth-child(' + (i + 1) + ')');
                        th.find('input').attr('size', 5);
                        if (col_search_val !== "") {
                            th.find('input').val(col_search_val);
                        }
                    }
                    initialLoad = true;
                }
            },
            order: [
                [total_columns - 1, "desc"]
            ],
            ajax: '{!! route('producto.producto.index') !!}',
            columnDefs: [

                {
                    targets: [-1],
                    visible: false,
                    searchable: false
                },
            ],
            columns: [{
                    data: 'producto',
                    name: 'pro_producto.producto',
                    orderable: true,
                    searchable: true
                },
                {
                    data: 'precio',
                    name: 'precio',
                    orderable: false,
                    searchable: false
                },
                {
                    data: 'categoria',
                    name: 'categoria',
                    orderable: false,
                    searchable: false
                },
                {
                    data: 'imagen',
                    name: 'imagen',
                    orderable: false,
                    searchable: false
                },
                {
                    data: 'acciones',
                    name: 'acciones',
                    orderable: true,
                    searchable: true
                },
                {
                    data: 'id',
                    name: 'id'
                },
            ]
        });

        var dTable = $(".datatable").DataTable();
        $(".dataTables_filter input")
            .unbind()
            .bind("input", function(e) {
                if (this.value.length >= 3 || e.keyCode == 13) {
                    dTable.search(this.value).draw();
                }
                if (this.value == "") {
                    dTable.search("").draw();
                }
                return;
            });
    });
</script>
@endsection

@section('titulo')
    Productos
@endsection --}}

{{-- @section('content')
    {{-- <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">Dashboard</a></li>

            <li class="breadcrumb-item active" aria-current="page">Productos</li>
        </ol>
    </nav> --}}
    {{-- <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <a href="{{ route('producto.producto.create') }}" class="btn btn-primary">
            Agregar producto
        </a>
        <a href="" class="btn btn-success">Importar productos vía
            Excel</a>
    </div> --}}
    {{-- <div class="alert alert-dismissible bg-light-primary border border-primary d-flex flex-column flex-sm-row p-5 mb-4">
        <!--begin::Icon-->
        <i class="ki-duotone ki-notification-bing fs-2hx text-primary me-4 mb-5 mb-sm-0"><span
                class="path1"></span><span class="path2"></span><span class="path3"></span></i>
        <!--end::Icon-->

        <!--begin::Wrapper-->
        <div class="d-flex flex-column pe-0 pe-sm-10">
            <!--begin::Title-->
            <h4 class="fw-semibold">Importante</h4>
            <!--end::Title-->

            <!--begin::Content-->
            <span>EN ESTE MENU PODREMOS AGREGAR, MODIFICAR O ELIMINAR PRODUCTOS PARA VENTA, QUE LUEGO DE AGREGARLOS,
                SE
                PODRAN UTLIZAR
                SEA PARA ASOCIARLOS
                A UN COMBO O UTILIZARLOS EN UNA COTIZACIÓN.</span>
            <!--end::Content-->
        </div>
    </div>
    {{-- @include('sessions') --}}
    {{-- <div class="card shadow-sm">
        <div class="card-body"> --}} 


            {{-- <div class="alert alert-info" role="alert">
                EN ESTE MENU PODREMOS AGREGAR, MODIFICAR O ELIMINAR PRODUCTOS PARA VENTA, QUE LUEGO DE AGREGARLOS, SE PODRAN UTLIZAR
                SEA PARA ASOCIARLOS
                A UN COMBO O UTILIZARLOS YA EN UNA COTIZACIÓN.
            </div> --}}
            
            {{-- @component('components.table')
                    @slot('thead')
                        <th>{{ __('Producto') }}</th>
                        <th>{{ __('Precio') }}</th>
                        <th>{{ __('Categorias y sub') }}</th>
                        <th>{{ __('Imagen') }}</th>
                        <th>{{ __('Acciones') }}</th>
                        <th>{{ __('ID') }}</th>
                    @endslot
                    @slot('tfoot')
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                    @endslot
                @endcomponent --}}

            {{-- @if (count($data) > 0)
                <table class="table table-bordered table-hover">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col" width="30">#</th>
                            <th scope="col">Producto</th>
                            <th scope="col">Precio</th>
                            <th>Categorias y sub</th>
                            <th scope="col" width="200">Imagen</th>
                            <th width="60">Editar</th>
                            <th scope="col" width="60">Eliminar</th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $key => $item)
                            <td> {{ $key + 1 }} </td>
                            <td>{{ $item->producto }}</td>
                            <td>
                                @foreach ($item->productosPrecios as $pro)
                                    <span class="badge bg-info text-light">{{ $pro->tipoDePrecio->tipo }}:
                                        ${{ number_format($pro->precio, 2) }}</span>
                                @endforeach
                            </td>
                            <td>
                                @foreach ($item->categorias as $categoria)
                                    <span class="badge bg-primary text-light"> {{ $categoria->categoria }} </span>
                                @endforeach
                            </td>
                            @php
                                $url = 'default.png';
                                if ($item->imagen != null) {
                                    $url = $item->imagen;
                                }
                            @endphp
                            <td> <img width="100" height="70" class="img-thumbnail"
                                    src="{{ asset('productos/' . $url) }}" alt=""> </td>
                            <td>
                                <a href="{{ route('productoproductos.edit', $item->id) }}" class="btn btn-warning"><i
                                        class="fas fa-edit"></i></a>
                            </td>
                            <td>
                                <form method="post" action="{{ route('productoproductos.destroy', $item->id) }}">
                                    @method('delete')
                                    @csrf
                                    <button type="submit" class="btn btn-danger"><i class="fas fa-trash"></i></button>
                                </form>
                            </td>

                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <div class="alert alert-danger">
                    <strong>¡Opps! Parece que no tienes ninguna producto registrado.</strong>
                </div>
            @endif --}}
        {{-- </div>
    </div>
@endsection  --}}


<x-app-layout>
    <x-slot:title>
        Lista de productos
      </x-slot>
      <x-slot:subtitle>
      </x-slot>

    <div class="col-md-12">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dasboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Productos</li>
          </ol>
    </div>
    <div class="col-md-12">
        <x-alert></x-alert>
    </div>
    
    <div class="col-md-12 text-end mb-4">
        <a class="btn btn-success" href="{{route('producto.producto.create')}}" title="Crear"> <i class="fas fa-save"></i> </a>
    </div>

    <div class="col-md-12">

        <div class="card">
            <div class="card-body">
                <h5> Productos </h5>
                <table class="table table-sm" id="datatable-responsive">
                    <thead>
                        <tr>
                            <th scope="col" width="40">#</th>
                            <th scope="col">Codigo</th>
                            <th scope="col">Nombre</th>
                            <th  scope="col">Categoría</th>
                            <th scope="col">Descripción</th>
                            <th scope="col">Stock</th>
                            <th  scope="col">Tipo de producto</th>
                            <th scope="col">Activo</th>
                            <th scope="col" width="50" class="text-center"><i class="fas fa-eye"></i></th>
                            <th scope="col" width="50" class="text-center"><i class="fas fa-edit"></i></th>
                            <th scope="col" width="50" class="text-center"><i class="fas fa-trash"></i></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($productos as $key => $item)
                            <tr class="@if($item->activo ==  false) table-danger @endif">
                                <th scope="row">{{$key + 1}}</th>
                                <td>{{$item->codigo}}</td>
                                <td>{{$item->producto}}</td>
                                <td>
                                    @if ($item->categorias->isEmpty())
                                        Producto sin categoría
                                    @else
                                        @foreach ($item->categorias as $categoria)
                                            {{$categoria->categoria}} - 
                                        @endforeach                                        
                                    @endif
                                </td>
                                <td>{{$item->descripcion}}</td>
                                <td>{{$item->alerta_stock}}</td>
                                <td>{{$item->tipoProducto->tipo}}</td>
                                <td>
                                    @if ($item->activo)
                                        Activo
                                    @else
                                        Inactivo
                                    @endif
                                </td>
                                <td><a href="{{route('producto.producto.show', $item->id)}}" class="btn btn-success" title="Ver producto"><i class="fas fa-eye"></i></a></td>
                                <td><a href="{{route('producto.producto.edit', $item->id)}}" class="btn btn-warning" title="Editar producto"><i class="fas fa-edit"></i></a></td>
                                <td>
                                    <form id="form{{ $item->id }}"
                                        action="{{ route('producto.producto.destroy', $item->id) }}"
                                        method="post">
                                        @method('DELETE')
                                        @csrf
                                        <button
                                            onclick="confirm('form{{ $item->id }}','¿Desea eliminar el producto?')"
                                            class="btn btn-danger"
                                            type="button" title="Eliminar"><i class="fas fa-trash"></i>
                                        </button>
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
