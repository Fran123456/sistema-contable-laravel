@extends('metronic.base')


@section('titulo')
    Productos - editar
@endsection

@section('content')
    {{-- <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="/producto/productos">Productos</a></li>
            <li class="breadcrumb-item active" aria-current="page">Editar Producto</li>
        </ol>
    </nav> --}}



    @include('sessions')
    <h2 style="text-align: center">Producto: {{ $data->producto }}</h2>


    <div class="container-fluid">
        <form action="{{ route('productoproductos.update', $data->id) }}" method="post" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="row">
                <div class="form-group col-sm-6">
                    <label for="" class="form-label">Código: </label>
                    <input type="text" name="codigo" value="{{ $data->codigo }}" class="form-control"
                        placeholder="Ingrese el codigo" required autofocus>
                </div>
                <div class="form-group col-sm-6">
                    <label for="" class="form-label">Nombre del producto: </label>
                    <input type="text" name="nombre" value="{{ $data->producto }}" class="form-control"
                        placeholder="Ingrese el nombre del producto" required autofocus>
                </div>


                <div class="form-group col-sm-6 mt-4">
                    <label for="" class="form-label">Imagen del producto </label>
                    <input type="file" class="form-control" name="imagen" accept="image/*">
                    <button type="submit" class="btn btn-primary mt-4"><i class='fas fa-check-circle'></i> Guardar</button>
                </div>
                <div class="form-group col-sm-6 mt-4">
                    @php
                        $url = 'default.png';
                        if ($data->imagen != null) {
                            $url = $data->imagen;
                        }
                    @endphp
                    <label for="" class="form-label">Imagen actual </label><br>
                    <img width="400" height="470" class="img-thumbnail" src="{{ asset('productos/' . $url) }}"
                        alt="">
                </div>
            </div>
        </form>



        @include('producto.producto.categorias')
        <div class="card mt-3">
            <div class="card-header text-center bg-white">
                <b>Listado de atributos del producto</b>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Categoría</th>
                            <th scope="col">Subcategoría</th>
                            <th scope="col">Atributo</th>
                            <th scope="col">Valor</th>
                            <th scope="col">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (count($valoresAtributos) > 0)
                            @foreach ($valoresAtributos as $valor)
                                <tr>
                                    <th scope="row">{{ $loop->iteration }}</th>
                                    <td>{{ $valor->categoria }}</td>
                                    <td>{{ $valor->es_subcategoria == 0 ? 'No' : 'Es subcategoría' }}</td>
                                    <td>{{ $valor->atributo }}</td>
                                    <td>{{ ($valor->valor != null) ? $valor->valor : 'No se le agrego valor' }}</td>
                                    <td>
                                        <form method="post"
                                            action="{{ route('deleteAtributosCategoriaProductos', $valor->atributo_producto_categoria_id) }}">
                                            @method('delete')
                                            @csrf
                                            <button type="submit" class="btn btn-danger"><i
                                                    class="fas fa-trash"></i></button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="6" class="text-center">No se han encontrado registros para esta tabla</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>

        <br>
        @include('producto.producto.precios')

    </div>
@endsection
