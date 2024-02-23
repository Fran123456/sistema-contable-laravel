@extends('metronic.base')


@section('titulo')
    Productos - editar
@endsection

@section('content')

    @include('sessions')
    <h3 style="text-align: center">Producto: {{ $data->producto }}</h3>

    <div class="alert alert-info" role="alert">
        LOS PRODUCTOS INTERNOS SON DE USO LOCAL, ES DECIR NO SON PRODUCTOS A LA VENTA, Y SON UTILIZADO PARA REALIZAR ORDENES DE COMPRA
       </div>


    <div class="container-fluid">
        <form action="{{ route('productoproductos-internos.update', $data->id) }}" method="post" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="row">
                <div class="form-group col-sm-6">
                    <label for="" class="control-label">Código: </label>
                    <input type="text" name="codigo" value="{{ $data->codigo }}" class="form-control"
                        placeholder="Ingrese el codigo" required autofocus>
                </div>
                <div class="form-group col-sm-6">
                    <label for="" class="control-label">Nombre del producto: </label>
                    <input type="text" name="nombre" value="{{ $data->producto }}" class="form-control"
                        placeholder="Ingrese el nombre del producto" required autofocus>
                </div>


                <div class="form-group col-sm-6 mt-4">
                    <label for="" class="control-label">Imagen del producto </label>
                    <input type="file" name="imagen" accept="image/*">
                    <br>
                    <button type="submit" class="btn btn-warning mt-4"> Guardar</button>
                </div>
                <div class="form-group col-sm-6 mt-4">
                    @php
                        $url = 'default.png';
                        if ($data->imagen != null) {
                            $url = $data->imagen;
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
