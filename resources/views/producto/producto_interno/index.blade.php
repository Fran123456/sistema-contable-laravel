@extends('metronic.base')
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
                ajax: '{!! route('producto-interno.indexData') !!}',
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
                        data: 'categorias',
                        name: 'categorias',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'imagen',
                        name: 'pro_producto.imagen',
                        orderable: true,
                        searchable: true
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
    Productos - internos
@endsection

@section('content')

    @include('sessions')
    <h3 style="text-align: center">Productos internos</h3>


    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <a href="{{ route('productoproductos-internos.create') }}" class="btn btn-primary">
            Agregar producto interno
        </a>
    </div>


    <div class="alert alert-info" role="alert">
        LOS PRODUCTOS INTERNOS SON DE USO LOCAL, ES DECIR NO SON PRODUCTOS A LA VENTA, Y SON UTILIZADO PARA REALIZAR ORDENES
        DE COMPRA
    </div>


    @component('components.table')
        @slot('thead')
            <th>{{ __('Producto') }}</th>
            <th>{{ __('Categorias') }}</th>
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
        @endslot
    @endcomponent
    {{-- @if (count($data) > 0)
        <table class="table table-bordered table-hover">
            <thead class="thead-dark">
                <tr>
                    <th scope="col" width="30">#</th>
                    <th scope="col">Producto</th>
                    <th>Categorias</th>
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
                    <td> <img width="100" height="70" class="img-thumbnail" src="{{ asset('productos/' . $url) }}"
                            alt=""> </td>
                    <td>
                        <a href="{{ route('productoproductos-internos.edit', $item->id) }}" class="btn btn-warning"><i
                                class="fas fa-edit"></i></a>
                    </td>
                    <td>
                        <form method="post" action="{{ route('productoproductos-internos.destroy', $item->id) }}">
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

@endsection
