{{-- @extends('metronic.base')
@section('extracss')
@endsection
@section('extrajs')
@endsection

@section('titulo')
    Productos - proveedor
@endsection

@section('content')

    @include('sessions')
    <h3 style="text-align: center">Productos por proveedor</h3>

    <div class="alert alert-info" role="alert">
       LOS PRODUCTOS SE ASOCIAN A UN PROVEEDOR, EN ESTE MENU PODRA REALIZAR DICHA OPERACIÓN, ASOCIAR PRODUCTOS INTERNOS O DE VENTA
       Y ASOCIAR LOS PRECIOS QUE DICHOS PROVEEDORES LE PROPORCIONEN.
      </div>


    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <a href="{{ route('productoproductos-proveedor.create') }}" class="btn btn-primary">
            Agregar producto a un proveedor
        </a>
    </div>



    @if (count($data) > 0)
        <table class="table table-bordered table-hover">
            <thead class="thead-dark">
                <tr>
                    <th scope="col" width="30">#</th>
                    <th scope="col">Producto</th>
                    <th scope="col" width="100">Codigo</th>
                    <th scope="col" width="100">Proveedores</th>
                    <th scope="col" width="160">Imagen</th>
                    <th width="60" class="text-center"><i class="fas fa-edit"></i></th>


                </tr>
            </thead>
            <tbody>
                @foreach ($data as $key => $item)
                    <td> {{ $key + 1 }} </td>
                    <td>{{ $item->productoVenta->producto }}</td>
                    <td>{{ $item->productoVenta->codigo }}</td>
                    <td>
                        @foreach ($item->proveedores($item->productoVenta->id) as $pro)
                            <span class="badge badge-secondary">{{ $pro->proveedor->nombreProveedor }}</span>
                        @endforeach


                    </td>
                    @php
                        $url = 'default.png';
                        if ($item->productoVenta->imagen != null) {
                            $url = $item->productoVenta->imagen;
                        }
                    @endphp
                    <td> <img width="100" height="70" class="img-thumbnail" src="{{ asset('productos/' . $url) }}"
                            alt=""> </td>
                    <td class="text-center">
                        <a href="{{ route('productoproductos-proveedor.edit', $item->productoVenta->id) }}"
                            class="btn btn-warning"><i class="fas fa-edit"></i></a>
                    </td>


                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <div class="alert alert-danger">
            <strong>¡Opps! Parece que no tienes ninguna producto registrado.</strong>
        </div>
    @endif

@endsection --}}

<x-app-layout>
    <x-slot:title>
        Lista de proveedores
    </x-slot>
    <x-slot:subtitle>
    </x-slot>

    <div class="col-md-12">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">Dasboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Proveedores</li>
        </ol>
    </div>
    <div class="col-md-12">
        <x-alert></x-alert>
    </div>

    <div class="col-md-12 text-end mb-4">
        <a class="btn btn-success" href="{{ route('producto.producto_proveedor.create') }}" title="Crear"> <i
                class="fas fa-save"></i> </a>
    </div>

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
                            <th scope="col">Precio unitario</th>
                            <th scope="col">Stock</th>
                            <th scope="col">Proveedor</th>
                            <th scope="col" width="50" class="text-center"><i class="fas fa-edit"></i></th>
                            <th scope="col" width="50" class="text-center"><i class="fas fa-trash"></i></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($productoProveedor as $key => $item)
                            @foreach ($item->proveedores as $proveedor)
                                <tr>
                                    <th scope="row">{{ $key + 1 }}</th>
                                    <td>{{ $proveedor->pivot->codigo }}</td>
                                    <td>{{ $proveedor->pivot->producto }}</td>
                                    <td>{{ $proveedor->pivot->precio_unitario }}</td>
                                    <td>{{ $proveedor->pivot->stock }}</td>
                                    <td>{{ $proveedor->nombre }}</td>
                                    <td><a href="{{ route('producto.producto_proveedor.edit', $proveedor->pivot->id) }}"
                                            class="btn btn-warning" title="Editar"><i class="fas fa-edit"></i></a></td>
                                    <td>
                                        <form id="form{{ $item->id }}"
                                            action="{{ route('producto.producto_proveedor.destroy', $proveedor->pivot->id) }}"
                                            method="post">
                                            @method('DELETE')
                                            @csrf
                                            <button
                                                onclick="confirm('form{{ $item->id }}','¿Desea eliminar el producto?')"
                                                class="btn btn-danger" type="button" title="Eliminar"><i
                                                    class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </div>

</x-app-layout>
