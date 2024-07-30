

<x-app-layout>
    <x-slot:title>
        Lista de productos
      </x-slot>
      <x-slot:subtitle>
      </x-slot>

    <div class="col-md-12">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dasboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Productos</li>
          </ol>
    </div>
    <div class="col-md-12">
        <x-alert></x-alert>
    </div>
    
    <div class="col-md-12 text-end mb-4">
        <a class="btn btn-success" href="{{route('producto.producto.create')}}" title="Crear"> <i class="fas fa-save"></i> </a>
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
                            <th scope="col">Nombre</th>
                            
                         
                            <th  scope="col">Tipo de producto</th>
                            <th scope="col">Activo</th>
                            <th scope="col" width="50" class="text-center"><i class="fas fa-eye"></i></th>
                            <th scope="col" width="50" class="text-center"><i class="fas fa-edit"></i></th>
                            <th scope="col" width="50" class="text-center"><i class="fas fa-trash"></i></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($productos as $key => $item)
                            <tr class="@if($item->activo ==  false) table-danger @endif">
                                <th scope="row">{{$key + 1}}</th>
                                <td>{{$item->codigo}}</td>
                                <td>{{$item->producto}}</td>
                               
            
                                <td>{{$item->tipoProducto->tipo}}</td>
                                <td>
                                    @if ($item->activo)
                                        Activo
                                    @else
                                        Inactivo
                                    @endif
                                </td>
                                <td><a href="{{route('producto.producto.show', $item->id)}}" class="btn btn-success" title="Ver producto"><i class="fas fa-eye"></i></a></td>
                                <td><a href="{{route('producto.producto.edit', $item->id)}}" class="btn btn-warning" title="Editar producto"><i class="fas fa-edit"></i></a></td>
                                <td>
                                    <form id="form{{ $item->id }}"
                                        action="{{ route('producto.producto.destroy', $item->id) }}"
                                        method="post">
                                        @method('DELETE')
                                        @csrf
                                        <button
                                            onclick="confirm('form{{ $item->id }}','¿Desea eliminar el producto?')"
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

</x-app-layout>
