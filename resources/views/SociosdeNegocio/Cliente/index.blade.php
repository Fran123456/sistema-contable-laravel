<x-app-layout>
    <x-slot:title>
        Lista de clientes
    </x-slot>
    <x-slot:subtitle>
    </x-slot>

    <div class="col-md-12">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Clientes</li>
        </ol>
    </div>
    <div class="col-md-12">
        <x-alert></x-alert>
    </div>

    <div class="col-md-12 text-end mb-4">
        <a class="btn btn-success" href="{{ route('socios.cliente.create') }}" title="Crear"><i class="fas fa-user-plus"></i></a>
    </div>

    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <h5>Clientes</h5>
                <table class="table table-sm" id="datatable-responsive">
                    <thead>
                        <tr>
                            <th scope="col" width="40">#</th>
                            <th scope="col">Nombre</th>
                            <th scope="col">Clasificación</th>
                            <th scope="col">Tipo</th>
                            <th scope="col" width="120">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($cliente as $key => $item)
                            <tr class="@if($item->activo == false) table-danger @endif">
                                <td scope="row">{{$key + 1}}</td>
                                <td>{{$item->nombre}} {{$item->apellido}}</td> {{-- Nombre completo --}}
                                <td>{{$item->clasificacion->tipo}}</td>
                                <td>{{$item->tipo_cliente}}</td>
                                <td class="text-center">
                                    <a target="_blank" href="{{route('socios.cliente.show', $item->id)}}" title="Ver cliente" class="mx-0.5"><i class="fas fa-eye fa-lg"></i></a>
                                    <a href="{{route('socios.cliente.edit', $item->id)}}" title="Editar cliente" class="mx-0.5" @if(!$item->activo) style="pointer-events: none; opacity: 0.5;" @endif><i class="fas fa-edit fa-lg"></i></a>
                                    <form id="form{{ $item->id }}" action="{{ route('socios.cliente.destroy', $item->id) }}" method="post" class="d-inline">
                                        @method('DELETE')
                                        @csrf
                                        <a href="#" onclick="if(confirm('¿Desea eliminar el cliente?')) { event.preventDefault(); this.closest('form').submit(); }" title="Eliminar" class="mx-0.5"><i class="fas fa-trash fa-lg" style="color: #f43e3e;"></i></a>
                                    </form>
                                    @if($item->activo)
                                        <a href="{{route('socios.deshabilitarCliente', $item->id)}}" title="Deshabilitar Cliente" class="mx-0.5"><i class="fa-solid fa-ban fa-lg" style="color: #df1111;"></i></a>
                                    @else
                                        <a href="{{route('socios.habilitarCliente', $item->id)}}" title="Habilitar Cliente" class="mx-0.5"><i class="fa-solid fa-check fa-lg" style="color: #28a745;"></i></a>
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
