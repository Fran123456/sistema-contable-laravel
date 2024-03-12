<x-app-layout>
    <x-slot:title>
        Clasificacion de clientes
      </x-slot>
      <x-slot:subtitle>
      </x-slot>

    <div class="col-md-12">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">Dasboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Clasificacion de clientes</li>
          </ol>
    </div>
    <div class="col-md-12">
        <x-alert></x-alert>
    </div>
    {{-- Crear el tipo de cliente --}}
    <div class="col-md-12">
        <form action="{{route('socios.clasificacion.store') }}" method="post">
            @csrf
            <div class="row">
                <div class="col-md-6 mt-2">
                    <label for="socios_clasificacion"> <strong>Tipo de cliente</strong> </label>
                    <input type="text" name="tipo" class="form-control" required>
                    @error('tipo')
                        {{$message}}
                    @enderror
                </div>
                <div class="col-md-6 mt-2">
                    <label for="socios_descripcion"> <strong>Descripción</strong> </label>
                    <input type="text" name="descripcion" class="form-control">
                </div>
                <div class="col-md-12 mb-3 mt-3">
                    <button class="btn btn-primary mb-2" style="color:white;" type="submit"> <i class="fas fa-save"></i>
                    </button>
                </div>
            </div>
        </form>
    </div>

    <div class="col-md-12">

        <div class="card">
            <div class="card-body">
                <h5> Clasificacion de clientes</h5>
                <table class="table table-sm" id="datatable-responsive">
                    <thead>
                        <tr>
                            <th scope="col" width="40">#</th>
                            <th scope="col">Tipo de cliente</th>
                            <th scope="col">Descripción</th>
                            <th scope="col" width="50" class="text-center"><i class="fas fa-edit"></i></th>
                            <th scope="col" width="50" class="text-center"><i class="fas fa-trash"></i></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($tipos as $key => $item)
                            <tr>
                                <th scope="row">{{$key + 1}}</th>
                                <td>{{$item->tipo}}</td>
                                <td>{{$item->descripcion}}</td>
                                <td> 
                                    <a href="{{route('socios.clasificacion.edit', $item->id)}}" class="btn btn-warning" title="Editar"><i class="fas fa-edit"></i></a>
                                </td>
                                <td>
                                    <form id="form{{ $item->id }}"
                                        action="{{ route('socios.clasificacion.destroy', $item->id) }}"
                                        method="post">
                                        @method('DELETE')
                                        @csrf
                                        <button
                                            onclick="confirm('form{{ $item->id }}','¿Desea eliminar el tipo de cliente?')"
                                            class="btn btn-danger"
                                            type="button" title="Eliminar"><i class="fas fa-trash"></i></button>
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