<x-app-layout>
    <x-slot:title>
    Configuración de contabilidad
    </x-slot>

    <div class="col-md-12">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dasboard</a></li>
            <li class="breadcrumb-item active" aria-current="page"><a href="{{route('contabilidad.utilidades.index')}}">Configuración Estado de resultado</a></li>
            <li class="breadcrumb-item">Operaciones de {{$utilidadSeleccionada->utilidad}}</li>
        </ol>
    </div>
    <div class="col-md-12">
        <x-alert></x-alert>
    </div>
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">

                <div class="mt-2 mb-3">
                     <a type="button" title="Editar" class="mx-0.5 btn btn-success" data-bs-toggle="modal" data-bs-target="#createModal">
                        Agregar nueva operación
                    </a>
                    @include('contabilidad.estado_resultado.utilidadOperaciones.create')
                </div>
                    
                    <table class="table table-sm" id="datatable-responsive">
                        <thead>
                            <tr>
                                <th scope="col" width="40">#</th>
                                <th scope="col">Utilidad</th>    
                                <th scope="col">Operacion</th>    
                                <th scope="col">signo</th>    
                                <th scope="col" class="text-center">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($utilidadOperaciones as $key => $item)
                            <tr>
                                <th scope="row">{{$key + 1}}</th>
                                <td>{{$item->utilidad->utilidad}}</td>
                                <td>{{$item->utilidadOperacion->utilidad}}</td>
                                <td>{{$item->signo}}</td>
                                <td class="text-center">
                                    <form id="form{{ $item->id }}"
                                        action="{{ route('contabilidad.utilidadOperaciones.destroy', ['utilidad_id'=>$utilidad_id,$item->id]) }}" method="post"
                                        class="d-inline">
                                        @method('DELETE')
                                        @csrf
                                        <a href="#"
                                            onclick="if(confirm('form{{ $item->id }}','¿Desea eliminar la operación?')) { event.preventDefault(); this.closest('form').submit(); }"
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