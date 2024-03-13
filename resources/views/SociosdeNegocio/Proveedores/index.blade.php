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
                            <th scope="col">Giro</th>
                            <th scope="col">Teléfono</th>
                            <th scope="col">Dirección</th>
                            <th scope="col" width="50" class="text-center"><i class="fas fa-eye"></i></th>
                            <th scope="col" width="50" class="text-center"><i class="fas fa-edit"></i></th>
                            <th scope="col" width="50" class="text-center"><i class="fas fa-trash"></i></th>
                            <th scope="col" width="50" class="text-center"><i class="fa-solid fa-ban"></i></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($proveedores as $key => $item)
                            <tr class="@if($item->activo ==  false) table-danger @endif">
                                <th scope="row">{{$key + 1}}</th>
                                <td>{{$item->nombre}}</td>
                                <td>{{$item->giro}}</td>
                                <td>{{$item->telefono}}</td>
                                <td>{{$item->direccion}}</td>
                                <td><a href="{{route('socios.proveedores.show', $item->id)}}" class="btn btn-success" title="Ver proveedor"><i class="fas fa-eye"></i></a></td>
                                <td><a href="{{route('socios.proveedores.edit', $item->id)}}" class="btn btn-warning @if(!$item->activo) disabled @endif" title="Editar"><i class="fas fa-edit"></i></a></td>
                                <td>
                                    <form id="form{{ $item->id }}"
                                        action="{{ route('socios.proveedores.destroy', $item->id) }}"
                                        method="post">
                                        @method('DELETE')
                                        @csrf
                                        <button
                                            onclick="confirm('form{{ $item->id }}','¿Desea eliminar el proveedor?')"
                                            class="btn btn-danger"
                                            type="button" title="Eliminar"><i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                                <td><a href="{{route('socios..deshabilitarProveedor', $item->id)}}" class="btn btn-light @if(!$item->activo) disabled @endif" title="Deshabilitar Proveedor"><i class="fa-solid fa-ban" style="color: #df1111;"></a></td>
                            </tr>
                        @endforeach
                       
                    </tbody>
                </table>
            </div>
        </div>

    </div>

</x-app-layout>
