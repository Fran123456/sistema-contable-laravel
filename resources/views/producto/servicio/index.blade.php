<x-app-layout>
    <x-slot:title>
        Lista de servicios
      </x-slot>
      <x-slot:subtitle>
      </x-slot>

    <div class="col-md-12">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dasboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Servicios</li>
          </ol>
    </div>
    <div class="col-md-12">
        <x-alert></x-alert>
    </div>
    
    <div class="col-md-12 text-end mb-4">
        <a class="btn btn-success" href="{{route('producto.servicio.create')}}" title="Crear"> <i class="fas fa-save"></i> </a>
    </div>

    <div class="col-md-12">

        <div class="card">
            <div class="card-body">
                <h5> Servicios </h5>
                <table class="table table-sm" id="datatable-responsive">
                    <thead>
                        <tr>
                            <th scope="col" width="40">#</th>
                            <th scope="col">Codigo</th>
                            <th scope="col">Nombre</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($servicios as $key => $item)
                            <tr >
                                <th scope="row">{{$key + 1}}</th>
                                <td>{{$item->codigo}}</td>
                                <td>{{$item->nombre}}</td>
                                <td class="text-center">
                                    <a href="{{ route('producto.servicio.show', $item->id) }}" title="Ver contacto"
                                        class="mx-0.5"><i class="fas fa-eye fa-lg"></i></a>
                                    <a href="{{ route('producto.servicio.edit', $item->id) }}" title="Editar"
                                        class="mx-0.5"><i class="fas fa-edit fa-lg"></i></a>
                                    <form id="form{{ $item->id }}"
                                        action="{{ route('producto.servicio.destroy', $item->id) }}" method="post"
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