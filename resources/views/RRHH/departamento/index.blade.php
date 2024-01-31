<x-app-layout>
    <x-slot:title>
        Lista de departamentos
      </x-slot>
      <x-slot:subtitle>
      </x-slot>

    <div class="col-md-12">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">Dasboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Departamentos</li>
          </ol>
    </div>
    <div class="col-md-12">
        <x-alert></x-alert>
    </div>
    
    <div class="col-md-12 text-end mt-2 mb-2">
        <!-- Button trigger modal -->
        <a style="color: white" type="button" class="btn btn-primary" href="{{ route('rrhh.departamento.create') }}">
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
                            <th scope="col" width="90">Departamento</th>
                            <th scope="col" width="90">Area</th>
                            <th scope="col" width="50" class="text-center">Acciones</th>
                            <th scope="col" width="50" class="text-center"><i class="fas fa-trash"></i></th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach ($departamentos as $key => $item)
                        <tr>
                            <th scope="row">{{$key + 1}}</th>
                            <td>{{ $item->departamento }}</td>
                            <td>{{ $item->area->area}}</td>
                            <td class="text-center"> 
                                <a href="{{route('rrhh.departamento.edit', $item->id)}}"><i class="fa-solid fa-file-pen fa-2x"></i></a>
                            </td>
                            <td class="text-center">
                                    <button
                                        onclick="confirm('form','¿Desea eliminar el area?')"
                                        class="btn btn-danger"
                                        type="button"><i class="fas fa-trash"></i></button>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </div>

</x-app-layout>