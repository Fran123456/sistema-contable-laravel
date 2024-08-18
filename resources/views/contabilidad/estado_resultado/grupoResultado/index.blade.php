<x-app-layout>
    <x-slot:title>
    Configuración de contabilidad
    </x-slot>

    <div class="col-md-12">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dasboard</a></li>
            <li class="breadcrumb-item active" aria-current="page"><a href="{{route('contabilidad.utilidades.index')}}">Configuración Estado de resultado</a></li>
            <li class="breadcrumb-item">Grupos</li>
        </ol>
    </div>
    <div class="col-md-12">
        <x-alert></x-alert>
    </div>
    <div class="col-md-12">

        <div class="card">
            <div class="card-body">

                <div class="mt-2 mb-3">
                    <a type="button" title="create" class="mx-0.5 btn btn-success" data-bs-toggle="modal" data-bs-target="#createModal">
                        Agregar nuevo grupo
                    </a>
                    @include('contabilidad.estado_resultado.grupoResultado.create')
                    @include('contabilidad.estado_resultado.grupoResultado.edit')
                </div>
                    
                    <table class="table table-sm" id="datatable-responsive">
                        <thead>
                            <tr>
                                <th scope="col" width="40">#</th>
                                <th scope="col">Grupo</th>                 
                                <th scope="col">Signo</th>                 
                                <th scope="col">Utilida</th>               
                                <th scope="col" class="text-center"><i class="fas fa-edit"></i></th>
                            </tr>
                    </thead>
                    <tbody>
                        @foreach ($grupos as $key => $item)
                        <tr>
                            <th scope="row">{{$key + 1}}</th>
                            <td>{{$item->grupo}}</td>
                            <td>{{$item->signo}}</td>
                            <td>{{$item->utilidad->utilidad}}</td>
                            <td class="text-center">
                                <a type="button" title="Editar" class="mx-0.5 edit-button" data-bs-toggle="modal" data-bs-target="#editModal" id='modalEdit'
                                data-grupo="{{ $item->grupo }}" 
                                data-signo="{{ $item->signo }}" 
                                data-id="{{ $item->id }}"
                                data-utilidad-id="{{ $item->utilidad_id }}">
                                 <i class="fas fa-edit fa-lg"></i>
                             </a>
                                <form id="form{{ $item->id }}"
                                    action="{{ route('contabilidad.grupoResultado.destroy', ['utilidad_id'=>$utilidad_id, $item->id]) }}" method="post"
                                    class="d-inline">
                                    @method('DELETE')
                                    @csrf
                                    <a href="#"
                                        onclick="if(confirm('form{{ $item->id }}','¿Desea eliminar el contacto?')) { event.preventDefault(); this.closest('form').submit(); }"
                                        title="Eliminar" class="mx-0.5"><i class="fas fa-trash fa-lg"
                                            style="color: #f43e3e"></i></a>
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