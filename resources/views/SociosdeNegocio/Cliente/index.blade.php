<x-app-layout>
    <x-slot:title>
        Lista de clientes
      </x-slot>
      <x-slot:subtitle>
      </x-slot>
  
    <div class="col-md-12">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">Dasboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Clientes</li>
          </ol>
    </div>
    <div class="col-md-12">
        <x-alert></x-alert>
    </div>

    <div class="col-md-12 text-end mb-4">
        <a class="btn btn-success" href="{{ route('socios.cliente.create') }}" title="Crear"> <i class="fas fa-user-plus"></i> </a>
    </div>

    <div class="col-md-12">

        <div class="card">
            <div class="card-body">
                <h5> Clientes </h5>
                <table class="table table-sm" id="datatable-responsive">
                    <thead>
                        <tr>
                            <th scope="col" width="40">#</th>
                            <th scope="col">Nombre</th>
                            <th scope="col">Clasificación</th>
                            <th scope="col">Tipo</th>

                            <th scope="col" width="50" class="text-center"><i class="fas fa-eye"></i></th>
                            <th scope="col" width="50" class="text-center"><i class="fas fa-edit"></i></th>
                            <th scope="col" width="50" class="text-center"><i class="fas fa-trash"></i></th>
                            <th scope="col" width="50" class="text-center"><i class="fa-solid fa-ban"></i></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($cliente as $key => $item)
                            <tr class="@if($item->activo ==  false) table-danger @endif">
                                <td scope="row">{{$key + 1}}</td>
                                <td>{{$item->nombre}} {{$item->apellido}}</td> {{-- Nombre completo --}}
                                <td>{{$item->clasificacion->tipo}}</td>
                                <td>{{$item->tipo_cliente}}</td>
                                
                                <td><a target="_blank" href="{{route('socios.cliente.show', $item->id)}}" class="btn btn-success" title="Ver cliente"><i class="fas fa-eye"></i></a></td>
                                <td>
                                    <a href="{{route('socios.cliente.edit', $item->id)}}" class="btn btn-warning @if(!$item->activo) disabled @endif" title="Editar"><i class="fas fa-edit"></i></a>
                                </td>
                                <td>
                                    <form id="form{{ $item->id }}"
                                        action="{{ route('socios.cliente.destroy', $item->id) }}"
                                        method="post">
                                        @method('DELETE')
                                        @csrf
                                        <button
                                            onclick="confirm('form{{ $item->id }}','¿Desea eliminar el cliente?')"
                                            class="btn btn-danger"
                                            type="button" title="Eliminar"><i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                                <td><a href="{{route('socios.deshabilitarCliente', $item->id)}}" class="btn btn-light" title="Deshabilitar Cliente"><i class="fa-solid fa-ban" style="color: #df1111;"></a></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</x-app-layout>
