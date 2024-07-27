<x-app-layout>
    <x-chosen></x-chosen>
   <x-slot:title>
       Ver producto
    </x-slot>

    <x-slot:subtitle>
    </x-slot>
    <div class="col-md-12">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dasboard</a></li>
            <li class="breadcrumb-item"><a href="{{route('producto.producto.index')}}">Productos</a></li>
            <li class="breadcrumb-item active" aria-current="page">Ver producto</li>
        </ol>
    </div>
    <div class="col-md-12">
        <x-alert></x-alert>
    </div>

    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                @csrf
                <div class="row">
                    <div class="col-md-4 mt-3">
                        <label for="producto_codigo"> <strong>Codigo</strong> </label>
                        <input type="text" name="codigo" class="form-control" value={{$producto->codigo}} readonly>
                        @error('codigo')
                            {{$message}}
                        @enderror
                    </div>
                    <div class="col-md-8 mt-3">
                        <label for="producto_nombre"> <strong>Nombre</strong> </label>
                        <input type="text" name="producto" class="form-control" value="{{$producto->producto}}" readonly>
                        @error('producto')
                            {{$message}}
                        @enderror
                    </div>

                    <div class="col-md-12 mt-2">
                        <h6>Categorias</h6>
                        @if ($producto->categorias->isEmpty())
                            Producto sin categoría
                        @else
                            @foreach ($producto->categorias as $categoria)
                                <h6><span class="badge text-bg-primary">{{$categoria->categoria}} </span></h6>
                            @endforeach                                        
                        @endif
                    </div>



                    <div class="col-md-3 mt-3">
                        <label for="producto_tipo"> <strong>Tipo de producto</strong> </label>
                        <select name="tipo_producto_id" id="tipo_producto_id" class="form-control" readonly>
                            <option value="">Selecciona una opción</option> 
                            @foreach ($tipoProductos as $tipoProducto)
                                <option value="{{$tipoProducto->id}}" @if ($tipoProducto->id == $producto->tipo_producto_id) selected @endif>
                                    {{$tipoProducto->tipo}}
                                </option>                                   
                            @endforeach
                        </select>
                    </div>
                    {{-- <div class="col-md-4 mt-3">
                        <label for="producto_stock"> <strong>Stock</strong> </label>
                        <input type="number" name="alerta_stock" class="form-control" value="{{$producto->alerta_stock}}" readonly>
                    </div> --}}
                    <div class="col-md-3 mt-3">
                        <label for="producto_lote"> <strong>Requiere lote</strong> </label>
                        <select name="requiere_lote" id="requiere_lote" class="form-control" readonly>
                            <option value=""> Selecciona una opción </option>
                            <option value="1" {{$producto->requiere_lote === 1 ? 'selected' : ' '}}> Si </option>
                            <option value="0" {{$producto->requiere_lote === 0 ? 'selected' : ' '}}> No </option>
                        </select>
                    </div>   
                    <div class="col-md-3 mt-3">
                        <label for="producto_vencimiento"> <strong>Fecha de vencimiento</strong> </label>
                        <select name="requiere_vencimiento" id="requiere_vencimiento" class="form-control" readonly>
                            <option value=""> Selecciona una opción </option>
                            <option value="1" {{$producto->requiere_vencimiento === 1 ? 'selected' : ' '}}> Si </option>
                            <option value="0" {{$producto->requiere_vencimiento === 0 ? 'selected' : ' '}}> No </option>
                        </select>
                    </div> 
                    <div class="col-md-3 mt-3">
                        <label for="producto_activo"> <strong>Activo</strong> </label>
                        <select name="activo" id="activo" class="form-control" readonly>
                            <option value=""> Selecciona una opción </option>
                            <option value="1" {{$producto->activo === 1 ? 'selected' : ' '}}> Activo </option>
                            <option value="0" {{$producto->activo === 0 ? 'selected' : ' '}}> Inactivo </option>
                        </select>
                    </div>     
                    <div class="col-md-12 mt-3">
                        <label for="producto_descripcion"> <strong>Descripción</strong> </label>
                        <textarea name="descripcion" class="form-control" cols="30" rows="10" readonly>{{$producto->descripcion}}</textarea>
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
                                        

                                        <img  class="img-fluid" src="/productos/{{$producto->imagen }}" alt="Imagen producto" >
                                    </div>
                            </div>
                        @endif
                    </div>   
                </div>
            </div>
        </div>
    </div>

</x-app-layout>