<x-app-layout>
    <x-slot:title>
    Configuración de contabilidad
    </x-slot>

    <div class="col-md-12">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dasboard</a></li>
            <li class="breadcrumb-item active" aria-current="page"><a href="{{route('contabilidad.utilidades.index')}}">Configuración Estado de resultado</a></li>
            <li class="breadcrumb-item"><a href="{{route('contabilidad.grupoResultado.index', ['utilidad_id' => $utilidad_id])}}">Grupos de {{$utilidadSeleccionada->utilidad}}</a></li>
            <li class="breadcrumb-item">Sub grupos de {{$grupo->grupo}}</li>
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
                        Agregar nuevo sub grupo
                    </a>
                    @include('contabilidad.estado_resultado.subGrupoResultado.create')
                    @include('contabilidad.estado_resultado.subGrupoResultado.edit')
                </div>
                    
                    <table class="table table-sm" id="datatable-responsive">
                        <thead>
                            <tr>
                                <th scope="col" width="40">#</th>
                                <th scope="col">Sub grupo</th>                 
                                <th scope="col">Grupo</th>                 
                                <th scope="col">Utilida</th>               
                                <th scope="col" class="text-center">Acciones</th>
                            </tr>
                    </thead>
                    <tbody>
                        @foreach ($subGrupos as $key => $item)
                        <tr>
                            <th scope="row">{{$key + 1}}</th>
                            <td>{{$item->sub_grupo}}</td>
                            <td>{{$item->grupo->grupo}}</td>
                            <td>{{$item->utilidad->utilidad}}</td>
                            <td class="text-center">
                                <a type="button" title="Editar" class="mx-0.5 p-2 edit-button" data-bs-toggle="modal" data-bs-target="#editModal" id='modalEdit'
                                data-sub_grupo="{{ $item->sub_grupo }}" 
                                data-grupo_id="{{ $item->grupo_id }}" 
                                data-id="{{ $item->id }}"
                                data-utilidad-id="{{ $item->utilidad_id }}">
                                 <i class="fas fa-edit fa-lg"></i>
                                </a>
                                <a type="button" title="cuentas asociadas" class="mx-0.5 p-1" href="{{ route('contabilidad.cuentaResultado.index', ['utilidad_id' => $utilidad_id, 'grupo_id'=> $grupo_id, $item->id])}}">
                                    <i class="fas fa-file-invoice"></i>
                                </a>
                                <form id="form{{ $item->id }}"
                                    action="{{ route('contabilidad.subGrupoResultado.destroy', ['utilidad_id'=>$utilidad_id,'grupo_id'=>$grupo_id, $item->id]) }}" method="post"
                                    class="d-inline">
                                    @method('DELETE')
                                    @csrf
                                    <a href="#"
                                        onclick="if(confirm('form{{ $item->id }}','¿Desea eliminar el sub grupo?')) { event.preventDefault(); this.closest('form').submit(); }"
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