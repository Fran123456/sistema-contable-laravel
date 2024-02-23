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
            ajax: '{!! route('combo.indexData') !!}',
            columnDefs: [

                {
                    targets: [-1],
                    visible: false,
                    searchable: false
                },
            ],
            columns: [{
                    data: 'codigo',
                    name: 'pro_combo.codigo',
                    orderable: true,
                    searchable: true
                },
                {
                    data: 'combo',
                    name: 'pro_combo.combo',
                    orderable: true,
                    searchable: true
                },
                {
                    data: 'productos',
                    name: 'cantidad',
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
    Combos
@endsection

@section('content')
    {{-- <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="/">Dashboard</a></li>

      <li class="breadcrumb-item active" aria-current="page">Combos</li>
    </ol>
  </nav> --}}
    @include('sessions')
    {{-- <h3 style="text-align: center">Combos para productos</h3> --}}

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <a href="{{ route('productocombos.create') }}" class="btn btn-primary">
            Agregar combo
        </a>
    </div>

    {{-- <div class="alert alert-info" role="alert">
        EN ESTE MENU PODREMOS AGREGAR, MODIFICAR O ELIMINAR UN COMBO PARA VENTA, QUE LUEGO DE AGREGARLOS, SE PODRA UTLIZAR
        YA EN UNA COTIZACIÓN.
    </div> --}}
    <!--begin::Alert-->
    <div class="alert alert-dismissible bg-light-primary border border-primary d-flex flex-column flex-sm-row p-5 mb-5">
        <!--begin::Icon-->
        <i class="ki-duotone ki-notification-bing fs-2hx text-primary me-4 mb-5 mb-sm-0"><span class="path1"></span><span
                class="path2"></span><span class="path3"></span></i>
        <!--end::Icon-->

        <!--begin::Wrapper-->
        <div class="d-flex flex-column pe-0 pe-sm-10">
            <!--begin::Title-->
            <h4 class="fw-semibold">IMPORTANTE</h4>
            <!--end::Title-->

            <!--begin::Content-->
            <span>EN ESTE MENU PODREMOS AGREGAR, MODIFICAR O ELIMINAR UN COMBO PARA VENTA, QUE LUEGO DE AGREGARLOS, SE PODRA
                UTLIZAR
                YA EN UNA COTIZACIÓN.</span>
            <!--end::Content-->
        </div>
        <!--end::Wrapper-->

        <!--begin::Close-->
        <button type="button" class="position-absolute position-sm-relative m-2 m-sm-0 top-0 end-0 btn btn-icon ms-sm-auto"
            data-bs-dismiss="alert">
            <i class="ki-duotone ki-cross fs-1 text-primary"><span class="path1"></span><span class="path2"></span></i>
        </button>
        <!--end::Close-->
    </div>
    <!--end::Alert-->
    <div class="card shadow-sm">
        <div class="card-body">
            @component('components.table')
                    @slot('thead')
                        <th>{{ __('Codigo') }}</th>
                        <th>{{ __('Combo') }}</th>
                        <th>{{ __('Productos') }}</th>
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
                            <th scope="col" width="40">#</th>
                            <th scope="col" width="100">Codigo</th>
                            <th scope="col">Combo</th>

                            <th scope="col" width="60">Productos</th>
                            <th class="text-center" scope="col" width="40"><i class="fas fa-edit"></i></th>
                            <th class="text-center" width="40"><i class="fas fa-trash"></i></th>
                        </tr>

                    </thead>
                    <tbody>
                        @foreach ($data as $key => $item)
                            <td> {{ $key + 1 }} </td>
                            <td>{{ $item->codigo }}</td>
                            <td>{{ $item->combo }}</td>

                            <td>{{ count($item->productos) }}</td>
                            <td>
                                <a href="{{ route('productocombos.edit', $item->id) }}?&edit=1" class="btn btn-warning"><i
                                        class="fas fa-edit"></i></a>
                            </td>
                            <td>
                                <form method="post" action="{{ route('productocombos.destroy', $item->id) }}">
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
                    <strong>¡Opps! Parece que no tienes ningun combo registrado.</strong>
                </div>
            @endif --}}
        </div>
    </div>
@endsection
