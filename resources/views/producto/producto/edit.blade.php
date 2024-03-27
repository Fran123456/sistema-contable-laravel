{{-- @extends('metronic.base')


@section('titulo')
    Productos - editar
@endsection

@section('content') --}}
    {{-- <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="/producto/productos">Productos</a></li>
            <li class="breadcrumb-item active" aria-current="page">Editar Producto</li>
        </ol>
    </nav> --}}



    {{-- @include('sessions')
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
@endsection --}}


<x-app-layout>
    <x-chosen></x-chosen>
   <x-slot:title>
       Editar producto
    </x-slot>

    <x-slot:subtitle>
    </x-slot>
    <div class="col-md-12">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dasboard</a></li>
            <li class="breadcrumb-item"><a href="{{route('producto.producto.index')}}">Productos</a></li>
            <li class="breadcrumb-item active" aria-current="page">Editar producto</li>
        </ol>
    </div>
    <div class="col-md-12">
        <x-alert></x-alert>
    </div>

    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <form action="{{route('producto.producto.update', $producto) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-md-4 mt-3">
                            <label for="producto_codigo"> <strong>Codigo</strong> </label>
                            <input type="text" name="codigo" class="form-control" value={{$producto->codigo}} readonly>
                            @error('codigo')
                                {{$message}}
                            @enderror
                        </div>
                        <div class="col-md-4 mt-3">
                            <label for="producto_nombre"> <strong>Nombre</strong> </label>
                            <input type="text" name="producto" class="form-control" value="{{$producto->producto}}" required>
                            @error('producto')
                                {{$message}}
                            @enderror
                        </div>
                        <div class="col-md-4 mt-3">
                            <label for="producto_tipo"> <strong>Tipo de producto</strong> </label>
                            <select name="tipo_producto_id" id="tipo_producto_id" class="form-control">
                               <option value="">Selecciona una opción</option> 
                               @foreach ($tipoProductos as $tipoProducto)
                                    <option value="{{$tipoProducto->id}}" @if ($tipoProducto->id == $producto->tipo_producto_id) selected @endif>
                                        {{$tipoProducto->tipo}}
                                    </option>                                   
                               @endforeach
                            </select>
                        </div>
                        <div class="col-md-4 mt-3">
                            <label for="producto_stock"> <strong>Stock</strong> </label>
                            <input type="number" name="alerta_stock" class="form-control" value="{{$producto->alerta_stock}}">
                        </div>
                        <div class="col-md-4 mt-3">
                            <label for="producto_lote"> <strong>Requiere lote</strong> </label>
                            <select name="requiere_lote" id="requiere_lote" class="form-control">
                                <option value=""> Selecciona una opción </option>
                                <option value="1" {{$producto->requiere_lote === 1 ? 'selected' : ' '}}> Si </option>
                                <option value="0" {{$producto->requiere_lote === 0 ? 'selected' : ' '}}> No </option>
                            </select>
                        </div>   
                        <div class="col-md-4 mt-3">
                            <label for="producto_vencimiento"> <strong>¿Tiene fecha de vencimiento?</strong> </label>
                            <select name="requiere_vencimiento" id="requiere_vencimiento" class="form-control">
                                <option value=""> Selecciona una opción </option>
                                <option value="1" {{$producto->requiere_vencimiento === 1 ? 'selected' : ' '}}> Si </option>
                                <option value="0" {{$producto->requiere_vencimiento === 0 ? 'selected' : ' '}}> No </option>
                            </select>
                        </div> 
                        <div class="col-md-4 mt-3">
                            <label for="producto_activo"> <strong>Activo</strong> </label>
                            <select name="activo" id="activo" class="form-control">
                                <option value=""> Selecciona una opción </option>
                                <option value="1" {{$producto->activo === 1 ? 'selected' : ' '}}> Activo </option>
                                <option value="0" {{$producto->activo === 0 ? 'selected' : ' '}}> Inactivo </option>
                            </select>
                        </div>     
                        <div class="col-md-4 mt-3">
                            <label for="producto_descripcion"> <strong>Descripción</strong> </label>
                            <textarea name="descripcion" class="form-control" cols="30" rows="10">{{$producto->descripcion}}</textarea>
                        </div>   
                        <div class="col-md-4 mt-3 ">
                            <label for="producto_imagen"><strong>Imagen</strong></label>
                            <input class="form-control" type="file" name="imagen" id="imagen" accept="image/png, image/jpg, image/jpeg" value="{{$producto->imagen}}">
                        </div> 
                        <div class="row">
                            @if ($producto->imagen)
                                <div class=" row ">
                                    <div class=" col-md-6 mt-2 mb-12 ">
                                        <label for="imagen_producto"><strong>Imagen actual</strong></label>
                                    </div>
                                </div>
                                <div class=" row ">
                                        <div class=" col-md-12 mt-2 mb-12 ">
                                            <img src="/productos/{{$producto->imagen }}" alt="Imagen producto" style=" max-width:300px; max-height:200px;">
                                        </div>
                                </div>
                            @endif
                        </div>   
                        <div class="col-md-12 mt-4 mb-1">
                            <button class="btn btn-success" style="color:aliceblue" type="submit">Guardar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

</x-app-layout>