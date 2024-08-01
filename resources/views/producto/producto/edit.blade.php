

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
                <h5>Editar Producto</h5>
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
                       {{-- 
                        <div class="col-md-4 mt-3">
                            <label for="producto_stock"> <strong>Stock</strong> </label>
                            <input type="number" name="alerta_stock" class="form-control" value="{{$producto->alerta_stock}}">
                        </div>
                       --}}
                        <div class="col-md-4 mt-3">
                            <label for="producto_lote"> <strong>Requiere lote</strong> </label>
                            <select name="requiere_lote" id="requiere_lote" class="form-control">
                                <option value=""> Selecciona una opción </option>
                                <option value="1" {{$producto->requiere_lote === 1 ? 'selected' : ' '}}> Si </option>
                                <option value="0" {{$producto->requiere_lote === 0 ? 'selected' : ' '}}> No </option>
                            </select>
                        </div>  
                        
                        <div class="col-md-12 mt-3">
                            <label for="producto_nombre"> <strong>Nombre</strong> </label>
                            <input type="text" name="producto" class="form-control" value="{{$producto->producto}}" required>
                            @error('producto')
                                {{$message}}
                            @enderror
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
                        <div class="col-md-12 mt-3">
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
                            <button class="btn btn-success" style="color:aliceblue" type="submit">Editar producto</button>
                        </div>
                    </div>
                </form>
                <br>

                {{-- Agregar una categoria al producto --}}
                
            </div>
        </div>
    </div>

    <div class="col-md-12 mt-3">
        <div class="card">
            <div class="card-body">
                <h5>Categorias</h5>
                <form action="{{route('producto.producto.update', $producto)}}" method="post">
                    @csrf
                    @method('PUT')
                    <div class="row align-items-end">
                        <div class="col-md-4 mt-3">
                            <label for="productos_categoria"><strong>Categorias</strong></label>
                            <select id="productos_categoria" name="categoria" required class="form-control">
                                <option value="0" selected disabled>Seleccionar opción</option>
                                @foreach($categorias as $categoria)
                                    <option value="{{$categoria->id}}">{{$categoria->categoria}}</option>  
                                @endforeach
                            </select>
                        </div>
                        <input type="hidden" name="producto" value="{{$producto->producto}}">
                        <div class="col-md-6">
                            <button class="btn btn-success" style="color:aliceblue" type="submit">Agregar categoria</button>
                        </div>
                    </div>
                </form>
                <hr>
                <h5> Productos </h5>
                    <table class="table table-sm" id="datatable-responsive">
                        <thead>
                            <tr>
                                <th scope="col" width="40">#</th>
                                <th  scope="col">Categoría</th>
                                <th scope="col" width="50" class="text-center"><i class="fas fa-trash"></i></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($categoriaProducto as $key => $item)
                                <tr>
                                    <th scope="row">{{$key + 1}}</th>
                                    <td>
                                        {{$item->categoria}}
                                    </td>
                                    <td>
                                        <form id="form{{ $item->id }}"
                                            action="{{ route('producto.eliminarCategoria', [$producto->id, $item->id])}}"
                                            method="post">
                                            @method('DELETE')
                                            @csrf
                                            <button
                                                onclick="confirm('form{{ $item->id }}','¿Desea eliminar la categoria del producto?')"
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

    <!-- card para pro_productos_tipo_precio -->
    <div class="col-md-12 mt-3">
        <div class="card">
            <div class="card-body">
                <h5>Precios del Producto</h5>
                <form action="{{ route('producto.agregarPrecio', $producto) }}" method="post">
                    @csrf
                    <div class="row align-items-end">
                        <div class="col-md-4 mt-3">
                            <label for="tipo_precio"><strong>Tipo de Precio</strong></label>
                            <select id="tipo_precio" name="tipo_precio_id" required class="form-control">
                                <option value="" selected disabled>Seleccionar opción</option>
                                @foreach($tiposPrecios as $tipoPrecio)
                                    <option value="{{ $tipoPrecio->id }}">{{ $tipoPrecio->tipo }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4 mt-3">
                            <label for="precio"><strong>Precio</strong></label>
                            <input type="number" step="0.01" name="precio" required class="form-control">
                        </div>
                        <div class="col-md-4 mt-3">
                            <button class="btn btn-success" style="color:aliceblue" type="submit">Agregar Precio</button>
                        </div>
                    </div>
                </form>
                <hr>
                <h5>Precios actuales</h5>
                <table class="table table-sm" id="datatable-precios">
                    <thead>
                        <tr>
                            <th scope="col" width="40">#</th>
                            <th scope="col">Tipo de Precio</th>
                            <th scope="col">Precio</th>
                            <th scope="col" width="50" class="text-center"><i class="fas fa-trash"></i></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($producto->productosPrecios as $key => $item)
                            <tr>
                                <th scope="row">{{ $key + 1 }}</th>
                                <td>{{ $item->tipoPrecio->tipo }}</td>
                                <td>{{ $item->precio }}</td>
                                <td>
                                    <form action="{{ route('producto.eliminarPrecio', [$producto->id, $item->id]) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger" title="Eliminar"><i class="fas fa-trash text-white"></i></button>
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