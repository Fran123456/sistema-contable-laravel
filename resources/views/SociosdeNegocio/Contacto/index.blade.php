<x-app-layout>
    <x-slot:title>
        Lista de contactos
      </x-slot>
      <x-slot:subtitle>
      </x-slot>

    <div class="col-md-12">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">Dasboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Contactos</li>
          </ol>
    </div>
    <div class="col-md-12">
        <x-alert></x-alert>
    </div>

    <div class="col-md-12 text-end mb-4">
        <a class="btn btn-success" href="{{ route('socios.contacto.create') }}" title="Crear"> <i class="fas fa-user-plus"></i> </a>
    </div>

    <div class="col-md-12">

        <div class="card">
            <div class="card-body">
                <h5> Contactos </h5>
                <table class="table table-sm" id="datatable-responsive">
                    <thead>
                        <tr>
                            <th scope="col" width="40">#</th>
                            <th scope="col">Nombre completo</th>
                            <th scope="col">Teléfono</th>
                            <th scope="col">Cargo</th>
                            <th scope="col">Estado</th>
                            <th scope="col" width="160px" >Acciones </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($contactos as $key => $item)
                            <tr>
                            <th scope="row">{{$key + 1}}</th>
                                <td>{{$item->nombre}} {{$item->apellido}}</td> {{-- Nombre completo --}}
                                <td>{{$item->telefono}}</td>
                                <td>{{$item->cargo->cargo}}</td>
                                <td>{{$item->estado}}</td>
                                <td class="text-center">
                                    <a href="{{route('socios.registro.show', $item->id)}}" title="Ver detalles" class="mx-0.5"><i class="fa-solid fa-file-lines fa-lg"></i></a>
                                    <a href="{{ url('/')}}/cv/{{$item->cv}}" target="_blank" title="Descargar CV" class="mx-0.5"><i class="fas fa-file-download fa-lg"></i></a>
                                    <a href="{{route('socios.contacto.show', $item->id)}}" title="Ver contacto" class="mx-0.5"><i class="fas fa-eye fa-lg"></i></a>
                                    <a href="{{route('socios.contacto.edit', $item->id)}}" title="Editar" class="mx-0.5"><i class="fas fa-edit fa-lg"></i></a>
                                    <form id="form{{ $item->id }}" action="{{ route('socios.contacto.destroy', $item->id) }}" method="post" class="d-inline">
                                        @method('DELETE')
                                        @csrf
                                        <a href="#" onclick="if(confirm('form{{ $item->id }}','¿Desea eliminar el contacto?')) { event.preventDefault(); this.closest('form').submit(); }" title="Eliminar" class="mx-0.5"><i class="fas fa-trash fa-lg" style="color: #f43e3e"></i></a>
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
