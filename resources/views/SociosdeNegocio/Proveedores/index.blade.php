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
        <a class="btn btn-success" href="{{route('socios.proveedores.create')}}" title="Crear"> <i class="fas fa-user-plus"></i> </a>
    </div>

    <div class="col-md-12">

        <div class="card">
            <div class="card-body">
                <h5> Proveedores </h5>
                <table class="table table-sm" id="datatable-responsive">
                    <thead>
                        <tr>
                            <th scope="col" width="40">#</th>
                            <th scope="col">Nombre</th>
                            <th scope="col">NIT/DUI</th>
                            <th scope="col" width="110">Productos</th>
                            <th scope="col" width="110px">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($proveedores as $key => $item)
                            <tr class="@if($item->activo ==  false) table-danger @endif">
                                <th scope="row">{{$key + 1}}</th>
                                <td>{{$item->nombre}}</td>
                                <td>
                                    @if ($item->nit)
                                        {{$item->nit}}
                                    @elseif ($item->dui)
                                        {{$item->dui}}
                                    @else
                                        No asignado
                                    @endif
                                </td>
                                <td><a href="{{ route('socios.listarProductos', $item->id) }}" title="Productos" class="mx-0.5"><i class="fab fa-product-hunt fa-lg"></i></a>
                                    <a target="_blank" href="{{ route('viewFormProveedor', $item->id) }}" title="Formulario" class="mx-0.5"><i class="fa fa-link fa-lg"></i></a>
                                </td>
                                <td class="">
                                    <a href="{{route('socios.proveedores.show', $item->id)}}" title="Ver proveedor" class="mx-0.5"><i class="fas fa-eye fa-lg"></i></a>
                                    <a href="{{route('socios.proveedores.edit', $item->id)}}" title="Editar proveedor" class="mx-0.5" @if(!$item->activo)  @endif><i class="fas fa-edit fa-lg"></i></a>
                                    <form id="form{{ $item->id }}"
                                        action="{{ route('socios.proveedores.destroy', $item->id) }}"
                                        method="post" class="d-inline">
                                        @method('DELETE')
                                        @csrf
                                        <a href="#" onclick="confirm('form{{ $item->id }}','¿Desea eliminar el proveedor?')" title="Eliminar" class="mx-0.5"><i class="fas fa-trash fa-lg"></i></a>
                                    </form>
                                    @if($item->activo)
                                        <a href="{{route('socios..deshabilitarProveedor', $item->id)}}" title="Deshabilitar Proveedor" class="mx-0.5"><i class="fa-solid fa-ban fa-lg" style="color: #df1111;"></i></a>
                                    @else
                                        <a href="{{route('socios..habilitarProveedor', $item->id)}}" title="Habilitar Proveedor" class="mx-0.5"><i class="fa-solid fa-check fa-lg" style="color: #28a745;"></i></a>
                                    @endif
                                </td>    
                            </tr>
                        @endforeach
                       
                    </tbody>
                </table>
            </div>
        </div>

    </div>

</x-app-layout>
