<x-app-layout>
    <x-slot:title>
        Observaciones
      </x-slot>
      <x-slot:subtitle>
      </x-slot>

    <div class="col-md-12">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">Dasboard</a></li>
            <li class="breadcrumb-item"><a href="{{route('socios.contacto.index')}}">Contactos</a></li>
            <li class="breadcrumb-item active" aria-current="page">Observaciones</li>
          </ol>
    </div>
    <div class="col-md-12">
        <x-alert></x-alert>
    </div>
    
    <form action="{{route('socios.registro.store' ) }}" method="post">
        @csrf
        <div class="row">
            <div class="col-md-12 mt-2 mb-12">
                <label for="socios_registro"> <strong>Observación</strong> </label>
                <textarea name="observacion" class="form-control" requiredcols="30" rows="10"></textarea>
                @error('observacion')
                    {{$message}}
                @enderror
            </div>
            <input type="hidden" name="contacto_id" id="contacto_id" value="{{$contactoId}}">
            <div class="col-md-12 mt-3 mb-3 ">
                <button class="btn btn-success" style="color:aliceblue" type="submit">Guardar</button>
            </div>
            
        </div>
    </form>

    <div class="col-md-12">

        <div class="card">
            <div class="card-body">
                <h5> Observaciones </h5>
                <table class="table table-sm" id="datatable-responsive">
                    <thead>
                        <tr>
                            <th scope="col" width="40">#</th>
                            <th scope="col">Observación</th>
                            <th scope="col">Fecha</th>
                            <th scope="col" width="50" class="text-center"><i class="fas fa-edit"></i></th>
                            <th scope="col" width="50" class="text-center"><i class="fas fa-trash"></i></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($registro as $key => $item)
                            <tr>
                                <th scope="row">{{$key + 1}}</th>
                                <td>{{$item->observacion}}</td>
                                <td>{{$item->created_at}}</td>
                                <td> 
                                    <a href="{{route('socios.registro.edit', $item->id)}}" class="btn btn-warning" title="Editar"><i class="fas fa-edit"></i></a>
                                </td>
                                <td>
                                    <form id="form{{ $item->id }}"
                                        action="{{ route('socios.registro.destroy', $item->id) }}"
                                        method="post">
                                        @method('DELETE')
                                        @csrf
                                        <button
                                            onclick="confirm('form{{ $item->id }}','¿Desea eliminar la observación?')"
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