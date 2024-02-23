@extends('metronic.base')


@section('titulo')
    Productos - crear
@endsection

@section('content')
<nav aria-label="breadcrumb">

    </nav>

    @include('sessions')
    <h3 style="text-align: center">Agregar producto interno </h3>

    <div class="alert alert-info" role="alert">
        LOS PRODUCTOS INTERNOS SON DE USO LOCAL, ES DECIR NO SON PRODUCTOS A LA VENTA, Y SON UTILIZADO PARA REALIZAR ORDENES DE COMPRA
       </div>


    <div class="container-fluid">
        <form action="{{ route('productoproductos-internos.store') }}" method="post" enctype="multipart/form-data">

            @csrf
            <div class="row">
                <div class="form-group col-sm-6">
                    <label for="" class="control-label">Código: </label>
                    <input type="text" name="codigo" value="{{ $data?->codigo }}" class="form-control"
                        placeholder="Ingrese el codigo" required autofocus
                        @if ($data?->codigo != null) readonly @endif />
                </div>
                <div class="form-group col-sm-6">
                    <label for="" class="control-label">Nombre del producto: </label>
                    <input type="text" name="nombre" value="{{ $data?->producto }}" class="form-control"
                        placeholder="Ingrese el nombre del producto" required autofocus
                        @if ($data?->producto != null) readonly @endif />
                </div>


                <div class="form-group col-sm-6 mt-4">
                    <label for="" class="control-label">Imagen del producto </label>
                    <input @if ($data?->producto != null) disabled @endif type="file" name="imagen" accept="image/*">
                    <br>
                    <button @if ($data?->producto != null) disabled @endif type="submit" class="btn btn-warning mt-4">
                        Guardar</button>
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
                    <label for="" class="control-label">Imagen actual </label><br>
                    <img width="400" height="470" class="img-thumbnail" src="{{ asset('productos/' . $url) }}"
                        alt="">
                </div>
            </div>
        </form>


        @include('producto.producto_interno.categorias')









    </div>
@endsection
