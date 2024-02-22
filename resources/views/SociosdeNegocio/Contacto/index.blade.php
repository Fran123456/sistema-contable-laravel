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
                            <th scope="col" width="50">Observaciones </th>
                            <th scope="col" width="50" class="text-center">CV</th>
                            <th scope="col" width="50" class="text-center"><i class="fas fa-eye"></i></th>
                            <th scope="col" width="50" class="text-center"><i class="fas fa-edit"></i></th>
                            <th scope="col" width="50" class="text-center"><i class="fas fa-trash"></i></th>
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
                                <td class="text-center"><a href="" class="btn btn-secondary"><i class="fa-solid fa-file-lines"></i></a></td>
                                <td> <a href="{{ Storage::url($item->cv) }}" target="_blank" class="btn btn-success" title="Descargar"> <i class="fa-solid fa-download"></i> </a> </td>
                                <td><a href="" class="btn btn-success" title="Ver contacto"><i class="fas fa-eye"></i></a></td>
                                <td><a href="" class="btn btn-warning" title="Editar"><i class="fas fa-edit"></i></a></td>
                                <td><a href="" class="btn btn-danger" title="Eliminar"><i class="fas fa-trash"></i></a></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </div>

</x-app-layout>