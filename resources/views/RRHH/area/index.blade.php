<x-app-layout>
    <x-slot:title>
        Lista de areas
      </x-slot>
      <x-slot:subtitle>
      </x-slot>

    <div class="col-md-12">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">Dasboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Areas</li>
          </ol>
    </div>
    <div class="col-md-12">
        <x-alert></x-alert>
    </div>
    
    <div class="col-md-12 text-end mt-2 mb-2">
        <!-- Button trigger modal -->
        <a style="color: white" type="button" class="btn btn-primary" href="{{ route('rrhh.area.create') }}">
            <i class="fas fa-save"></i>
        </a>

    </div>

    <div class="col-md-12">

        <div class="card">
            <div class="card-body">
                <h5>Areas</h5>
                <table class="table table-sm" id="datatable-responsive">
                    <thead>
                        <tr>
                            <th scope="col" width="40">#</th>
                            <th scope="col" width="90">Area</th>
                            <th scope="col" width="90">Empresa</th>
                            <th scope="col" width="40">Activo</th>
                            {{-- <th scope="col" width="50" class="text-center">Editar</th> --}}
                            <th width="50" class="text-center" scope="col"><i
                                class="fas fa-edit"></i></th>
                            <th scope="col" width="50" class="text-center"><i class="fas fa-trash"></i></th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach ($areas as $key => $area)
                        <tr>
                            <th scope="row">{{$key + 1}}</th>
                            <td>{{ $area->area }}</td>
                            {{-- Mostramos el nombre de la empresa.
                                1 parametro es de la función del Modelo
                                2 parametro es el nombre en la bbdd --}}
                            <td> {{$area->empresa->empresa}}</td>
                            <td>
                                @if ($area->activo)
                                    Activo
                                @else
                                    Inactivo
                                @endif
                            </td>
                            <td class="text-center">
                                <a href="{{ route('rrhh.area.edit', $area->id)}}" class="btn btn-warning"> <i class="fas fa-edit"></i> </a>
                            </td>
                            <td class="text-center">
                                <form id="form{{ $area->id }}"
                                    action="{{ route('rrhh.area.destroy', $area->id) }}"
                                    method="post">
                                    @method('DELETE')
                                    @csrf
                                    <button
                                        onclick="confirm('form{{ $area->id }}','¿Desea eliminar el area?')"
                                        class="btn btn-danger"
                                        type="button"><i class="fas fa-trash"></i></button>
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