<x-app-layout>
    <x-chosen></x-chosen>
   <x-slot:title>
       Crear producto
    </x-slot>

    <x-slot:subtitle>
    </x-slot>
    <div class="col-md-12">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dasboard</a></li>
            <li class="breadcrumb-item"><a href="{{route('producto.producto.index')}}">Productos</a></li>
            <li class="breadcrumb-item active" aria-current="page">Crear contacto</li>
        </ol>
    </div>
    <div class="col-md-12">
        <x-alert></x-alert>
    </div>

    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <form action="{{route('producto.producto.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-4 mt-3">
                            <label for="producto_codigo"> <strong>Codigo</strong> </label>
                            <input type="text" name="codigo" class="form-control" value="PR-{{$codigoProducto}}">
                            @error('codigo')
                                {{$message}}
                            @enderror
                        </div>
                        <div class="col-md-4 mt-3">
                            <label for="producto_nombre"> <strong>Nombre</strong> </label>
                            <input type="text" name="producto" class="form-control" required>
                            @error('producto')
                                {{$message}}
                            @enderror
                        </div>
                        <div class="col-md-4 mt-3">
                            <label for="producto_tipo"> <strong>Tipo de producto</strong> </label>
                            <select name="tipo_producto_id" id="tipo_producto_id" class="form-control">
                               <option value="">Selecciona una opción</option> 
                               @foreach ($tipoProductos as $tipoProducto)
                                    <option value="{{$tipoProducto->id}}">{{$tipoProducto->tipo}}</option>                                   
                               @endforeach
                            </select>
                        </div>
                        <div class="col-md-4 mt-3">
                            <label for="producto_stock"> <strong>Stock</strong> </label>
                            <input type="number" name="alerta_stock" class="form-control">
                        </div>
                        <div class="col-md-4 mt-3">
                            <label for="producto_lote"> <strong>Requiere lote</strong> </label>
                            <select name="requiere_lote" id="requiere_lote" class="form-control">
                                <option value=""> Selecciona una opción </option>
                                <option value="1"> Si </option>
                                <option value="0"> No </option>
                            </select>
                        </div>   
                        <div class="col-md-4 mt-3">
                            <label for="producto_vencimiento"> <strong>¿Tiene fecha de vencimiento?</strong> </label>
                            <select name="requiere_vencimiento" id="requiere_vencimiento" class="form-control">
                                <option value=""> Selecciona una opción </option>
                                <option value="1"> Si </option>
                                <option value="0"> No </option>
                            </select>
                        </div> 
                        <div class="col-md-4 mt-3">
                            <label for="producto_activo"> <strong>Activo</strong> </label>
                            <select name="activo" id="activo" class="form-control">
                                <option value="1"> Activo </option>
                                <option value="0"> Inactivo </option>
                            </select>
                        </div>     
                        <div class="col-md-4 mt-3">
                            <label for="producto_descripcion"> <strong>Descripción</strong> </label>
                            <textarea name="descripcion" class="form-control" cols="30" rows="10"></textarea>
                        </div>      
                        <div class="col-md-4 mt-3">
                            <label for="producto_imagen"><strong>Imagen</strong></label>
                            <input class="form-control" type="file" name="imagen" id="imagen" accept="image/png, image/jpg, image/jpeg">
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