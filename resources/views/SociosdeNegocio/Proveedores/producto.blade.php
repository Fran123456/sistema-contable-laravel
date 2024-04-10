<x-app-layout>
    <x-slot:title>
        Lista de productos
      </x-slot>
      <x-slot:subtitle>
      </x-slot>

    <div class="col-md-12">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">Dasboard</a></li>
            <li class="breadcrumb-item"><a href="{{route('socios.proveedores.index')}}">Proveedores</a></li>
            <li class="breadcrumb-item active" aria-current="page">Productos</li>
          </ol>
    </div>
    <div class="col-md-12">
        <x-alert></x-alert>
    </div>
    
    <form action="{{ route('producto.producto_proveedor.store') }}" method="post">
        @csrf
        <div class="row">
            <div class="col-md-3 mt-3">
                <label for="producto_proveedor"> <strong>Producto</strong> </label>
                <select name="producto_id" id="producto" class="form-control" required>
                   <option value="">Selecciona una opción</option> 
                   @foreach ($productos as $item)
                       <option value="{{$item->id}}">{{$item->producto}}</option>
                   @endforeach
                </select>
                @error('producto')
                    {{$message}}
                @enderror
            </div>
            <div class="col-md-3 mt-3">
                <label for="producto_codigo"> <strong>Codigo</strong> </label>
                <input type="text" name="codigo" class="form-control">
            </div>
            <div class="col-md-3 mt-3">
                <label for="producto_nombre"> <strong>Nombre</strong> </label>
                <input type="text" name="producto" class="form-control">
            </div>
            <div class="col-md-3 mt-3">
                <label for="producto_precio"> <strong>Precio unitario</strong> </label>
                <input type="number" name="precio_unitario" class="form-control" step="any" required>
            </div>
            <input type="hidden" name="proveedor_id" value="{{$idProveedor}}">
            <div class="col-md-12 text-end mt-2 mb-2">
                <button class="btn btn-success" style="color:aliceblue" type="submit">Guardar</button>
            </div>
        </div>
    </form>

    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <h5> Productos </h5>
                <table class="table table-sm" id="datatable-responsive">
                    <thead>
                        <tr>
                            <th scope="col" width="40">#</th>
                            <th scope="col">Codigo</th>
                            <th scope="col">Producto</th>
                            <th  scope="col">Precio unitario</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($productoProveedor as $key => $item)
                            <tr>
                                <td>{{$key + 1}}</td>
                                <td>{{$item->codigo}}</td>    
                                <td>{{$item->producto }}</td>
                                <td>{{$item->precio_unitario }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>