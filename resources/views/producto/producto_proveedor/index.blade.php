@extends('metronic.base')
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

@endsection
