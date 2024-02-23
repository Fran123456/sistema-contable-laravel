@extends('metronic.base')
@section('titulo')
    Categorias
@endsection
@section('extracss')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap4.min.css">
@endsection
@section('extrajs')
    <script src="//cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap4.min.js"></script>
    <script>
        $(document).ready(function() {

            //FUNCION PARA CAMBIAR EL PLACEHOLDER AL INPUT FILE DE EXAMENES DE SALUD y PROPEDEUTICOS
            $('.custom-file input').change(function(e) {
                var files = [];
                for (var i = 0; i < $(this)[0].files.length; i++) {
                    files.push($(this)[0].files[i].name);
                }
                $(this).next('.custom-file-label').html(files.join(', '));
            });
        });
    </script>
@endsection
@section('content')
    {{-- <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="/producto/categoria">Categorias y sub categoria para producto</a></li>
            <li class="breadcrumb-item active" aria-current="page">Importar atributos de categoría vía Excel</li>
        </ol>
    </nav> --}}
    {{-- <h5 class="alert alert-info"><b>Importante:</b> Para poder realizar un ingreso de atributos a la categoría
        <b><u>{{ $categoria->categoria }}</u></b> por medio de la importación
        vía Excel, descargue la plantilla proporcionada y llenela en base a lo que se le solicita y luego suba la plantilla
        correctamente llena en su respectivo apartado. <b>No modifique las cabeceras de la plantilla proporcionada</b>
    </h5> --}}
    <div class="alert alert-dismissible bg-light-primary d-flex flex-column flex-sm-row p-5 mb-1">
        <!--begin::Icon-->
        <i class="ki-duotone ki-notification-bing fs-2hx text-primary me-4 mb-5 mb-sm-0"><span class="path1"></span><span
                class="path2"></span><span class="path3"></span></i>
        <!--end::Icon-->

        <!--begin::Wrapper-->
        <div class="d-flex flex-column pe-0 pe-sm-10">
            <!--begin::Title-->
            <h4 class="fw-semibold">Importante</h4>
            <!--end::Title-->

            <!--begin::Content-->
            <span>Para poder realizar un ingreso de atributos a la categoría
                <b><u>{{ $categoria->categoria }}</u></b> por medio de la importación
                vía Excel, descargue la plantilla proporcionada y llenela en base a lo que se le solicita y luego suba la
                plantilla
                correctamente llena en su respectivo apartado. <b>No modifique las cabeceras de la plantilla
                    proporcionada</b></span>
            <!--end::Content-->
        </div>
    </div>
    @include('sessions')

    <a href="{{ asset('/producto/descargar-plantilla-atributos-excel') }}" class="btn btn-success mb-5"><i
            class="fas fa-download"></i> Descargar plantilla</a>
    <form action="{{ route('producto.importarAtributosStore') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="input-group mb-2">
            <input type="file" class="form-control" name="import_file" id="import_file" accept=".xls, .xlsx" required>
            <input type="hidden" name="pro_categoria_id" id="pro_categoria_id" value="{{ $categoria->id }}">
        </div>
        <button class="btn btn-primary mt-2" type="submit"><i class='fas fa-check-circle'></i> Importar</button>
    </form>
@endsection
