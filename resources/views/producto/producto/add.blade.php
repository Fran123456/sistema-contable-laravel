@extends('metronic.base')


@section('titulo')
    Productos - crear
@endsection

@section('content')
    {{-- <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="/producto/productos">Productos</a></li>
            <li class="breadcrumb-item active" aria-current="page">Agregar Producto</li>
        </ol>
    </nav> --}}


    @include('sessions')
    <div class="col-md-12 mt-3">
        <div style="text-align: right;">
            <a class="btn btn-danger" href="/producto/productos/create">NUEVO PRODUCTO</a>
        </div>
    </div>

    <h2 style="text-align: center">Agregar producto </h2>


    <div class="container-fluid mt-6">
        <form action="{{ route('productoproductos.store') }}" method="post" enctype="multipart/form-data">

            @csrf
            <div class="row mb-6">
                <div class="form-group col-sm-6">
                    <label for="" class="form-label">Código: </label>
                    <input type="text" name="codigo" value="{{ $data?->codigo }}" class="form-control"
                        placeholder="Ingrese el codigo" required autofocus
                        @if ($data?->codigo != null) readonly @endif />
                </div>
                <div class="form-group col-sm-6">
                    <label for="" class="form-label">Nombre del producto: </label>
                    <input type="text" name="nombre" value="{{ $data?->producto }}" class="form-control"
                        placeholder="Ingrese el nombre del producto" required autofocus
                        @if ($data?->producto != null) readonly @endif />
                </div>


                <div class="form-group col-sm-6 mt-4">
                    <label for="" class="form-label">Imagen del producto </label>
                    <input @if ($data?->producto != null) disabled @endif type="file" class="form-control" name="imagen" accept="image/*">
                    <button @if ($data?->producto != null) disabled @endif type="submit" class="btn btn-primary mt-4">
                        <i class='fas fa-check-circle'></i> Guardar</button>
                </div>
                <div class="form-group col-sm-6 mt-4">
                    @php
                        $url = 'default.png';
                        if ($data?->imagen != null) {
                            $url = $data?->imagen;
                        }
                        if ($url == null) {
                            $url = 'default.png';
                        }

                    @endphp
                    <label for="" class="form-label">Imagen actual </label><br>
                    <img width="400" height="470" class="img-thumbnail" src="{{ asset('productos/' . $url) }}"
                        alt="">
                </div>
            </div>
        </form>


        @include('producto.producto.categorias')
        <br>
        @include('producto.producto.precios')

        <br>
        @include('producto.producto.lote')









    </div>
@endsection
