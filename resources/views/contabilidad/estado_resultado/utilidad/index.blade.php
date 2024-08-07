<x-app-layout>
    <x-slot:title>
    Configuración de contabilidad
    </x-slot>

    <div class="col-md-12">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dasboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Configuración Estado de resultado</li>
        </ol>
    </div>
    <div class="col-md-12">
        <x-alert></x-alert>
    </div>
    <div class="col-md-12">

        <div class="card">
            <div class="card-body">

                <div class="mt-2 mb-3">
                    @include('contabilidad.estado_resultado.utilidad.create')
                    @include('contabilidad.estado_resultado.utilidad.edit')
                </div>
                    
                    <table class="table table-sm" id="datatable-responsive">
                        <thead>
                            <tr>
                                <th scope="col" width="40">#</th>
                                <th scope="col">Utilidad</th>                 
                                <th scope="col" class="text-center"><i class="fas fa-edit"></i></th>
                            </tr>
                    </thead>
                    <tbody>
                        @foreach ($utilidades as $key => $item)
                        <tr>
                            <th scope="row">{{$key + 1}}</th>
                            <td>{{$item->utilidad}}</td>
                            <td class="text-center">
                                <a type="button" class="mx-0.5 edit-btn" data-id="{{ $item->id }}" data-bs-toggle="modal" data-bs-target="#editModal">
                                    <i class="fas fa-edit fa-lg"></i>
                                </a>
                                <form id="form{{ $item->id }}"
                                    action="{{ route('contabilidad.utilidades.destroy', $item->id) }}" method="post"
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